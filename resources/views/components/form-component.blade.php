<div>
    {{-- form input tailwind --}}
    <div class="relative top-10 mx-auto  border w-1/2 shadow-lg rounded-md bg-slate-300">
        <div class="mt-3 text-center">
            <h3 class="header text-lg leading-6 font-medium text-gray-900">Form Barang</h3>
            <form id="formbarang" class="bg-slate-300 shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    {{-- hidden --}}
                    <input type="hidden" id="barangid" name="barangid" value="">
                    {{-- title --}}
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="name">
                        Nama barang
                    </label>
                    <input id="namabarang" class="w-1/2 shadow appearance-none border rounded  py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="Name" name="name" value="{{ old('name') }}">
                    {{-- error --}}
                    @error('name')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="picture">
                        Picture
                    </label>
                    {{-- input file image with old --}}
                    <input class="w-1/2 shadow appearance-none border rounded  py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="picture" type="file" placeholder="Picture" name="picture" value="{{ old('picture') }}">
                    @error('picture')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="buying_price">
                        Harga Beli
                    </label>
                    <input id="hargabeli" value="{{ old('buying_price') }}" class="w-1/2 shadow appearance-none border rounded  py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="buying_price" type="text" placeholder="Buying Price" name="buying_price">
                    {{-- error --}}
                    @error('buying_price')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="selling_price">
                        Harga Jual
                    </label>
                    <input id="hargajual" value="{{ old('selling_price') }}" class="w-1/2 shadow appearance-none border rounded  py-2 px-3 text-gray-700 leading-tight focus:outline-none focus
                    :shadow-outline" id="selling_price" type="text" placeholder="Selling Price" name="selling_price">
                {{-- error --}}
                @error('selling_price')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
                </div>
                
                <div class="mb-6">
                    <label class="inline-block text-gray-700 text-sm font-bold mb-2" for="quantity">
                        Stok
                    </label>
                    <input id="stok" value="{{ old('quantity') }}" class="w-1/2 shadow appearance-none border rounded  py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="quantity" type="text" placeholder="Quantity" name="quantity">
                    {{-- error --}}
                    @error('quantity')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                {{-- buton --}}
                <div class="flex items-center justify-between">
                    <button id="formbtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Add
                    </button>
                </div>
            </form>
            <div class="items-center px-4 py-3">
                <button id="ok-btn"
                    class="px-4 py-2 bg-purple-500 text-white 
                        text-base font-medium rounded-md w-full 
                        shadow-sm hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-300">
                    close
                </button>
            </div>
        </div>
    </div>
</div>