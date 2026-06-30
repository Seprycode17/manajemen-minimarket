@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-slate-500">Total Jenis Barang</p>
            <h4 class="text-3xl font-bold text-slate-800 mt-1">{{ $totalItems }}</h4>
        </div>
        <div class="w-12 h-12 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl">
            <i class="fa-solid fa-box"></i>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-slate-500">Kategori Produk</p>
            <h4 class="text-3xl font-bold text-slate-800 mt-1">{{ $totalCategories }}</h4>
        </div>
        <div class="w-12 h-12 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center text-xl">
            <i class="fa-solid fa-tags"></i>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-slate-500">Mitra Supplier</p>
            <h4 class="text-3xl font-bold text-slate-800 mt-1">{{ $totalSuppliers }}</h4>
        </div>
        <div class="w-12 h-12 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl">
            <i class="fa-solid fa-truck"></i>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
    <div class="mb-4">
        <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
            <i class="fa-solid fa-triangle-exclamation text-red-500"></i> Kontrol Peringatan Stok (Sistem Manual &rarr; Digital)
        </h3>
        <p class="text-xs text-slate-500">Daftar produk yang jumlah stoknya kritis (&le; 5 unit) dan harus segera dipesan ulang ke supplier.</p>
    </div>

    @if($lowStockItems->isEmpty())
        <div class="p-4 bg-emerald-50 text-emerald-700 text-sm rounded border border-emerald-200 text-center font-medium">
            Aman! Semua persediaan stok barang di rak minimarket dalam kondisi terpenuhi.
        </div>
    @else
        <div class="overflow-x-auto rounded-lg border border-slate-200">
            <table class="w-full text-left text-sm text-slate-500">
                <thead class="bg-slate-50 text-slate-700 uppercase font-semibold text-xs">
                    <tr>
                        <th class="px-6 py-3">Kode</th>
                        <th class="px-6 py-3">Nama Produk</th>
                        <th class="px-6 py-3 text-center">Sisa Stok</th>
                        <th class="px-6 py-3">Aksi Restock</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($lowStockItems as $item)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 font-mono text-red-600 font-bold">{{ $item->code }}</td>
                        <td class="px-6 py-4 font-medium text-slate-900">{{ $item->name }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-2.5 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-full">{{ $item->stock }} Pcs</span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('stock-in.index') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold text-xs underline">Input Barang Masuk</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection