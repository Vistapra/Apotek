<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detail Transaksi') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="text-gray-900 dark:text-gray-100">
                    @forelse ($produk_transaksi as $pt)
                        <div class="flex flex-col gap-y-5">
                            <!-- Desktop View -->
                            <div class="hidden sm:flex flex-row items-center justify-between gap-x-10 mb-5">
                                @role('Owner')
                                    <x-transaction-info label="{{ __('Nama Pembeli') }}" value="{{ $pt->user->name }}" />
                                @endrole
                                <x-transaction-info label="{{ __('Total Transaksi') }}"
                                    value="Rp {{ number_format($pt->total_harga, 0, ',', '.') }}" />
                                <x-transaction-info label="{{ __('Tanggal') }}"
                                    value="{{ $pt->created_at->format('d M Y H:i:s') }}" />

                                <div class="flex flex-col mb-4">
                                    <p class="text-base text-gray-500 dark:text-gray-400 mb-1">
                                        {{ __('Status') }}
                                    </p>
                                    <x-transaction-status :status="$pt->konfirmasi" />
                                </div>
                                <div class="flex items-center">
                                    <a href="#"
                                        class="font-bold py-3 px-5 rounded-full text-white bg-indigo-700 hover:bg-indigo-800 transition-colors duration-200">
                                        {{ __('Lihat Detail') }}
                                    </a>
                                </div>
                            </div>

                            <!-- Mobile View -->
                            <div class="flex flex-col sm:hidden gap-y-5 mb-5">
                                @role('Owner')
                                    <x-transaction-info label="{{ __('Nama Pembeli') }}" value="{{ $pt->user->name }}" />
                                @endrole
                                <x-transaction-info label="{{ __('Total Transaksi') }}"
                                    value="Rp {{ number_format($pt->total_harga, 0, ',', '.') }}" />
                                <x-transaction-info label="{{ __('Tanggal') }}"
                                    value="{{ $pt->created_at->format('d M Y H:i:s') }}" />

                                <div class="flex flex-row items-center gap-x-2">
                                    <p class="text-base text-gray-500 dark:text-gray-400 mr-2">
                                        {{ __('Status') }}
                                    </p>
                                    <x-transaction-status :status="$pt->konfirmasi" />
                                </div>
                                <div class="flex items-center justify-center">
                                    <a href="#"
                                        class="font-bold py-3 px-5 rounded-full text-white bg-indigo-700 hover:bg-indigo-800 transition-colors duration-200">
                                        {{ __('Lihat Detail') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <hr class="border-gray-300 dark:border-gray-700 my-5">
                    @empty
                        <p>Belum ada transaksi yang tersedia</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
