<form action="/barang/store" method="post">
    {{csrf_field()}}
    <div class="form-group">
        <label for="name">Nama Barang</label>
        <input class="form-control @error('name') is-invalid @enderror" type="text" name="nama" id="name" value="{{ old('name') }}" placeholder="Masukkan Nama Buku"> @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="type">Harga Barang</label>
        <input class="form-control @error('type') is-invalid @enderror" type="text" name="harga" id="type" value="{{ old('type') }}" placeholder="masukkan tipe buku"> @error('type')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group float-right">
        <button class="btn btn-lg btn-danger" type="reset">Reset</button>
        <button class="btn btn-lg btn-primary" type="submit">Submit</button>
    </div>
</form>