@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto space-y-10">
    <!-- Header -->
    <div class="flex items-center justify-between reveal">
        <a href="{{ route('admin.products.index') }}" class="group flex items-center gap-3 text-slate-400 hover:text-primary-600 transition-colors font-bold text-sm">
            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm border border-slate-100 group-hover:border-primary-200 transition-all">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
            </div>
            Back to Inventory
        </a>
    </div>

    <!-- Form Card -->
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-[3rem] border border-slate-100 shadow-sm overflow-hidden reveal">
        @csrf
        @method('PUT')
        <div class="p-10 md:p-16">
            <div class="mb-12">
                <h2 class="text-3xl font-black text-slate-800 mb-2">Edit <span class="text-primary-600">Product</span></h2>
                <p class="text-slate-400 text-sm font-medium">Update the details for {{ $product->name }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <!-- Name -->
                <div class="space-y-3">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Product Name</label>
                    <input type="text" name="name" value="{{ $product->name }}" required
                           class="w-full bg-slate-50 border-2 border-transparent rounded-[1.5rem] py-4 px-6 focus:border-primary-500 focus:bg-white focus:ring-0 transition-all text-sm font-bold text-slate-700">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Price -->
                <div class="space-y-3">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Price per unit ($)</label>
                    <input type="number" step="0.01" name="price" value="{{ $product->price }}" required
                           class="w-full bg-slate-50 border-2 border-transparent rounded-[1.5rem] py-4 px-6 focus:border-primary-500 focus:bg-white focus:ring-0 transition-all text-sm font-bold text-slate-700">
                    @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Category -->
                <div class="space-y-3">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Category</label>
                    <select name="category_id" class="w-full bg-slate-50 border-2 border-transparent rounded-[1.5rem] py-4 px-6 focus:border-primary-500 focus:bg-white focus:ring-0 transition-all text-sm font-bold text-slate-700 appearance-none">
                        @foreach(App\Models\Category::all() as $cat)
                            <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Quantity -->
                <div class="space-y-3">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Update Stock</label>
                    <input type="number" name="quantity" value="{{ $product->quantity ?? 10 }}" 
                           class="w-full bg-slate-50 border-2 border-transparent rounded-[1.5rem] py-4 px-6 focus:border-primary-500 focus:bg-white focus:ring-0 transition-all text-sm font-bold text-slate-700">
                </div>

                <!-- Description -->
                <div class="md:col-span-2 space-y-3">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Product Description</label>
                    <textarea name="description" rows="5"
                              class="w-full bg-slate-50 border-2 border-transparent rounded-[2rem] py-5 px-8 focus:border-primary-500 focus:bg-white focus:ring-0 transition-all text-sm font-bold text-slate-700 leading-relaxed">{{ $product->description }}</textarea>
                </div>

                <!-- Current Image Preview -->
                <div class="md:col-span-2 space-y-4">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Current Image</label>
                    <div class="w-40 h-40 rounded-[2.5rem] overflow-hidden border border-slate-100 shadow-sm bg-slate-50">
                        <img src="{{ $product->image ? (Str::startsWith($product->image, 'http') ? $product->image : asset('storage/' . $product->image)) : asset('image/shop.jpg') }}" class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Image Upload (New) -->
                <div class="md:col-span-2 space-y-3">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Replace Image (Optional)</label>
                    <div class="relative group">
                        <input type="file" name="image" id="image-upload" class="hidden">
                        <label for="image-upload" class="flex flex-col items-center justify-center w-full min-h-[200px] bg-slate-50 border-3 border-dashed border-slate-200 rounded-[2.5rem] cursor-pointer group-hover:border-primary-400 group-hover:bg-primary-50 transition-all duration-300">
                            <div id="image-preview-container" class="hidden w-20 h-20 rounded-2xl overflow-hidden mb-3 border border-primary-200">
                                <img id="image-preview" src="#" class="w-full h-full object-cover">
                            </div>
                            <div id="upload-icon" class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-slate-300 group-hover:text-primary-500 shadow-sm border border-slate-100 transition-all mb-3">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                            </div>
                            <span id="upload-text" class="text-sm font-bold text-slate-500 group-hover:text-primary-700">Click to upload new image</span>
                        </label>
                    </div>
                    @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <script>
            document.getElementById('image-upload').onchange = function (evt) {
                const [file] = this.files
                if (file) {
                    document.getElementById('image-preview').src = URL.createObjectURL(file)
                    document.getElementById('image-preview-container').classList.remove('hidden')
                    document.getElementById('upload-icon').classList.add('hidden')
                    document.getElementById('upload-text').innerText = 'Change Image: ' + file.name
                }
            }
        </script>

        <!-- Footer Actions -->
        <div class="px-10 md:px-16 py-8 bg-slate-50 border-t border-slate-100 flex justify-end gap-4">
            <a href="{{ route('admin.products.index') }}" class="px-8 py-4 text-slate-400 hover:text-slate-600 font-bold transition-colors">Cancel</a>
            <button type="submit" class="px-10 py-4 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-2xl shadow-xl shadow-primary-200 transition-all">Update Product</button>
        </div>
    </form>
</div>
@endsection
