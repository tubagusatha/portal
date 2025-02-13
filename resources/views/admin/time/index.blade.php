@extends('layout.app')

@section('content')
    @include('layout.navbar.navbaradmin')

    <div class="min-h-screen flex justify-center items-center sm:ml-64 bg-gray-100 p-4 sm:p-6">
        <div class="w-full max-w-5xl bg-white shadow-lg rounded-2xl p-4 sm:p-6">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 gap-4">
                <h2 class="text-2xl sm:text-3xl font-semibold text-gray-700">Data Ucapan</h2>
                <a href="{{ route('ucapan.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 sm:px-5 rounded-lg shadow-md transition">
                    + Tambah Data
                </a>
            </div>

            <div class="relative overflow-x-auto sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 sm:px-6 py-3">ID</th>
                            <th scope="col" class="px-4 sm:px-6 py-3">Text</th>
                            <th scope="col" class="px-4 sm:px-6 py-3">Waktu</th>
                            <th scope="col" class="px-4 sm:px-6 py-3">Waktu End</th>
                            <th scope="col" class="px-4 sm:px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ucapan as $u)
                            <tr class="bg-white border border-gray-300 hover:bg-gray-100 dark:hover:bg-gray-200">
                                <td class="px-4 sm:px-6 py-4 text-black">{{ $u->id }}</td>
                                <td class="px-4 sm:px-6 py-4 text-black">{{ $u->text ?? 'Tidak ada data' }}</td>
                                <td class="px-4 sm:px-6 py-4 text-black">{{ $u->waktu ?? 'Tidak ada data' }}</td>
                                <td class="px-4 sm:px-6 py-4 text-black">{{ $u->waktu_end ?? 'Tidak ada data' }}</td>

                                <!-- Kolom Aksi -->
                                <td class="px-4 sm:px-6 py-4 text-center">
                                    <a href="{{ route('ucapan.edit', $u->id) }}"
                                        class="text-yellow-500 hover:underline">Edit</a> |
                                    <form action="{{ route('ucapan.destroy', $u->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 sm:px-6 py-4 text-center text-gray-500">
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
