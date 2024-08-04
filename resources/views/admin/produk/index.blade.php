<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Produk') }}
            </h2>
            <div class="mb-4">
                <a href="{{ route('admin.produk.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-200 active:bg-blue-800 disabled:opacity-25 transition">
                    {{ __('Tambah Produk') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($produk->isEmpty())
                        <p>{{ __('Tidak ada Produk tersedia.') }}</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>

                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            {{ __('Foto') }}
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            {{ __('Nama') }}
                                        </th>

                                        <th scope="col"
                                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            {{ __('Harga') }}
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            {{ __('Kategori') }}
                                        </th>

                                        <th scope="col"
                                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            {{ __('Deskripsi') }}
                                        </th>

                                        <th scope="col"
                                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            {{ __('Aksi') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                    @foreach ($produk as $p)
                                        <tr>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                <img src="{{ Storage::url($p->foto) }}" alt="{{ $p->nama }}"
                                                    class="w-16 h-16 object-cover rounded">
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 dark:text-gray-100">
                                                {{ $p->nama }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                                Rp {{ number_format($p->harga, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                                {{ $p->kategori->nama }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-wrap text-sm text-black dark:text-white">
                                                <div class="about-container">
                                                    {{ $p->deskripsi }}
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                                <div class="flex justify-center space-x-2">
                                                    <a href="{{ route('admin.produk.edit', $p->id) }}"
                                                        class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 transition-colors duration-200">
                                                        {{ __('Edit') }}
                                                    </a>
                                                    <form action="{{ route('admin.produk.destroy', $p->id) }}"
                                                        method="POST" class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-700 transition-colors duration-200"
                                                            onclick="return confirm('{{ __('Apakah Anda yakin ingin menghapus produk ini?') }}')">
                                                            {{ __('Hapus') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <style>
        .about-container,
        .name-container {
            max-height: 100px;
            overflow-y: auto;
            white-space: pre-wrap;
            text-align: justify;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</x-app-layout>
