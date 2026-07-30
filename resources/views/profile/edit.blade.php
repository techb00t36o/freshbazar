@extends('layouts.shop')

@section('content')
<div class="bg-slate-50 min-h-screen pt-24 pb-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <div class="mb-12 reveal">
            <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight mb-2">Manage <span class="text-primary-600">Profile</span></h1>
            <p class="text-slate-500">Update your account settings and security preferences.</p>
        </div>

        <div class="space-y-8">
            
            <!-- Profile Information Card -->
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden reveal">
                <div class="p-8 md:p-12">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 bg-primary-100 text-primary-600 rounded-2xl flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-slate-900">Personal Information</h2>
                            <p class="text-sm text-slate-400">Update your account's profile information and email address.</p>
                        </div>
                    </div>

                    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                        @csrf
                        @method('patch')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-bold text-slate-700 mb-2">Display Name</label>
                                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus
                                    class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none transition-all" />
                                @error('name') <p class="mt-2 text-xs text-red-500 font-bold">{{ $message }}</p> @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Email Address</label>
                                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                                    class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none transition-all" />
                                @error('email') <p class="mt-2 text-xs text-red-500 font-bold">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="flex items-center gap-4 pt-4">
                            <button type="submit" class="px-8 py-4 bg-primary-600 text-white font-bold rounded-2xl hover:bg-primary-700 transition-all shadow-xl shadow-primary-200">
                                Save Changes
                            </button>

                            @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-emerald-600 font-bold">Saved successfully.</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Update Password Card -->
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden reveal">
                <div class="p-8 md:p-12">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-slate-900">Security & Password</h2>
                            <p class="text-sm text-slate-400">Ensure your account is using a long, random password to stay secure.</p>
                        </div>
                    </div>

                    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                        @csrf
                        @method('put')

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="current_password" class="block text-sm font-bold text-slate-700 mb-2">Current Password</label>
                                <input id="current_password" name="current_password" type="password" 
                                    class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none transition-all" />
                                @error('current_password') <p class="mt-2 text-xs text-red-500 font-bold">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-bold text-slate-700 mb-2">New Password</label>
                                <input id="password" name="password" type="password" 
                                    class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none transition-all" />
                                @error('password') <p class="mt-2 text-xs text-red-500 font-bold">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-bold text-slate-700 mb-2">Confirm Password</label>
                                <input id="password_confirmation" name="password_confirmation" type="password" 
                                    class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none transition-all" />
                                @error('password_confirmation') <p class="mt-2 text-xs text-red-500 font-bold">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="flex items-center gap-4 pt-4">
                            <button type="submit" class="px-8 py-4 bg-slate-900 text-white font-bold rounded-2xl hover:bg-slate-800 transition-all shadow-xl shadow-slate-200">
                                Update Password
                            </button>

                            @if (session('status') === 'password-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-emerald-600 font-bold">Updated successfully.</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="bg-red-50 rounded-[2.5rem] border border-red-100 overflow-hidden reveal">
                <div class="p-8 md:p-12">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 bg-red-100 text-red-600 rounded-2xl flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-red-900">Danger Zone</h2>
                            <p class="text-sm text-red-600/70">Once you delete your account, there is no going back. Please be certain.</p>
                        </div>
                    </div>
                    
                    <button @click="$dispatch('open-modal', 'confirm-user-deletion')" class="px-6 py-3 bg-red-600 text-white font-bold rounded-xl hover:bg-red-700 transition-all shadow-lg shadow-red-200">
                        Delete Account
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Simple Confirmation Modal (Placeholder or Alpine) -->
<template x-if="false">
    <!-- Integration with Alpine modal for deletion would go here -->
</template>
@endsection
