<div class="tab-pane fade show active" id="pills-info-icon" role="tabpanel" aria-labelledby="pills-info-tab-icon">
<div class="row">
    <div class="col-md-4 col-lg-3">
        <div class="form-group">
            <label class="control-label">
                Nama Produk
            </label>
            <p class="form-control-static">{{ $dataProduk->name }}</p>
        </div>
        <div class="form-group">
            <label class="control-label">
                Kategori
            </label>
            <p class="form-control-static">{{ $dataProduk->kategori->name }}</p>
        </div>
        <div class="form-group">
            <label class="control-label">
                Harga
            </label>
            <p class="form-control-static">@currency($dataProduk->harga)</p>
        </div>
        <div class="form-group">
            <label class="control-label">
                Diskon
            </label>
            <p class="form-control-static">{{ $dataProduk->diskon }}%</p>
        </div>
    </div>
    <div class="col-md-6 col-lg-8">
        <div class="form-group">
            <label class="control-label">
                Deskripsi Singkat
            </label>
            <p class="form-control-static">{!!$dataProduk->deskripsi_singkat !!}%</p>
        </div>
        <div class="form-group">
            <label class="control-label">
                Deskripsi Lengkap
            </label>
            <p class="form-control-static">{!! $dataProduk->deskripsi_lengkap !!}%</p>
        </div>
    </div>
</div>
</div>