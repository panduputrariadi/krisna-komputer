<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
use App\Models\Product;

class AdminDashboardController extends Controller
{
    public function statistic()
    {
        $status = Cashier::COMPLETE;
        $count = Cashier::with('product')->where('status', $status)
        ->sum('total');

        $countItems = Product::sum('stok');

        return view('Admin.AdminDashboard', compact('count', 'countItems'));
    }
}
