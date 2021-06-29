<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Sewa;

class PenyewaanDitolak extends Mailable
{
    use Queueable, SerializesModels;

    public $sewa;
    protected $pesan;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Sewa $sewa, $pesan)
    {
        //
        $this->sewa = $sewa;
        $this->pesan = $pesan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('MarketplacePenyewaanBarang@RentALL.com')
            ->view('email.penyewaan_ditolak')
            ->with([
                'pesan' => $this->pesan,
            ]);
    }
}
