<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        @if (Session::get('error'))
            <div class="row">
                <div class="col-md-4 offset-4 mt-2 py-2 rounded bg-danger text-white fw-bold">
                    {{ Session::get('error') }}
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-4 offset-4 rounded bg-info mt-3 py-3">
                <h2 class="text-center fw-bold" style="font-size: 20px">Tambah Data Produk</h2>
                <form class="mt-3" action="{{ route('postRequest', ['user' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf()
                    <div class="mb-1">
                        <label for="exampleFormControlInput1" class="form-label fw-semibold">Gambar Produk</label>
                        <input type="file" class="form-control" name="image" id="image" placeholder="Masukkan gambar produk" value="{{ old('image') }}">
                        @error('image')
                            <div id="imageError" class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-1">
                        <label for="exampleFormControlInput1" class="form-label fw-semibold">Nama Produk</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan nama produk" value="{{ old('name') }}">
                        @error('name')
                            <div id="nameError" class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-1">
                        <label for="exampleFormControlInput1" class="form-label fw-semibold">Berat</label>
                        <input type="number" class="form-control" name="weight" id="weight" placeholder="Masukkan berat produk" value="{{ old('weight') }}">
                        @error('weight')
                            <div id="weightError" class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-1">
                        {{-- <label for="exampleFormControlInput1" class="form-label fw-semibold">Harga</label>
                        <input type="number" class="form-control" name="price" placeholder="Masukkan harga produk"> --}}
                        <label for="price" class="form-label fw-semibold">price</label>
                        <input type="number" class="form-control form-control-sm" placeholder="Masukkan price produk" name="price" id="price" value="{{ old('price') }}">
                        @error('price')
                            <div id="priceError" class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-1">
                        <label for="exampleFormControlInput1" class="form-label fw-semibold">Stok</label>
                        <input type="number" class="form-control" name="stock" id="stock" placeholder="Masukkan stok produk" value="{{ old('stock') }}">
                        @error('stock')
                            <div id="stockError" class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-1">
                        <label for="exampleFormControlInput1" class="form-label fw-semibold">Kondisi</label>
                        <select class="form-select form-control" aria-label="Default select example" name="condition">
                            <option value="0" {{ old('condition') == '0' ? 'selected' : '' }}>Pilih Kondisi Barang</option>
                            <option value="Bekas" {{ old('condition') == 'Bekas' ? 'selected' : '' }}>Bekas</option>
                            <option value="Baru" {{ old('condition') == 'Baru' ? 'selected' : '' }}>Baru</option>
                        </select>
                        @error('condition')
                            <div id="conditionError" class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label fw-semibold">Deskripsi</label>
                        <textarea class="form-control" name="description" id="description" rows="3" placeholder="Tuliskan deskripsi produk yang akan dijual">{{ old('description') }}</textarea>
                        @error('description')
                            <div id="descriptionError" class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex">
                        <button class="btn btn-dark mx-auto" id="formId" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

</html>
