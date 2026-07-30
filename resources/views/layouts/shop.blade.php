<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'FreshBazar - Organic Grocery Store' }}</title>
    
    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    },
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
                    }
                }
            }
        }
    </script>
    
    <style>
        [x-cloak] { display: none !important; }
        .glass {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .animate-float { animation: float 6s ease-in-out infinite; }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        .reveal { opacity: 0; transform: translateY(30px); transition: all 0.8s ease-out; }
        .reveal.active { opacity: 1; transform: translateY(0); }
        
        /* Shimmer Effect for Skeletons */
        .shimmer {
            background: linear-gradient(90deg, #f1f5f9 25%, #f8fafc 50%, #f1f5f9 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
        }
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
    </style>
</head>
<body class="h-full font-sans text-slate-900 overflow-x-hidden" 
      x-data="shopApp()" 
      x-init="init()"
      @keyup.escape="showCart = false; showQuickView = false"
      :class="(showCart || showQuickView) ? 'overflow-hidden' : ''">

    <!-- Global Toast Notifications -->
    <div class="fixed bottom-8 right-8 z-[100] flex flex-col gap-3 pointer-events-none">
        <template x-for="toast in toasts" :key="toast.id">
            <div x-show="toast.visible" 
                 x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-y-10 opacity-0" x-transition:enter-end="translate-y-0 opacity-100"
                 x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 class="bg-slate-900 text-white rounded-2xl py-4 px-6 shadow-2xl flex items-center gap-3 pointer-events-auto border border-slate-700">
                <div class="w-8 h-8 bg-primary-600 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-bold" x-text="toast.message"></p>
                </div>
                <button @click="hideToast(toast.id)" class="text-slate-400 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        </template>
    </div>

    <!-- Quick View Modal -->
    <div x-show="showQuickView" x-cloak class="fixed inset-0 z-[70] flex items-center justify-center p-4 sm:p-6 lg:p-8 overflow-hidden">
        <div class="absolute inset-0 bg-slate-950/60 backdrop-blur-sm transition-opacity" @click="showQuickView = false"></div>
        <div class="relative bg-white rounded-[3rem] shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto"
             x-transition:enter="ease-out duration-300 transform" x-transition:enter-start="scale-95 opacity-0" x-transition:enter-end="scale-100 opacity-100">
            <button @click="showQuickView = false" class="absolute top-6 right-8 z-20 p-3 bg-slate-50 hover:bg-slate-100 rounded-2xl text-slate-400 hover:text-slate-600 transition-all">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
            
            <template x-if="activeProduct">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-0 md:gap-10">
                    <div class="p-8 md:p-12">
                        <div class="aspect-square rounded-3xl overflow-hidden bg-slate-50 border border-slate-100 shadow-inner">
                            <img :src="activeProduct.image_url" class="w-full h-full object-cover">
                        </div>
                    </div>
                    <div class="p-8 md:p-12 md:pl-0 flex flex-col pt-0 md:pt-12">
                        <div class="mb-4">
                            <span class="inline-block px-3 py-1 bg-primary-100 text-primary-700 text-[10px] font-bold uppercase tracking-widest rounded-full mb-4">Farm Fresh</span>
                            <h2 class="text-3xl font-extrabold text-slate-900 leading-tight mb-2" x-text="activeProduct.name"></h2>
                            <div class="flex items-center gap-1 text-amber-400">
                                @for($i=0; $i<5; $i++) <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg> @endfor
                                <span class="text-slate-400 text-xs ml-2">(120+ Reviews)</span>
                            </div>
                        </div>
                        
                        <div class="text-2xl font-bold text-primary-700 mb-6" x-text="'$' + activeProduct.price + ' / kg'"></div>
                        
                        <p class="text-slate-500 text-sm leading-relaxed mb-8 flex-1" x-text="activeProduct.description || 'Our fresh, premium quality products are sourced directly from local farmers to ensure you get the best nutrition and taste.'"></p>
                        
                        <div class="space-y-4 mb-4">
                            <div class="flex items-center gap-4 text-sm font-bold text-slate-800">
                                <span class="text-slate-400 font-medium">Availability:</span>
                                <span class="text-emerald-600 flex items-center gap-1">
                                    <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                                    In Stock (Direct From Farm)
                                </span>
                            </div>
                        </div>

                        <div class="flex gap-4 mt-auto">
                            <button @click="addToCart(activeProduct); showQuickView = false" class="flex-1 py-4 bg-primary-600 text-white font-bold rounded-2xl hover:bg-primary-700 transition-all shadow-xl shadow-primary-200 flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="sticky top-0 z-50 transition-all duration-300 glass border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="/home" class="flex items-center gap-2">
                        <div class="w-10 h-10 bg-primary-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-primary-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewbox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <span class="text-2xl font-bold tracking-tight text-primary-900">FreshBazar</span>
                    </a>
                </div>

                <!-- Desktop Search -->
                <div class="hidden md:flex flex-1 max-w-lg mx-10 relative" @click.away="searchQuery = ''">
                    <div class="relative w-full group">
                        <input type="text" 
                               x-model="searchQuery"
                               placeholder="Search for groceries..." 
                               class="w-full bg-slate-100 border-none rounded-2xl py-3 px-5 pl-12 focus:ring-2 focus:ring-primary-500 bg-opacity-80 group-hover:bg-opacity-100 transition-all">
                        <div class="absolute left-4 top-3.5 text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewbox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Search Suggestions -->
                    <template x-if="searchQuery.length > 0">
                        <div class="absolute top-16 left-0 w-full bg-white rounded-2xl shadow-2xl border border-slate-100 overflow-hidden z-50">
                            <div class="p-4 bg-slate-50 border-b border-slate-100 text-xs font-bold text-slate-400 uppercase tracking-widest">Products</div>
                            <div class="max-h-96 overflow-y-auto">
                                <template x-for="product in filteredProducts" :key="product.id">
                                    <div @click="openQuickView(product); searchQuery = ''" class="flex items-center gap-4 p-4 hover:bg-primary-50 transition-colors border-b border-slate-50 last:border-0 group cursor-pointer">
                                        <div class="w-12 h-12 bg-slate-100 rounded-lg overflow-hidden flex-shrink-0">
                                            <img :src="product.image_url" class="w-full h-full object-cover">
                                        </div>
                                        <div class="flex-1">
                                            <div class="text-sm font-bold text-slate-800" x-text="product.name"></div>
                                            <div class="text-xs text-primary-600 font-bold" x-text="'$' + product.price"></div>
                                        </div>
                                        <div class="text-slate-300 group-hover:text-primary-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                                        </div>
                                    </div>
                                </template>
                                <template x-if="filteredProducts.length === 0">
                                    <div class="p-8 text-center text-slate-400">No products found for "<span x-text="searchQuery"></span>"</div>
                                </template>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Icons -->
                    @guest
                        <a href="{{ route('login') }}" class="hidden sm:flex items-center gap-2 px-6 py-2.5 text-sm font-bold text-slate-600 hover:text-primary-600 hover:bg-primary-50 rounded-xl transition-all">
                            Sign In
                        </a>
                        <a href="{{ route('register') }}" class="hidden lg:flex items-center gap-2 px-6 py-2.5 bg-primary-600 text-white text-sm font-bold rounded-xl hover:bg-primary-700 transition-all shadow-lg shadow-primary-100">
                            Join Now
                        </a>
                    @else
                        <div class="flex items-center gap-2 sm:gap-4">
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="hidden md:flex items-center gap-2 px-5 py-2.5 bg-amber-50 text-amber-700 text-xs font-black uppercase tracking-widest rounded-xl border border-amber-100 hover:bg-amber-100 transition-all shadow-sm">
                                    Admin Center
                                </a>
                            @else
                                <a href="{{ route('dashboard') }}" class="hidden md:flex items-center gap-2 px-5 py-2.5 bg-primary-50 text-primary-700 text-xs font-black uppercase tracking-widest rounded-xl border border-primary-100 hover:bg-primary-100 transition-all shadow-sm">
                                    My Dashboard
                                </a>
                            @endif
                            
                            <div class="flex items-center gap-3 px-4 py-2 bg-slate-50 rounded-2xl border border-slate-100">
                                <div class="w-8 h-8 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center font-bold text-sm">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                                <span class="hidden sm:inline text-sm font-bold text-slate-700">{{ explode(' ', auth()->user()->name)[0] }}</span>
                                
                                <a href="{{ route('profile.edit') }}" class="p-1.5 text-slate-400 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-all" title="Manage Profile">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                </a>

                                <form action="{{ route('logout') }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="p-1.5 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all ml-2" title="Logout">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest
                    
                    <button @click="showCart = true" class="relative p-3 text-slate-600 hover:bg-slate-100 rounded-2xl transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewbox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <span x-show="cartCount > 0" x-text="cartCount" class="absolute top-2 right-2 w-5 h-5 bg-primary-600 text-white text-[10px] font-bold flex items-center justify-center rounded-full border-2 border-white"></span>
                    </button>

                    <button class="md:hidden p-2 text-slate-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewbox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 mt-20 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <div class="col-span-1 md:col-span-1">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-8 h-8 bg-primary-600 rounded-lg flex items-center justify-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewbox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-primary-900 tracking-tight">FreshBazar</span>
                    </div>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6">
                        Freshness delivered to your doorstep. We source the finest organic groceries from local farms to ensure your health and happiness.
                    </p>
                    <div class="flex gap-4">
                        <!-- Social Icons Placeholder -->
                        <div class="w-8 h-8 rounded-lg bg-slate-100"></div>
                        <div class="w-8 h-8 rounded-lg bg-slate-100"></div>
                        <div class="w-8 h-8 rounded-lg bg-slate-100"></div>
                    </div>
                </div>
                
                <div>
                    <h4 class="font-bold text-slate-900 mb-6 uppercase text-xs tracking-widest">Quick Links</h4>
                    <ul class="space-y-4">
                        <li><a href="/home" class="text-slate-500 hover:text-primary-600 transition-colors">Home</a></li>
                        <li><a href="/shop" class="text-slate-500 hover:text-primary-600 transition-colors">Special Offers</a></li>
                        <li><a href="/about" class="text-slate-500 hover:text-primary-600 transition-colors">About Us</a></li>
                        <li><a href="/contact" class="text-slate-500 hover:text-primary-600 transition-colors">Contact</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-slate-900 mb-6 uppercase text-xs tracking-widest">Customer Service</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-slate-500 hover:text-primary-600 transition-colors">My Account</a></li>
                        <li><a href="#" class="text-slate-500 hover:text-primary-600 transition-colors">Order Tracking</a></li>
                        <li><a href="#" class="text-slate-500 hover:text-primary-600 transition-colors">Privacy Policy</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-slate-900 mb-6 uppercase text-xs tracking-widest">Join Our Newsletter</h4>
                    <p class="text-slate-500 text-sm mb-6">Stay updated with latest offers and fresh arrivals.</p>
                    <div class="flex gap-2">
                        <input type="email" placeholder="Email address" class="flex-1 bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none">
                        <button class="bg-primary-600 text-white p-2.5 rounded-xl hover:bg-primary-700 transition-all shadow-lg shadow-primary-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewbox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-slate-100 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-slate-400 text-sm">
                <p>&copy; 2026 FreshBazar Project. All rights reserved.</p>
                <div class="flex gap-8">
                    <a href="#" class="hover:text-slate-600">Privacy</a>
                    <a href="#" class="hover:text-slate-600">Terms</a>
                    <a href="#" class="hover:text-slate-600">Cookies</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Cart Overlay -->
    <div x-show="showCart" x-cloak class="fixed inset-0 z-[60] overflow-hidden" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
        <div class="absolute inset-0 bg-slate-900 bg-opacity-50 backdrop-blur-sm transition-opacity" 
             x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             @click="showCart = false"></div>
        <div class="absolute inset-y-0 right-0 pl-10 max-w-full flex">
            <div class="w-screen max-w-md bg-white shadow-2xl flex flex-col"
                 x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                 x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">
                
                <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50">
                    <h2 class="text-xl font-bold text-slate-900" id="slide-over-title">Shopping Cart</h2>
                    <button @click="showCart = false" class="text-slate-400 hover:text-slate-500 p-2">
                        <svg class="h-6 w-6" fill="none" viewbox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="flex-1 overflow-y-auto px-6 py-6">
                    <template x-if="cart.length > 0">
                        <div class="space-y-6">
                            <template x-for="(item, index) in cart" :key="index">
                                <div class="flex items-center gap-4 group">
                                    <div class="w-20 h-20 bg-slate-50 rounded-2xl overflow-hidden flex-shrink-0 border border-slate-100">
                                        <img :src="item.image_url" class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-bold text-slate-800 text-sm" x-text="item.name"></h4>
                                        <div class="flex items-center justify-between mt-2">
                                            <div class="flex items-center border border-slate-200 rounded-lg overflow-hidden">
                                                <button @click="updateQty(index, -1)" class="px-2 py-1 bg-slate-50 hover:bg-slate-100">-</button>
                                                <span class="px-3 py-1 bg-white text-xs font-bold" x-text="item.qty"></span>
                                                <button @click="updateQty(index, 1)" class="px-2 py-1 bg-slate-50 hover:bg-slate-100">+</button>
                                            </div>
                                            <span class="font-bold text-primary-600 text-sm" x-text="'$' + (item.price * item.qty).toFixed(2)"></span>
                                        </div>
                                    </div>
                                    <button @click="removeItem(index)" class="p-2 text-slate-300 hover:text-red-500 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </div>
                            </template>
                        </div>
                    </template>
                    
                    <template x-if="cart.length === 0">
                        <div class="h-full flex flex-col items-center justify-center text-center">
                            <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mb-6 text-slate-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewbox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                            </div>
                            <p class="text-slate-500 font-bold mb-1">Your cart is empty</p>
                            <p class="text-slate-400 text-sm">Add some delicious groceries to get started!</p>
                        </div>
                    </template>
                </div>

                <div x-show="cart.length > 0" class="p-6 border-t border-slate-100 bg-slate-50 space-y-4">
                    <div class="flex justify-between items-center text-slate-500 text-sm">
                        <span>Subtotal</span>
                        <span class="font-bold text-slate-900" x-text="'$' + cartTotal.toFixed(2)"></span>
                    </div>
                    <button @click="checkout()" class="w-full py-4 bg-primary-600 text-white font-bold rounded-2xl hover:bg-primary-700 transition-all shadow-xl shadow-primary-100 flex items-center justify-center gap-2">
                        Checkout Now
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewbox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        function shopApp() {
            return {
                cartCount: 0,
                showCart: false,
                cart: [],
                
                searchQuery: '',
                allProducts: [],
                
                activeCategory: 0, // 0 for All
                showQuickView: false,
                activeProduct: null,
                
                toasts: [],
                toastId: 0,

                countdown: { d: 0, h: 0, m: 0, s: 0 },
                
                init() {
                    // Initialize Cart
                    const savedCart = localStorage.getItem('freshbazar_cart');
                    if (savedCart) {
                        this.cart = JSON.parse(savedCart);
                        this.updateCartGlobal();
                    }

                    // Check for Order Success from Session
                    @if(session('success'))
                        this.cart = [];
                        this.updateCartGlobal();
                        this.showToast('{{ session('success') }}');
                    @endif

                    // Check for general errors
                    @if(session('error'))
                        this.showToast('{{ session('error') }}');
                    @endif

                    // Initialize Intersection Observer for Scroll Reveals
                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                entry.target.classList.add('active');
                            }
                        });
                    }, { threshold: 0.1 });
                    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

                    // Start Countdown (Hardcoded 24h from now)
                    this.startCountdown();
                },

                startCountdown() {
                    const targetDate = new Date().getTime() + (24 * 60 * 60 * 1000);
                    setInterval(() => {
                        const now = new Date().getTime();
                        const distance = targetDate - now;
                        this.countdown.d = Math.floor(distance / (1000 * 60 * 60 * 24));
                        this.countdown.h = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        this.countdown.m = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        this.countdown.s = Math.floor((distance % (1000 * 60)) / 1000);
                    }, 1000);
                },

                get filteredProducts() {
                    let products = this.allProducts;
                    
                    if (this.searchQuery !== '') {
                        products = products.filter(p => p.name.toLowerCase().includes(this.searchQuery.toLowerCase()));
                    }
                    
                    if (this.activeCategory !== 0) {
                        products = products.filter(p => p.category_id == this.activeCategory);
                    }
                    
                    return products;
                },

                filterByCategory(id) {
                    this.activeCategory = id;
                    // Auto-scroll to products section
                    const el = document.getElementById('shop');
                    if (el) {
                        window.scrollTo({
                            top: el.offsetTop - 100,
                            behavior: 'smooth'
                        });
                    }
                },

                openQuickView(product) {
                    this.activeProduct = product;
                    this.showQuickView = true;
                },

                addToCart(product) {
                    const existing = this.cart.find(item => item.id === product.id);
                    if (existing) {
                        existing.qty++;
                    } else {
                        this.cart.push({ ...product, qty: 1 });
                    }
                    this.updateCartGlobal();
                    this.showToast(`"${product.name}" added to cart!`);
                },

                showToast(message) {
                    const id = ++this.toastId;
                    this.toasts.push({ id, message, visible: true });
                    setTimeout(() => this.hideToast(id), 3000);
                },

                hideToast(id) {
                    const toast = this.toasts.find(t => t.id === id);
                    if (toast) toast.visible = false;
                    setTimeout(() => {
                        this.toasts = this.toasts.filter(t => t.id !== id);
                    }, 300);
                },

                updateQty(index, delta) {
                    if (this.cart[index].qty + delta > 0) {
                        this.cart[index].qty += delta;
                        this.updateCartGlobal();
                    }
                },

                removeItem(index) {
                    this.cart.splice(index, 1);
                    this.updateCartGlobal();
                },

                async checkout() {
                    if (this.cart.length === 0) return;
                    
                    try {
                        const response = await fetch('{{ route('cart.sync') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ cart: this.cart })
                        });
                        
                        if (response.ok) {
                            window.location.href = '{{ route('checkout.index') }}';
                        }
                    } catch (error) {
                        console.error('Cart sync failed:', error);
                        this.showToast('Something went wrong. Please try again.');
                    }
                },

                updateCartGlobal() {
                    this.cartCount = this.cart.reduce((sum, item) => sum + item.qty, 0);
                    this.cartTotal = this.cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
                    localStorage.setItem('freshbazar_cart', JSON.stringify(this.cart));
                }
            }
        }
    </script>
</body>
</html>
