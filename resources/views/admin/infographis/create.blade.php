@extends('layout.app')

@section('content')
    <div class="max-w-xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Tambah Infografis</h2>

        <!-- Menampilkan pesan error -->
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('infographis.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <!-- Judul -->
            <div>
                <label for="title" class="block text-sm font-semibold text-gray-700">Judul</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                    class="mt-2 w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition"
                    required>
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="deskripsi" class="block text-sm font-semibold text-gray-700">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4"
                    class="mt-2 w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition">{{ old('deskripsi') }}</textarea>
            </div>




            <!-- Upload Gambar -->
            <div>
                <label for="image" class="block text-sm font-semibold text-gray-700">Gambar</label>
                <input type="file" name="image" id="image" accept="image/*"
                    class="mt-2 w-full text-sm text-gray-600 file:border file:border-gray-300 file:rounded-md file:px-4 file:py-2 file:bg-gray-100 hover:file:bg-gray-200 transition">
            </div>

            <label for="image_thumbnail" class="block text-sm font-semibold text-gray-700">Gambar Thumbnail</label>
            <input type="file" name="image_thumbnail" id="image_thumbnail" accept="image/*" disabled
                class="mt-2 w-full text-sm text-gray-600 file:border file:border-gray-300 file:rounded-md file:px-4 file:py-2 file:bg-gray-100 hover:file:bg-gray-200 transition">

            <!-- Input URL Video -->
            <div>
                <label for="video" class="block text-sm font-semibold text-gray-700">URL Video</label>
                <input type="url" name="video" id="video" value="{{ old('video') }}"
                    placeholder="Masukkan URL video (contoh: https://www.youtube.com/watch?v=...)"
                    class="mt-2 w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition">
            </div>
            <div class="flex items-center mb-4">
                <!-- Tidak Ditampilkan (0) -->
                <input id="radio-hide" type="radio" value="0" name="show"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                    checked>
                <label for="radio-hide" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tidak
                    Ditampilkan</label>
            </div>
            <div class="flex items-center">
                <!-- Ditampilkan (1) -->
                <input id="radio-show" type="radio" value="1" name="show"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="radio-show" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tampilkan</label>
            </div>


            <!-- Tombol Simpan -->
            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-3 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-300 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>

    <!-- Validasi Frontend: Tidak Bisa Isi Gambar & Video Bersamaan -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const imageInput = document.getElementById("image");
            const imageThumbnailInput = document.getElementById("image_thumbnail");
            const videoInput = document.getElementById("video");
            const form = document.querySelector("form");

            function validateInputs() {
                if (imageInput.files.length > 0 && videoInput.value.trim() !== "") {
                    alert("Anda tidak bisa mengisi gambar dan video sekaligus. Pilih salah satu.");
                    return false;
                }
                return true;
            }

            imageInput.addEventListener("change", function() {
                if (imageInput.files.length > 0) {
                    videoInput.value = "";
                    videoInput.setAttribute("disabled", "disabled");
                    imageThumbnailInput.removeAttribute("disabled"); // Aktifkan thumbnail jika gambar ada
                } else {
                    videoInput.removeAttribute("disabled");
                    imageThumbnailInput.value = "";
                    imageThumbnailInput.setAttribute("disabled",
                        "disabled"); // Matikan thumbnail jika tidak ada gambar
                }
            });

            videoInput.addEventListener("input", function() {
                if (videoInput.value.trim() !== "") {
                    imageInput.value = "";
                    imageThumbnailInput.value = "";
                    imageInput.setAttribute("disabled", "disabled");
                    imageThumbnailInput.setAttribute("disabled", "disabled");
                } else {
                    imageInput.removeAttribute("disabled");
                }
            });

            form.addEventListener("submit", function(event) {
                if (!validateInputs()) {
                    event.preventDefault();
                }
            });
        });
    </script>

@endsection
