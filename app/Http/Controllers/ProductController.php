<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Photo;
use App\Models\Cashier;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SeriesProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{

    public function toPageProduct(Request $request)
    {
        $keyword = $request->keyword;

        $product = Product::with('seriesproduct', 'category')
            ->where('nama', 'LIKE', '%' . $keyword . '%')
            ->orWhereHas('seriesproduct', function ($query) use ($keyword) {
                $query->where('seri',  'LIKE', '%' . $keyword . '%');
            })->orWhereHas('category', function ($query) use ($keyword) {
                $query->where('kategori',  'LIKE', '%' . $keyword . '%');
            })->orWhere('stok', 'LIKE', '%' . $keyword . '%')->orWhere('harga', 'LIKE', '%' . $keyword . '%')
            ->simplePaginate(5);
        $category = Category::all();
        $series = SeriesProduct::all();

        $status = Cashier::COMPLETE;

        $count = Cashier::with('product')->where('status', $status)
            ->sum('total');
        $countItems = Product::sum('stok');
        return view('Admin.AdminProduct', compact('product', 'category', 'series', 'count', 'countItems'));
    }

    public function saveproduct(Request $request)
    {
        try{
            if (!$request->filled('nama', 'categories_id', 'harga', 'stok', 'series_products_id')) {
                Alert::info('info', 'Anda harus mengisi semua formulir yang telah disediakan');
                return redirect('product');
            }

            $validated = $request->validate([
                'nama' => 'required|string',
                'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif',
                'series_products_id' => 'required|unique:products,series_products_id',
                'categories_id' => 'required',
                'harga' => 'required|string',
                'stok' => 'required|string',
            ]);

            $product = Product::create($validated);

            if ($request->hasFile('photos')) {
                $photos = [];
                foreach ($request->file('photos') as $photoFile) {
                    $extension = $photoFile->getClientOriginalExtension();
                    $newName = $product->nama . '-' . $product->seriesproduct->seri . '-' . '-' . uniqid() . '.' . $extension; // Unique name for each photo
                    $path = $photoFile->storeAs('photo', $newName);
                    $photoId = Str::ulid();
                    $photos[] = [
                        'id' => $photoId,
                        'product_id' => $product->id,
                        'path' => $path,
                    ];
                }
                Photo::insert($photos);
            }
            Alert::success('success', 'Successfully Add New Product');
            return redirect('product');
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

    public function updateProduct(Request $request, $id)
    {

        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'nullable|string',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'series_products_id' => 'nullable|exists:series_products,id',
            'categories_id' => 'nullable|exists:categories,id',
            'harga' => 'nullable|string',
            'stok' => 'nullable|string',
        ]);
        $product->update($validated);

        // Update photos
        if ($request->hasFile('photos')) {
            $photos = [];
            foreach ($request->file('photos') as $photoFile) {
                $extension = $photoFile->getClientOriginalExtension();
                $newName = 'Update ' . $product->nama . '-' . $product->seriesproduct->seri . '-' . '-' . uniqid() . '.' . $extension; // Unique name for each photo
                $path = $photoFile->storeAs('photo', $newName);
                $photoId = Str::ulid();
                $photos[] = [
                    'id' => $photoId,
                    'product_id' => $product->id,
                    'path' => $path,
                ];
            }

            if ($photos) {
                $oldPhotos = $product->photo;
                foreach ($oldPhotos as $oldPhoto) {
                    Storage::delete($oldPhoto->path);
                }
                Photo::where('product_id', $product->id)->delete();
                Photo::insert($photos);
            }
        }

        Alert::success('success', 'Successfully Update Product');
        return redirect('product');
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect('product');
    }

    public function showDetailProductToCustomer($id)
    {
        $product = Product::findOrFail($id);
        $category = Category::all();
        $chart = Cashier::all();
        return view('User.CustomerDetailProduct', compact('product', 'category', 'chart'));
    }
}
