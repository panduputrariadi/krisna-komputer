<?php

use App\Http\Controllers\AdminDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ComplainController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SeriesProductController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use Symfony\Component\Mime\MessageConverter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authentication'])->middleware('guest');
Route::post('register', [UserController::class, 'signUp']);
Route::get('register', function(){
    return view('Auth.Register');
});

Route::middleware(['auth.check'])->group(function(){
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::get('/', [UserController::class, 'customerDashboard'])->name('Krisna-Komputer');

    Route::get('adminDashboard', [AdminDashboardController::class, 'statistic'])->name('adminDashboard');

    //product routes
    Route::get('product', [ProductController::class, 'toPageProduct']);
    Route::post('product', [ProductController::class, 'saveproduct']);
    Route::get('updateProduct/{id}', [ProductController::class, 'toPgaeUpdate']);
    Route::put('product/{id}', [ProductController::class, 'updateProduct']);
    Route::get('product/{id}', [ProductController::class, 'deleteProduct']);

    // Category Routes
    Route::get('category', [CategoryController::class, 'toPageCategory']);
    Route::post('category', [CategoryController::class, 'saveCategory']);
    Route::put('category/{id}', [CategoryController::class, 'editCategory']);
    Route::get('category/{id}', [CategoryController::class, 'deleteCategory']);

    // Series Product Routes
    Route::get('SeriesProduct', [SeriesProductController::class, 'toPageSeriesProduct']);
    Route::post('SeriesProduct', [SeriesProductController::class, 'saveSeries']);
    Route::put('SeriesProduct/{id}', [SeriesProductController::class, 'updateSeries']);
    Route::get('SeriesProduct/{id}', [SeriesProductController::class, 'deleteSeries']);

    //Route Transaction
    Route::get('transaction', [CashierController::class, 'transaction'])->name('transaction');
    Route::get('completeTransaction', [CashierController::class, 'customerHistory']);
    Route::get('reportTransaction', [CashierController::class, 'generateTranactionHistory']);
    Route::put('markAsInvalid/{id}', [CashierController::class, 'markAsInvalid']);
    Route::put('transaction/{id}', [CashierController::class, 'checkCustomerSubtantion']);

    //admin chatting route
    Route::get('inbox', [MessageController::class, 'readMessageCustomer'])->name('inbox');
    Route::get('readNewMessagesCustomer', [MessageController::class, 'readNewMessagesCustomer'])->name('readNewMessagesCustomer');
    Route::post('/message/send', [MessageController::class, 'sendMessageToCustomer'])->name('message.sendMessageToCustomer');

    //Customer Route
    Route::get('detailProduct/{id}', [ProductController::class, 'showDetailProductToCustomer'])->name('detailProduct');

    Route::post('/customerItem/{id}', [CashierController::class, 'customerItem'])->name('customerItem');
    Route::get('/chart', [CashierController::class, 'toCustomerChart'])->name('chart');
    Route::get('chart/{id}', [CashierController::class, 'deleteChart']);

    Route::get('/checkout', [CashierController::class, 'customerCheckout'])->name('checkout');
    Route::get('trackingItem', [CashierController::class, 'checkCustomerItem'])->name('trackingItem');

    Route::get('/profile', [UserController::class, 'ToPageProfile'])->name('profile');
    Route::put('/profileUpdate', [UserController::class, 'updateProfile'])->name('profileUpdate');
    Route::post('/uploadPayment/{id}', [CashierController::class, 'uploadPayment']);

    Route::get('/categoryProduct/{id}', [CategoryController::class, 'productWithCategory']);

    //Route Chatting Customer
    Route::get('message', [MessageController::class, 'readMessageAdmin'])->name('message');
    Route::post('message/sendMessage', [MessageController::class, 'sendMessageToAdmin'])->name('message.sendMessage');
    Route::get('message/getNewMessages', [MessageController::class, 'getNewMessages'])->name('getNewMessages');

    //Route Complain
    Route::get('complain', [ComplainController::class, 'pageComplain'])->name('complain');
    Route::post('complain/{id}', [ComplainController::class, 'createComplain']);
});


