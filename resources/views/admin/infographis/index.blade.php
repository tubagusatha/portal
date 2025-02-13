@extends('layout.app')

@section('content')
    @include('layout.navbar.navbaradmin')

    <div class="min-h-screen flex justify-center items-center sm:ml-64 bg-gray-100 p-4 sm:p-6">
        <div class="w-full max-w-5xl bg-white shadow-lg rounded-2xl p-4 sm:p-6">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 gap-4">
                <h2 class="text-2xl sm:text-3xl font-semibold text-gray-700">Data Infographis</h2>
                <a href="{{ route('infographis.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 sm:px-5 rounded-lg shadow-md transition">
                    + Tambah Data
                </a>
            </div>

            <div class="relative overflow-x-auto sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 sm:px-6 py-3">ID</th>
                            <th scope="col" class="px-4 sm:px-6 py-3">Judul</th>
                            <th scope="col" class="px-4 sm:px-6 py-3">Deskripsi</th>
                            <th scope="col" class="px-4 sm:px-6 py-3 text-center">Gambar</th>
                            <th scope="col" class="px-4 sm:px-6 py-3 text-center">Thumbnail</th>
                            <th scope="col" class="px-4 sm:px-6 py-3 text-center">Video</th>
                            <th scope="col" class="px-4 sm:px-6 py-3 text-center">Status</th>
                            <th scope="col" class="px-4 sm:px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($infographis as $i)
                            <tr class="bg-white border border-gray-300 hover:bg-gray-100 dark:hover:bg-gray-200">
                                <td class="px-4 sm:px-6 py-4 text-black">{{ $i->id }}</td>
                                <td class="px-4 sm:px-6 py-4 text-black">{{ $i->title ?? 'Tidak ada data' }}</td>
                                <td class="px-4 sm:px-6 py-4 text-black">{{ $i->deskripsi ?? 'Tidak ada data' }}</td>

                                <!-- Kolom Gambar -->
                                <td class="px-4 sm:px-6 py-4 text-center">
                                    @if ($i->image)
                                        <img src="{{ asset('storage/' . $i->image) }}" alt="Gambar Infografis"
                                            class="mx-auto rounded-lg w-32 h-32 object-cover">
                                    @else
                                        <span class="text-gray-500">Tidak ada data</span>
                                    @endif
                                </td>

                                <!-- Kolom Gambar Thumbnail -->
                                <td class="px-4 sm:px-6 py-4 text-center">
                                    @if ($i->image_thumbnail)
                                        <img src="{{ asset('storage/' . $i->image_thumbnail) }}" alt="Thumbnail Infografis"
                                            class="mx-auto rounded-lg w-32 h-32 object-cover">
                                    @else
                                        <span class="text-gray-500">Tidak ada thumbnail</span>
                                    @endif
                                </td>

                                <!-- Kolom Video -->
                                <td class="px-4 sm:px-6 py-4 text-center">
                                    @if ($i->video)
                                        @php
                                            preg_match(
                                                '/(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=))([\w-]+)/',
                                                $i->video,
                                                $matches,
                                            );
                                            $videoId = $matches[1] ?? null;
                                        @endphp

                                        @if ($videoId)
                                            <iframe class="w-32 h-32 rounded-lg mx-auto"
                                                src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0"
                                                allowfullscreen>
                                            </iframe>
                                        @else
                                            <video controls class="w-32 h-32 object-cover mx-auto rounded-lg">
                                                <source src="{{ asset('storage/' . $i->video) }}" type="video/mp4">
                                                Browser Anda tidak mendukung pemutaran video.
                                            </video>
                                        @endif
                                    @else
                                        <span class="text-gray-500">Tidak ada data</span>
                                    @endif
                                </td>

                                <!-- Kolom Status Show -->
                                <td class="px-10 sm:px-6 py-4 text-center">
                                    <span class="px-3 py-1 rounded-lg text-black">
                                        {{ $i->show ? 'Tampilkan' : 'Tidak Ditampilkan' }}
                                    </span>
                                </td>

                                <!-- Kolom Aksi -->
                                <td class="px-4 sm:px-6 py-4 text-center">
                                    <a href="{{ route('infographis.edit', $i->id) }}"
                                        class="text-yellow-500 hover:underline">Edit</a> |
                                    <form action="{{ route('infographis.destroy', $i->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 sm:px-6 py-4 text-center text-gray-500">
                                    Tidak ada data.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
