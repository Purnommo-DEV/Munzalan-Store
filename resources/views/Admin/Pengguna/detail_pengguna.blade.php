@extends('Admin.Layouts.master')
@section('content')
	<div class="content">
		<div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                            </div>
                        </div>
                        <div class="card-body">
                          <div class="row gutters-sm">
                            <div class="col-md-4 mb-3">
                              <div class="card">
                                <div class="card-body">
                                  <div class="d-flex flex-column align-items-center text-center">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                                    <div class="mt-3">
                                      <h4>{{$detail_pengguna->user->name}}</h4>
                                      <p class="text-secondary mb-1">Pelanggan</p>
                                      @if(Cache::has('user-is-online' . $detail_pengguna->id))
                                      <span class="py-2 px-2 badge-success">Aktif</span>
                                  @else
                                  <div class="btn-toolbar mb-3 justify-content-center">
                                      <div class="btn-group mr-2" role="group" aria-label="First group">
                                        <button type="button" class="btn btn-danger">Tidak Aktif</button>
                                        <button type="button" >Aktif {{Carbon\Carbon::parse($detail_pengguna->user->terakhir_dilihat)->diffForHumans()}}</button>
                                      </div>
                                    </div>
                                  @endif
                                </div>
                                  </div>
                                </div>
                              </div>
                              <div class="card mt-3">
                              </div>
                            </div>
                            <div class="col-md-8">
                              <div class="card mb-3">
                                <div class="card-body">
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <h6 class="mb-0">Nama Pelanggan</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                      {{$detail_pengguna->user->name}}
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                      {{$detail_pengguna->user->email}}
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <h6 class="mb-0">Phone</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                      {{$detail_pengguna->nomor_hp}}
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <h6 class="mb-0">Alamat</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                      {{$detail_pengguna->alamat}}
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <h6 class="mb-0">Kota</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                      {{$detail_pengguna->kota->name}}
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <h6 class="mb-0">Provinsi</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                      {{$detail_pengguna->provinsi->name}}
                                    </div>
                                  </div>
                                  <hr>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection