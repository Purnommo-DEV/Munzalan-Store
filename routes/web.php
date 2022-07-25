<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\WebcamController;
use App\Http\Controllers\Admin\IklanController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PesananController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\FrontEnd\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\FrontEnd\BelanjaController;
use App\Http\Controllers\FrontEnd\BerandaController;
use App\Http\Controllers\FrontEnd\PenggunaController;
use App\Http\Controllers\FrontEnd\RegisterController;
use App\Http\Controllers\Admin\DataPenggunaController;
use App\Http\Controllers\FrontEnd\KeranjangController;
use App\Http\Controllers\FrontEnd\PemeriksaanController;
use App\Http\Controllers\Admin\PesananLangsungController;
use App\Http\Controllers\Admin\TentangKamiController;
use App\Http\Controllers\FrontEnd\DetailProdukController;
use App\Http\Controllers\FrontEnd\ProdukFavoritController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['auth', 'hakAkses:ADMIN'])->group(function () {
    Route::get('/dashboard',                    [DashboardController::class, 'admin_halaman_dashboard'])->name('AdminDashboard');
    Route::get('/produk',                       [ProdukController::class, 'admin_halaman_produk'])->name('AdminProduk');
    Route::get('/halamanTambahProduk',          [ProdukController::class, 'admin_halaman_tambah_produk'])->name('HalamanTambahProduk');
    Route::post('/tambahProduk',                [ProdukController::class, 'admin_tambah_produk'])->name('TambahProduk');
    Route::get('/halamanUbahProduk/{id}',       [ProdukController::class, 'admin_halaman_ubah_produk'])->name('HalamanUbahProduk');
    Route::post('/ubahProduk/{id}',             [ProdukController::class, 'admin_ubah_produk'])->name('UbahProduk');
    Route::get('/detailProduk/{id}',            [ProdukController::class, 'admin_detail_produk'])->name('AdminHalamanDetailProduk');
    Route::post('/tambahUkuranProduk',          [ProdukController::class, 'admin_tambah_ukuran_produk'])->name('tambahUkuranProduk');
    Route::post('/ubahUkuranProduk/{id}',       [ProdukController::class, 'admin_ubah_ukuran_produk'])->name('ubahUkuranProduk');
    Route::get('/hapusUkuranProduk/{id}',       [ProdukController::class, 'admin_hapus_ukuran_produk'])->name('AdminHapusUkuranProduk');
    Route::get('/hapusProduk/{id}',             [ProdukController::class, 'admin_hapus_produk'])->name('AdminHapusProduk');
    Route::get('/pesananPelanggan',             [PesananController::class, 'admin_halaman_pesanan'])->name('AdminHalamanPesanan');
    Route::get('/detailPesananPelanggan/{id}',  [PesananController::class, 'admin_halaman_detail_pesanan'])->name('AdminHalamanDetailPesanan');
    Route::get('/kategori',                     [KategoriController::class, 'admin_halaman_kategori'])->name('HalamanKategori');
    Route::post('/tambahKategori',              [KategoriController::class, 'admin_tambah_kategori'])->name('TambahKategori');
    Route::post('/ubahKategori/{id}',           [KategoriController::class, 'admin_ubah_kategori'])->name('ubahKategori');
    Route::get('/hapusKategori/{id}',           [KategoriController::class, 'admin_hapus_kategori'])->name('HapusKategori');
    Route::post('/statusPesananLogs',           [PesananController::class, 'admin_status_pesanan_logs'])->name('StatusPesananLogs');
    Route::post('/verifikasiPembayaran',        [PesananController::class, 'admin_verifikasi_pembayaran'])->name('VerifikasiPembayaran');
    
    //PENGGUNA
    Route::get('/pengguna',                     [DataPenggunaController::class, 'admin_halaman_pengguna'])->name('AdminHalamanPengguna');
    Route::get('/detailPengguna/{id}',          [DataPenggunaController::class, 'admin_halaman_detail_pengguna'])->name('AdminHalamanDetailPengguna');

    // PESANAN LANGSUNG
    Route::get('/pesanLangsung',                [PesananLangsungController::class, 'admin_pesan_langsung'])->name('AdminPesananLangsung');
    Route::post('/masukKeranjang',              [PesananLangsungController::class, 'admin_masuk_keranjang'])->name('AdminMasukkanKeranjang');
    Route::post('/buatPesanan',                 [PesananLangsungController::class, 'admin_buat_pesanan'])->name('AdminBuatPesanan');
    Route::post('/konfirmasiPembayaran',        [PesananLangsungController::class, 'admin_konfirmasi_pembayaran'])->name('AdminKonfirmasiPembayaran');
    Route::get('/atribut/{id}',                 [PesananLangsungController::class, 'getAtribut']);

    // LAPORAN
    Route::get('/laporanPenjualan',             [LaporanController::class, 'admin_laporan_penjualan'])->name('AdminLaporanPenjualan');
    Route::get('/cetakLaporanPenjualan/{tglawal}/{tglakhir}',             [LaporanController::class, 'admin_cetak_laporan_penjualan'])->name('cetakLaporanPenjualan');

    //Slide
    Route::get('/pengaturanSlide',              [SliderController::class, 'admin_slide'])->name('AdminSlide');
    Route::post('/tambahSlide',                 [SliderController::class, 'admin_tambah_slide'])->name('AdminTambahSlide');
    Route::post('/ubahSlide/{id}',              [SliderController::class, 'admin_ubah_slide'])->name('ubahSlide');
    Route::get('/hapusSlide/{id}',              [SliderController::class, 'admin_hapus_slide'])->name('hapusSlide');

    //Iklan
    Route::get('/pengaturanIklan',              [IklanController::class, 'admin_iklan'])->name('AdminIklan');
    Route::post('/tambahIklan',                 [IklanController::class, 'admin_tambah_iklan'])->name('TambahIklan');
    Route::post('/ubahIklan/{id}',              [IklanController::class, 'admin_ubah_iklan'])->name('ubahIklan');
    Route::get('/hapusIklan/{id}',              [IklanController::class, 'admin_hapus_iklan'])->name('hapusIklan');
    
    //TENTANG KAMI
    Route::get('/tentangKami',                  [TentangKamiController::class, 'admin_tentang_kami']);
    Route::post('/tambahTentangKami',           [TentangKamiController::class, 'admin_tambah_tentang_kami'])->name('TambahTentangKami');
    Route::put('/ubahTentangKami/{id}',         [TentangKamiController::class, 'admin_ubah_tentang_kami'])->name('UbahTentangKami');
});

    // UMUM
    Route::get('/belanja',               [BelanjaController::class, 'halaman_belanja'])->name('HalamanBelanja');
    Route::get('/belanjaFilter',         [BelanjaController::class, 'filter_produk'])->name('HalamanBelanjaFilter');
    Route::get('/filterKategori',        [BelanjaController::class, 'filter_kategori'])->name('HalamanBelanjaFilterKategori');
    Route::get('/',                      [BerandaController::class, 'halaman_beranda'])->name('HalamanBeranda');
    Route::get('/detail_produk/{slug}',  [DetailProdukController::class, 'halaman_detail_produk'])->name('HalamanDetailProduk');
    Route::get('/frontTentangKami',      [TentangKamiController::class, 'front_tentang_kami'])->name('FrontTentangKami');
    Route::post('/cekLogin',             [LoginController::class, 'ceklogin'])->name('cekLogin');
    Route::post('/userLogout',           [LoginController::class, 'user_logout'])->name('UserLogOut');
    Route::get('/login',                 [LoginController::class, 'halaman_login'])->name('HalamanLogin');
    Route::get('/register',              [RegisterController::class, 'halaman_register'])->name('HalamanRegister');
    Route::post('/simpanUser',           [RegisterController::class, 'tambah_user'])->name('TambahUser');
    Route::get('/kota/{provinsi_id}',    [PemeriksaanController::class, 'getCities']);
    Route::post('/periksa',              [PemeriksaanController::class, 'periksa_belanjaan'])->name('periksaBelanjaan');
    Route::post('/tampilProdukHarga',             [DetailProdukController::class, 'tampilProdukHarga']);
    Route::post('/tampilProdukStok',              [DetailProdukController::class, 'tampilProdukStok']);
    Route::post('/tampilBerat',                   [DetailProdukController::class, 'tampilBerat']);

