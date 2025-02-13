@extends('layout.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-semibold mb-4">Edit Portal</h2>
    <form action="{{ route('portal.update', $portal->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Judul</label>
            <input type="text" name="title" value="{{ old('title', $portal->title) }}" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Deskripsi</label>
            <textarea name="deskripsi" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">{{ old('deskripsi', $portal->deskripsi) }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Gambar Portal</label>
            @if ($portal->portal_image)
                <img src="{{ asset('storage/' . $portal->portal_image) }}" alt="Gambar Portal" class="w-40 h-40 object-cover rounded-lg border mb-3">
            @endif
            <input type="file" name="portal_image" class="w-full px-3 py-2 border rounded-lg">
            <small class="text-gray-500">Upload gambar baru jika ingin mengganti.</small>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Link</label>
            <input type="url" name="link" value="{{ old('link', $portal->link) }}" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Simpan Perubahan</button>
    </form>
</div>
@endsection
