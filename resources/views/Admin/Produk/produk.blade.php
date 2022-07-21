@extends('Admin.Layouts.master')
@section('content')
	<div class="content">
		<div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                    <a href="{{ route('HalamanTambahProduk') }}" 
                                        class="btn btn-primary btn-round ml-auto">Tambah Produk
                                    </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal -->
                            <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header no-bd">
                                            <h5 class="modal-title">
                                                <span class="fw-mediumbold">
                                                New</span> 
                                                <span class="fw-light">
                                                    Row
                                                </span>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="small">Create a new row using this form, make sure you fill them all</p>
                                            <form>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Name</label>
                                                            <input id="addName" type="text" class="form-control" placeholder="fill name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 pr-0">
                                                        <div class="form-group form-group-default">
                                                            <label>Position</label>
                                                            <input id="addPosition" type="text" class="form-control" placeholder="fill position">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-default">
                                                            <label>Office</label>
                                                            <input id="addOffice" type="text" class="form-control" placeholder="fill office">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer no-bd">
                                            <button type="button" id="addRowButton" class="btn btn-primary">Add</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th>Nama Produk</th>
                                            <th>Kategori</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataProduk as $dataProduks)
                                            <tr>
                                                <td height="50">{{$dataProduks->name}}</td>
                                                <td>{{$dataProduks->kategori->name}}</td>
                                                <td>@currency($dataProduks->harga)</td>
                                                {{-- <td>{{$dataProduks->diskon}}%</td> --}}
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="{{ route('AdminHalamanDetailProduk', $dataProduks->id) }}" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Detail, Tambah Ukuran & Stok">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('HalamanUbahProduk', $dataProduks->id) }}" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Ubah">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a href="#" produk-id="{{$dataProduks->id}}" class="btn btn-link btn-danger hapusProduk" data-original-title="Hapus">
                                                            <i class="fa fa-times"></i>
                                                        </button>
													</div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
    //Jika ada class yang bernama delete lalu di klik maka jalankan function() dan tampilkan alert(1) atau pesan
    $('.hapusProduk').click(function(){
        //Buat variabel baru siswa_id, This mengacu pada clas yang di klik yaitu .delete kemudia ambil attributnya yaitu siswa_id
        var produk_id = $(this).attr('produk-id');
        swal({
        title: "Yakin ?",
        text: "Menghapus Data ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                window.location = "/hapusProduk/"+produk_id;
                }
            });
        });
    </script>
@endsection