Route::middleware(['auth', 'hakAkses:USER'])->group(function () {
    // PROFIL PENGGUNA
    Route::get('/profileUser',                    [PenggunaController::class, 'halaman_profile'])->name('HalamanProfile');
    Route::post('/konfirmasiTerima',              [PenggunaController::class, 'konfirmasi_terima_pesanan'])->name('KonfirmasiTerimaPesanan');
    Route::post('/penilaian',                     [PenggunaController::class, 'pemberian_penilaian'])->name('Penilaian');
    Route::put('/ubahDataPelanggan/{id}',         [PenggunaController::class, 'ubah_data_pelanggan'])->name('UbahDataPelanggan');

    // HALAMAN UTAMA
    Route::get('/totalProdukFavorit',             [BerandaController::class, 'total_produk_favorit']);
    Route::post('/tambahKeProdukFavorit',         [BerandaController::class, 'tambah_ke_produk_favorit']);

    // DETAIL PRODUK
    Route::post('/tambahKeKeranjang',             [DetailProdukController::class, 'tambah_ke_keranjang'])->name('TambahKeKeranjang');

    // PRODUK FAVORIT
    Route::post('/deleteProdukFavorit',           [ProdukFavoritController::class, 'delete_produk_favorit']);
    Route::get('/produkFavorit',                  [ProdukFavoritController::class, 'produk_favorit'])->name('HalamanProdukFavorit');
    Route::get('/mengurutkanProdukFavorit',       [ProdukFavoritController::class, 'urutkan_produk_favorit'])->name('UrutkanProdukFavorit');

    // KERANJANG BELANJA
    Route::post('/updateKuantitasKeranjang',      [KeranjangController::class, 'update_kuantitas_barang_keranjang']);
    Route::post('/deleteBarangKeranjang',         [KeranjangController::class, 'delete_barang_keranjang']);
    Route::get('/keranjang',                      [KeranjangController::class, 'halaman_keranjang'])->name('HalamanKeranjang');

    // PEMERIKSAAN
    Route::post('/tambahAlamat',                  [PemeriksaanController::class, 'simpan_alamat'])->name('tambahAlamat');
    Route::get('/ubahAlamat/{id}',                [PemeriksaanController::class, 'ubah_alamat']);
    Route::put('/perbaruiAlamat/{id}',            [PemeriksaanController::class, 'alamat_baru'])->name('perbaruiAlamat');
    Route::get('/hapusAlamat/{id}',               [PemeriksaanController::class, 'hapus_alamat']);
    Route::get('/pemeriksaan',                    [PemeriksaanController::class, 'halaman_pemeriksaan'])->name('HalamanPemeriksaan');
});
// Route::get('webcam', [WebcamController::class, 'index']);
// Route::post('webcam', [WebcamController::class, 'store'])->name('webcam.capture');
