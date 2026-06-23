<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Supplier;

class DashboardController extends Controller
{
    public function index() {
        $totalItems = Item::count();
        $totalCategories = Category::count();
        $totalSuppliers = Supplier::count();
        $lowStockItems = Item::where('stock', '<=', 5)->get(); // Alert stok menipis

        return view('dashboard', compact('totalItems', 'totalCategories', 'totalSuppliers', 'lowStockItems'));
    }
}