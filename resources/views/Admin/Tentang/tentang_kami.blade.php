@extends('Admin/Layouts/master')
@section('content')
<div class="content">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#tmbTentangKami">
                                <i class="fa fa-plus"></i>
                                Tentang Kami
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Modal -->
                        <div class="modal fade" id="tmbTentangKami" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header no-bd">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold">
                                                Tentang Kami
                                            </span> 
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('TambahTentangKami') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Teks</label>
                                                            <textarea type="text" class="form-control ckeditor" name="teks" placeholder="TentangKami"></textarea>
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
                                        <th>Gambar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                            <td>{!!$tentang_kami->teks!!}</td>
                                            <td><img src="{{ asset('gambar/gambar_tentang_kami') }}/{{ $tentang_kami->gambar }}" width="100" alt="Tidak Ada Gambar"></td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href = "#" data-toggle="modal" data-target="#editTentangKami-{{ $tentang_kami->id }}" class="btn btn-link btn-primary"
                                                        data-original-title="Edit TentangKami">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="editTentangKami-{{ $tentang_kami->id }}" tabindex="-1" role="dialog"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header no-bd">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{route('UbahTentangKami', $tentang_kami->id )}}" method="POST" enctype="multipart/form-data">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Tentang Kami</label>
                                                                        <textarea name="teks" type="text"
                                                                            class="form-control ckeditor" placeholder="Contoh : Koko Kurta">{!! $tentang_kami->teks !!}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Gambar</label>
                                                                        <input name="gambar" type="file" accept="image/png, image/jpeg" value="{{ $tentang_kami->gambar }}"
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