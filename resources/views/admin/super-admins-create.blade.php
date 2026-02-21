@extends('layouts.app')
@section('title', 'Register New Staff')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-12">
    <div class="mb-10 text-center">
        <h1 class="text-3xl font-black text-gray-900 font-display mb-2">Register <span class="text-purple-600">New Staff</span></h1>
        <p class="text-gray-500 font-medium">Create a new administrative account for system management</p>
    </div>

    <div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl shadow-purple-50/50 p-8 md:p-12">
        <form method="POST" action="{{ route('super-admin.admins.store') }}">
            @csrf

            <div class="space-y-6">
                {{-- Name --}}
                <div>
                    <label for="name" class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Full Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus 
                        class="w-full bg-gray-50 border-gray-100 rounded-2xl px-5 py-4 text-sm font-medium focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all placeholder:text-gray-300"
                        placeholder="e.g. John Doe">
                    @error('name') <p class="mt-2 text-xs text-red-500 font-bold ml-1">{{ $message }}</p> @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required 
                        class="w-full bg-gray-50 border-gray-100 rounded-2xl px-5 py-4 text-sm font-medium focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all placeholder:text-gray-300"
                        placeholder="john@example.com">
                    @error('email') <p class="mt-2 text-xs text-red-500 font-bold ml-1">{{ $message }}</p> @enderror
                </div>

                {{-- Role Selection --}}
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3 ml-1">Access Role</label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="relative flex flex-col p-4 bg-gray-50 rounded-2xl border-2 border-transparent cursor-pointer hover:bg-gray-100 transition-all has-[:checked]:border-purple-500 has-[:checked]:bg-purple-50/30 group">
                            <input type="radio" name="role" value="admin" class="sr-only" required {{ old('role', 'admin') == 'admin' ? 'checked' : '' }}>
                            <span class="text-xs font-bold text-gray-800 mb-1">Admin</span>
                            <span class="text-[9px] text-gray-500 leading-tight">Can manage users, jobs, and moderate content.</span>
                        </label>
                        <label class="relative flex flex-col p-4 bg-gray-50 rounded-2xl border-2 border-transparent cursor-pointer hover:bg-gray-100 transition-all has-[:checked]:border-purple-500 has-[:checked]:bg-purple-50/30 group">
                            <input type="radio" name="role" value="super_admin" class="sr-only" {{ old('role') == 'super_admin' ? 'checked' : '' }}>
                            <span class="text-xs font-bold text-purple-700 mb-1">Super Admin</span>
                            <span class="text-[9px] text-gray-500 leading-tight">Full system access, including staff management.</span>
                        </label>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Password</label>
                        <input id="password" type="password" name="password" required 
                            class="w-full bg-gray-50 border-gray-100 rounded-2xl px-5 py-4 text-sm font-medium focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all placeholder:text-gray-300"
                            placeholder="••••••••">
                        @error('password') <p class="mt-2 text-xs text-red-500 font-bold ml-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label for="password_confirmation" class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required 
                            class="w-full bg-gray-50 border-gray-100 rounded-2xl px-5 py-4 text-sm font-medium focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all placeholder:text-gray-300"
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="pt-4 flex flex-col sm:flex-row gap-4">
                    <button type="submit" class="flex-1 bg-slate-900 text-white rounded-2xl py-4 text-sm font-bold hover:bg-black hover:shadow-xl hover:shadow-slate-200 transition-all active:scale-95">
                        Register Staff Member
                    </button>
                    <a href="{{ route('super-admin.admins.index') }}" class="sm:w-32 bg-gray-100 text-gray-600 rounded-2xl py-4 text-sm font-bold text-center hover:bg-gray-200 transition-all">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
