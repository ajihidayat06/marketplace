<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Sewa;

class KonfirmasiBayar extends Command
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
        $sewa = Sewa::where('status_id', 1)->get();
        foreach ($sewa as $item) {
            $batas = $item->created_at;
            $batas_akhir = strtotime($batas . "+2 minutes");
            date_default_timezone_set('Asia/Jakarta');
            $sekarang = strtotime("now");

            if (($sekarang > $batas_akhir) && ($item->status_id == 1)) {
                $item->status_id = 9;
                $item->save();
            }
        }
    }
}
