<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel - FreshBazar' }}</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            200: '#a7f3d0',
                            300: '#6ee7b7',
                            400: '#34d399',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b',
                            950: '#022c22',
                        },
                    },
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <style>
        [x-cloak] { display: none !important; }
        .glass-dark {
            background: rgba(6, 78, 59, 0.9);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .sidebar-gradient {
            background: linear-gradient(180deg, #064e3b 0%, #022c22 100%);
        }
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.05);
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(16, 185, 129, 0.2);
            border-radius: 10px;
        }
    </style>
</head>
<body class="h-full font-sans text-slate-900 overflow-x-hidden" x-data="{ sidebarOpen: true }">
    
    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 z-50 w-72 h-full sidebar-gradient transition-transform duration-300 transform"
         :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
        
        <div class="flex flex-col h-full">
            <!-- Logo area -->
            <div class="flex items-center gap-3 px-8 h-24 border-b border-white/10">
                <div class="w-10 h-10 bg-primary-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-primary-900/50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-white font-bold text-xl leading-none">FreshBazar</h1>
                    <p class="text-primary-400 text-[10px] font-bold uppercase tracking-widest mt-1">Admin Control</p>
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="flex-1 px-4 py-8 overflow-y-auto custom-scrollbar">
                <nav class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="flex items-center gap-3 px-4 py-3.5 rounded-2xl transition-all duration-300 {{ request()->routeIs('admin.dashboard') ? 'bg-primary-500 text-white shadow-lg shadow-primary-900/50' : 'text-emerald-100/60 hover:bg-white/5 hover:text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        <span class="font-semibold text-sm">Dashboard</span>
                    </a>

                    <div class="pt-6 pb-2 px-4 text-primary-500 text-[10px] uppercase font-bold tracking-widest">Inventory Management</div>
                    
                    <a href="{{ route('admin.products.index') }}" 
                       class="flex items-center gap-3 px-4 py-3.5 rounded-2xl transition-all duration-300 {{ request()->routeIs('admin.products.*') ? 'bg-primary-500 text-white shadow-lg shadow-primary-900/50' : 'text-emerald-100/60 hover:bg-white/5 hover:text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-4-4H8a4 4 0 00-4 4v4m14 4v1m-9-1v1m-4-1v1m3 3h10a1 1 0 001-1v-4a1 1 0 00-1-1H3a1 1 0 00-1 1v4a1 1 0 001 1h3z" />
                        </svg>
                        <span class="font-semibold text-sm">Product List</span>
                    </a>

                    <a href="{{ route('admin.categories.index') }}" 
                       class="flex items-center gap-3 px-4 py-3.5 rounded-2xl transition-all duration-300 {{ request()->routeIs('admin.categories.*') ? 'bg-primary-500 text-white shadow-lg shadow-primary-900/50' : 'text-emerald-100/60 hover:bg-white/5 hover:text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <span class="font-semibold text-sm">Categories</span>
                    </a>

                    <div class="pt-6 pb-2 px-4 text-primary-500 text-[10px] uppercase font-bold tracking-widest">Sales & Orders</div>

                    <a href="{{ route('admin.orders.index') }}" 
                       class="flex items-center gap-3 px-4 py-3.5 rounded-2xl transition-all duration-300 {{ request()->routeIs('admin.orders.*') ? 'bg-primary-500 text-white shadow-lg shadow-primary-900/50' : 'text-emerald-100/60 hover:bg-white/5 hover:text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-4-4H8a4 4 0 00-4 4v4m14 4v1m-9-1v1m-4-1v1m3 3h10a1 1 0 001-1v-4a1 1 0 00-1-1H3a1 1 0 00-1 1v4a1 1 0 001 1h3z" />
                        </svg>
                        <span class="font-semibold text-sm">Customer Orders</span>
                    </a>

                    <!-- Logout -->
                    <div class="pt-10">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3.5 rounded-2xl text-red-300 hover:bg-red-500 hover:text-white transition-all duration-300 group">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                <span class="font-bold text-sm">Logout Session</span>
                            </button>
                        </form>
                    </div>
                </nav>
            </div>

            <!-- Footer area -->
            <div class="p-6 border-t border-white/10">
                <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 overflow-hidden rounded-2xl bg-white/5 text-emerald-100 hover:bg-white/10 transition-all group">
                    <div class="w-8 h-8 rounded-xl bg-primary-500 flex items-center justify-center text-white flex-shrink-0 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                    <div class="flex-1 overflow-hidden">
                        <p class="text-[11px] font-bold uppercase tracking-widest leading-none mb-1">Live Preview</p>
                        <p class="text-xs text-emerald-400 truncate">Visit Storefront</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="transition-all duration-300" :style="sidebarOpen ? 'margin-left: 18rem' : 'margin-left: 0'">
        
        <!-- Top Bar -->
        <header class="h-24 sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-slate-200 px-8 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = !sidebarOpen" class="p-2.5 rounded-xl bg-slate-100 text-slate-500 hover:bg-primary-500 hover:text-white transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <div class="hidden md:block">
                    <h2 class="text-xl font-bold text-slate-800">{{ $title ?? 'Admin Dashboard' }}</h2>
                    <p class="text-xs text-slate-400 font-medium mt-0.5">Manage your grocery inventory efficiently</p>
                </div>
            </div>

            <div class="flex items-center gap-6">
                <!-- Topbar Search -->
                <div class="hidden lg:flex relative">
                    <input type="text" placeholder="Search data..." class="w-64 bg-slate-100 border-none rounded-2xl py-2.5 px-5 pl-10 focus:ring-2 focus:ring-primary-500 transition-all text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 absolute left-4 top-3 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                <div class="flex items-center gap-4 border-l border-slate-200 pl-6">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-bold text-slate-800 leading-none mb-1">{{ Auth::user()->name ?? 'Administrator' }}</p>
                        <p class="text-[10px] font-bold text-primary-600 uppercase tracking-widest">Super Admin</p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-slate-100 p-0.5 border border-slate-200">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'Admin' }}&background=10b981&color=fff" class="w-full h-full rounded-[0.9rem] object-cover">
                    </div>
                </div>
            </div>
        </header>

        <!-- Dynamic Content -->
        <main class="p-8">
            <!-- Flash Messages -->
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
                     class="mb-8 p-4 bg-primary-100 border border-primary-200 text-primary-800 rounded-3xl flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary-500" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                        <span class="font-bold text-sm">{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" class="text-primary-800/50 hover:text-primary-800"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</body>
</html>
