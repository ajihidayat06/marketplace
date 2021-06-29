<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Sewa;

class PenyewaanSelesai extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $selesai_sewa = Sewa::where('status_id', 7)->get();

        foreach ($selesai_sewa as $item) {
            $tgl_selesai = $item->sewa_tanggal_berakhir;
            // $akhir = strtotime($tgl_selesai . "+34 hours");
            $akhir = strtotime($tgl_selesai . "+10 minutes");
            date_default_timezone_set('Asia/Jakarta');
            $sekarang = strtotime("now");

            if (($sekarang > $akhir) && ($item->status_id == 7)) {
                $item->status_id = 8;
                $item->save();
            }
        }
    }
}
