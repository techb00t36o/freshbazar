@extends('layouts.admin')

@section('content')
<div class="space-y-8 text-center py-20 bg-white rounded-[3rem] border border-slate-100 shadow-sm reveal">
    <div class="w-24 h-24 bg-primary-50 rounded-[2rem] flex items-center justify-center text-primary-600 mx-auto mb-8 shadow-inner">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
        </svg>
    </div>
    <h2 class="text-3xl font-black text-slate-800">Category <span class="text-primary-600">Management</span></h2>
    <p class="text-slate-400 max-w-sm mx-auto font-medium">Manage your grocery categories to help customers find products faster.</p>
    
    <div class="max-w-xl mx-auto mt-12 overflow-hidden rounded-[2.5rem] border border-slate-50 shadow-sm">
        <table class="w-full">
            <tbody class="divide-y divide-slate-50">
                @foreach(App\Models\Category::all() as $cat)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="py-6 px-10 text-left font-bold text-slate-700">{{ $cat->name }}</td>
                    <td class="py-6 px-10 text-right">
                        <span class="text-[10px] font-black text-primary-600 uppercase tracking-widest bg-primary-100 px-3 py-1 rounded-full">{{ $cat->products_count ?? 0 }} Items</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="pt-10">
        <button class="px-10 py-4 bg-primary-600 text-white font-bold rounded-2xl shadow-xl shadow-primary-200 hover:bg-primary-700 transition-all">+ Add Category</button>
    </div>
</div>
@endsection
