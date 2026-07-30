<!-- resources/views/components/category-card.blade.php -->
@props(['category'])

<!-- resources/views/components/category-card.blade.php -->
@props(['category'])

<div @click="filterByCategory({{ $category->id }})" 
     class="group flex flex-col items-center bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer reveal"
     :class="activeCategory == {{ $category->id }} ? 'border-primary-500 bg-primary-50 shadow-lg -translate-y-2' : 'hover:border-primary-200'">
    <div class="w-16 h-16 rounded-2xl flex items-center justify-center mb-4 transition-all duration-300"
         :class="activeCategory == {{ $category->id }} ? 'bg-primary-600 shadow-lg shadow-primary-200' : 'bg-primary-50 group-hover:bg-primary-600'">
        <!-- Dynamic Icon based on Category name -->
        @php
            $icon = match(Str::lower($category->name)) {
                'vegetable', 'vegetables' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>',
                'fish' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" /></svg>',
                'meat' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>',
                default => '<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>'
            };
        @endphp
        <div class="transition-colors duration-300"
             :class="activeCategory == {{ $category->id }} ? 'text-white' : 'text-primary-600 group-hover:text-white'">
            {!! $icon !!}
        </div>
    </div>
    <span class="text-sm font-bold transition-colors"
          :class="activeCategory == {{ $category->id }} ? 'text-primary-900' : 'text-slate-700 group-hover:text-primary-800'">{{ $category->name }}</span>
    <span class="text-[10px] uppercase font-bold tracking-tighter mt-1"
          :class="activeCategory == {{ $category->id }} ? 'text-primary-600' : 'text-slate-400'">Select</span>
</div>
