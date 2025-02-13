@extends('layout.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gradient-to-br bg-slate-100  px-4">
    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-3xl shadow-xl transform transition-all duration-500 scale-105 hover:scale-110">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-700">Login</h2>
            <p class="text-gray-500">Masuk untuk melanjutkan</p>
        </div>

        @if(session('success'))
            <div class="p-3 text-sm text-green-600 bg-green-100 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('auth') }}" method="POST" class="space-y-5">
            @csrf
            <div class="relative">
                <label class="block text-gray-600 font-medium">Email</label>
                <input type="email" name="email" class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none transition-all duration-300" required>
                @error('email')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="relative">
                <label class="block text-gray-600 font-medium">Password</label>
                <input type="password" name="password" class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none transition-all duration-300" required>
                @error('password')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full py-3 font-semibold text-white bg-indigo-500 rounded-lg shadow-md hover:bg-indigo-600 focus:ring-2 focus:ring-indigo-300 transition-all duration-300">
                Masuk
            </button>
        </form>

        <div class="flex items-center justify-center text-sm text-gray-500">
            <a href="#" class="hover:text-indigo-600 mx-1">Lupa password?</a>
            <a href="{{ route('registerform') }}" class="hover:text-indigo-600">Daftar akun</a>
        </div>
    </div>
</div>
@endsection
