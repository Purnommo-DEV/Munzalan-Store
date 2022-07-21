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
                            <div class="table-responsive">
                                <table id="kategoris" class="display table table-striped table-hover text-center" >
                                    <thead>
                                        <tr>
                                            <th>Nama Pelanggan</th>
                                            <th>Email</th>
                                            <th>Alamat</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $online_user = 0;
                                        @endphp
                                        @foreach ($alamat_pengguna as $alamat_penggunas)
                                            <tr>
                                                <td>{{$alamat_penggunas->user->name}}</td>
                                                <td>{{$alamat_penggunas->user->email}}</td>
                                                <td>{{$alamat_penggunas->alamat}}, {{$alamat_penggunas->kota->name}}, {{$alamat_penggunas->provinsi->name}}</td>

                                                <td>
                                                @if(Cache::has('user-is-online' . $alamat_penggunas->id))
                                                    <span class="py-2 px-2 badge-success">Aktif</span>
                                                @else
                                                <div class="btn-toolbar mb-3 justify-content-center">
                                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                                      <button type="button" class="btn btn-danger">Tidak Aktif</button>
                                                      <button type="button" >Aktif {{Carbon\Carbon::parse($alamat_penggunas->user->terakhir_dilihat)->diffForHumans()}}</button>
                                                    </div>
                                                  </div>
                                                  
                                                  {{-- <div class="btn-toolbar justify-content-center">
                                                    <div class="btn-group" role="group" aria-label="First group">
                                                      <button type="button" style="background-color: transparent; color:black">{{Carbon\Carbon::parse($alamat_penggunas->user->terakhir_dilihat)->diffForHumans()}}</button>
                                                    </div>
                                                  </div> --}}
                                                @endif
                                                </td>
                                                <td><a href="{{ route('AdminHalamanDetailPengguna',$alamat_penggunas->user_id ) }}" class="btn btn-sm btn-primary">Detail</a></td>
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