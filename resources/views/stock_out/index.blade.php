@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 h-fit">
        <h3 class="text-base font-bold text-slate-800 mb-1">Catat Barang Keluar</h3>
        <p class="text-xs text-slate-500 mb-4">Pengurangan stok otomatis (karena penjualan manual, rusak, atau expired).</p>

        @if($errors->any())
            <div class="mb-3 p-2 bg-red-50 text-red-600 text-xs rounded border border-red-200 font-medium">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('stock-out.store') }}" method="POST" class="space-y-4">
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

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Keterangan / Alasan</label>
                <input type="text" name="notes" placeholder="Contoh: Barang Rusak / Kadaluwarsa" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm">
            </div>
            
            <button type="submit" class="w-full bg-rose-600 hover:bg-rose-700 text-white font-medium py-2 rounded-lg text-sm shadow transition">
                <i class="fa-solid fa-arrow-up mr-1"></i> Konfirmasi Barang Keluar
            </button>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 lg:col-span-2">
        <h3 class="text-base font-bold text-slate-800 mb-1">Riwayat Pengurangan Barang Keluar</h3>
        <p class="text-xs text-slate-500 mb-4">Log digital mutasi pengurangan stok minimarket.</p>

        <div class="overflow-x-auto rounded-lg border border-slate-200">
            <table class="w-full text-left text-sm text-slate-500">
                <thead class="bg-slate-50 text-slate-700 uppercase font-semibold text-xs">
                    <tr>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Barang</th>
                        <th class="px-6 py-3">Keterangan</th>
                        <th class="px-6 py-3 text-center">Qty Keluar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($stockOuts as $so)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 text-xs font-medium text-slate-600">{{ date('d/m/Y', strtotime($so->date)) }}</td>
                        <td class="px-6 py-4 font-semibold text-slate-800">{{ $so->item->name }}</td>
                        <td class="px-6 py-4 text-xs italic text-slate-500">{{ $so->notes ?? '-' }}</td>
                        <td class="px-6 py-4 text-center text-rose-600 font-bold">-${{ $so->qty }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-slate-400">Belum ada riwayat barang keluar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
</div>
@endsection