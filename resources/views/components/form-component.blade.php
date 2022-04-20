<div>
    {{-- form input tailwind --}}
    <div class="flex justify-center">
        <div class="w-full max-w-sm">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Nama barang
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="Name" name="name" value="{{ old('name') }}">
                    {{-- error --}}
                    @error('name')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="picture">
                        Picture
                    </label>
                    {{-- input file image with old --}}
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="picture" type="file" placeholder="Picture" name="picture" value="{{ old('picture') }}">
                    {{-- error --}}
                    {{-- <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="picture" type="text" placeholder="Picture" name="picture" value="{{ old('picture') }}"> --}}
                    {{-- error --}}
                    {{-- <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="picture" type="file" placeholder="Picture" name="picture">                     --}}
                    {{-- error --}}
                    @error('picture')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="buying_price">
                        Harga Beli
                    </label>
                    <input value="{{ old('buying_price') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="buying_price" type="text" placeholder="Buying Price" name="buying_price">
                    {{-- error --}}
                    @error('buying_price')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="selling_price">
                        Harga Jual
                    </label>
                    <input value="{{ old('selling_price') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus
                    :shadow-outline" id="selling_price" type="text" placeholder="Selling Price" name="selling_price">
                {{-- error --}}
                @error('selling_price')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
                </div>
                
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="quantity">
                        Stok
                    </label>
                    <input value="{{ old('quantity') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="quantity" type="text" placeholder="Quantity" name="quantity">
                    {{-- error --}}
                    @error('quantity')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                {{-- buton --}}
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Add
                    </button>
                </div>
            </form>
        </div>
</div>