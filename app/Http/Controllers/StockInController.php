<?php

namespace App\Http\Controllers;

use App\Models\StockIn;
use App\Models\Item;
use App\Models\Supplier;
use Illuminate\Http\Request;

class StockInController extends Controller
{
    public function index() {
        $stockIns = StockIn::with(['item', 'supplier'])->latest()->get();
        $items = Item::all();
        $suppliers = Supplier::all();
        return view('stock_in.index', compact('stockIns', 'items', 'suppliers'));
    }

    public function store(Request $request) {
        $request->validate(['item_id' => 'required', 'supplier_id' => 'required', 'qty' => 'required|numeric', 'date' => 'required']);
        
        // Simpan log transaksi barang masuk
        StockIn::create($request->all());

        // POIN PLUS KASUS NYATA: Otomatis tambah stok di tabel items
        $item = Item::find($request->item_id);
        $item->increment('stock', $request->qty);

        return back()->with('success', 'Transaksi barang masuk berhasil dicatat. Stok bertambah!');
    }
}