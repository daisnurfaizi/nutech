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

{{-- button modal --}}

{{-- as --}}

{{-- alert --}}
@if ($errors->any())
<div class="bg-red-100 border-t-4 border-red-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
    <div class="flex">
      <div class="py-1"><svg class="fill-current h-6 w-6 text-red-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
      <div>
        <p class="font-bold">Check In your Input Form</p>
        <p class="text-sm">Make sure .</p>
      </div>
    </div>
  </div>
    
@endif
{{-- success --}}
@if (session('success'))
<div class="bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md" role="alert">
    <div class="flex">
      <div class="py-1"><svg class="fill-current h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
      <div>
        <p class="font-bold">Success</p>
        <p class="text-sm">{{ session('success') }}</p>
      </div>
    </div>
  </div>
@endif
{{-- end alert --}}


<div class="flex mt-4">
    <div class="w-80 mx-auto mt-5 p-7">
        
    <button class="bg-purple-500 text-white rounded-md px-8 py-2 text-base font-medium hover:bg-blue-500
    focus:outline focus:ring-2 focus:ring-green-300" id="open-btn">Input Barang</button>
    </div>
    {{-- over lap effect --}}
    <div id="modal" class="fixed hidden inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
    <x-form-component></x-form-component>
        
        
    </div>
</div>
{{-- <x-form-component></x-form-component> --}}
{{-- search --}}
<div class="flex mt-4 justify-center">
  <input id="search" type="text" class="border border-gray-400 p-2 w-1/2 " placeholder="Search">
</div>
<div class="container">
    {{-- card product tailwind --}}
    <div class="flex flex-wrap">
        @foreach ($items as $item)
            <div class="w-1/3 p-3 item">
                <div class="bg-slate-300 shadow-md rounded p-4">
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
                                    {{-- hidden --}}
                                    <input data-id="id" type="hidden" class="id" value="{{ $item->id }}">
                                    <h3 class="namabarang text-xl font-bold">Nama Barang:</h3>
                                    <h3 class="namabarang text-xl font-bold">{{ $item->name }}</h3>
                                </div>
                                <div class="w-full">
                                    {{-- harga beli --}}
                                    <p class="hargabeli text-xl">Harga Beli {{"Rp.". $item->buying_price }}</p>
                                </div>
                                <div class="w-full">
                                    {{-- harga jual --}}
                                    <p class="hargajual text-xl">Harga Jual {{"Rp.". $item->selling_price }}</p>
                                </div>
                                {{-- jumlah item --}}
                                <div class="w-full">
                                    <p class="jumlahitem text-xl">Stok {{ $item->quantity }}</p>
                                </div>
                                {{-- edit and delete inline --}}
                                
                                <a href="{{ route('items.destroy',$item->id) }}" class="delete text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</a>
                                <button type="button" class="editdata text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:focus:ring-yellow-900">Update</button>
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
@if (session('status'))
    <script>
        $( document ).ready(
            Swal.fire({
                title: 'Success',
                text: '{{ session('status') }}',
                icon: 'success',
                confirmButtonText: 'Ok'
            })
        });
    </script>
@endif
<script>
    let modal = document.getElementById('modal');
    let btn = document.getElementById('open-btn');
    let button = document.getElementById('ok-btn');
    // modal.style.display = 'none';

btn.onclick = function() {
    modal.style.display = "block";
    resetform();
}

button.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
<script>
    
    const search = document.getElementById('search');
    search.addEventListener('keyup', function(e) {
        const searchValue = e.target.value;
        const items = document.querySelectorAll('.item');
        items.forEach(function(item) {
            if (item.textContent.toLowerCase().indexOf(searchValue.toLowerCase()) != -1) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });

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
// edit data 
const editBtn = document.querySelectorAll('.editdata');
editBtn.forEach(function(btn) {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
    // get closest class
        const closest = e.target.closest('.item');
        // get hidden input
        const id = closest.querySelector('.id').value;
        // const id = e.target.getAttribute('data-id').value;
        const name = closest.querySelector('.namabarang').textContent;
        const buying_price = closest.querySelector('.hargabeli').textContent;
        const selling_price = closest.querySelector('.hargajual').textContent;
        const quantity = closest.querySelector('.jumlahitem').textContent;
        // const picture = closest.querySelector('.picture').textContent;
        const data = {
            id: id,
            name: name,
            buying_price: removeNumber(buying_price),
            selling_price: removeNumber(selling_price),
            quantity: removeNumber(quantity),
            // picture: picture
        };
        console.log(data);
        const barangid = document.getElementById('barangid').value = data.id;
        const namabarang = document.getElementById('namabarang').value = data.name;
        const hargabeli = document.getElementById('hargabeli').value = data.buying_price;
        const hargajual = document.getElementById('hargajual').value = data.selling_price;
        const jumlahitem = document.getElementById('stok').value = data.quantity;
        // const picture = document.getElementById('picture').value = data.picture;
        const formbtn = document.getElementById('formbtn').textContent = 'Update';
        // btn.onclick = function() {
            modal.style.display = "block";
        // }
    });
});

// fuction remove all exept number
function removeNumber(string) {
    return string.replace(/[^0-9]/g, '');
}
// reset form
function resetform() {
    const barangid = document.getElementById('barangid').value = '';
    const namabarang = document.getElementById('namabarang').value = '';
    const hargabeli = document.getElementById('hargabeli').value = '';
    const hargajual = document.getElementById('hargajual').value = '';
    const jumlahitem = document.getElementById('stok').value = '';
    // const picture = document.getElementById('picture').value = '';
    const formbtn = document.getElementById('formbtn').textContent = 'Add';
}
</script>
</body>
</html>