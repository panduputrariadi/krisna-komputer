<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Cashier;
use App\Models\NewUser;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

    public function customerDashboard(){
        $product = Product::with('seriesproduct', 'category', 'photo')->get();
        $categories = Category::withCount(['product as total_products' => function ($query) {
            $query->select(DB::raw("COUNT(*)"));
        }])->get();
        $chart = Cashier::all();
        return view('User.CustomerDashboard', compact('product', 'categories', 'chart'));
    }

    public function ToPageProfile(Request $request)
    {
        $user = Auth::user();
        $chart = Cashier::all();
        return view('User.CustomerProfile', compact('user', 'chart'));
    }

    public function signUp(Request $request){
        try {
            $validated = $request->validate([
                'name' => 'string|nullable',
                'email' => 'string|required|email|unique:users,email',
                'password' => 'string|required|min:6|unique:users,password',
                'no_hp' => 'string|nullable',
                'alamat' => 'string|nullable',
                'photo' => 'file|nullable',
                'role_id' => 'nullable|exists:roles,id'
            ]);

            $validated['password'] = Hash::make($validated['password']);
            $validated['role_id'] = 2;

            $user = User::create($validated);
            Alert::success('success', 'Berhasil mendaftarkan akun anda');
            return redirect('login');
        } catch (ValidationException $e) {
            $errors = $e->errors();
            foreach ($errors as $field => $errorMessages) {
                foreach ($errorMessages as $errorMessage) {
                    Alert::error('Error', $errorMessage);
                }
            }

            return redirect()->back()->withInput();
        }
    }


    public function SaveUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string',
            'photo' => 'nullable|string',
            'role_id' => 'required',
            'password' => 'required|string',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($request->all());
        Alert::success('success', 'Success Created User');
        return redirect('user');
    }

    public function updateProfile(Request $request){
        try{
            $user = NewUser::find(Auth::id());
            $validated = $request->validate([
                'name' => 'nullable|string',
                'email' => 'nullable|unique:users,email|email',
                'alamat' => 'nullable|string',
                'no_hp' => 'nullable|string',
                'photo' => 'nullable|file',
            ]);

            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $extension = $photo->getClientOriginalExtension();
                $loggedInUsername = auth()->user()->name;
                $newName = $loggedInUsername . '-' . now()->timestamp . '.' . $extension;
                $photoPath = $photo->storeAs('photo', $newName, 'public');
                $validated['photo'] = $photoPath;
            }
            $user->update($validated);

            Alert::success('Success', 'Your profile has been updated.');
            return redirect()->route('profile');
        } catch (ValidationException $e) {
            $errors = $e->errors();
            foreach ($errors as $field => $errorMessages) {
                foreach ($errorMessages as $errorMessage) {
                    Alert::error('Error', $errorMessage);
                }
            }

            return redirect()->back()->withInput();
        }
    }

    public function deleteUser($id){
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('user');
    }
}
