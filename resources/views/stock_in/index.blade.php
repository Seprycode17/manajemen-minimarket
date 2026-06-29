@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 h-fit">
        <h3 class="text-base font-bold text-slate-800 mb-1">Catat Barang Masuk</h3>
        <p class="text-xs text-slate-500 mb-4">Stok sistem otomatis bertambah setelah disimpan.</p>

        <form action="{{ route('stock-in.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Pilih Barang</label>
                <select name="item_id" required class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm bg-white">
                    <option value="">-- Pilih Produk --</option>
                    @foreach($items as $item)
                        <option value="{{ $item->id }}">{{ $item->code }} - {{ $item->name }} (Sisa Stok: {{ $item->stock }})</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Supplier Pasokan</label>
                <select name="supplier_id" required class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm bg-white">
                    <option value="">-- Pilih Supplier --</option>
                    @foreach($suppliers as $sup)
                        <option value="{{ $sup->id }}">{{ $sup->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Jumlah (Qty)</label>
                    <input type="number" name="qty" min="1" required class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm" placeholder="0">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Tanggal</label>
                    <input type="date" name="date" value="{{ date('Y-m-d') }}" required class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm">
                </div>
            </div>
            
            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-medium py-2 rounded-lg text-sm shadow transition">
                <i class="fa-solid fa-arrow-down mr-1"></i> Konfirmasi Barang Masuk
            </button>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 lg:col-span-2">
        <h3 class="text-base font-bold text-slate-800 mb-1">Riwayat Pasokan Barang Masuk</h3>
        <p class="text-xs text-slate-500 mb-4">Log digital mutasi penambahan stok minimarket.</p>

        <div class="overflow-x-auto rounded-lg border border-slate-200">
            <table class="w-full text-left text-sm text-slate-500">
                <thead class="bg-slate-50 text-slate-700 uppercase font-semibold text-xs">
                    <tr>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Barang</th>
                        <th class="px-6 py-3">Supplier</th>
                        <th class="px-6 py-3 text-center">Qty Masuk</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($stockIns as $si)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 text-xs font-medium text-slate-600">{{ date('d/m/Y', strtotime($si->date)) }}</td>
                        <td class="px-6 py-4 font-semibold text-slate-800">{{ $si->item->name }}</td>
                        <td class="px-6 py-4 text-xs text-slate-700">{{ $si->supplier->name }}</td>
                        <td class="px-6 py-4 text-center text-emerald-600 font-bold">+{{ $si->qty }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-slate-400">Belum ada riwayat barang masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
</div>
@endsection