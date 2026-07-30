@extends('layouts.shop')

@section('content')
<div class="bg-slate-50 min-h-screen pt-24 pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Welcome Header -->
        <div class="mb-12 reveal">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight mb-2">Hello, <span class="text-primary-600">{{ explode(' ', $user->name)[0] }}!</span></h1>
                    <p class="text-slate-500">Welcome back to your FreshBazar dashboard. Here's what's happening today.</p>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('home') }}" class="px-6 py-3 bg-primary-600 text-white font-bold rounded-2xl hover:bg-primary-700 transition-all shadow-lg shadow-primary-100 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                        Start Shopping
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            <!-- Total Orders -->
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 hover:shadow-xl transition-all reveal">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 bg-primary-100 text-primary-600 rounded-2xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                    </div>
                    <span class="text-sm font-bold text-slate-400 uppercase tracking-widest">Total Orders</span>
                </div>
                <div class="text-4xl font-extrabold text-slate-900">{{ $stats['total_orders'] }}</div>
                <div class="mt-2 text-xs text-slate-400 font-medium italic">Placed since you joined</div>
            </div>

            <!-- Pending Orders -->
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 hover:shadow-xl transition-all reveal">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <span class="text-sm font-bold text-slate-400 uppercase tracking-widest">Pending</span>
                </div>
                <div class="text-4xl font-extrabold text-slate-900">{{ $stats['pending_orders'] }}</div>
                <div class="mt-2 text-xs text-slate-400 font-medium italic">Current orders in progress</div>
            </div>

            <!-- Total Spent -->
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 hover:shadow-xl transition-all reveal">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <span class="text-sm font-bold text-slate-400 uppercase tracking-widest">Total Spent</span>
                </div>
                <div class="text-4xl font-extrabold text-slate-900">${{ number_format($stats['total_spent'], 2) }}</div>
                <div class="mt-2 text-xs text-slate-400 font-medium italic">Premium organic investments</div>
            </div>
        </div>

        <!-- Recent Orders Table -->
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden reveal">
            <div class="p-8 border-b border-slate-100 flex items-center justify-between">
                <h3 class="text-xl font-bold text-slate-900">Recent Orders</h3>
                <a href="#" class="text-sm font-bold text-primary-600 hover:text-primary-700 transition-colors">View All Orders</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50">
                            <th class="px-8 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest uppercase">Order ID</th>
                            <th class="px-8 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest uppercase">Date</th>
                            <th class="px-8 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest uppercase">Total</th>
                            <th class="px-8 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest uppercase">Status</th>
                            <th class="px-8 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest uppercase text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($orders as $order)
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-8 py-6 font-bold text-slate-700">#FB-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-8 py-6 text-slate-500 text-sm">{{ $order->created_at->format('M d, Y') }}</td>
                            <td class="px-8 py-6 font-bold text-slate-900">${{ number_format($order->total, 2) }}</td>
                            <td class="px-8 py-6">
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-amber-100 text-amber-700',
                                        'processing' => 'bg-primary-100 text-primary-700',
                                        'completed' => 'bg-emerald-100 text-emerald-700',
                                        'cancelled' => 'bg-red-100 text-red-700',
                                    ];
                                    $class = $statusClasses[$order->status] ?? 'bg-slate-100 text-slate-700';
                                @endphp
                                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $class }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <button class="px-4 py-2 bg-slate-50 text-slate-600 font-bold text-xs rounded-xl hover:bg-slate-900 hover:text-white transition-all">
                                    Details
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-8 py-20 text-center">
                                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                                </div>
                                <p class="text-slate-500 font-bold mb-2">No orders found</p>
                                <a href="{{ route('home') }}" class="text-primary-600 font-bold text-sm hover:underline">Go to the shop to place your first order!</a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection