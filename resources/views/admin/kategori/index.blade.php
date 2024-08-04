<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Kategori') }}
            </h2>
            <div class="mb-4">
                <a href="{{ route('admin.kategori.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-200 active:bg-blue-800 disabled:opacity-25 transition">
                    {{ __('Tambah Kategori') }}
                </a>
            </div>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">


                    @if ($kategori->isEmpty())
                        <p>{{ __('Tidak ada kategori tersedia.') }}</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            {{ __('Nama') }}
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            {{ __('Ikon') }}
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            {{ __('Aksi') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                    @foreach ($kategori as $k)
                                        <tr>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 dark:text-gray-100">
                                                {{ $k->nama }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                <img src="{{ Storage::url($k->ikon) }}" alt="{{ $k->nama }}"
                                                    class="w-16 h-16 object-cover rounded">

                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                                <div class="flex justify-center space-x-2">
                                                    <a href="{{ route('admin.kategori.edit', $k->id) }}"
                                                        class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 transition-colors duration-200">
                                                        {{ __('Edit') }}
                                                    </a>
                                                    <form action="{{ route('admin.kategori.destroy', $k->id) }}"
                                                        method="POST" class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-700 transition-colors duration-200"
                                                            onclick="return confirm('{{ __('Apakah Anda yakin ingin menghapus kategori ini?') }}')">
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
</x-app-layout>
