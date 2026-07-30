<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FreshBazar</title>
    
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
<body class="h-full font-sans antialiased text-slate-900 flex items-center justify-center p-4 bg-[url('https://images.unsplash.com/photo-1542838132-92c53300491e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80')] bg-cover bg-center">
    <!-- Overlay -->
    <div class="fixed inset-0 bg-emerald-950/40 backdrop-blur-[2px]"></div>

    <div class="relative w-full max-w-lg reveal">
        <!-- Logo Area -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-[2rem] shadow-2xl shadow-emerald-900/20 mb-6 group transition-transform hover:scale-110">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <h1 class="text-4xl font-black text-white tracking-tight italic">Fresh<span class="text-primary-300">Bazar</span></h1>
            <p class="text-emerald-100/80 font-medium mt-2">Sign in to continue your journey</p>
        </div>

        <div class="glass overflow-hidden rounded-[3rem] shadow-2xl border border-white/40">
            <div class="p-10 md:p-14">
                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Email Address</label>
                        <div class="relative group">
                            <input type="email" name="email" required placeholder="name@example.com" value="{{ old('email') }}"
                                   class="w-full bg-white/50 border-2 border-transparent rounded-2xl py-4 px-6 focus:border-primary-500 focus:bg-white focus:ring-0 transition-all text-sm font-bold text-slate-700">
                            @error('email') <p class="text-red-500 text-[10px] font-bold mt-1 ml-1 uppercase">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div class="flex justify-between items-center px-1">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-[0.2em]">Password</label>
                            <a href="#" class="text-[10px] font-black text-primary-600 uppercase tracking-widest hover:text-primary-700">Forgot?</a>
                        </div>
                        <div class="relative group">
                            <input type="password" name="password" required placeholder="••••••••"
                                   class="w-full bg-white/50 border-2 border-transparent rounded-2xl py-4 px-6 focus:border-primary-500 focus:bg-white focus:ring-0 transition-all text-sm font-bold text-slate-700">
                            @error('password') <p class="text-red-500 text-[10px] font-bold mt-1 ml-1 uppercase">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="flex items-center px-1">
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-primary-600 focus:ring-primary-500 transition-all">
                            <span class="text-xs font-bold text-slate-500 group-hover:text-slate-700 transition-colors">Keep me signed in</span>
                        </label>
                    </div>

                    <button type="submit" class="w-full py-5 bg-primary-600 hover:bg-primary-700 text-white font-black rounded-2xl shadow-xl shadow-primary-900/20 transition-all active:scale-[0.98] uppercase tracking-widest text-sm">
                        Enter Storefrount
                    </button>
                </form>

                <div class="mt-10 pt-10 border-t border-slate-200">
                    <p class="text-center text-sm font-medium text-slate-500">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="text-primary-600 font-extrabold hover:underline">Join Now</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-8 text-center">
            <p class="text-[10px] font-black text-emerald-100/40 uppercase tracking-[0.3em]">&copy; 2026 FreshBazar Enterprise</p>
        </div>
    </div>
</body>
</html>