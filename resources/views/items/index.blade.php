<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Hello, world!</title>
  </head>
  <body>
    <!-- Scrollable modal -->
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Launch static backdrop modal
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Input Barang</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {{-- form --}}
            <form method="POST" enctype="multipart/form-data" id="form">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama Barang</label>
                    <input type="text" class="form-control" id="nama" name="name" placeholder="Nama Barang">
                    {{-- error --}}
                    <div class="invalid-feedback" id="errorname">
                        
                    </div>
                </div>
                <div class="form-group">
                    <label for="harga">Harga Beli</label>
                    <input type="text" class="form-control" id="harga_beli" name="buying_price" placeholder="Harga Barang">
                    {{-- error --}}
                    <div class="invalid-feedback" id="errorharga">
                    </div>
                  </div>
                {{-- harga jual --}}
                <div class="form-group">
                    <label for="harga_jual">Harga Jual</label>
                    <input type="text" class="form-control" id="harga_jual" name="selling_price" placeholder="Harga Jual">
                    {{-- error --}}
                    <div class="invalid-feedback" id="errorhargajual">
                    </div>
                  </div>
                <div class="form-group">
                    <label for="jumlah">Jumlah Barang</label>
                    <input type="text" class="form-control" id="jumlah" name="quantity" placeholder="Jumlah Barang">

                    {{-- error --}}
                    <div class="invalid-feedback" id="errorjumlah">
                    </div>
                  </div>
                {{-- upload image --}}
                <div class="form-group">
                    <label for="image">Upload Gambar</label>
                    <input type="file" class="form-control" id="image" name="picture">

                    {{-- error --}}
                    <div class="invalid-feedback" id="errorimage">
                    </div>
                  </div>
                {{-- picture --}}
                <div class="form-group">
                    {{-- <label for="image">Gambar</label> --}}
                    <img src="" alt="" id="image_preview" style="width: 100px; height: 100px;">
                </div>
            </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" id="InputBarang" class="btn btn-primary">Understood</button>
        </div>
      </div>
    </div>
  </div>

  
  

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
// image preview
$('#image').change(function(){
    var reader = new FileReader();
    reader.onload = function(e){
        $('#image_preview').attr('src', e.target.result);
    }
    reader.readAsDataURL(this.files[0]);
});
// input barang with upload foto
$(document).ready(function(){
  $('#nama').removeClass('is-valid');

  // var images = new FormData(dataimage);
    $('#InputBarang').click(function(){
        var name = $('#nama').val();
        var buying_price = $('#harga_beli').val();
        var selling_price = $('#harga_jual').val();
        var quantity = $('#jumlah').val();
        // file upload
// required image
        var image = $('#image').val();
        if(image == ''){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please upload image',
            })
        }else{
          var file = $('#image').prop('files')[0];
        // var picture = $('#image');
        // ajak multipart/form-data
        $.ajax({
            type: 'POST',
            url: '{{ route('items.store') }}',
            entype: 'multipart/form-data',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            contentType: false,
            processData: false,
            cache: false,
            data: {
                // '_token': '{{ csrf_token() }}',
                'name': name,
                'buying_price': buying_price,
                'selling_price': selling_price,
                'quantity': quantity,
                'picture': file
            },
            // failed
            error: function(response){
                console.log(response.responseJSON);
                
                var errors = response.responseJSON.message;
                if(errors.name){
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: errors.name,
                  })
                }
                if(errors.buying_price){
                  $('#harga_beli').addClass('is-invalid');
                    $('#errorharga').html(errors.buying_price);
                }
                if(errors.selling_price){
                  $('#harga_jual').addClass('is-invalid');
                    $('#errorhargajual').html(errors.selling_price);
                }
                if(errors.quantity){
                  $('#jumlah').addClass('is-invalid');
                    $('#errorjumlah').html(errors.quantity);
                }
                if(errors.picture){
                    $('#errorimage').html(errors.picture);
                }

            },
            success: function(data) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Data berhasil ditambahkan',
                    icon: 'success',
                    confirmButtonText: 'Oke'
                })
            }
          });
        }
        // end required image  
        
    });
});

    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>
