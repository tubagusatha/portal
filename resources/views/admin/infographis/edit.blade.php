@extends('layout.app')

@section('content')
    <div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4 text-center">Edit Infografis</h2>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('infographis.update', $infographis->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-4">
            @csrf
            @method('PATCH')

            <!-- Judul -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                <input type="text" name="title" id="title" value="{{ old('title', $infographis->title) }}"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">{{ old('deskripsi', $infographis->deskripsi) }}</textarea>
            </div>

            <!-- Menampilkan Gambar Saat Ini -->
            @if ($infographis->image)
                <div class="mb-4">
                    <p class="text-sm text-gray-600">Gambar Saat Ini:</p>
                    <img src="{{ asset('storage/' . $infographis->image) }}" alt="Gambar Infografis"
                        class="w-40 rounded-md mt-2">
                </div>
            @endif

            <!-- Input Gambar Baru -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Ganti Gambar</label>
                <input type="file" name="image" id="image" accept="image/*"
                    class="mt-1 block w-full text-sm text-gray-500 file:border file:border-gray-300 file:rounded-md file:px-3 file:py-2 file:bg-gray-50 hover:file:bg-gray-100">
            </div>

            <!-- Menampilkan URL Video Saat Ini -->
            @if ($infographis->video)
                <div class="mb-4">
                    <p class="text-sm text-gray-600">Video Saat Ini:</p>
                    <iframe class="w-full h-48 rounded-md mt-2"
                        src="https://www.youtube.com/embed/{{ Str::afterLast($infographis->video, 'v=') }}" frameborder="0"
                        allowfullscreen></iframe>
                </div>
            @endif

            <!-- Input URL Video Baru -->
            <div>
                <label for="video" class="block text-sm font-medium text-gray-700">Ganti URL Video</label>
                <input type="url" name="video" id="video" value="{{ old('video', $infographis->video) }}"
                    placeholder="Masukkan URL video (contoh: https://www.youtube.com/watch?v=...)"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="flex items-center mb-4">
                <!-- Tidak Ditampilkan (0) -->
                <input id="radio-hide" type="radio" value="0" name="show"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                    {{ !$infographis->show ? 'checked' : '' }}>
                <label for="radio-hide" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tidak
                    Ditampilkan</label>
            </div>

            <div class="flex items-center">
                <!-- Ditampilkan (1) -->
                <input id="radio-show" type="radio" value="1" name="show"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                    {{ $infographis->show ? 'checked' : '' }}>
                <label for="radio-show" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tampilkan</label>
            </div>


            <!-- Tombol Simpan -->
            <div class="flex justify-end">
                <button type="submit" id="submitBtn"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:ring-2 focus:ring-blue-300">
                    Perbarui
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('image');
            const videoInput = document.getElementById('video');
            const form = document.querySelector('form');

            function validateInputs() {
                if (imageInput.files.length > 0 && videoInput.value.trim() !== '') {
                    alert('Anda hanya bisa mengisi gambar atau video, bukan keduanya.');
                    return false;
                }
                return true;
            }

            form.addEventListener('submit', function(event) {
                if (!validateInputs()) {
                    event.preventDefault();
                }
            });

            imageInput.addEventListener('change', function() {
                if (imageInput.files.length > 0) {
                    videoInput.value = ''; // Reset video input
                }
            });

            videoInput.addEventListener('input', function() {
                if (videoInput.value.trim() !== '') {
                    imageInput.value = ''; // Reset image input
                }
            });
        });
    </script>
@endsection
