@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 h-fit">
        <h3 class="text-base font-bold text-slate-800 mb-1">Tambah Supplier Baru</h3>
        <p class="text-xs text-slate-500 mb-4">Daftarkan mitra atau distributor penyuplai barang minimarket.</p>

        <form action="{{ route('suppliers.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Perusahaan / Supplier</label>
                <input type="text" name="name" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm" placeholder="Contoh: PT. Unilever Indonesia">
            </div>
            
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">No. Telepon / WhatsApp</label>
                <input type="text" name="phone" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm" placeholder="Contoh: 08123456789">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Alamat Kantor / Gudang</label>
                <textarea name="address" rows="3" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm" placeholder="Masukkan alamat lengkap supplier..."></textarea>
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 rounded-lg text-sm shadow transition">
                <i class="fa-solid fa-plus mr-1"></i> Simpan Supplier
            </button>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 md:col-span-2">
        <div class="mb-4">
            <h3 class="text-base font-bold text-slate-800">Master Data Mitra Supplier</h3>
            <p class="text-xs text-slate-500">Daftar kontak distributor resmi untuk keperluan restock barang masuk.</p>
        </div>

        <div class="overflow-x-auto rounded-lg border border-slate-200">
            <table class="w-full text-left text-sm text-slate-500">
                <thead class="bg-slate-50 text-slate-700 uppercase font-semibold text-xs">
                    <tr>
                        <th class="px-6 py-3">Nama Supplier</th>
                        <th class="px-6 py-3">Kontak</th>
                        <th class="px-6 py-3">Alamat</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($suppliers as $supplier)
                    <tr class="hover:bg-slate-50 text-slate-800">
                        <td class="px-6 py-4 font-semibold text-slate-900">
                            <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST" class="space-y-1">
                                @csrf @method('PUT')
                                <input type="text" name="name" value="{{ $supplier->name }}" class="bg-transparent border-0 border-b border-transparent hover:border-slate-300 focus:border-indigo-500 focus:ring-0 p-0 text-sm font-semibold text-slate-900 w-full rounded">
                                <input type="hidden" name="phone" value="{{ $supplier->phone }}">
                                <input type="hidden" name="address" value="{{ $supplier->address }}">
                            </form>
                        </td>
                        <td class="px-6 py-4 text-xs font-mono text-slate-600">{{ $supplier->phone }}</td>
                        <td class="px-6 py-4 text-xs max-w-xs truncate">{{ $supplier->address }}</td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center items-center gap-2">
                                <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" onsubmit="return confirm('Hapus data supplier ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-xs font-semibold">
                                        <i class="fa-solid fa-trash-can"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-slate-400 text-sm">Belum ada data supplier. Silakan tambahkan melalui form di sebelah kiri.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <p class="text-[10px] text-slate-400 mt-3 italic">*Tip: Klik langsung pada kolom Nama Supplier untuk mengedit teks secara cepat.</p>
    </div>

</div>
@endsection