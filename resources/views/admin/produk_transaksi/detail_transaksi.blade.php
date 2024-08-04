<x-app-layout>
    <div class="py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow-sm sm:rounded-lg">
                <!-- Header Section -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4">
                    <div class="mb-4 sm:mb-0">
                        <h3 class="text-lg font-semibold text-gray-500 dark:text-gray-400">Total Transaksi</h3>
                        <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">Rp 18.000.000</p>
                    </div>
                    <div class="mb-4 sm:mb-0">
                        <h3 class="text-lg font-semibold text-gray-500 dark:text-gray-400">Tanggal</h3>
                        <p class="text-xl font-bold text-gray-900 dark:text-gray-100">25 Januari 2024</p>
                    </div>
                    <div class="flex items-center gap-x-2">
                        <div class="bg-yellow-500 text-white px-4 py-2 rounded-full">
                            PENDING
                        </div>
                    </div>
                </div>

                <hr class="border-gray-300 dark:border-gray-600 my-4">

                <!-- Main Content -->
                <div class="flex flex-col sm:flex-row gap-8">
                    <!-- List of Items -->
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-white mb-3">List of Items</h3>
                        <div class="grid grid-cols-1 gap-y-2">
                            @foreach (range(1, 7) as $index)
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <img src="https://via.placeholder.com/50" alt="panadol" class="w-10 h-10 mr-3">
                                        <div>
                                            <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100">panadol</h4>
                                            <p class="text-gray-500 dark:text-gray-400">Rp 280.000</p>
                                        </div>
                                    </div>
                                    <span class="bg-blue-100 text-black px-2 py-1 rounded">Vitamins</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Transaction Proof -->
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-white mb-2">Bukti Transaksi :</h3>
                        <img src="https://via.placeholder.com/300x400" alt="Bukti Dummy"
                            class="border border-gray-300 dark:border-gray-600" style="width: 300px; height: auto;">
                    </div>

                </div>

                <hr class="border-gray-300 dark:border-gray-600 my-4">

                <!-- Delivery Details -->
                <h3 class="text-xl font-bold text-white mb-3">Details of Delivery</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                    <div>
                        <p class="text-gray-500 dark:text-gray-400">Alamat</p>
                        <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100">Jalan Dummy No. 123</h4>
                    </div>
                    <div>
                        <p class="text-gray-500 dark:text-gray-400">Kota</p>
                        <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100">Dummy City</h4>
                    </div>
                    <div>
                        <p class="text-gray-500 dark:text-gray-400">Kode Pos</p>
                        <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100">12345</h4>
                    </div>
                    <div>
                        <p class="text-gray-500 dark:text-gray-400">No Telp</p>
                        <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100">081234567890</h4>
                    </div>
                    <div>
                        <p class="text-gray-500 dark:text-gray-400">Catatan</p>
                        <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100">Catatan dummy</h4>
                    </div>
                </div>

                <hr class="border-gray-300 dark:border-gray-600 my-4">
                @role('Owner')
                    <form method="POST" action="{{ route('produk_transaksi.update', 1) }}">
                        @csrf
                        @method('PUT')
                        <button
                            class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition-colors duration-200">Konfirmasi
                            Order</button>
                    </form>
                @endrole

                @role('Pembeli')
                    <button onclick="window.location.href='https://wa.me/+6288232324437'"
                        class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition-colors duration-200">
                        Konfirmasi Admin
                    </button>
                @endrole
            </div>
        </div>
    </div>
</x-app-layout>
