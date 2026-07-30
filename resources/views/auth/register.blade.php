<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join FreshBazar - Create Account</title>
    
    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Outfit', 'sans-serif'] },
                    colors: {
                        primary: {
                            50: '#ecfdf5', 100: '#d1fae5', 200: '#a7f3d0', 300: '#6ee7b7',
                            400: '#34d399', 500: '#10b981', 600: '#059669', 700: '#047857',
                            800: '#065f46', 900: '#064e3b',
                        },
                    }
                }
            }
        }
    </script>
    <style>
        .glass {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
        .reveal { opacity: 0; transform: translateY(20px); animation: reveal 0.8s ease-out forwards; }
        @keyframes reveal { to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="h-full font-sans antialiased text-slate-900 flex items-center justify-center p-4 bg-[url('https://images.unsplash.com/photo-1543168256-418811576931?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80')] bg-cover bg-center">
    <!-- Overlay -->
    <div class="fixed inset-0 bg-emerald-950/40 backdrop-blur-[2px]"></div>

    <div class="relative w-full max-w-xl reveal">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-black text-white tracking-tight italic">Fresh<span class="text-primary-300">Bazar</span></h1>
            <p class="text-emerald-100/70 font-medium mt-1">Start your healthy lifestyle today</p>
        </div>

        <div class="glass overflow-hidden rounded-[3rem] shadow-2xl border border-white/40">
            <div class="p-10 md:p-12">
                <div class="mb-10">
                    <h2 class="text-2xl font-black text-slate-800">Create <span class="text-primary-600">Account</span></h2>
                    <p class="text-xs font-bold text-slate-400 mt-1 uppercase tracking-widest leading-none">Join our farm-fresh community</p>
                </div>

                <form action="{{ route('register') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @csrf
                    
                    <div class="md:col-span-2 space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Full Name</label>
                        <input type="text" name="name" required placeholder="John Doe" value="{{ old('name') }}"
                               class="w-full bg-white/50 border-2 border-transparent rounded-2xl py-4 px-6 focus:border-primary-500 focus:bg-white focus:ring-0 transition-all text-sm font-bold text-slate-700">
                        @error('name') <p class="text-red-500 text-[10px] font-bold mt-1 uppercase">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2 space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Email Address</label>
                        <input type="email" name="email" required placeholder="john@example.com" value="{{ old('email') }}"
                               class="w-full bg-white/50 border-2 border-transparent rounded-2xl py-4 px-6 focus:border-primary-500 focus:bg-white focus:ring-0 transition-all text-sm font-bold text-slate-700">
                        @error('email') <p class="text-red-500 text-[10px] font-bold mt-1 uppercase">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Password</label>
                        <input type="password" name="password" required placeholder="••••••••"
                               class="w-full bg-white/50 border-2 border-transparent rounded-2xl py-4 px-6 focus:border-primary-500 focus:bg-white focus:ring-0 transition-all text-sm font-bold text-slate-700">
                        @error('password') <p class="text-red-500 text-[10px] font-bold mt-1 uppercase">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Confirm</label>
                        <input type="password" name="password_confirmation" required placeholder="••••••••"
                               class="w-full bg-white/50 border-2 border-transparent rounded-2xl py-4 px-6 focus:border-primary-500 focus:bg-white focus:ring-0 transition-all text-sm font-bold text-slate-700">
                    </div>

                    <div class="md:col-span-2 pt-4">
                        <button type="submit" class="w-full py-5 bg-primary-600 hover:bg-primary-700 text-white font-black rounded-2xl shadow-xl shadow-primary-900/20 transition-all active:scale-[0.98] uppercase tracking-widest text-sm">
                            Create Account
                        </button>
                    </div>
                </form>

                <div class="mt-8 text-center text-sm font-medium text-slate-500">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-primary-600 font-extrabold hover:underline">Sign In</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>