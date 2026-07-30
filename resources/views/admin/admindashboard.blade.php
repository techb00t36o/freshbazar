@extends('layouts.admin')

@section('content')
<div class="space-y-10">
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <!-- Total Sales -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 hover:shadow-xl transition-all group reveal">
            <div class="flex justify-between items-start mb-6">
                <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center text-primary-600 group-hover:bg-primary-600 group-hover:text-white transition-all duration-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="px-3 py-1 bg-emerald-100 text-primary-700 text-[10px] font-bold rounded-full">+12.5%</span>
            </div>
            <p class="text-slate-400 font-bold text-xs uppercase tracking-widest mb-1">Total Revenue</p>
            <h3 class="text-3xl font-black text-slate-800">$12,450.00</h3>
        </div>

        <!-- Total Orders -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 hover:shadow-xl transition-all group reveal">
            <div class="flex justify-between items-start mb-6">
                <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-all duration-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-4-4H8a4 4 0 00-4 4v4m14 4v1m-9-1v1m-4-1v1m3 3h10a1 1 0 001-1v-4a1 1 0 00-1-1H3a1 1 0 00-1 1v4a1 1 0 001 1h3z" />
                    </svg>
                </div>
                <span class="px-3 py-1 bg-blue-100 text-blue-700 text-[10px] font-bold rounded-full">+5.2%</span>
            </div>
            <p class="text-slate-400 font-bold text-xs uppercase tracking-widest mb-1">Total Orders</p>
            <h3 class="text-3xl font-black text-slate-800">156</h3>
        </div>

        <!-- Total Products -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 hover:shadow-xl transition-all group reveal">
            <div class="flex justify-between items-start mb-6">
                <div class="w-14 h-14 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 group-hover:bg-amber-600 group-hover:text-white transition-all duration-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <span class="px-3 py-1 bg-amber-100 text-amber-700 text-[10px] font-bold rounded-full">Active</span>
            </div>
            <p class="text-slate-400 font-bold text-xs uppercase tracking-widest mb-1">Total Products</p>
            <h3 class="text-3xl font-black text-slate-800">42</h3>
        </div>

        <!-- Customer Count -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 hover:shadow-xl transition-all group reveal">
            <div class="flex justify-between items-start mb-6">
                <div class="w-14 h-14 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-all duration-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <span class="px-3 py-1 bg-purple-100 text-purple-700 text-[10px] font-bold rounded-full">New</span>
            </div>
            <p class="text-slate-400 font-bold text-xs uppercase tracking-widest mb-1">New Customers</p>
            <h3 class="text-3xl font-black text-slate-800">12k+</h3>
        </div>
    </div>

    <!-- Charts & Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Placeholder for a Chart -->
        <div class="lg:col-span-2 bg-white p-10 rounded-[3rem] border border-slate-100 shadow-sm reveal">
            <div class="flex justify-between items-center mb-10">
                <h3 class="text-xl font-bold text-slate-800">Sales Overview</h3>
                <div class="flex gap-2">
                    <button class="px-4 py-2 bg-slate-50 text-slate-500 text-xs font-bold rounded-xl hover:bg-slate-100">Month</button>
                    <button class="px-4 py-2 bg-primary-600 text-white text-xs font-bold rounded-xl shadow-lg shadow-primary-200">Year</button>
                </div>
            </div>
            
            <div class="aspect-[16/7] w-full bg-slate-50 rounded-3xl flex items-center justify-center border-2 border-dashed border-slate-200 overflow-hidden relative">
                <div class="absolute inset-0 flex items-end px-12 pb-8 gap-4">
                    @for($i=0; $i<12; $i++)
                        <div class="flex-1 bg-primary-500/20 rounded-t-lg transition-all hover:bg-primary-500 group relative" style="height: {{ rand(30, 90) }}%">
                            <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-slate-800 text-white text-[10px] py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity">
                                ${{ rand(100, 500) }}
                            </div>
                        </div>
                    @endfor
                </div>
                <p class="text-slate-400 font-bold text-sm uppercase tracking-widest relative z-10 bg-white/80 px-6 py-2 rounded-full border border-slate-100">Revenue Statistics</p>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white p-10 rounded-[3rem] border border-slate-100 shadow-sm reveal">
            <h3 class="text-xl font-bold text-slate-800 mb-8">Stock Alerts</h3>
            <div class="space-y-6">
                @php
                    $alerts = [
                        ['p' => 'Organic Tomatoes', 'q' => '5kg left', 'color' => 'red'],
                        ['p' => 'Fresh Milk', 'q' => '12 units left', 'color' => 'amber'],
                        ['p' => 'Green Spinach', 'q' => 'Out of stock', 'color' => 'red'],
                        ['p' => 'Local Honey', 'q' => '8 bottles left', 'color' => 'amber'],
                    ];
                @endphp
                @foreach($alerts as $a)
                    <div class="flex items-center gap-4 group cursor-pointer hover:translate-x-1 transition-transform">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center bg-{{ $a['color'] }}-50 text-{{ $a['color'] }}-600 font-bold border border-{{ $a['color'] }}-100 group-hover:bg-{{ $a['color'] }}-600 group-hover:text-white transition-all">
                            {{ substr($a['p'], 0, 1) }}
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-bold text-slate-800">{{ $a['p'] }}</h4>
                            <p class="text-[10px] font-bold text-{{ $a['color'] }}-600 uppercase tracking-widest">{{ $a['q'] }}</p>
                        </div>
                        <svg class="w-4 h-4 text-slate-300 group-hover:text-{{ $a['color'] }}-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </div>
                @endforeach
            </div>
            
            <button class="w-full mt-12 py-3 bg-slate-50 text-slate-400 text-xs font-bold uppercase tracking-widest rounded-2xl hover:bg-slate-100 transition-all">View All Inventory</button>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="bg-white p-10 rounded-[3rem] border border-slate-100 shadow-sm reveal">
        <div class="flex justify-between items-center mb-10">
            <h3 class="text-2xl font-black text-slate-800">Recent <span class="text-primary-600">Orders</span></h3>
            <a href="{{ route('admin.orders.index') }}" class="text-sm font-bold text-primary-600 hover:text-primary-700 flex items-center gap-2 group">
                View All Orders
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
            </a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-slate-400 text-[10px] uppercase font-black tracking-[0.2em] border-b border-slate-50">
                        <th class="pb-6 px-4">Order ID</th>
                        <th class="pb-6 px-4">Customer</th>
                        <th class="pb-6 px-4">Status</th>
                        <th class="pb-6 px-4">Amount</th>
                        <th class="pb-6 px-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @for($i=1; $i<=5; $i++)
                    <tr class="group hover:bg-slate-50/50 transition-colors">
                        <td class="py-6 px-4">
                            <span class="text-xs font-black text-slate-400 uppercase tracking-tighter">#FB-00{{ $i }}</span>
                        </td>
                        <td class="py-6 px-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-primary-100 text-primary-600 flex items-center justify-center font-bold text-xs uppercase">J</div>
                                <span class="text-sm font-bold text-slate-700">John Doe</span>
                            </div>
                        </td>
                        <td class="py-6 px-4">
                            <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-bold rounded-full">Shipped</span>
                        </td>
                        <td class="py-6 px-4 font-bold text-slate-800 text-sm">$120.00</td>
                        <td class="py-6 px-4 text-right">
                            <button class="p-2 text-slate-300 hover:text-primary-600 hover:bg-primary-50 rounded-xl transition-all">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            </button>
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, { threshold: 0.1 });
        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    });
</script>
@endsection
