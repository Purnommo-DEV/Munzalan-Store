@extends('Admin.Layouts.master')
@section('content')
	<div class="content">
		<div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#tmbIklan">
                                    <i class="fa fa-plus"></i>
                                    Tambah Iklan
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal -->
                            <div class="modal fade" id="tmbIklan" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header no-bd">
                                            <h5 class="modal-title">
                                                <span class="fw-mediumbold">
                                                    Tambah Iklan
                                                </span> 
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('TambahIklan') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group form-group-default">
                                                                <label>Teks</label>
                                                                <textarea id="inputFloatingLabel2" type="text" name="teks" class="form-control input-solid ckeditor" rows="2" required></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group form-group-default">
                                                                <label>Ukuran</label>
                                                                <select class="form-control" name="ukuran">
                                                                    <option value="" disabled selected>-- Pilih Ukuran (Pixel) --</option>
                                                                    <option value="277x260">277x260</option>
                                                                    <option value="576x260">576x260</option>
                                                                </select>
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
                                            <th>Teks</th>
                                            <th>Ukuran</th>
                                            <th>Gambar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_iklan as $data_iklans)
                                            <tr>
                                                <td>{!!$data_iklans->teks!!}</td>
                                                <td>{{$data_iklans->ukuran}}</td>
                                                <td><img src="{{ asset('gambar/gambar_iklan') }}/{{ $data_iklans->gambar }}" width="100" alt="Tidak Ada Gambar"></td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href = "#" data-toggle="modal" data-target="#editIklan-{{ $data_iklans->id }}" class="btn btn-link btn-primary"
                                                            data-original-title="Edit Iklan">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a href="#" iklan-id="{{$data_iklans->id}}" class="btn btn-link btn-danger hapusIklan" data-original-title="Hapus">
                                                            <i class="fa fa-times"></i>
                                                        </button>
													</div>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="editIklan-{{ $data_iklans->id }}" tabindex="-1" role="dialog"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header no-bd">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{route('ubahIklan', $data_iklans->id )}}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Nama Iklan</label>
                                                                            <textarea id="inputFloatingLabel2" type="text" name="teks" class="form-control input-solid ckeditor" rows="2" required>{{ $data_iklans->teks }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Ukuran</label>
                                                                            <select class="form-control" name="ukuran">
                                                                                @if (old('ukuran', $data_iklans->ukuran)=="277x260")
                                                                                <option value="277x260" selected>277x260</option>
                                                                                <option value="576x260" >576x260</option>
                                                                                @elseif (old('ukuran', $data_iklans->ukuran)=="576x260")
                                                                                <option value="576x260" selected>576x260</option>
                                                                                <option value="277x260" >277x260</option>
                                                                                @else
                                                                                <option value="277x260" >277x260</option>
                                                                                <option value="576x260" >576x260</option>
                                                                                @endif
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Gambar</label>
                                                                            <input name="gambar" type="file" accept="image/png, image/jpeg" value="{{ $data_iklans->gambar }}"
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
    $('.hapusIklan').click(function(){
        //Buat variabel baru siswa_id, This mengacu pada clas yang di klik yaitu .delete kemudia ambil attributnya yaitu siswa_id
        var iklan_id = $(this).attr('iklan-id');
        swal({
        title: "Yakin ?",
        text: "Menghapus Data ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                window.location = "/hapusIklan/"+iklan_id;
                }
            });
        });
    </script>
@endsection