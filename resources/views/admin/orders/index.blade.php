@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-center bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm gap-4 reveal">
        <div>
            <h2 class="text-3xl font-black text-slate-800">Customer <span class="text-primary-600">Orders</span></h2>
            <p class="text-slate-400 text-sm font-medium mt-1">Track and manage store sales and shipments</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.orders.export') }}" class="px-6 py-3 bg-slate-50 text-slate-500 font-bold rounded-xl border border-slate-100 hover:bg-slate-100 transition-all">Export CSV</a>
            <a href="{{ route('admin.orders.report') }}" target="_blank" class="px-6 py-3 bg-primary-600 text-white font-bold rounded-xl shadow-lg shadow-primary-200 hover:bg-primary-700 transition-all">Report</a>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="bg-white rounded-[3rem] border border-slate-100 shadow-sm overflow-hidden reveal">
        <div class="p-8 border-b border-slate-50 flex justify-between items-center gap-4 flex-wrap">
            <div class="flex gap-4">
                <button class="px-5 py-2.5 bg-primary-600 text-white text-xs font-bold rounded-full">All Orders</button>
                <button class="px-5 py-2.5 bg-slate-50 text-slate-400 text-xs font-bold rounded-full hover:bg-slate-100">Pending</button>
                <button class="px-5 py-2.5 bg-slate-50 text-slate-400 text-xs font-bold rounded-full hover:bg-slate-100">Delivered</button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-slate-400 text-[10px] uppercase font-black tracking-[0.2em] border-b border-slate-50">
                        <th class="py-6 px-10">Order ID</th>
                        <th class="py-6 px-4">Customer</th>
                        <th class="py-6 px-4">Status</th>
                        <th class="py-6 px-4 text-center">Items</th>
                        <th class="py-6 px-4">Total Amount</th>
                        <th class="py-6 px-10 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($orders as $order)
                    <tr class="group hover:bg-slate-50/50 transition-all">
                        <td class="py-6 px-10">
                            <span class="text-xs font-black text-slate-400 uppercase tracking-tighter">#ORD-{{ $order->id }}</span>
                        </td>
                        <td class="py-6 px-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-primary-50 text-primary-600 flex items-center justify-center font-black text-xs uppercase shadow-sm">
                                    {{ substr($order->user->name ?? 'U', 0, 1) }}
                                </div>
                                <div>
                                    <span class="block text-sm font-bold text-slate-800">{{ $order->user->name ?? 'Guest User' }}</span>
                                    <span class="text-[10px] font-bold text-slate-400 mt-0.5">{{ $order->user->email ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-6 px-4">
                            @php
                                $statusColor = match($order->status ?? 'pending') {
                                    'pending' => 'bg-amber-100 text-amber-700',
                                    'shipped' => 'bg-blue-100 text-blue-700',
                                    'delivered' => 'bg-emerald-100 text-emerald-700',
                                    default => 'bg-slate-100 text-slate-700'
                                };
                            @endphp
                            <span class="px-3 py-1 {{ $statusColor }} text-[10px] font-black uppercase tracking-widest rounded-full">
                                {{ $order->status ?? 'Pending' }}
                            </span>
                        </td>
                        <td class="py-6 px-4 text-center">
                            <span class="text-sm font-bold text-slate-500">{{ $order->items_count ?? count($order->items ?? []) }} Items</span>
                        </td>
                        <td class="py-6 px-4 font-black text-slate-800 text-sm">
                            ${{ number_format($order->total ?? 0, 2) }}
                        </td>
                        <td class="py-6 px-10 text-right">
                            <div class="flex justify-end gap-2">
                                <!-- View Details -->
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="p-3 bg-slate-50 hover:bg-primary-500 hover:text-white rounded-xl text-slate-400 transition-all shadow-sm" title="View Order">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                </a>

                                <!-- Print Invoice -->
                                <a href="{{ route('admin.orders.invoice', $order->id) }}" target="_blank" class="p-3 bg-slate-50 hover:bg-emerald-500 hover:text-white rounded-xl text-slate-400 transition-all shadow-sm" title="Print Invoice">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2-2H9a2 2 0 00-2 2v4" /></svg>
                                </a>

                                <!-- Mark as Completed -->
                                @if($order->status !== 'completed')
                                <form action="{{ route('admin.orders.status', $order->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="completed">
                                    <button type="submit" class="p-3 bg-slate-50 hover:bg-amber-500 hover:text-white rounded-xl text-slate-400 transition-all shadow-sm" title="Mark as Completed">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-20 text-center text-slate-400 bg-slate-50/20">
                            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 border-4 border-white shadow-inner">
                                <svg class="w-10 h-10 text-slate-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-4-4H8a4 4 0 00-4 4v4m14 4v1m-9-1v1m-4-1v1m3 3h10a1 1 0 001-1v-4a1 1 0 00-1-1H3a1 1 0 00-1 1v4a1 1 0 001 1h3z" /></svg>
                            </div>
                            <p class="font-bold">No orders found yet.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if(method_exists($orders, 'links'))
        <div class="p-8 border-t border-slate-50">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
