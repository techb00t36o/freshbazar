@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-center bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm gap-4 reveal">
        <div>
            <h2 class="text-3xl font-black text-slate-800">Product <span class="text-primary-600">Inventory</span></h2>
            <p class="text-slate-400 text-sm font-medium mt-1">Manage, edit, and track your store's stock</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="group flex items-center gap-2 px-8 py-4 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-2xl transition-all shadow-xl shadow-primary-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            Add New Product
        </a>
    </div>

    <!-- Product Table -->
    <div class="bg-white rounded-[3rem] border border-slate-100 shadow-sm overflow-hidden reveal">
        <div class="p-8 border-b border-slate-50 flex justify-between items-center gap-4 flex-wrap">
            <div class="relative max-w-sm w-full">
                <input type="text" placeholder="Filter products..." class="w-full bg-slate-50 border-none rounded-2xl py-3 px-5 pl-12 focus:ring-2 focus:ring-primary-500 text-sm transition-all">
                <svg class="h-5 w-5 absolute left-4 top-3 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            </div>
            <div class="flex gap-2">
                <button class="p-3 bg-slate-50 hover:bg-slate-100 rounded-xl text-slate-400 transition-all"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" /></svg></button>
                <button class="p-3 bg-slate-50 hover:bg-slate-100 rounded-xl text-slate-400 transition-all"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" /></svg></button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-slate-400 text-[10px] uppercase font-black tracking-[0.2em] border-b border-slate-50">
                        <th class="py-6 px-10">Product</th>
                        <th class="py-6 px-4">Price</th>
                        <th class="py-6 px-4">Category</th>
                        <th class="py-6 px-4">Status</th>
                        <th class="py-6 px-10 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($products as $product)
                    <tr class="group hover:bg-slate-50/50 transition-all">
                        <td class="py-6 px-10">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 rounded-2xl overflow-hidden bg-slate-50 border border-slate-100 shadow-inner flex-shrink-0">
                                    <img src="{{ $product->image ? (Str::startsWith($product->image, 'http') ? $product->image : asset('storage/' . $product->image)) : asset('image/shop.jpg') }}" class="w-full h-full object-cover transition-transform group-hover:scale-110">
                                </div>
                                <div class="overflow-hidden">
                                    <span class="block text-sm font-bold text-slate-800 truncate">{{ $product->name }}</span>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">ID: #FB-{{ $product->id }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-6 px-4">
                            <span class="text-sm font-black text-primary-700">${{ number_format($product->price, 2) }}</span>
                        </td>
                        <td class="py-6 px-4">
                            <span class="text-xs font-bold text-slate-500 bg-slate-100 px-3 py-1 rounded-lg">{{ $product->category->name ?? 'Uncategorized' }}</span>
                        </td>
                        <td class="py-6 px-4">
                            @if(($product->quantity ?? 10) > 5)
                                <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-bold rounded-full">In Stock</span>
                            @else
                                <span class="px-3 py-1 bg-amber-100 text-amber-700 text-[10px] font-bold rounded-full">Low Stock</span>
                            @endif
                        </td>
                        <td class="py-6 px-10 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="p-3 bg-slate-50 hover:bg-primary-500 hover:text-white rounded-xl text-slate-400 transition-all shadow-sm">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Delete this product?');" class="inline">
                                    @csrf @method('DELETE')
                                    <button class="p-3 bg-slate-50 hover:bg-red-500 hover:text-white rounded-xl text-slate-400 transition-all shadow-sm">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-20 text-center text-slate-400 bg-slate-50/20">
                            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 border-4 border-white shadow-inner">
                                <svg class="w-10 h-10 text-slate-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                            </div>
                            <p class="font-bold">No products available.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
