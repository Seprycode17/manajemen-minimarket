@extends('layouts.app')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 max-w-2xl mx-auto">
    <div class="mb-6">
        <h3 class="text-lg font-bold text-slate-800">Edit Data Barang</h3>
        <p class="text-sm text-slate-500">Perbarui informasi spesifikasi produk</p>
    </div>

    <form action="{{ route('items.update', $item->id) }}" method="POST" class="space-y-5">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Kode SKU / Barcode</label>
                <input type="text" name="code" value="{{ $item->code }}" required class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm font-mono bg-slate-50" readonly>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Kategori</label>
                <select name="category_id" required class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $item->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Nama Barang</label>
            <input type="text" name="name" value="{{ $item->name }}" required class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm">
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Harga Jual Satuan (Rp)</label>
            <input type="number" name="price" value="{{ $item->price }}" required class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm">
        </div>
        <div>
    <label class="block text-sm font-medium text-slate-700 mb-1">Stok Sistem (Manual)</label>
    <input type="number" name="stock" value="{{ $item->stock }}" required class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm" placeholder="Masukkan jumlah stok">
</div>

        <div class="flex justify-end gap-3 pt-2">
            <a href="{{ route('items.index') }}" class="px-4 py-2 bg-slate-100 text-slate-700 text-sm rounded-lg">Batal</a>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-lg shadow">Perbarui Data</button>
        </div>
    </form>
</div>
@endsection