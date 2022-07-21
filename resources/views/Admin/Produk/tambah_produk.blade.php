@extends('Admin.Layouts.master')
@section('content')

<div class="content">
    <div class="page-inner">
        @if ($errors->any())
            @foreach ($errors->all as $error)
                <li>{{ $error }}</li>
            @endforeach
        @endif
        <form action="{{ route('TambahProduk') }}" method="POST" enctype="multipart/form-data">
            <div class="row">
                @csrf
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Info Produk</div>
                            @if ($errors->any())
                            @foreach ($errors->all as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-floating-label">
                                        <input id="inputFloatingLabel2" type="text" name="name" value="{{ old('name') }}" class="form-control input-solid" required>
                                        <label for="inputFloatingLabel2" class="placeholder">Nama Produk</label>
                                    </div>
                                    <div class="form-group form-floating-label">
                                        <select name="kategori_id" value="{{ old('kategori_id') }}" class="form-control input-solid" id="selectFloatingLabel2" required>
                                            <option value="">&nbsp;</option>
                                            @foreach ($kategori as $kategoris)
                                                <option value="{{ $kategoris->id }}">{{ $kategoris->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="selectFloatingLabel2" class="placeholder">Select</label>
                                    </div>
                                    <div class="form-group form-floating-label">
                                        <input id="inputFloatingLabel2" type="text" name="harga" value="{{ old('harga') }}" class="form-control input-solid" required>
                                        <label for="inputFloatingLabel2" class="placeholder">Harga Jual</label>
                                    </div>
                                    <div class="form-group form-floating-label">
                                        <input id="inputFloatingLabel2" type="text" name="harga_beli" value="{{ old('harga_beli') }}" class="form-control input-solid" required>
                                        <label for="inputFloatingLabel2" class="placeholder">Harga Beli</label>
                                    </div>
                                    <div class="form-group form-floating-label">
                                        <input id="inputFloatingLabel2" type="text" name="diskon" value="{{ old('diskon') }}" class="form-control input-solid" required>
                                        <label for="inputFloatingLabel2" class="placeholder">Diskon</label>
                                    </div>
                                    <div class="form-group form-floating-label">
                                        <textarea id="inputFloatingLabel2" type="text" name="deskripsi_singkat" class="form-control input-solid" required>{{ old('deskripsi_singkat') }}</textarea>
                                        <label for="inputFloatingLabel2" class="placeholder">Deskripsi Singkat</label>
                                    </div>
                                    <div class="form-group form-floating-label">
                                        <textarea id="inputFloatingLabel2" type="text" name="deskripsi_lengkap" class="form-control input-solid ckeditor" rows="2" required>{{ old('deskripsi_lengkap') }}</textarea>
                                        <label for="inputFloatingLabel2" class="placeholder">Deskripsi Lengkap</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Gambar Produk</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">Gambar 1</label>
                                        <input type="file" name="gambar1" value="{{ old('gambar1') }}" class="form-control-file" id="exampleFormControlFile1" required>
                                        <span class="text-danger">@error('gambar1') {{$message}} @enderror</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">Gambar 2</label>
                                        <input type="file" name="gambar2" value="{{ old('gambar2') }}" class="form-control-file" id="exampleFormControlFile1" required>
                                        <span class="text-danger">@error('gambar2') {{$message}} @enderror</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">Gambar 3</label>
                                        <input type="file" name="gambar3" value="{{ old('gambar3') }}" class="form-control-file" id="exampleFormControlFile1" required>
                                        <span class="text-danger">@error('gambar3') {{$message}} @enderror</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">Gambar 4</label>
                                        <input type="file" name="gambar4" value="{{ old('gambar4') }}" class="form-control-file" id="exampleFormControlFile1" required>
                                        <span class="text-danger">@error('gambar4') {{$message}} @enderror</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">Gambar 5</label>
                                        <input type="file" name="gambar5" value="{{ old('gambar5') }}" class="form-control-file" id="exampleFormControlFile1" required>
                                        <span class="text-danger">@error('gambar5') {{$message}} @enderror</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Ukuran & Stok</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Ukuran</label>
                                        <div class="selectgroup w-100">
                                            <label class="selectgroup-item">
                                                <input type="radio" name="ukuran" value="S" class="selectgroup-input" checked="">
                                                <span class="selectgroup-button">S</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="ukuran" value="M" class="selectgroup-input">
                                                <span class="selectgroup-button">M</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="ukuran" value="L" class="selectgroup-input">
                                                <span class="selectgroup-button">L</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="ukuran" value="XL" class="selectgroup-input">
                                                <span class="selectgroup-button">XL</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="ukuran" value="XXL" class="selectgroup-input">
                                                <span class="selectgroup-button">XXL</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group form-floating-label">
                                        <input id="inputFloatingLabel2" type="text" name="stok" value="{{ old('stok') }}" class="form-control input-solid" required>
                                        <label for="inputFloatingLabel2" class="placeholder">Stok</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="col-12 col-md-8" >
                <button class="btn btn-success" type="submit">Submit</button>
                <a href="{{ route('AdminProduk') }}" class="btn btn-danger" >Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection