@extends('layout.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gradient-to-br bg-slate-100 px-3">
    <div class="w-full max-w-sm p-6 space-y-4 bg-white rounded-2xl shadow-md transform transition-all duration-300 scale-100 hover:scale-105">
        <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-700">Buat Akun</h2>
            <p class="text-sm text-gray-500">Isi formulir untuk daftar</p>
        </div>

        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm text-gray-600 font-medium">Nama Lengkap</label>
                <input type="text" name="name" class="w-full px-3 py-1.5 mt-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-teal-400 focus:outline-none transition-all duration-200 text-sm" required>
                @error('name')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-600 font-medium">Email</label>
                <input type="email" name="email" class="w-full px-3 py-1.5 mt-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-teal-400 focus:outline-none transition-all duration-200 text-sm" required>
                @error('email')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-600 font-medium">Password</label>
                <input type="password" name="password" class="w-full px-3 py-1.5 mt-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-teal-400 focus:outline-none transition-all duration-200 text-sm" required>
                @error('password')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-600 font-medium">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="w-full px-3 py-1.5 mt-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-teal-400 focus:outline-none transition-all duration-200 text-sm" required>
            </div>

            <button type="submit" class="w-full py-2 text-sm font-semibold text-white bg-teal-500 rounded-md shadow-md hover:bg-teal-600 focus:ring-2 focus:ring-teal-300 transition-all duration-200">
                Daftar
            </button>
        </form>

        <div class="flex items-center justify-between text-xs text-gray-500">
            <p>Sudah punya akun?</p>
            <a href="{{ route('login') }}" class="text-teal-600 hover:underline">Masuk</a>
        </div>
    </div>
</div>
@endsection
