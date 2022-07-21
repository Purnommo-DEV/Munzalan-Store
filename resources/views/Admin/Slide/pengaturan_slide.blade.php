@extends('Admin.Layouts.master')
@section('content')
	<div class="content">
		<div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#tmbSlide">
                                    <i class="fa fa-plus"></i>
                                    Tambah Slide
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal -->
                            <div class="modal fade" id="tmbSlide" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header no-bd">
                                            <h5 class="modal-title">
                                                <span class="fw-mediumbold">
                                                    Tambah Slide
                                                </span> 
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('AdminTambahSlide') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group form-group-default">
                                                                <label>Teks</label>
                                                                <textarea type="text" class="ckeditor form-control" name="teks" placeholder="Slide"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 pr-0">
                                                            <div class="form-group form-group-default">
                                                                <label>Tipe</label>
                                                                <select name="tipe" class="form-control">
                                                                    <option value="1">Slide Utama</option>
                                                                    <option value="2">Slide Kedua</option>
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
                                            <th>Tipe</th>
                                            <th>Gambar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_slide as $data_slides)
                                            <tr>
                                                <td>{!!$data_slides->teks!!}</td>
                                                <td>{{$data_slides->tipe}}</td>
                                                <td><img src="{{ asset('gambar/gambar_slider') }}/{{ $data_slides->gambar }}" width="100" alt="Tidak Ada Gambar"></td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href = "#" data-toggle="modal" data-target="#editSlide-{{ $data_slides->id }}" class="btn btn-link btn-primary"
                                                            data-original-title="Edit Slide">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a href="#" slide-id="{{$data_slides->id}}" class="btn btn-link btn-danger hapusSlide" data-original-title="Hapus">
                                                            <i class="fa fa-times"></i>
                                                        </button>
													</div>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="editSlide-{{ $data_slides->id }}" tabindex="-1" role="dialog"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header no-bd">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{route('ubahSlide', $data_slides->id )}}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Teks</label>
                                                                            <textarea name="teks" value="{{ $data_slides->teks }}" type="text"
                                                                                class="ckeditor form-control" placeholder="Contoh : Promo Jum'at">{!! $data_slides->teks !!}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Tipe</label>
                                                                            <select class="form-control" name="tipe">
                                                                            @if (old('tipe', $data_slides->tipe)==1)
                                                                                <option value="1" selected>Slide Utama</option>
                                                                                <option value="2" >Slide Kedua</option>
                                                                            @elseif (old('tipe', $data_slides->tipe)==2)
                                                                                <option value="2" selected>Slide Kedua</option>
                                                                                <option value="1" >Slide Utama</option>
                                                                            @else
                                                                                <option value="1" >Slide Utama</option>
                                                                                <option value="2" >Slide Kedua</option>
                                                                            @endif
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Gambar</label>
                                                                            <input name="gambar" type="file" accept="image/png, image/jpeg" value="{{ $data_slides->gambar }}"
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
    $('.hapusSlide').click(function(){
        var slide_id = $(this).attr('slide-id');
        swal({
        title: "Yakin ?",
        text: "Menghapus Data ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                window.location = "/hapusSlide/"+slide_id;
                }
            });
        });
    </script>
@endsection