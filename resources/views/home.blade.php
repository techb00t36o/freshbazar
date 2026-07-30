@extends('layouts.shop')

@php
    use App\Models\Category;
    use App\Models\Product;

    $categories = Category::all();
    $featuredProducts = Product::latest()->take(8)->get();
@endphp

@section('content')
    <!-- Pass Products to Alpine for Search & Filtering -->
    <div x-init="allProducts = @js($featuredProducts->map(fn($p) => [
        'id' => $p->id,
        'category_id' => $p->category_id,
        'name' => $p->name,
        'price' => $p->price,
        'description' => $p->description,
        'image_url' => $p->image ? (Str::startsWith($p->image, 'http') ? $p->image : asset('storage/' . $p->image)) : asset('image/shop.jpg')
    ]))"></div>

    <!-- Hero Section -->
    <section class="relative bg-emerald-950 overflow-hidden min-h-[700px] flex items-center pt-32 pb-40">
        <!-- Background Decoration -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-[600px] h-[600px] bg-primary-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-[400px] h-[400px] bg-emerald-400 rounded-full mix-blend-multiply filter blur-3xl opacity-10"></div>
        
        <!-- Bottom Wave Divider -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-0">
            <svg class="relative block w-full h-[80px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C58.37,105.3,116.36,105.28,174.45,98.19c50.31-6.14,101.44-18,151.75-27.14Z" fill="#f8fafc"></path>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 reveal">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="text-white">
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-emerald-700/50 backdrop-blur-sm rounded-full text-emerald-300 text-xs font-bold uppercase tracking-widest mb-6">
                        <span class="w-2 h-2 bg-emerald-400 rounded-full animate-ping"></span>
                        Fresh Delivery Every Day
                    </div>
                    <h1 class="text-5xl lg:text-7xl font-extrabold tracking-tight mb-8 leading-[1.1]">
                        Freshness <span class="text-primary-400">Hand-Picked</span> For Your Family.
                    </h1>
                    <p class="text-emerald-100/80 text-lg mb-10 max-w-lg leading-relaxed">
                        Shop your daily essentials from the comfort of your home. We provide 100% organic and farm-fresh groceries delivered in 30 minutes.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="#shop" class="px-8 py-4 bg-primary-500 hover:bg-primary-600 text-white font-bold rounded-2xl transition-all shadow-xl shadow-primary-900/40 flex items-center gap-2">
                            <span>Shop Now</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                        <button class="px-8 py-4 bg-emerald-800/40 hover:bg-emerald-800/60 backdrop-blur-md text-white font-bold rounded-2xl border border-emerald-700/50 transition-all">
                            View Offers
                        </button>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-8 mt-16 border-t border-emerald-800/50 pt-8">
                        <div>
                            <div class="text-2xl font-bold">12k+</div>
                            <div class="text-emerald-400 text-xs uppercase tracking-tighter">Customers</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold">4.9/5</div>
                            <div class="text-emerald-400 text-xs uppercase tracking-tighter">Rating</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold">30m</div>
                            <div class="text-emerald-400 text-xs uppercase tracking-tighter">Delivery</div>
                        </div>
                    </div>
                </div>

                <div class="relative hidden lg:block">
                    <div class="relative z-10 w-full animate-float">
                         <img src="{{ asset('image/hero-premium.png') }}" alt="Hero Image" class="w-full drop-shadow-[0_35px_35px_rgba(0,0,0,0.5)]">
                    </div>
                    <!-- Decorative Elements -->
                    <div class="absolute -top-10 -left-10 w-32 h-32 bg-amber-400/20 backdrop-blur-xl rounded-full border border-amber-400/30 flex items-center justify-center p-4">
                        <div class="text-center text-white">
                            <span class="block text-xl font-bold text-amber-400">20%</span>
                            <span class="text-[10px] uppercase font-medium">Off Today</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Category Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-20">
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
            <!-- All Categories Filter -->
            <div @click="filterByCategory(0)" 
                 class="group flex flex-col items-center bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer reveal"
                 :class="activeCategory == 0 ? 'border-primary-500 bg-primary-50 shadow-lg -translate-y-2' : 'hover:border-primary-200'">
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center mb-4 transition-all duration-300"
                     :class="activeCategory == 0 ? 'bg-primary-600 shadow-lg shadow-primary-200' : 'bg-primary-50 group-hover:bg-primary-600'">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" :class="activeCategory == 0 ? 'text-white' : 'text-primary-600 group-hover:text-white'" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" /></svg>
                </div>
                <span class="text-sm font-bold" :class="activeCategory == 0 ? 'text-primary-900' : 'text-slate-700'">All Items</span>
            </div>
            @foreach($categories as $category)
                <x-category-card :category="$category" />
            @endforeach
        </div>
    </section>

    <!-- Flash Deal Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-32 reveal">
        <div class="bg-primary-900 rounded-[3rem] p-8 md:p-16 overflow-hidden relative shadow-2xl flex flex-col lg:flex-row items-center gap-12">
            <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
                <div class="absolute top-0 right-0 w-96 h-96 bg-primary-500 rounded-full filter blur-[100px]"></div>
            </div>
            
            <div class="flex-1 relative z-10 text-center lg:text-left">
                <span class="inline-block px-4 py-1 bg-primary-600 text-white text-xs font-bold uppercase tracking-[0.2em] rounded-full mb-6">Flash Sale ending soon</span>
                <h2 class="text-4xl md:text-5xl font-black text-white mb-8 leading-tight">Get <span class="text-primary-400">20% Off</span> on All Organic Vegetables!</h2>
                
                <div class="flex flex-wrap justify-center lg:justify-start gap-4">
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 w-20 text-center border border-white/10">
                        <div class="text-2xl font-black text-white" x-text="countdown.h">00</div>
                        <div class="text-[10px] text-primary-300 font-bold uppercase">Hrs</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 w-20 text-center border border-white/10">
                        <div class="text-2xl font-black text-white" x-text="countdown.m">00</div>
                        <div class="text-[10px] text-primary-300 font-bold uppercase">Min</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 w-20 text-center border border-white/10">
                        <div class="text-2xl font-black text-white" x-text="countdown.s">00</div>
                        <div class="text-[10px] text-primary-300 font-bold uppercase">Sec</div>
                    </div>
                </div>
            </div>
            
            <div class="w-full lg:w-96 relative z-10">
                <div class="bg-white rounded-[2.5rem] p-8 shadow-2xl">
                    <div class="relative aspect-square rounded-2xl overflow-hidden mb-6">
                        <img src="/image/freshbazar-bg.jpg" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-primary-900/60 to-transparent"></div>
                        <div class="absolute bottom-4 left-4">
                            <span class="text-white text-lg font-bold">Mix Veggie Pack</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-slate-400 line-through text-sm font-bold">$12.00</span>
                            <div class="text-2xl font-black text-primary-700">$9.60</div>
                        </div>
                        <button class="px-6 py-3 bg-primary-600 text-white font-bold rounded-xl hover:bg-primary-700 transition-all">Claim Now</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section id="shop" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-32 reveal">
        <div class="flex flex-col md:flex-row justify-between items-center md:items-end mb-10 gap-4">
            <div>
                <span class="text-sm font-bold text-primary-600 uppercase tracking-widest">Our Selection</span>
                <h2 class="text-4xl font-extrabold text-slate-900 tracking-tight">Best <span class="text-primary-600">Sellers</span></h2>
            </div>
            <!-- Category Indicator (Alpine) -->
            <template x-if="activeCategory !== 0">
                <div class="flex items-center gap-2 px-4 py-2 bg-primary-50 text-primary-700 rounded-full border border-primary-100">
                    <span class="text-xs font-bold uppercase tracking-widest">Filtered By Category</span>
                    <button @click="activeCategory = 0" class="p-1 hover:bg-primary-200 rounded-full"><svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" /></svg></button>
                </div>
            </template>
        </div>

        <!-- Skeleton Loader (Alpine) -->
        <div x-show="!allProducts.length" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <template x-for="n in 8">
                <div class="bg-white rounded-3xl p-4 shadow-sm border border-slate-50">
                    <div class="aspect-square rounded-2xl shimmer mb-4"></div>
                    <div class="h-4 w-2/3 shimmer rounded mb-2"></div>
                    <div class="h-4 w-1/3 shimmer rounded"></div>
                </div>
            </template>
        </div>

        <!-- Dynamic Product Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($featuredProducts as $product)
                <div x-show="activeCategory == 0 || activeCategory == {{ $product->category_id }}"
                     x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                    <x-product-card :product="$product" />
                </div>
            @empty
                <div class="col-span-full py-20 text-center">
                    <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300">
                         <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <p class="text-slate-500 font-medium">No products found in the database.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-32 reveal">
        <div class="text-center mb-16">
            <span class="text-sm font-bold text-primary-600 uppercase tracking-widest">Testimonials</span>
            <h2 class="text-4xl font-extrabold text-slate-900 tracking-tight">What Our <span class="text-primary-600">Customers</span> Say</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
                $testimonials = [
                    ['name' => 'Sarah Johnson', 'role' => 'Healthy Eater', 'text' => 'The freshness of the vegetables is unmatched. It feels like I picked them from the farm myself!'],
                    ['name' => 'Michael Chen', 'role' => 'Daily Shopper', 'text' => 'Fast delivery and excellent packaging. The Emerald Green theme looks amazing!'],
                    ['name' => 'Emily Davis', 'role' => 'Organic Lover', 'text' => 'I love supporting local farms. FreshBazar makes it so easy to eat organic on a budget.']
                ];
            @endphp
            @foreach($testimonials as $t)
                <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all group">
                    <div class="flex items-center gap-1 text-amber-400 mb-6">
                        @for($i=0; $i<5; $i++) <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg> @endfor
                    </div>
                    <p class="text-slate-600 mb-8 italic leading-relaxed">"{{ $t['text'] }}"</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center text-primary-600 font-bold text-lg">
                            {{ substr($t['name'], 0, 1) }}
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900">{{ $t['name'] }}</h4>
                            <p class="text-xs text-slate-400 font-medium">{{ $t['role'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Simple Features Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-32 mb-10 reveal">
        <div class="bg-emerald-600 rounded-[3rem] p-12 overflow-hidden relative shadow-2xl shadow-emerald-200">
            <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-500 rounded-full -mr-32 -mt-32"></div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative z-10">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-emerald-500/50 rounded-2xl flex items-center justify-center text-white flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-white font-bold text-lg mb-2">Fast Delivery</h4>
                        <p class="text-emerald-100 text-sm">Get your orders delivered to your home within 30 minutes.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4 border-emerald-500/30 md:border-l md:pl-12">
                    <div class="w-12 h-12 bg-emerald-500/50 rounded-2xl flex items-center justify-center text-white flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-white font-bold text-lg mb-2">Secure Payment</h4>
                        <p class="text-emerald-100 text-sm">We ensure 100% secure payment systems for all our customers.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4 border-emerald-500/30 md:border-l md:pl-12">
                    <div class="w-12 h-12 bg-emerald-500/50 rounded-2xl flex items-center justify-center text-white flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-white font-bold text-lg mb-2">Best Quality</h4>
                        <p class="text-emerald-100 text-sm">Hand-picked fresh products directly from local farmers.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-30px); }
        }
    </style>
@endsection