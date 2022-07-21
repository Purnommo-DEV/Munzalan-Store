@extends('Admin.Layouts.master')
@section('content')
	<div class="content">
		<div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#tmbKategori">
                                    <i class="fa fa-plus"></i>
                                    Tambah Kategori
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal -->
                            <div class="modal fade" id="tmbKategori" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header no-bd">
                                            <h5 class="modal-title">
                                                <span class="fw-mediumbold">
                                                    Tambah Kategori
                                                </span> 
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('TambahKategori') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group form-group-default">
                                                                <label>Nama Kategori</label>
                                                                <input type="text" class="form-control" name="name" placeholder="Kategori">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 pr-0">
                                                            <div class="form-group form-group-default">
                                                                <label>Gambar</label>
                                                                <input type="file" class="form-control" name="gambar" accept="image/png, image/jpeg" placeholder="Gambar">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <div class="modal-footer no-bd">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="kategoris" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th>Nama Kategori</th>
                                            <th>Gambar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_kategori as $data_kategoris)
                                            <tr>
                                                <td>{{$data_kategoris->name}}</td>
                                                <td><img src="{{ asset('gambar/gambar_kategori') }}/{{ $data_kategoris->gambar }}" width="100" alt="Tidak Ada Gambar"></td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href = "#" data-toggle="modal" data-target="#editKategori-{{ $data_kategoris->id }}" class="btn btn-link btn-primary"
                                                            data-original-title="Edit Kategori">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a href="#" kategori-id="{{$data_kategoris->id}}" class="btn btn-link btn-danger hapusKategori" data-original-title="Hapus">
                                                            <i class="fa fa-times"></i>
                                                        </button>
													</div>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="editKategori-{{ $data_kategoris->id }}" tabindex="-1" role="dialog"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header no-bd">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{route('ubahKategori', $data_kategoris->id )}}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Nama Kategori</label>
                                                                            <input name="name" value="{{ $data_kategoris->name }}" type="text"
                                                                                class="form-control" placeholder="Contoh : Koko Kurta">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Gambar</label>
                                                                            <input name="gambar" type="file" accept="image/png, image/jpeg" value="{{ $data_kategoris->gambar }}"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer no-bd">
                                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                                <button type="button" class="btn btn-danger"
                                                                    data-dismiss="modal">Close</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
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
    $('.hapusKategori').click(function(){
        //Buat variabel baru siswa_id, This mengacu pada clas yang di klik yaitu .delete kemudia ambil attributnya yaitu siswa_id
        var kategori_id = $(this).attr('kategori-id');
        swal({
        title: "Yakin ?",
        text: "Menghapus Data ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                window.location = "/hapusKategori/"+kategori_id;
                }
            });
        });
    </script>
@endsection