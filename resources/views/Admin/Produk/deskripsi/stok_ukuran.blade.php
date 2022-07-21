<div class="tab-pane fade" id="pills-stokUkuran-icon" role="tabpanel" aria-labelledby="pills-stokUkuran-tab-icon">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#tambahUkuran">
                        <i class="fa fa-plus"></i>
                        Tambah Atribut
                    </button>
                    <div class="modal fade" id="tambahUkuran" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header no-bd">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('tambahUkuranProduk')}}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Ukuran</label>
                                                    <input name="produk_id" value="{{ $dataProduk->id }}" type="hidden"
                                                        hidden>
                                                    <input name="ukuran" type="text" class="form-control"
                                                        placeholder="Contoh : XL">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-group-default">
                                                    <label>Berat(g)</label>
                                                    <input name="berat" type="text" class="form-control"
                                                        placeholder="Contoh : 100">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-group-default">
                                                    <label>Stok</label>
                                                    <input name="stok" type="text" class="form-control"
                                                        placeholder="Contoh : 10">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer no-bd">
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="add-row" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Ukuran</th>
                            <th>Berat(g)</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ukuranStokProduk as $item)
                        @if ($dataProduk->id == $item->produk_id)
                        <tr>
                            <td>{{ $item->ukuran }}</td>
                            <td>{{ $item->berat }}</td>
                            <td>{{ $item->stok }}</td>
                            <td>
                                <div class="form-button-action">

                                    <a href="#" data-toggle="modal" data-target="#editUkuran-{{ $item->id }}"
                                        class="btn btn-link btn-primary" data-original-title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="#" ukuran-id="{{ $item->id }}" class="btn btn-link btn-danger hapusUkuran"
                                        data-original-title="Remove">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endif
                        <div class="modal fade" id="editUkuran-{{ $item->id }}" tabindex="-1" role="dialog"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header no-bd">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{route('ubahUkuranProduk', $item->id )}}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Ukuran</label>
                                                        <input name="ukuran" value="{{ $item->ukuran }}" type="text"
                                                            class="form-control" placeholder="Contoh : XL">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Berat(g)</label>
                                                        <input name="berat" type="text" value="{{ $item->berat }}"
                                                            class="form-control" placeholder="Contoh : 1000">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Stok</label>
                                                        <input name="stok" type="text" value="{{ $item->stok }}"
                                                            class="form-control" placeholder="Contoh : 10">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer no-bd">
                                            <button type="submit" class="btn btn-primary">Tambah</button>
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
