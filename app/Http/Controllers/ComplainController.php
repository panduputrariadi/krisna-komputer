<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Cashier;
use App\Models\Complain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ComplainController extends Controller
{
    public function pageComplain(){
        $complain = Complain::with('user', 'cashier')->where('customer',auth()->user()->id)->get();
        $chart = Cashier::with('product', 'user')->get();

        return view('User.CustomerComplain', compact('complain', 'chart'));
    }

    public function createComplain(Request $request, $id){
        try{
            DB::beginTransaction();
            $validate = $request->validate([
                'kontenKomplain' => 'nullable|string',
            ]);
            $customer = Auth::user();
            $cashier = Cashier::findOrFail($id);

            $complain = Complain::create([
                'customer' => $customer->id,
                'productComplain' => $cashier->id,
                'kontenKomplain' => $request->kontenKomplain,
            ]);

            DB::commit();

            return redirect('complain');
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

}
