@extends('layout.app')

@section('content')
    @include('layout.navbar.navbaradmin')

    <div class="min-h-screen flex justify-center items-center sm:ml-64 bg-gray-100 p-4 sm:p-6">
        <div class="w-full max-w-2xl bg-white shadow-lg rounded-2xl p-6">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Edit Ucapan</h2>

            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>⚠ {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('ucapan.update', $ucapan->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-4">
                    <label for="text" class="block text-gray-700 font-semibold">Ucapan:</label>
                    <input type="text" name="text" id="text" value="{{ old('text', $ucapan->text) }}" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <label for="waktu" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Pilih Waktu Mulai:
                </label>

                <div class="flex">
                    <input type="time" name="waktu" id="waktu"
                        class="rounded-none rounded-s-lg bg-gray-50 border text-gray-900 leading-none 
                               focus:ring-blue-500 focus:border-blue-500 block flex-1 w-full text-sm 
                               border-gray-300 p-2.5 dark:placeholder-gray-400 
                                dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ old('waktu', \Carbon\Carbon::parse($ucapan->waktu)->format('H:i')) }}" required>

                    <span
                        class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border rounded-s-0 
                                 border-s-0 border-gray-300 rounded-e-md">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                </div>

                <label for="waktu_end" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Pilih Waktu Selesai:
                </label>

                <div class="flex my-10">
                    <input type="time" name="waktu_end" id="waktu_end"
                        class="rounded-none rounded-s-lg bg-gray-50 border text-gray-900 leading-none 
                               focus:ring-blue-500 focus:border-blue-500 block flex-1 w-full text-sm 
                               border-gray-300 p-2.5 dark:placeholder-gray-400 
                                dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ old('waktu_end', \Carbon\Carbon::parse($ucapan->waktu_end)->format('H:i')) }}" required>

                    <span
                        class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border rounded-s-0 
                                 border-s-0 border-gray-300 rounded-e-md">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg shadow-md transition">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
