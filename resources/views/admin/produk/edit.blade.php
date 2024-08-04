<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-10 text-gray-900 dark:text-gray-100">

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                            role="alert">
                            <strong class="font-bold">Whoops!</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                            role="alert">
                            <strong class="font-bold">Success!</strong>
                            <ul>
                                <li>{{ session('success') }}</li>
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.produk.update', $produk->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div>
                            <x-input-label for="nama" :value="__('Nama')" />
                            <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama"
                                :value="old('nama', $produk->nama)" required autofocus autocomplete="nama" />
                            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="harga" :value="__('Harga')" />
                            <x-text-input id="harga" class="block mt-1 w-full" type="text" name="formatted_harga"
                                :value="old('harga', number_format($produk->harga, 0, ',', '.'))" required />
                            <input type="hidden" id="harga_hidden" name="harga"
                                value="{{ old('harga', $produk->harga) }}">
                            <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="kategori_id" :value="__('Kategori')" />
                            <select id="kategori_id" name="kategori_id"
                                class="py-3 rounded-lg pl-3 w-full border border-slate-300" required>
                                <option value="" disabled selected>{{ __('Pilih kategori') }}</option>
                                @foreach ($kategori as $k)
                                    <option value="{{ $k->id }}"
                                        @if (old('kategori_id', $produk->kategori_id) == $k->id) selected @endif>
                                        {{ $k->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('kategori_id')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                            <textarea id="deskripsi" class="block mt-1 w-full" name="deskripsi" required>{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                            <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="foto" :value="__('Foto')" />
                            <x-text-input id="foto" class="block mt-1 w-full" type="file" name="foto" />
                            <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                            @if ($produk->foto)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $produk->foto) }}" alt="Foto Produk"
                                        class="w-32 h-32 object-cover">
                                </div>
                            @endif
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Update Produk') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var hargaInput = document.getElementById('harga');
            var hiddenInput = document.getElementById('harga_hidden');

            // Initialize hidden input value based on the formatted price input
            if (hargaInput.value) {
                var cleaned = hargaInput.value.replace(/\D/g, '');
                hiddenInput.value = cleaned;
            }

            hargaInput.addEventListener('input', function(e) {
                var harga = e.target.value;
                var cleaned = harga.replace(/\D/g, '');
                var rupiah = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }).format(cleaned);
                e.target.value = (cleaned === "") ? "" : rupiah;
                hiddenInput.value = cleaned;
            });
        });
    </script>
</x-app-layout>
