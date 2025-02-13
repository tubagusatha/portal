@extends('layout.app')

@section('content')
    <div class="max-w-xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Edit Background</h2>

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

        <form action="{{ route('bg.update', $bgfront->id) }}" method="POST" enctype="multipart/form-data"
            class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
            @csrf
            @method('PATCH') <!-- Sesuai dengan route -->

            <!-- Upload Background -->
            <label class="block mb-2 text-sm font-medium text-gray-900">Upload Background Desktop</label>
            <input type="file" name="image_bg" class="w-full p-2 border rounded-lg">

            <!-- Tampilkan gambar background saat ini -->
            @if ($bgfront->image_bg)
                <div class="mt-2">
                    <p class="text-sm text-gray-700">Background Ukuran Desktop Saat Ini:</p>
                    <img src="{{ asset('storage/' . $bgfront->image_bg) }}" class="w-full h-auto rounded-lg shadow-md">
                </div>
            @endif

            <!-- Upload Background Resolusi Lain -->
            <label class="block mt-4 mb-2 text-sm font-medium text-gray-900">Upload Background Ukuran Hp</label>
            <input type="file" name="image_bgres" class="w-full p-2 border rounded-lg">

            <!-- Tampilkan gambar background resolusi lain saat ini -->
            @if ($bgfront->image_bgres)
                <div class="mt-2">
                    <p class="text-sm text-gray-700">Backround ukuran hp saat ini:</p>
                    <img src="{{ asset('storage/' . $bgfront->image_bgres) }}" class="w-full h-auto rounded-lg shadow-md">
                </div>
            @endif

            <button type="submit" class="mt-4 w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">
                Update
            </button>
        </form>
    </div>
@endsection
