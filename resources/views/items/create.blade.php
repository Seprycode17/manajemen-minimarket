@extends('layouts.app')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 max-w-2xl mx-auto">
    <div class="mb-6">
        <h3 class="text-lg font-bold text-slate-800">Tambah Produk Baru</h3>
        <p class="text-sm text-slate-500">Masukkan spesifikasi item baru ke dalam katalog master inventaris</p>
    </div>

    @if($errors->any())
        <div class="mb-4 p-3 bg-red-50 border-l-4 border-red-500 text-red-700 text-xs rounded">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('items.store') }}" method="POST" class="space-y-5">
        @csrf
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Kode SKU / Barcode</label>
                <input type="text" name="code" value="{{ old('code') }}" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm font-mono" placeholder="Contoh: BRG001">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Kategori</label>
                <select name="category_id" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm bg-white">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Nama Barang</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm" placeholder="Contoh: Indomie Goreng Aceh">
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Harga Jual Satuan (Rp)</label>
            <input type="number" name="price" value="{{ old('price') }}" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm" placeholder="Contoh: 3500">
        </div>

        <div class="flex justify-end gap-3 pt-2">
            <a href="{{ route('items.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-medium rounded-lg transition">Batal</a>
            <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow transition">Simpan Barang</button>
        </div>
    </form>
</div>
@endsection