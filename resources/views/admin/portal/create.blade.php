@extends('layout.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-semibold mb-4">Tambah Portal</h2>
    <form action="{{ route('portal.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Judul</label>
            <input type="text" name="title" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Deskripsi</label>
            <textarea name="deskripsi" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300"></textarea>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Gambar Portal</label>
            <input type="file" name="portal_image" class="w-full px-3 py-2 border rounded-lg" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Link</label>
            <input type="url" name="link" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Simpan</button>
    </form>
</div>
@endsection