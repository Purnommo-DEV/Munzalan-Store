<html>
<head>
    <style>
.styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}
.styled-table thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
}
.styled-table th,
.styled-table td {
    padding: 12px 15px;
}
.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}
.styled-table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
}

    </style>
</head>
<body>
    <div class="container">
        <div class="heading">
            {{-- <h1>Funda of Web IT: You a new enquiry from Contact Form</h1> --}}
        </div>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Nama Pelanggan</th>
                    <td style="color: black; background-color: #ffffff">{{ Auth::user()->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td style="color: black; background-color: #ffffff">{{ Auth::user()->email }}</td>
                </tr>
                <tr>
                    <th>Nomor Hp</th>
                    <td style="color: black; background-color: #ffffff">{{ $alamat_pengiriman['nomor_hp'] }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td style="color: black; background-color: #ffffff">{{ $alamat_pengiriman['alamat'] }}</td>
                </tr>
                <tr>
                    <th>Kota</th>
                    <td style="color: black; background-color: #ffffff">{{ $alamat_pengiriman['kota']['name'] }}</td>
                </tr>
                <tr>
                    <th>Provinsi</th>
                    <td style="color: black; background-color: #ffffff">{{ $alamat_pengiriman['provinsi']['name'] }}</td>
                </tr>
            </thead>
        </table>

        <table class="styled-table">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Ukuran</th>
                    <th>Kuantitas</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total_bayar = 0;        
                @endphp
                @foreach ($data_produk_dipesan as $items)
                <tr>
                    <td>{{ $items['nama_produk'] }}</td>
                    <td>{{ $items['ukuran_produk'] }}</td>
                    <td>{{ $items['kuantitas'] }}</td>
                    <td>@currency($items['harga_produk'])</td>
                </tr>
                @php
                    $total_bayar += ($items['harga_produk'] * $items['kuantitas'])
                @endphp
                @endforeach
                @php
                    $total_bayar_keseluruhan = $total_bayar + $data_pesanan['ongkos_kirim']
                @endphp
                <tr><td></td>
                    <td><b>Total</b>
                    <br><p>(Termasuk ongkos kirim)</p></td>
                      <td>@currency($total_bayar_keseluruhan)</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
