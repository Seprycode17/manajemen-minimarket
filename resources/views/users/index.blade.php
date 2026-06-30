@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 h-fit">
        <h3 class="text-base font-bold text-slate-800 mb-1">Registrasi Pengguna Baru</h3>
        <p class="text-xs text-slate-500 mb-4">Daftarkan akun Admin atau Petugas baru secara internal.</p>

        <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" required class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm" placeholder="Nama Pegawai">
            </div>
            
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Alamat Email</label>
                <input type="email" name="email" required class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm" placeholder="pegawai@gmail.com">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Password</label>
                <input type="password" name="password" required class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm" placeholder="Minimal 6 karakter">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Hak Akses (Role)</label>
                <select name="role" required class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm bg-white">
                    <option value="petugas">Petugas Toko</option>
                    <option value="admin">Admin / Pemilik</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 rounded-lg text-sm shadow transition">
                <i class="fa-solid fa-user-plus mr-1"></i> Daftarkan Akun
            </button>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 md:col-span-2">
        <div class="mb-4">
            <h3 class="text-base font-bold text-slate-800">Manajemen Pengguna</h3>
            <p class="text-xs text-slate-500">Daftar semua staf yang memiliki akses ke sistem V-Market.</p>
        </div>

        <div class="overflow-x-auto rounded-lg border border-slate-200">
            <table class="w-full text-left text-sm text-slate-500">
                <thead class="bg-slate-50 text-slate-700 uppercase font-semibold text-xs">
                    <tr>
                        <th class="px-6 py-3">Nama</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3 text-center">Role</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($users as $user)
                    <tr class="hover:bg-slate-50 text-slate-800">
                        <td class="px-6 py-4 font-semibold text-slate-900">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-xs font-mono text-slate-600">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-2 py-0.5 text-xs font-bold rounded-full {{ $user->role == 'admin' ? 'bg-indigo-100 text-indigo-700' : 'bg-amber-100 text-amber-700' }}">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center items-center">
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus pengguna ini? Akses mereka ke sistem akan dicabut.')">
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
                        <td colspan="4" class="px-6 py-8 text-center text-slate-400 text-sm">Belum ada pengguna tambahan lain di sistem.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection