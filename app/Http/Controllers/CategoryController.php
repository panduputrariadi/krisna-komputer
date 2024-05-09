<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    public function toPageCategory()
    {
        $category = Category::simplePaginate(5);
        $status = Cashier::COMPLETE;

        $count = Cashier::with('product')->where('status', $status)
        ->sum('total');
        $countItems = Product::sum('stok');
        return view('Admin.AdminCategories', compact('category', 'countItems', 'count'));
    }

    public function saveCategory(Request $request)
    {
        try{
            $validated = $request->validate([
                'kategori' => 'required|unique:categories,kategori|string'
            ]);

            $category = Category::create($request->all());
            Alert::success('success', 'Successfully Add New Category');
            return redirect('category')->with('success', 'Successfully Add New Category');
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

    public function editCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $request->validate([
            'kategori' => 'nullable|string'
        ]);
        $category->update($request->all());
        Alert::success('success', 'Successfully Update Category');
        return redirect('category')->with('success', 'Successfully Update Category');
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect('category');
    }

    public function productWithCategory($ulid){
        $category = Category::findOrFail($ulid);
        $product = $category->product()->with(['photo', 'seriesproduct'])->get();
        $chart = Cashier::all();

        return view('User.CustomerCategoryProduct', compact('category', 'chart', 'product'));
    }

}
