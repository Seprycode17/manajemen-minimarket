<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Inventaris Minimarket</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md border border-slate-200">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-indigo-900 tracking-tight">Sistem Inventaris V-Market</h1>
            <p class="text-sm text-slate-500 mt-1">Silakan masuk ke akun Anda</p>
        </div>

        @if($errors->any())
            <div class="mb-4 p-3 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm rounded">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ url('login') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Alamat Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm" placeholder="contoh@gmail.com">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm" placeholder="••••••••">
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-lg shadow-md transition duration-200 text-sm">
                Masuk ke Sistem
            </button>
        </form>

        <div class="mt-6 pt-4 border-t border-slate-100 text-center text-xs text-slate-400">
            &copy; 2026 V-Market Inventory System
        </div>
    </div>

</body>
</html>