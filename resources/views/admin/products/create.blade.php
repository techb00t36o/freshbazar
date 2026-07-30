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
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-[3rem] border border-slate-100 shadow-sm overflow-hidden reveal">
        @csrf
        <div class="p-10 md:p-16">
            <div class="mb-12">
                <h2 class="text-3xl font-black text-slate-800 mb-2">Create <span class="text-primary-600">New Product</span></h2>
                <p class="text-slate-400 text-sm font-medium">Fill in the details to add a new item to your farm-fresh collection</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <!-- Name -->
                <div class="space-y-3">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Product Name</label>
                    <input type="text" name="name" required placeholder="e.g. Organic Tomatoes" 
                           class="w-full bg-slate-50 border-2 border-transparent rounded-[1.5rem] py-4 px-6 focus:border-primary-500 focus:bg-white focus:ring-0 transition-all text-sm font-bold text-slate-700">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Price -->
                <div class="space-y-3">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Price per unit ($)</label>
                    <input type="number" step="0.01" name="price" required placeholder="0.00" 
                           class="w-full bg-slate-50 border-2 border-transparent rounded-[1.5rem] py-4 px-6 focus:border-primary-500 focus:bg-white focus:ring-0 transition-all text-sm font-bold text-slate-700">
                    @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Category (Select Placeholder) -->
                <div class="space-y-3">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Category</label>
                    <select name="category_id" class="w-full bg-slate-50 border-2 border-transparent rounded-[1.5rem] py-4 px-6 focus:border-primary-500 focus:bg-white focus:ring-0 transition-all text-sm font-bold text-slate-700 appearance-none">
                        @foreach(App\Models\Category::all() as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Quantity -->
                <div class="space-y-3">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Initial Stock</label>
                    <input type="number" name="quantity" value="10" 
                           class="w-full bg-slate-50 border-2 border-transparent rounded-[1.5rem] py-4 px-6 focus:border-primary-500 focus:bg-white focus:ring-0 transition-all text-sm font-bold text-slate-700">
                </div>

                <!-- Description -->
                <div class="md:col-span-2 space-y-3">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Product Description</label>
                    <textarea name="description" rows="5" placeholder="Tell customers about the source and quality..." 
                              class="w-full bg-slate-50 border-2 border-transparent rounded-[2rem] py-5 px-8 focus:border-primary-500 focus:bg-white focus:ring-0 transition-all text-sm font-bold text-slate-700 leading-relaxed"></textarea>
                </div>

                <!-- Image Upload -->
                <div class="md:col-span-2 space-y-3">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Product Image</label>
                    <div class="relative group">
                        <input type="file" name="image" required id="image-upload" class="hidden">
                        <label for="image-upload" class="flex flex-col items-center justify-center w-full min-h-[250px] bg-slate-50 border-3 border-dashed border-slate-200 rounded-[2.5rem] cursor-pointer group-hover:border-primary-400 group-hover:bg-primary-50 transition-all duration-300">
                            <div id="image-preview-container" class="hidden w-24 h-24 rounded-2xl overflow-hidden mb-4 border border-primary-200">
                                <img id="image-preview" src="#" class="w-full h-full object-cover">
                            </div>
                            <div id="upload-icon" class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-slate-300 group-hover:text-primary-500 shadow-sm border border-slate-100 transition-all mb-4">
                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                            </div>
                            <span id="upload-text" class="text-sm font-bold text-slate-500 group-hover:text-primary-700">Choose Image or Drop here</span>
                            <span id="upload-hint" class="text-[10px] text-slate-400 uppercase font-black tracking-widest mt-2">JPG, PNG (Max 2MB)</span>
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
                    document.getElementById('upload-text').innerText = 'Selected: ' + file.name
                    document.getElementById('upload-hint').innerText = (file.size / 1024 / 1024).toFixed(2) + ' MB'
                }
            }
        </script>

        <!-- Footer Actions -->
        <div class="px-10 md:px-16 py-8 bg-slate-50 border-t border-slate-100 flex justify-end gap-4">
            <button type="reset" class="px-8 py-4 text-slate-400 hover:text-slate-600 font-bold transition-colors">Discard</button>
            <button type="submit" class="px-10 py-4 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-2xl shadow-xl shadow-primary-200 transition-all">Publish Product</button>
        </div>
    </form>
</div>
@endsection
