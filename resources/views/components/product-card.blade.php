<!-- resources/views/components/product-card.blade.php -->
@props(['product'])

@php
    $imgFallback = asset('image/shop.jpg');
    if ($product->image) {
        $imgUrl = Str::startsWith($product->image, 'http') ? $product->image : asset('storage/' . $product->image);
    } else {
        $imgUrl = $imgFallback;
    }
@endphp

<div class="group bg-white rounded-3xl p-4 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-slate-100">
    <div class="relative aspect-square overflow-hidden rounded-2xl bg-slate-50 mb-4">
        <img src="{{ $imgUrl }}" 
             alt="{{ $product->name }}" 
             onerror="this.onerror=null;this.src='https://placehold.co/600x600/emerald/white?text=Product'"
             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
        
        <div class="absolute top-3 right-3 flex flex-col gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            <button @click="openQuickView({ 
                    id: {{ $product->id }}, 
                    name: '{{ $product->name }}', 
                    price: {{ $product->price }}, 
                    image_url: '{{ $imgUrl }}',
                    description: '{{ addslashes($product->description) }}'
                })" 
                class="p-2 bg-white hover:bg-primary-600 hover:text-white rounded-xl text-slate-400 shadow-sm transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </button>
            <button class="p-2 bg-white hover:bg-red-500 hover:text-white rounded-xl text-slate-400 shadow-sm transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewbox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
            </button>
        </div>
    </div>

    <div class="px-1">
        <div class="flex justify-between items-start mb-2">
            <div>
                <span class="text-xs font-bold text-primary-600 uppercase tracking-wider">Organic</span>
                <h3 class="text-lg font-bold text-slate-800 line-clamp-1">{{ $product->name }}</h3>
            </div>
            <div class="text-right">
                <span class="text-lg font-bold text-primary-700">${{ $product->price }}</span>
                <p class="text-[10px] text-slate-400 font-medium">/ 1 kg</p>
            </div>
        </div>

        <div class="flex items-center gap-1 mb-4">
            @for($i = 0; $i < 5; $i++)
                <svg class="w-3 h-3 text-amber-400 fill-current" viewbox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            @endfor
            <span class="text-xs text-slate-400 ml-1">(4.8)</span>
        </div>

        <button @click="addToCart({ 
                id: {{ $product->id }}, 
                name: '{{ $product->name }}', 
                price: {{ $product->price }}, 
                image_url: '{{ $imgUrl }}' 
            })" 
            class="w-full py-3 bg-slate-50 hover:bg-primary-600 group-hover:text-white rounded-xl font-bold text-slate-700 transition-all flex items-center justify-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewbox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Add to Cart
        </button>
    </div>
</div>
