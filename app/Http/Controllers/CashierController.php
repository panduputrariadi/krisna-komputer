<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Cashier;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Jobs\ChangeStatusJob;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendEmailNotificationJob;
use RealRashid\SweetAlert\Facades\Alert;
use App\Mail\sendNotificationToCheckingCustomerPayment;

class CashierController extends Controller
{
    protected $adminDashboardController;

    public function __construct(AdminDashboardController $adminDashboardController)
    {
        $this->adminDashboardController = $adminDashboardController;
    }

    public function customerItem(Request $request, $id)
    {
        $request->validate([
            'jumlah' => "required"
        ]);

        try {
            DB::beginTransaction();
            $product = Product::where('id', $id)->firstOrFail();
            $quantity = $request->jumlah;
            $total = $quantity * $product->harga;

            $transactionData = [
                'product_id' => $id,
                'user_id' => auth()->user()->id,
                'jumlah' => $quantity,
                'total' => $total,
                'status' => Cashier::UPLOAD_YOUR_PROOF_PAYMET,
            ];

            $transaction = Cashier::create($transactionData);
            if (!$transaction->product) {
                $transaction->product()->associate($product);
                $transaction->save();
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return redirect('chart');
    }

    public function uploadPayment(Request $request, $id)
    {

        $upload = Cashier::findOrFail($id);
        $request->validate([
            'photo' => 'nullable|image',
            'keterangan' => 'nullable|string'
        ]);
        ChangeStatusJob::dispatch($upload)->onQueue('status');

        $upload->status = Cashier::CHECKING;

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $extension = $photo->getClientOriginalExtension();
            $loggedInUsername = auth()->user()->name;
            $newName = $loggedInUsername . '-' . 'Bukti Pembayaran' .now()->timestamp . '.' . $extension;
            $photo->storeAs('photo', $newName, 'public');
            $upload->photo = $newName;
        }
        Alert::success('Berhasil', 'Pembelian akan diverifikasi secepatnya, silahkan lihat prosesnya pada bagian halaman Pembelian');
        $upload->keterangan = $request->input('keterangan');

        $upload->save();
        SendEmailNotificationJob::dispatch($upload)->onQueue('emails')->delay(now()->addMinutes(1));
        return redirect('chart');
    }

    public function checkCustomerSubtantion($id, Request $request)
    {
        DB::beginTransaction();

        try {
            $cashier = Cashier::findOrFail($id);

            $request->validate([
                'status' => 'nullable'
            ]);

            $cashier->status = Cashier::COMPLETE;
            $cashier->save();

            $product = $cashier->product;
            $quantity = $cashier->jumlah;

            $product->stok -= $quantity;
            $product->save();

            DB::commit();
            Alert::success('Berhasil', 'Berhasil Update Status, Silahkan Packing Barang pesanan');
            return redirect('transaction');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Terjadi kesalahan saat memproses transaksi. Silahkan coba lagi.');
            return redirect()->back();
        }
    }

    public function markAsInvalid($id, Request $request)
    {
        DB::beginTransaction();

        try {
            $cashier = Cashier::findOrFail($id);

            $request->validate([
                'status' => 'nullable'
            ]);

            $cashier->status = Cashier::INVALID;
            $cashier->save();

            DB::commit();
            Alert::success('Berhasil', 'Berhasil Update Status ditandai sebagai Invalid');
            return redirect('transaction');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Terjadi kesalahan saat memproses transaksi. Silahkan coba lagi.');
            return redirect()->back();
        }
    }

    public function checkCustomerItem()
    {
        $chart = Cashier::with('product')->where('user_id', auth()->user()->id)->get();
        return view('User.CustomerTrackingItem', compact('chart'));
    }

    public function toCustomerChart()
    {
        $status = Cashier::UPLOAD_YOUR_PROOF_PAYMET;
        $invalid = Cashier::INVALID;
        $chart = Cashier::with('product')
            ->where('user_id', auth()->user()->id)->where(function ($query) use ($status, $invalid) {
                $query->where('status', $status)
                    ->orWhere('status', $invalid);
            })
            ->get();

        $subtotal = $chart->sum('total');
        $total = $subtotal;

        return view('User.CustomerChart', compact('chart', 'subtotal', 'total'));
    }

    public function customerCheckout()
    {
        $status = Cashier::UPLOAD_YOUR_PROOF_PAYMET;
        $invalid = Cashier::INVALID;
        $chart = Cashier::with('product')
            ->where('user_id', auth()->user()->id)
            ->where(function ($query) use ($status, $invalid) {
                $query->where('status', $status)
                    ->orWhere('status', $invalid);
            })
            ->get();
        // $category = Category::all();
        return view('User.CustomerCheckout', ['chart' => $chart]);
    }

    public function transaction()
    {
        $cashier = Cashier::with('product', 'user')->where('status', '!=', 'berhasil')->get();
        $status = Cashier::COMPLETE;

        $count = Cashier::with('product')->where('status', $status)
            ->sum('total');
        $countItems = Product::sum('stok');
        return view('Admin.AdminCashier', compact('cashier', 'count', 'countItems'));
    }

    public function customerHistory(Request $request)
    {
        $keyword = $request->keyword;
        $status = Cashier::COMPLETE;

        $cashier = Cashier::with('product', 'user')->where('status', $status)
            ->where('updated_at', 'LIKE', '%' . $keyword . '%')
            ->get();

        $count = Cashier::with('product')->where('status', $status)
            ->sum('total');
        $countItems = Product::sum('stok');
        return view('Admin.AdminCustomerHistory', compact('cashier', 'count', 'countItems'));
    }

    public function generateTranactionHistory()
    {
        $endDate = Carbon::now()->endOfMonth();
        $startDate = Carbon::now()->startOfMonth();
        $printDate = Carbon::now();

        $status = Cashier::COMPLETE;
        $cashier = Cashier::with('product', 'user')->where('status', $status)
            // ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        $pdf =  PDF::loadView('PDF.ReportHistoryTransaction', compact('cashier', 'startDate', 'endDate', 'printDate'));
        return $pdf->download('LaporanPembelian.pdf');

        // return view('PDF.ReportHistoryTransaction', compact('cashier' , 'startDate', 'endDate'));
    }

    public function deleteChart($id, Request $request)
    {
        $chart = Cashier::findOrFail($id);
        $chart->delete();

        return redirect('chart');
    }

    protected function sendEmailNotification(Cashier $cashier)
    {
        $adminEmail = 'put.rariadi1144@gmail.com';

        dispatch(function () use ($adminEmail, $cashier) {
            $user = auth()->user();
            Mail::to($adminEmail)->send(new sendNotificationToCheckingCustomerPayment($user, $cashier));
        })->onQueue('emails')->delay(now()->addMinutes(1));
    }
}
