@extends('Admin.Layouts.master')
@section('content')
	<div class="content">
		<div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
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
                                <table id="pesanan" class="display table table-striped table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th>Kode Pesanan</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Alamat</th>
                                            <th>Total Belanja</th>
                                            <th>Metode Pembayaran</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pesananPelanggan as $pesananPelanggans)
                                            <tr>
                                                <td>{{$pesananPelanggans->id}}</td>
                                                <td>{{$pesananPelanggans->user->name}}</td>
                                                <td>{{$pesananPelanggans->alamat->alamat}}, {{$pesananPelanggans->alamat->kota->name}}, {{$pesananPelanggans->alamat->kode_pos}}, {{$pesananPelanggans->alamat->provinsi->name}}, {{$pesananPelanggans->negara}}</td>
                                                <td>@currency($pesananPelanggans->total_bayar)</td>
                                                <td>{{$pesananPelanggans->metode_pembayaran}}</td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="{{ route('AdminHalamanDetailPesanan', $pesananPelanggans->id) }}" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Detail Pesanan">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
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