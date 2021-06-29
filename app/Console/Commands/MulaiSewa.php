<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Sewa;

class MulaiSewa extends Command
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
        $mulai_sewa = Sewa::where('status_id', 6)->get();

        foreach ($mulai_sewa as $item) {
            $tgl_mulai = $item->sewa_tanggal_mulai;
            $awal = strtotime($tgl_mulai . "+10 minutes");
            date_default_timezone_set('Asia/Jakarta');
            $sekarang = strtotime("now");

            if (($sekarang > $awal) && ($item->status_id == 6)) {
                $item->status_id = 7;
                $item->save();
            }
        }
    }
}
