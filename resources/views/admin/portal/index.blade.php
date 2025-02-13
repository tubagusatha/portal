@extends('layout.app')

@section('content')
    @include('layout.navbar.navbaradmin')

    <div class="min-h-screen flex justify-center items-center sm:ml-64 bg-gray-100 p-4 sm:p-6">
        <div class="w-full max-w-5xl bg-white shadow-lg rounded-2xl p-4 sm:p-6">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 gap-4">
                <h2 class="text-2xl sm:text-3xl font-semibold text-gray-700">Data Portal</h2>
                <a href="{{ route('portal.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 sm:px-5 rounded-lg shadow-md transition">
                    + Tambah Data
                </a>
            </div>

            <div class="relative overflow-x-auto sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 sm:px-6 py-3">ID</th>
                            <th scope="col" class="px-4 sm:px-6 py-3">Name Portal</th>
                            <th scope="col" class="px-4 sm:px-6 py-3 text-center">Detail</th>
                            <th scope="col" class="px-4 sm:px-6 py-3">Link</th>
                            <th scope="col" class="px-4 sm:px-6 py-3">Image</th>
                            <th scope="col" class="px-4 sm:px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($portal as $p)
                            <tr class="bg-white border border-gray-300 hover:bg-gray-100 dark:hover:bg-gray-200">
                                <td class="px-4 sm:px-6 py-4 text-black">{{ $p->id }}</td>
                                <td class="px-4 sm:px-6 py-4 text-black">{{ $p->title ?? 'Tidak ada data' }}</td>
                                <td class="px-4 sm:px-6 py-4 text-black">{{ $p->deskripsi ?? 'Tidak ada data' }}</td>
                                <td class="px-4 sm:px-6 py-4">
                                    @if ($p->link)
                                        <a href="{{ $p->link }}" target="_blank" class="text-blue-500 hover:underline">
                                            {{ $p->link }}
                                        </a>
                                    @else
                                        <span class="text-gray-500">Tidak ada data</span>
                                    @endif
                                </td>


                                <!-- Kolom Gambar -->
                                <td class="px-4 sm:px-6 py-4 text-center">
                                    @if ($p->portal_image)
                                        <button data-modal-target="image-modal-{{ $p->id }}"
                                            data-modal-toggle="image-modal-{{ $p->id }}"
                                            class="text-blue-500 hover:underline">
                                            Lihat Gambar
                                        </button>

                                        <!-- Modal Gambar -->
                                        <div id="image-modal-{{ $p->id }}" tabindex="-1" aria-hidden="true"
                                            class="hidden fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50">
                                            <div class="relative p-4 w-full max-w-2xl bg-white rounded-lg shadow-md">
                                                <div class="flex items-center justify-between p-4 border-b">
                                                    <h3 class="text-xl font-semibold">Gambar Infografis</h3>
                                                    <button type="button" class="text-gray-500 hover:text-gray-900"
                                                        data-modal-hide="image-modal-{{ $p->id }}">
                                                        ✖
                                                    </button>
                                                </div>
                                                <div class="p-4 text-center">
                                                    <img src="{{ asset('storage/' . $p->portal_image) }}"
                                                        alt="Gambar Infografis" class="mx-auto rounded-lg">
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-gray-500">Tidak ada data</span>
                                    @endif
                                </td>
                                <!-- Kolom Aksi -->
                                <td class="px-4 sm:px-6 py-4 text-center">
                                    <a href="{{ route('portal.edit', $p->id) }}"
                                        class="text-yellow-500 hover:underline">Edit</a> |
                                    <form action="{{ route('portal.destroy', $p->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 sm:px-6 py-4 text-center text-gray-500">
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
