@extends('layout.app')

@section('content')
    @include('layout.navbar.navbaradmin')

    <div class="min-h-screen flex justify-center items-center sm:ml-64 bg-gray-100 p-4 sm:p-6">
        <div class="w-full max-w-5xl bg-white shadow-lg rounded-2xl p-4 sm:p-6">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 gap-4">
                <h2 class="text-2xl sm:text-3xl font-semibold text-gray-700">Data Background</h2>

                @if ($bg->isEmpty())
                    <a href="{{ route('bg.create') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 sm:px-5 rounded-lg shadow-md transition">
                        + Tambah Data
                    </a>
                @endif
            </div>

            <div class="relative overflow-x-auto sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 sm:px-6 py-3">ID</th>
                            <th scope="col" class="px-4 sm:px-6 py-3 text-center">Gambar</th>
                            <th scope="col" class="px-4 sm:px-6 py-3 text-center">Gambar Responsif</th>
                            <th scope="col" class="px-4 sm:px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bg as $i)
                            <tr class="bg-white border border-gray-300 hover:bg-gray-100 dark:hover:bg-gray-200">
                                <td class="px-4 sm:px-6 py-4 text-black">{{ $i->id }}</td>

                                <!-- Kolom Gambar -->
                                <td class="px-4 sm:px-6 py-4 text-center">
                                    @if ($i->image_bg)
                                        <img src="{{ asset('storage/' . $i->image_bg) }}" alt="Gambar Infografis"
                                            class="mx-auto rounded-lg w-32 h-32 object-cover">
                                    @else
                                        <span class="text-gray-500">Tidak ada data</span>
                                    @endif
                                </td>

                                <!-- Kolom Gambar Responsif -->
                                <td class="px-4 sm:px-6 py-4 text-center">
                                    @if ($i->image_bgres)
                                        <img src="{{ asset('storage/' . $i->image_bgres) }}" alt="Gambar Responsif"
                                            class="mx-auto rounded-lg w-32 h-32 object-cover">
                                    @else
                                        <span class="text-gray-500">Tidak ada data</span>
                                    @endif
                                </td>

                                <!-- Kolom Aksi -->
                                <td class="px-4 sm:px-6 py-4 text-center">
                                    <a href="{{ route('bg.edit', $i->id) }}"
                                        class="text-yellow-500 hover:underline">Edit</a> |
                                    <form action="{{ route('bg.destroy', $i->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 sm:px-6 py-4 text-center text-gray-500">
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
