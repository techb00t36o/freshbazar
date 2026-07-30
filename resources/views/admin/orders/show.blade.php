@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto space-y-10">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-center gap-6 reveal">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.orders.index') }}" class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-sm border border-slate-100 hover:border-primary-200 transition-all text-slate-400 hover:text-primary-600">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
            </a>
            <div>
                <h2 class="text-3xl font-black text-slate-800 tracking-tight">Order <span class="text-primary-600">#ORD-{{ $order->id }}</span></h2>
                <p class="text-slate-400 text-sm font-medium mt-1">Placed on {{ $order->created_at->format('M d, Y - h:i A') }}</p>
            </div>
        </div>
        <div class="flex flex-wrap gap-3">
            <!-- Print Invoice -->
            <a href="{{ route('admin.orders.invoice', $order->id) }}" target="_blank" class="px-8 py-4 bg-white text-slate-600 font-bold rounded-2xl border border-slate-100 shadow-sm hover:bg-slate-50 transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2-2H9a2 2 0 00-2 2v4" /></svg>
                Print Invoice
            </a>

            <!-- Update Status Form -->
            <form action="{{ route('admin.orders.status', $order->id) }}" method="POST" class="flex gap-2">
                @csrf
                @method('PATCH')
                <select name="status" class="px-4 py-4 bg-white border border-slate-100 rounded-2xl text-sm font-bold text-slate-700 focus:ring-2 focus:ring-primary-500 outline-none">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <button type="submit" class="px-8 py-4 bg-primary-600 text-white font-bold rounded-2xl shadow-xl shadow-primary-200 hover:bg-primary-700 transition-all">Update</button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Order Items -->
        <div class="lg:col-span-2 space-y-10">
            <div class="bg-white rounded-[3rem] border border-slate-100 shadow-sm overflow-hidden reveal">
                <div class="p-8 border-b border-slate-50">
                    <h3 class="text-xl font-bold text-slate-800">Order Items</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <tbody class="divide-y divide-slate-50">
                            @foreach($order->items as $item)
                            <tr class="group hover:bg-slate-50/50 transition-colors">
                                <td class="py-8 px-10">
                                    <div class="flex items-center gap-6">
                                        <div class="w-16 h-16 rounded-2xl overflow-hidden bg-slate-50 border border-slate-100 flex-shrink-0">
                                            <img src="{{ optional($item->product)->image ? (Str::startsWith($item->product->image, 'http') ? $item->product->image : asset('storage/' . $item->product->image)) : asset('image/shop.jpg') }}" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <span class="block text-sm font-bold text-slate-800">{{ $item->product->name ?? 'Deleted Product' }}</span>
                                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Ref: #P-{{ $item->product_id }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-8 px-4 text-center">
                                    <span class="text-sm font-bold text-slate-600">x{{ $item->quantity }}</span>
                                </td>
                                <td class="py-8 px-10 text-right">
                                    <span class="text-sm font-black text-primary-700">${{ number_format($item->price * $item->quantity, 2) }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Summary -->
                <div class="p-10 bg-slate-50/50 space-y-4">
                    <div class="flex justify-between text-sm font-bold text-slate-400">
                        <span>Subtotal</span>
                        <span>${{ number_format($order->total, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-sm font-bold text-slate-400">
                        <span>Shipping Fee</span>
                        <span>$0.00</span>
                    </div>
                    <div class="pt-4 border-t border-slate-200 flex justify-between text-xl font-black text-slate-900 uppercase tracking-tight">
                        <span>Grand Total</span>
                        <span class="text-primary-600">${{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer & Shipping Info -->
        <div class="space-y-10">
            <!-- Customer Detail -->
            <div class="bg-white p-10 rounded-[3rem] border border-slate-100 shadow-sm reveal">
                <h3 class="text-xl font-bold text-slate-800 mb-8 border-b border-slate-50 pb-6">Customer Profile</h3>
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-16 h-16 rounded-[2rem] bg-primary-100 text-primary-600 flex items-center justify-center font-black text-xl uppercase shadow-inner">
                        {{ substr($order->user->name ?? 'U', 0, 1) }}
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-800 text-lg leading-tight">{{ $order->user->name ?? 'Guest User' }}</h4>
                        <p class="text-[10px] font-bold text-primary-600 uppercase tracking-widest mt-1">Direct Buyer</p>
                    </div>
                </div>
                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="p-2 bg-slate-50 rounded-xl text-slate-400"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" /></svg></div>
                        <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Email Address</p><p class="text-xs font-bold text-slate-700 mt-1">{{ $order->user->email ?? 'N/A' }}</p></div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="p-2 bg-slate-50 rounded-xl text-slate-400"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg></div>
                        <div><p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Phone Number</p><p class="text-xs font-bold text-slate-700 mt-1">{{ $order->phone ?? '+880 1XXX-XXXXXX' }}</p></div>
                    </div>
                </div>
            </div>

            <!-- Shipping Address -->
            <div class="bg-primary-900 p-10 rounded-[3rem] text-white shadow-2xl reveal">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 bg-primary-800/50 rounded-xl flex items-center justify-center text-primary-400 shadow-inner">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    </div>
                    <h3 class="text-lg font-bold">Shipping Details</h3>
                </div>
                <div class="space-y-4">
                    <p class="text-sm font-medium leading-relaxed text-emerald-100/70">{{ $order->address ?? 'Home Delivery - 123 Street Name, Area Sub-district, Dhaka, Bangladesh.' }}</p>
                    <div class="pt-4 mt-6 border-t border-white/10">
                        <div class="inline-flex items-center gap-2 px-3 py-1 bg-emerald-800/50 rounded-full text-[10px] font-bold text-emerald-300 tracking-widest uppercase">
                            Fast Track Delivery
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
