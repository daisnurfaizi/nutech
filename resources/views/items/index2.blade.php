<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
{{-- button tailwind --}}

<div class="flex mt-4">
  <button id="tombolmodal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
    Add Item
  </button>
</div>
<x-form-component></x-form-component>
{{-- search --}}
<div class="flex mt-4 justify-center">
  <input id="search" type="text" class="border border-gray-400 p-2 w-1/2" placeholder="Search">
</div>
<div class="container">
    {{-- card product tailwind --}}
    <div class="flex flex-wrap">
        @foreach ($items as $item)
            <div class="w-1/3 p-3 item">
                <div class="bg-white shadow-md rounded p-4">
                    <div class="flex flex-wrap">
                        <div class="w-full">

                            {{-- <img src="{{$item->picture }}" alt="{{ $item->name }}" class="w-full"> --}}
                                {{-- image 400x400 --}}
                                <img src="{{ asset('images/'.$item->picture) }}" alt="{{ $item->name }}" class="w-full" style="height: 200px;">
                            {{-- <img src="{{ asset('images/'.$item->picture) }}" alt="{{ $item->name }}" class="w-full"> --}}
                            {{-- <img src="{{ asset('/images'.$item->picture) }}" alt="{{ $item->name }}" class="w-full"> --}}
                        </div>
                        <div class="w-full">
                            <div class="flex flex-wrap">
                                <div class="w-full">
                                    <h3 class="text-xl font-bold">{{ $item->name }}</h3>
                                </div>
                                <div class="w-full">
                                    {{-- harga beli --}}
                                    <p class="text-xl">Harga Beli {{"Rp.". $item->buying_price }}</p>
                                </div>
                                <div class="w-full">
                                    {{-- harga jual --}}
                                    <p class="text-xl">Harga Jual {{"Rp.". $item->selling_price }}</p>
                                </div>
                                {{-- jumlah item --}}
                                <div class="w-full">
                                    <p class="text-xl">Jumlah Item {{ $item->quantity }}</p>
                                </div>
                                {{-- edit and delete inline --}}
                                
                                <a href="{{ route('items.destroy',$item->id) }}" class="delete text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</a>
                                <button type="button" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:focus:ring-yellow-900">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    {{-- paginate number tailwind --}}
    <div class="flex justify-center mt-4 mb-10 bg-indigo-500">
        {{ $items->links() }}
        <div class="p-2 ml-3 font-bold"> Showing {{ $items->firstItem() }} to {{ $items->lastItem() }}
            of total {{$items->total()}} entries
        </div>
    </div>
        {{-- @endforeach --}}
        
</div>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}

<script>
    document.getElementById('search').addEventListener('keyup', function(e) {
        const search = e.target.value;
        console.log(search);
        fetch('/items/search', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                search: search
            })
        })
        .then(res => res.json())
        .then(data => {
            console.log(data);
            const items = data.items.data;
            let output = '';
            items.forEach(item => {
                output += `
                    <div class="w-1/3 p-3 item">
                        <div class="bg-white shadow-md rounded p-4">
                            <div class="flex flex-wrap">
                                <div class="w-full">
                                    <img src="{{$item->picture }}" alt="{{ $item->name }}" class="w-full">
                                </div>
                                <div class="w-full">
                                    <div class="flex flex-wrap">
                                        <div class="w-full">
                                            <h3 class="text-xl font-bold">{{ $item->name }}</h3>
                                        </div>
                                        <div class="w-full">
                                            {{-- harga beli --}}
                                            <p class="text-xl">Harga Beli {{"Rp.". $item->buying_price }}</p>
                                        </div>
                                        <div class="w-full">
                                            {{-- harga jual --}}
                                            <p class="text-xl">Harga Jual {{"Rp.". $item->selling_price }}</p>
                                        </div>
                                        {{-- jumlah item --}}
                                        <div class="w-full">
                                            <p class="text-xl">Jumlah Item {{ $item->quantity }}</p>
                                        </div>
                                        {{-- edit and delete inline --}}

                                        <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
                                        <button type="button" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:focus:ring-yellow-900">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });
            document.getElementById('items').innerHTML = output;
        })
        .catch(err => console.log(err));
    });

    // const search = document.getElementById('search');
    // search.addEventListener('keyup', function(e) {
    //     const searchValue = e.target.value;
    //     const items = document.querySelectorAll('.item');
    //     items.forEach(function(item) {
    //         if (item.textContent.toLowerCase().indexOf(searchValue.toLowerCase()) != -1) {
    //             item.style.display = 'block';
    //         } else {
    //             item.style.display = 'none';
    //         }
    //     });
    // });

// sweet alert delete
    const deleteBtn = document.querySelectorAll('.delete');
    deleteBtn.forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const href = e.target.getAttribute('href');
            console.log(href);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    window.location.href = href;
                }
            })
        });
    });
// show modal 
</script>
</body>
</html>