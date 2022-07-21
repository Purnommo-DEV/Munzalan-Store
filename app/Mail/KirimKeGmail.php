<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KirimKeGmail extends Mailable
{
    use Queueable, SerializesModels;
    public $alamat_pengiriman;
    public $data_produk_dipesan;
    public $data_pesanan;

    public function __construct($alamat_pengiriman, $data_produk_dipesan, $data_pesanan)
    {
        $this->alamat_pengiriman = $alamat_pengiriman;
        $this->data_produk_dipesan = $data_produk_dipesan;
        $this->data_pesanan = $data_pesanan;
    }
    public function build()
    {
        // return $this->view('view.name');
        $from_name = "MunzalanStore";
        $from_email = "munzalanstore@gmail.com";
        $subject = "Terima Kasih Telah Berbelanja di Munzalan Store";
        return $this->from($from_email, $from_name)
            ->view('Frontend.Mails.data_pesanan')
            ->subject($subject);
    }
}
