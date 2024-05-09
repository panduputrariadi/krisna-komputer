<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\SeriesProduct;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\ValidationException;

class SeriesProductController extends Controller
{
    public function toPageSeriesProduct()
    {
        $series = SeriesProduct::simplePaginate(5);
        $status = Cashier::COMPLETE;

        $count = Cashier::with('product')->where('status', $status)
        ->sum('total');
        $countItems = Product::sum('stok');
        return view('Admin.AdminSeriesProduct', compact('series', 'count', 'countItems'));
    }

    public function saveSeries(Request $request)
    {
        try{
            $validated = $request->validate([
                'seri' => 'required|unique:series_products,seri|string',
                'deskripsi' => 'required|string'
            ]);

            $series = SeriesProduct::create($request->all());
            Alert::success('success', 'Success Add New Series Product');
            return redirect('SeriesProduct')->with('success', 'Success Add New Series Product');
        } catch(ValidationException $e){
            $errors = $e->errors();
            foreach ($errors as $field => $errorMessages) {
                foreach ($errorMessages as $errorMessage) {
                    Alert::error('Error', $errorMessage);
                }
            }

            return redirect()->back()->withInput();
        }
    }

    public function updateSeries(Request $request, $id)
    {

        $series = SeriesProduct::findOrFail($id);
        $request->validate([
            'seri' => 'nullable|string',
            'deskripsi' => 'nullable|string'
        ]);

        $series->update($request->all());
        Alert::success('success', 'Success Edit Series Product');
        return redirect('SeriesProduct');
    }

    public function deleteSeries($id)
    {
        $series = SeriesProduct::findOrFail($id);
        $series->delete();
        return redirect('SeriesProduct');
    }

    public function contoh(){
        $katgori = Category::with('product')->get();
    }
}
