<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Kota;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\Provinsi;
use App\Models\Keranjang;
use App\Mail\KirimKeGmail;
use App\Models\GambarProduk;
use Illuminate\Http\Request;
use App\Models\PesananProduk;
use App\Models\ProdukAtribut;
use App\Models\AlamatPengiriman;
use App\Models\TransferPembayaran;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class PemeriksaanController extends Controller
{
    public function halaman_pemeriksaan(){
        $penggunaKeranjangItem = Keranjang::penggunaKeranjangItem();
        $provinsi = Provinsi::pluck('name', 'id');
        $tampil_alamat = AlamatPengiriman::alamatPengguna();
        $penggunaKeranjangItem = Keranjang::penggunaKeranjangItem();
        $gambar_produk = GambarProduk::get();
        $hitungDataKeranjang = Keranjang::penggunaKeranjangItem()->count();

        $id_kota_user = AlamatPengiriman::where('user_id', Auth::user()->id)->first();
        //Hitung Berat Pesanan
        $total_berat = 0;
        $data_berat = Keranjang::where('user_id', Auth::user()->id)->get();
        foreach($data_berat as $data){
            $total_berat += $data->berat * $data->kuantitas;    
        }
        // $berat = 444;

        $response = Http::withHeaders([
            'key' => 'aab53dc144442c9f6ce1e0ce902c84e2'
            ])->post('https://api.rajaongkir.com/starter/cost', [
                'origin'        => 364, // ID kota/kabupaten asal PONTIANAK
                'destination'   => $id_kota_user->kota_id, // ID kota/kabupaten tujuan
                'weight'        => $total_berat, // berat barang dalam gram
                'courier'       => 'jne'// kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
            ]);

        $cek_ongkir = $response['rajaongkir']['results'][0]['costs'];
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Result Cost Ongkir',
        //     'data'    => $cek_ongkir
        // ]);
       
            
        return view('Frontend.Pemeriksaan.pemeriksaan', compact('penggunaKeranjangItem', 'tampil_alamat', 'gambar_produk', 
        'hitungDataKeranjang', 'provinsi', 'cek_ongkir'));
    }

    public function getCities($id)
    {
        $kota = Kota::where('provinsi_id', $id)->pluck('name', 'id');
        return response()->json($kota);
    }

    public function check_ongkir(Request $request)
    {
        $id_kota_user = AlamatPengiriman::where('user_id', Auth::user()->id)->pluck('kota_id');
        $id_provinsi_user = AlamatPengiriman::where('user_id', Auth::user()->id)->pluck('provinsi_id');
        $id_kota_asal_admin = 364;

        //Hitung Berat Pesanan
        $berat = 0;
        $hitung_berat = Keranjang::where('user_id', Auth::user()->id)->get();
        foreach($hitung_berat as $hitung){
            $berat += $hitung->berat * $hitung->kuantitas;    
        }

        $cost = RajaOngkir::ongkosKirim([
            'origin'        => $id_kota_asal_admin, // ID kota/kabupaten asal
            'destination'   => $id_kota_user, // ID kota/kabupaten tujuan
            'weight'        => $berat, // berat barang dalam gram
            'courier'       => 'jne' // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();

        dd($cost);

        return response()->json($cost);
    }

    public function simpan_alamat(Request $request){

        $alamat_baru = new AlamatPengiriman;
        $alamat_baru->user_id = Auth::user()->id;
        $alamat_baru->name = $request->name;
        $alamat_baru->alamat = $request->alamat;
        $alamat_baru->email = $request->email;
        $alamat_baru->negara = $request->negara;
        $alamat_baru->provinsi_id = $request->provinsi_id;
        $alamat_baru->kota_id = $request->kota_id;
        $alamat_baru->kode_pos = $request->kode_pos;
        $alamat_baru->nomor_hp = $request->nomor_hp;
        $alamat_baru->save();

        toast('Berhasil Menambahkan Alamat','success');
        return redirect()->back()->with('success');
    }

    public function ubah_alamat($id)
    {
        $ubahAlamat = AlamatPengiriman::find($id);
        return response()->json([
            'data' => $ubahAlamat,
        ]);
    }

    public function alamat_baru(Request $request)
    {
        $alamat_id = $request->input('id');
        $alamatBaru = AlamatPengiriman::find($alamat_id);
        $alamatBaru->name = $request->name;
        $alamatBaru->alamat = $request->alamat;
        $alamatBaru->email = $request->email;
        $alamatBaru->negara = $request->negara;
        $alamatBaru->provinsi_id = $request->provinsi_id;
        $alamatBaru->kota_id = $request->kota_id;
        $alamatBaru->kode_pos = $request->kode_pos;
        $alamatBaru->nomor_hp = $request->nomor_hp;
        $alamatBaru->save();

        toast('Berhasil Memperbarui Alamat','success');
        return redirect()->back()->with('success');
    }

    public function hapus_alamat($id)
    {
        $data_alamat = AlamatPengiriman::find($id);
        $data_alamat->delete();

        toast('Berhasil Menghapus Alamat','success');
        return redirect()->back()->with('success');
    }

    public function periksa_belanjaan(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // dd($data);
            // echo Session::get('total_keseluruhan');
            
            if(empty($data['alamat_id'])){
                $message = "Tolong Pilih Alamat";
                session::flash('error_message', $message);
                return redirect()->back();
            }
            if(empty($data['metode_pembayaran'])){
                $message = "Tolong Pilih Metode Pembayaran";
                session::flash('error_message', $message);
                return redirect()->back();
            }
            // print_r($data); die;
            // if($data['metode_pembayaran'] == "TF"){
            //     $metode_pembayaran = "TF";
            // }else{
            //     $metode_pembayaran = "COD";
            // }

            // Masukkan ke Tabel Pesanan
            $pesanan = new Pesanan();
            $pesanan->user_id           = Auth::user()->id;
            $pesanan->alamat_id         = $data['alamat_id'];
            $pesanan->total_berat       = $data['total_berat'];
            $pesanan->total_bayar       = $data['total_bayar'];
            $pesanan->metode_pembayaran = $data['metode_pembayaran'];
            $pesanan->ongkos_kirim      = $data['ongkos_kirim'];
            $pesanan->pengiriman        = $data['pengiriman'];
            $pesanan->resi              = 0;
            $pesanan->status_pesanan    = "Menunggu Verifikasi";
            $pesanan->save();

            $pesanan_id = DB::getPdo()->lastInsertId();

            $isiKeranjang = Keranjang::where('user_id', Auth::user()->id)->get()->toArray();
            foreach ($isiKeranjang as $key=>$item){

                $detailProdukKeranjang = new PesananProduk;
                $detailProdukKeranjang->pesanan_id = $pesanan_id;
                $detailProdukKeranjang->user_id = Auth::user()->id;
                
                $tampilDetailProduk = Produk::select('name')->where('id',$item['produk_id'])->first()->toArray();
                $detailProdukKeranjang->produk_id = $item['produk_id'];
                $detailProdukKeranjang->nama_produk = $tampilDetailProduk['name'];
                $detailProdukKeranjang->ukuran_produk = $item['ukuran'];

                if(Produk::tampilDiskon($item['produk_id'])){
                    $tampilDiskon = Produk::tampilDiskon($item['produk_id']);
                }else{
                    $tampilDiskon = $item['harga'];
                }

                $detailProdukKeranjang->harga_produk = $tampilDiskon;
                $detailProdukKeranjang->kuantitas = $item['kuantitas'];
                $detailProdukKeranjang->save();

                $produkAtribut = ProdukAtribut::where('produk_id', $item['produk_id'])->where('ukuran', $item['ukuran'])->first();
                $produkAtribut['stok'] = $produkAtribut['stok'] - $item['kuantitas'];
                $produkAtribut->update();
            }


            $transfer_pembayaran = new TransferPembayaran();
            $transfer_pembayaran->pesanan_id = $pesanan_id;
            $transfer_pembayaran->user_id = Auth::user()->id;
            $transfer_pembayaran->asal_bank = $request->asal_bank;
            $transfer_pembayaran->nama_pengirim = $request->nama_pengirim;
            $transfer_pembayaran->nomor_rekening = $request->nomor_rekening;
            $transfer_pembayaran->status_bayar = "Sudah Bayar";
            $transfer_pembayaran->status_verifikasi = "Belum Di Verifikasi";

            
            if ($request->hasFile('bukti_bayar')) {
                $file = $request->file('bukti_bayar');
                $ekstensi = $file->getClientOriginalExtension();
                $filename = time(). '_' .'UID_'.Auth::user()->id .'_'.'PID_'.$pesanan_id.'.'.$ekstensi;
                $file->move('member/bukti_bayar', $filename);
                $transfer_pembayaran->bukti_bayar = $filename;
            }

            $transfer_pembayaran->save();

            // Kirim ke Gmail
            $alamat_pengiriman = AlamatPengiriman::where('user_id', Auth::user()->id)->with('kota','provinsi')->first()->toArray();
            // dd($alamat_pengiriman);
            $data_produk_dipesan = PesananProduk::where('pesanan_id', $pesanan_id)->get()->toArray();
            $data_pesanan = Pesanan::where('id', $pesanan_id)->first()->toArray();
            Mail::to(Auth::user()->email)->send(new KirimKeGmail($alamat_pengiriman, $data_produk_dipesan, $data_pesanan));

            $dataKeranjang = Keranjang::where('user_id', Auth::user()->id)->get();
            Keranjang::destroy($dataKeranjang);


        }
            Alert::success('Sukses','Berhasil Melakukan Pemesanan Produk');
            return redirect()->route('HalamanProfile')->with('success');
    }
}
