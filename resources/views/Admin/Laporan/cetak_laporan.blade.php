<table id="kategoris" class="display table table-striped table-hover text-center" style="font-size: 10%">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Kode Pesanan</th>
            <th>Pelanggan</th>
            <th>Nama Produk</th>
            <th>Kuantitas</th>
            <th>Harga Satuan</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data_pesanan as $data_pesanans)
            <tr>
                <td>{{ Carbon\Carbon::parse($data_pesanans->created_at)->isoFormat('dddd, D MMMM Y, h:mm A') }}</td>
                <td>{{ $data_pesanans->id }}</td>
                <td>{{ $data_pesanans->user->name }}</td>
                <td colspan="1">
                @foreach ($data_pesanan_produk as $data_pesanan_produks)
                    @if ($data_pesanans->id == $data_pesanan_produks->pesanan_id)
                    <hr>                                                        {{ $data_pesanan_produks->nama_produk }} ({{ $data_pesanan_produks->ukuran_produk }})<hr>
                    @endif
                @endforeach
                </td>
                <td colspan="1">
                    @foreach ($data_pesanan_produk as $data_pesanan_produks)
                        @if ($data_pesanans->id == $data_pesanan_produks->pesanan_id)
                        <hr>{{ $data_pesanan_produks->kuantitas }}<hr>
                        @endif
                    @endforeach
                </td>
                <td colspan="1">
                    @foreach ($data_pesanan_produk as $data_pesanan_produks)
                    @php
                        $sub_total = $data_pesanan_produks->harga_produk * $data_pesanan_produks->kuantitas
                    @endphp
                        @if ($data_pesanans->id == $data_pesanan_produks->pesanan_id)
                        <hr>@currency($data_pesanan_produks->harga_produk)<hr>
                        @endif
                    @endforeach
                </td>
                <td colspan="1">
                        @currency($data_pesanans->total_bayar)
                </td>
            </tr>
        @endforeach
    </tbody>
</table>