@extends('layouts.app')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="text-lg font-bold text-slate-800">Katalog Data Barang</h3>
            <p class="text-xs text-slate-500">Manajemen stok master dan harga jual produk minimarket</p>
        </div>
        <a href="{{ route('items.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg flex items-center gap-2 shadow transition text-sm">
            <i class="fa-solid fa-plus"></i> Tambah Barang Baru
        </a>
    </div>

    <div class="overflow-x-auto rounded-lg border border-slate-200">
        <table class="w-full text-left text-sm text-slate-500">
            <thead class="bg-slate-50 text-slate-700 uppercase font-semibold text-xs">
                <tr>
                    <th class="px-6 py-3">Kode SKU</th>
                    <th class="px-6 py-3">Nama Barang</th>
                    <th class="px-6 py-3">Kategori</th>
                    <th class="px-6 py-3 text-center">Stok Sistem</th>
                    <th class="px-6 py-3">Harga Satuan</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($items as $item)
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-4 font-mono font-bold text-indigo-600">{{ $item->code }}</td>
                    <td class="px-6 py-4 font-semibold text-slate-800">{{ $item->name }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 bg-slate-100 text-slate-600 text-xs rounded font-medium border border-slate-200">{{ $item->category->name }}</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-bold {{ $item->stock <= 5 ? 'bg-red-50 text-red-600 border border-red-200' : 'bg-slate-50 text-slate-700' }}">
                            {{ $item->stock }} Pcs
                        </span>
                    </td>
                    <td class="px-6 py-4 font-medium text-slate-800">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center items-center gap-3">
                            <a href="{{ route('items.edit', $item->id) }}" class="text-blue-600 hover:text-blue-800 font-medium text-xs">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </a>
                            @if(auth()->user()->role == 'admin')
                            <span class="text-slate-200">|</span>
                            <form action="{{ route('items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus barang ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-xs">
                                    <i class="fa-solid fa-trash"></i> Hapus
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
               @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-slate-400">
                        Belum ada data produk di katalog.
                    </td>
                </tr>
                @endforelse  </tbody>
        </table>
    </div>
</div>
@endsection