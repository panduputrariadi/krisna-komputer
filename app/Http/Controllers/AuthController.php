<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Cashier;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{

    public function login()
    {
        $product = Product::with('seriesproduct', 'category', 'photo')->get();
        $categories = Category::withCount(['product as total_products' => function ($query) {
            $query->select(DB::raw("COUNT(*)"));
        }])->get();
        $cashier = Cashier::all();
        return view('auth.login', compact('product', 'categories', 'cashier'));
    }

    public function register()
    {
        $register = User::with('roles');
        return view('auth.register');
    }

    public function authentication(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            Alert::toast('Selamat datang dan selamat belanja!', 'success')->position('top-end');

            return redirect()->intended('/');
        }

        Alert::error('Error', 'Username and Password are Wrong!');

        return redirect('/login');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
