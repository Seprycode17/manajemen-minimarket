@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 h-fit">
        <h3 class="text-base font-bold text-slate-800 mb-1">Tambah Kategori Baru</h3>
        <p class="text-xs text-slate-500 mb-4">Buat pengelompokan produk baru di minimarket.</p>

        <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Kategori</label>
                <input type="text" name="name" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm" placeholder="Contoh: Makanan Ringan, Sabun, Obat">
            </div>
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 rounded-lg text-sm shadow transition">
                <i class="fa-solid fa-plus mr-1"></i> Simpan Kategori
            </button>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 md:col-span-2">
        <div class="mb-4">
            <h3 class="text-base font-bold text-slate-800">Master Data Kategori</h3>
            <p class="text-xs text-slate-500">Mengatur semua kategori produk yang tersedia.</p>
        </div>

        <div class="overflow-x-auto rounded-lg border border-slate-200">
            <table class="w-full text-left text-sm text-slate-500">
                <thead class="bg-slate-50 text-slate-700 uppercase font-semibold text-xs">
                    <tr>
                        <th class="px-6 py-3 w-16 text-center">No</th>
                        <th class="px-6 py-3">Nama Kategori</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($categories as $index => $category)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 text-center font-medium text-slate-400">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 font-semibold text-slate-800">
                            <form action="{{ route('categories.update', $category->id) }}" method="POST" class="flex gap-2 items-center">
                                @csrf
                                @method('PUT')
                                <input type="text" name="name" value="{{ $category->name }}" class="bg-transparent border-0 border-b border-transparent hover:border-slate-300 focus:border-indigo-500 focus:ring-0 px-1 py-0.5 text-sm text-slate-800 font-medium rounded">
                                <button type="submit" class="text-xs text-emerald-600 hover:text-emerald-800 font-bold hidden border border-emerald-200 bg-emerald-50 px-1.5 py-0.5 rounded">Simpan</button>
                            </form>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center items-center gap-3">
                                <span class="text-xs text-slate-400 italic">Klik nama untuk edit</span>
                                <span class="text-slate-300">|</span>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Menghapus kategori ini juga akan menghapus semua barang di dalamnya! Yakin?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-xs font-semibold">
                                        <i class="fa-solid fa-trash-can"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-8 text-center text-slate-400 text-sm">Belum ada data kategori. Silakan tambahkan di form sebelah kiri.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection