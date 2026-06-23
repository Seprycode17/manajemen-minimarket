<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Inventaris Minimarket</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans flex">

    <div class="w-64 bg-indigo-900 min-h-screen text-white flex flex-col justify-between">
        <div class="p-5">
            <h1 class="text-xl font-bold tracking-wider mb-8 flex items-center gap-2">
                <i class="fa-solid fa-boxes-stacked text-amber-400"></i> V-Market Inv
            </h1>
            
            <nav class="space-y-2">
                <a href="{{ url('/') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-800 bg-indigo-700">
                    <i class="fa-solid fa-gauge mr-2"></i> Dashboard
                </a>
                
                @if(auth()->check() && auth()->user()->role == 'admin')
                <a href="{{ route('categories.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-800">
                    <i class="fa-solid fa-tags mr-2"></i> Kategori Barang
                </a>
                @endif

                <a href="{{ route('items.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-800">
                    <i class="fa-solid fa-box mr-2"></i> Data Barang
                </a>

                <a href="{{ route('stock-in.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-800">
                    <i class="fa-solid fa-arrow-down mr-2"></i> Barang Masuk
                </a>

                <a href="{{ route('stock-out.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-800">
                    <i class="fa-solid fa-arrow-up mr-2"></i> Barang Keluar
                </a>

                @if(auth()->check() && auth()->user()->role == 'admin')
                <a href="{{ route('suppliers.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-800">
                    <i class="fa-solid fa-truck mr-2"></i> Supplier
                </a>
                @endif
            </nav>
        </div>

        <div class="p-5 bg-indigo-950 flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold truncate">{{ auth()->check() ? auth()->user()->name : 'User' }}</p>
                <span class="text-xs bg-amber-500 text-black px-2 py-0.5 rounded-full capitalize font-bold">{{ auth()->check() ? auth()->user()->role : '' }}</span>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-gray-400 hover:text-red-400 p-2 rounded">
                    <i class="fa-solid fa-right-from-bracket text-lg"></i>
                </button>
            </form>
        </div>
    </div>

    <div class="flex-1 min-h-screen flex flex-col">
        <header class="bg-white shadow-sm py-4 px-8 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Sistem Manajemen Inventaris Minimarket</h2>
            <span class="text-sm text-gray-500">{{ date('d M Y') }}</span>
        </header>

        <main class="p-8 flex-1">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</body>
</html>