<?php

namespace App\Mail;

use App\Sewa;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KonfirmasiPembayaranDitolak extends Mailable
{
    use Queueable, SerializesModels;

    public $sewa;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Sewa $sewa)
    {
        //
        $this->sewa = $sewa;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('MarketplacePenyewaanBarang@RentALL.com')
            ->view('email.konfirmasi_pembayaran_ditolak');
    }
}
