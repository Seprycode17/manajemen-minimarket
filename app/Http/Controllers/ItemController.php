<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index() {
        $items = Item::with('category')->latest()->get();
        return view('items.index', compact('items'));
    }

    public function create() {
        $categories = Category::all();
        return view('items.create', compact('categories'));
    }

    public function store(Request $request) {
        $request->validate([
            'category_id' => 'required',
            'code' => 'required|unique:items',
            'name' => 'required',
            'price' => 'required|numeric',
        ]);
        Item::create($request->all());
        return redirect()->route('items.index')->with('success', 'Barang berhasil disimpan.');
    }

    public function edit(Item $item) {
        $categories = Category::all();
        return view('items.edit', compact('item', 'categories'));
    }

    public function update(Request $request, Item $item) {
    $request->validate([
        'category_id' => 'required',
        'code' => 'required|unique:items,code,'.$item->id,
        'name' => 'required',
        'price' => 'required|numeric',
        'stock' => 'required|numeric|min:0', // <-- Tambahkan baris ini
    ]);
    
  
        $item->update($request->all());
        return redirect()->route('items.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(Item $item) {
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Barang berhasil dihapus.');
    }
}