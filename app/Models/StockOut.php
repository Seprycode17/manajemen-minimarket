<?php

namespace App\Http\Controllers;

use App\Models\StockOut;
use App\Models\Item;
use Illuminate\Http\Request;

class StockOutController extends Controller
{
    public function index() {
        $stockOuts = StockOut::with('item')->latest()->get();
        $items = Item::all();
        return view('stock_out.index', compact('stockOuts', 'items'));
    }

    public function store(Request $request) {
        $request->validate(['item_id' => 'required', 'qty' => 'required|numeric', 'date' => 'required']);
        
        $item = Item::find($request->item_id);

        // Validasi agar stok tidak minus
        if ($item->stock < $request->qty) {
            return back()->withErrors(['qty' => 'Stok tidak mencukupi untuk dikeluarkan!'])->withInput();
        }

        // Simpan log transaksi barang keluar
        StockOut::create($request->all());

        // POIN PLUS KASUS NYATA: Otomatis kurangi stok di tabel items
        $item->decrement('stock', $request->qty);

        return back()->with('success', 'Transaksi barang keluar berhasil dicatat. Stok berkurang!');
    }
}