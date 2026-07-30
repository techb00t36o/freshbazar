@extends('layouts.shop')

@section('content')
<div class="bg-slate-50 min-h-screen pt-32 pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <form action="{{ route('checkout.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            @csrf
            
            <!-- Left Side: Order Information -->
            <div class="lg:col-span-2 space-y-10">
                <!-- Shipping Details -->
                <div class="bg-white rounded-[3rem] p-8 md:p-12 shadow-sm border border-slate-100 reveal active">
                    <div class="flex items-center gap-4 mb-10">
                        <div class="w-12 h-12 bg-primary-100 text-primary-600 rounded-2xl flex items-center justify-center font-bold">1</div>
                        <h2 class="text-2xl font-black text-slate-800">Shipping <span class="text-primary-600">Information</span></h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Full Name</label>
                            <input type="text" name="name" value="{{ Auth::guest() ? '' : Auth::user()->name }}" required
                                   class="w-full bg-slate-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-primary-500 transition-all font-bold text-slate-700">
                        </div>
                        <div class="space-y-3">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Phone Number</label>
                            <input type="text" name="phone" placeholder="e.g. 017XXXXXXXX" required
                                   class="w-full bg-slate-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-primary-500 transition-all font-bold text-slate-700">
                        </div>
                        <div class="md:col-span-2 space-y-3">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Delivery Address</label>
                            <textarea name="address" rows="3" placeholder="Apartment, Street, House Number..." required
                                      class="w-full bg-slate-50 border-none rounded-[2rem] py-5 px-8 focus:ring-2 focus:ring-primary-500 transition-all font-bold text-slate-700 leading-relaxed"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Payment Selection -->
                <div class="bg-white rounded-[3rem] p-8 md:p-12 shadow-sm border border-slate-100 reveal active">
                    <div class="flex items-center gap-4 mb-10">
                        <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center font-bold">2</div>
                        <h2 class="text-2xl font-black text-slate-800">Payment <span class="text-amber-600">Method</span></h2>
                    </div>

                    <div class="space-y-4">
                        <!-- Cash on Delivery Option -->
                        <label class="relative flex items-center p-6 bg-slate-50 rounded-3xl border-2 border-primary-500 cursor-pointer group transition-all">
                            <input type="radio" name="payment_method" value="COD" checked class="hidden">
                            <div class="flex items-center gap-6 flex-1">
                                <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-primary-600 shadow-sm border border-slate-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800">Cash on Delivery</h4>
                                    <p class="text-xs text-slate-400 font-medium">Pay once your fresh groceries arrive at home</p>
                                </div>
                                <div class="w-6 h-6 border-2 border-primary-500 rounded-full flex items-center justify-center">
                                    <div class="w-3 h-3 bg-primary-500 rounded-full"></div>
                                </div>
                            </div>
                        </label>

                        <!-- Other Options (Placeholder) -->
                        <div class="p-6 bg-slate-50/50 rounded-3xl border-2 border-slate-100 opacity-50 flex items-center gap-6">
                            <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-slate-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-300 text-sm">Online Payment (Bkash / Nagad)</h4>
                                <p class="text-[10px] uppercase font-bold tracking-widest text-slate-300">Coming Soon</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Order Summary -->
            <div class="space-y-8">
                <div class="bg-slate-900 rounded-[3rem] p-10 text-white shadow-2xl reveal active sticky top-32">
                    <h3 class="text-2xl font-bold mb-8 flex items-center gap-2">
                        Summary
                        <span class="text-xs bg-primary-600 px-3 py-1 rounded-full uppercase tracking-tighter">Items: {{ count($cart) }}</span>
                    </h3>
                    
                    <!-- Items Loop -->
                    <div class="space-y-6 mb-10 max-h-60 overflow-y-auto custom-scrollbar pr-4">
                        @foreach($cart as $id => $item)
                        <div class="flex items-center gap-4 group">
                            <div class="w-14 h-14 bg-white/5 rounded-2xl flex-shrink-0 flex items-center justify-center border border-white/10">
                                <span class="text-primary-400 font-bold text-xs">{{ $item['quantity'] }}x</span>
                            </div>
                            <div class="flex-1 overflow-hidden">
                                <h4 class="font-bold text-sm truncate">{{ $item['name'] }}</h4>
                                <p class="text-xs text-slate-400">${{ $item['price'] }} / unit</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="space-y-4 pt-8 border-t border-white/10">
                        <div class="flex justify-between text-slate-400">
                            <span>Subtotal</span>
                            <span class="font-bold text-white">
                                @php 
                                    $total = 0; 
                                    foreach($cart as $i) $total += $i['price'] * $i['quantity'];
                                    echo '$' . number_format($total, 2);
                                @endphp
                            </span>
                        </div>
                        <div class="flex justify-between text-slate-400">
                            <span>Shipping</span>
                            <span class="text-primary-500 font-bold uppercase tracking-tighter text-xs">Free Delivery</span>
                        </div>
                        <div class="pt-6 mt-6 border-t border-white/10 flex justify-between items-center text-2xl font-black italic">
                            <span class="uppercase tracking-tight text-xl">Total</span>
                            <span class="text-primary-500 tracking-tighter">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <button type="submit" class="w-full mt-10 py-5 bg-primary-600 hover:bg-primary-500 text-white font-black rounded-[1.5rem] shadow-2xl shadow-primary-900 transition-all flex items-center justify-center gap-3 group">
                        <span class="uppercase tracking-widest text-sm">Place My Order</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </button>
                    
                    <p class="text-[10px] text-center text-slate-500 mt-6 font-medium uppercase tracking-[0.2em]">Secured by FreshBazar Guard</p>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
