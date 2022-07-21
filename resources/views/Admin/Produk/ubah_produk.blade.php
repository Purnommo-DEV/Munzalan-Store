@extends('Admin.Layouts.master')
@section('content')

<div class="content">
    <div class="page-inner">
        @if ($errors->any())
            @foreach ($errors->all as $error)
                <li>{{ $error }}</li>
            @endforeach
        @endif
        <form action="{{ route('UbahProduk', $dataProduk->id) }}" method="POST" enctype="multipart/form-data">
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
                                        <input id="inputFloatingLabel2" type="text" name="name" value="{{ $dataProduk->name }}" class="form-control input-solid" required>
                                        <label for="inputFloatingLabel2" class="placeholder">Nama Produk</label>
                                    </div>
                                    <div class="form-group form-floating-label">
                                        <select name="kategori_id" value="{{ old('kategori_id') }}" class="form-control input-solid" id="selectFloatingLabel2" required>
                                            @foreach ($kategori as $kategoris)
                                                @if (old('kategori_id', $dataProduk->kategori_id) == $kategoris->id)
                                                    <option value="{{$kategoris->id}}" selected>{{ $kategoris->name }}</option>
                                                @else
                                                    <option value="{{$kategoris->id}}" >{{ $kategoris->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <label for="selectFloatingLabel2" class="placeholder">Select</label>
                                    </div>
                                    <div class="form-group form-floating-label">
                                        <input id="inputFloatingLabel2" type="text" name="harga" value="{{ $dataProduk->harga }}" class="form-control input-solid" required>
                                        <label for="inputFloatingLabel2" class="placeholder">Harga Jual</label>
                                    </div>
                                    <div class="form-group form-floating-label">
                                        <input id="inputFloatingLabel2" type="text" name="harga_beli" value="{{ $dataProduk->harga_beli }}" class="form-control input-solid" required>
                                        <label for="inputFloatingLabel2" class="placeholder">Harga Beli</label>
                                    </div>
                                    <div class="form-group form-floating-label">
                                        <input id="inputFloatingLabel2" type="text" name="diskon" value="{{ $dataProduk->diskon }}" class="form-control input-solid" required>
                                        <label for="inputFloatingLabel2" class="placeholder">Diskon</label>
                                    </div>
                                    <div class="form-group form-floating-label">
                                        <textarea id="inputFloatingLabel2" type="text" name="deskripsi_singkat" class="form-control input-solid" required>{{ $dataProduk->deskripsi_singkat }}</textarea>
                                        <label for="inputFloatingLabel2" class="placeholder">Deskripsi Singkat</label>
                                    </div>
                                    <div class="form-group form-floating-label">
                                        <textarea id="inputFloatingLabel2" type="text" name="deskripsi_lengkap" class="form-control input-solid ckeditor" required>{{ $dataProduk->deskripsi_lengkap }}</textarea>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">Gambar 1</label>
                                        <input type="file" name="gambar1" value="{{ $gambarProduk->gambar1 }}" class="form-control-file" id="exampleFormControlFile1">
                                        <span class="text-danger">@error('gambar1') {{$message}} @enderror</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">Gambar 1 Lama</label><br>
                                        @if ($gambarProduk->gambar1==NULL)
                                        <img src="{{ asset('gambar/tanpa_gambar/tanpaGambar.png') }}" width="90" height="100">
                                        @else
                                        <img src="{{ asset('gambar/gambar_produk') }}/{{ $gambarProduk->gambar1 }}" width="90" height="100">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">Gambar 2</label>
                                        <input type="file" name="gambar2" value="{{ $gambarProduk->gambar2 }}" class="form-control-file" id="exampleFormControlFile1">
                                        <span class="text-danger">@error('gambar2') {{$message}} @enderror</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">Gambar2 Lama</label><br>
                                        @if ($gambarProduk->gambar2==NULL)
                                        <img src="{{ asset('gambar/tanpa_gambar/tanpaGambar.png') }}" width="90" height="100">
                                        @else
                                        <img src="{{ asset('gambar/gambar_produk') }}/{{ $gambarProduk->gambar2 }}" width="90" height="100">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">Gambar 3</label>
                                        <input type="file" name="gambar3" value="{{ $gambarProduk->gambar3 }}" class="form-control-file" id="exampleFormControlFile1">
                                        <span class="text-danger">@error('gambar3') {{$message}} @enderror</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">Gambar Lama</label><br>
                                        @if ($gambarProduk->gambar3==NULL)
                                        <img src="{{ asset('gambar/tanpa_gambar/tanpaGambar.png') }}" width="90" height="100">
                                        @else
                                        <img src="{{ asset('gambar/gambar_produk') }}/{{ $gambarProduk->gambar3 }}" width="90" height="100">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">Gambar 4</label>
                                        <input type="file" name="gambar4" value="{{ $gambarProduk->gambar4 }}" class="form-control-file" id="exampleFormControlFile1">
                                        <span class="text-danger">@error('gambar4') {{$message}} @enderror</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">Gambar 4 Lama</label><br>
                                        @if ($gambarProduk->gambar4==NULL)
                                        <img src="{{ asset('gambar/tanpa_gambar/tanpaGambar.png') }}" width="90" height="100">
                                        @else
                                        <img src="{{ asset('gambar/gambar_produk') }}/{{ $gambarProduk->gambar4 }}" width="90" height="100">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">Gambar 5</label>
                                        <input type="file" name="gambar5" value="{{ $gambarProduk->gambar5 }}" class="form-control-file" id="exampleFormControlFile1">
                                        <span class="text-danger">@error('gambar5') {{$message}} @enderror</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">Gambar 5 Lama</label><br>
                                        @if ($gambarProduk->gambar5==NULL)
                                        <img src="{{ asset('gambar/tanpa_gambar/tanpaGambar.png') }}" width="90" height="100">
                                        @else
                                        <img src="{{ asset('gambar/gambar_produk') }}/{{ $gambarProduk->gambar5 }}" width="90" height="100">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8" >
                <button class="btn btn-success" type="submit">Submit</button>
                <a href="{{ route('AdminProduk') }}" class="btn btn-danger" >Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection