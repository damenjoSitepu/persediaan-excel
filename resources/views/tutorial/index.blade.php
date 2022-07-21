@extends('template.index')

@section('content')

<div class="mt-5">
    <form action="{{ route('import') }}" enctype="multipart/form-data" method="POST" class="w-75 m-auto text-center">
        @csrf
        <div class="mb-3">
            <label for="formFile" class="form-label fw-bold"><i class="fas fa-file-excel text-success"></i> Pilih File Import Excel</label>
            <input class="form-control" type="file" name="my-file" id="formFile">
        </div>

        @if(Session::has('message'))
            <div class="alert alert-success my-4" role="alert">
                {{ Session::get('message') }}
            </div>
        @endif

        @if($errors->any())
              <div class="d-flex flex-wrap text-danger fw-bold">
                @foreach($errors->all() as $error)
                <div style="width: 48%;" class="p-3 shadow rounded my-3 me-3">
                  <span><i class="fas fa-triangle-exclamation"></i> {{ $error }}</span>
                </div>  
                @endforeach
              </div>
        @endif

      @if(session()->has('failures'))
              <table class="table table-danger">
                <tr>
                  <th>Row</th>
                  <th>Attribute</th>
                  <th>Error</th>
                  <th>Value</th>
                </tr>

                @foreach(session()->get('failures') as $validations)
                <tr>
                  <td>{{ $validations->row() - 1 }}</td>
                  <td>{{ $validations->attribute() }}</td>
                  <td>
                    @foreach($validations->errors() as $errors)
                    {{ $errors }}
                    @endforeach
                  </td>
                  <td>
                    {{ $validations->values()['name'] }}
                  </td>
                </tr>
                @endforeach
              </table>
      @endif

    
    
        <button class="mt-3 btn btn-primary"><i class="fas fa-cogs"></i> Import File</button>
        <a href="{{ route('export') }}" class="mt-3 btn btn-success"><i class='fas fa-file'></i> Download Produk</a>
        <a href="{{ route('qrcode') }}" class="mt-3 btn btn-danger"><i class='fas fa-shop'></i> Download Qr Code</a>
    </form>

    <div class="card text-center my-5">
      <div class="card-header">
          <h2>Suzume No Tojimari</h2>
      </div>
      <div class="card-body">
          {!! QrCode::size(300)->generate('Suzume No Tojimari') !!}
      </div>
    </div>

    <table class="table w-75 m-auto text-center mt-5">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Product Name</th>
            <th scope="col">Stock</th>
          </tr>
        </thead>
        <tbody>
            
        @foreach($product as $p)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $p->name }}</td>
            <td>{{ $p->stock }}</td>
          </tr>
        @endforeach
          
        </tbody>
      </table>
</div>
@endSection()
