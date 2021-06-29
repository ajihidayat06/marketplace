<?php

namespace App\Console;

use App\Console\Commands\KonfirmasiBayar;
use App\Console\Commands\MulaiSewa;
use App\Console\Commands\PenyewaanSelesai;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Storage;
use App\Sewa;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->call(function () {
        //     Storage::append('MAHASISWA.txt', 'Habib');
        // });
        $schedule->call(function () {
            $sewa = Sewa::where('status_id', 1)->get();
            foreach ($sewa as $item) {
                $batas = $item->created_at;
                $batas_akhir = strtotime($batas . "+10 minutes");
                date_default_timezone_set('Asia/Jakarta');
                $sekarang = strtotime("now");

                if (($sekarang > $batas_akhir) && ($item->status_id == 1)) {
                    $item->status_id = 9;
                    $item->save();
                }
            }

            $mulai_sewa = Sewa::where('status_id', 6)->get();

            foreach ($mulai_sewa as $item) {
                $tgl_mulai = $item->sewa_tanggal_mulai;
                //+10 hours
                $awal = strtotime($tgl_mulai . "+10 hours");
                date_default_timezone_set('Asia/Jakarta');
                $sekarang = strtotime("now");

                if (($sekarang > $awal) && ($item->status_id == 6)) {
                    $item->status_id = 7;
                    $item->konfirmasi_penerimaan_barang = true;
                    $item->save();
                }
            }

            $selesai_sewa = Sewa::where('status_id', 7)->get();

            foreach ($selesai_sewa as $item) {
                $tgl_selesai = $item->sewa_tanggal_berakhir;
                // $akhir = strtotime($tgl_selesai . "+34 hours");
                $akhir = strtotime($tgl_selesai . "+34 hours");
                date_default_timezone_set('Asia/Jakarta');
                $sekarang = strtotime("now");

                if (($sekarang > $akhir) && ($item->status_id == 7)) {
                    $item->status_id = 8;
                    $item->konfirmasi_pengembalian_barang = true;
                    $item->save();
                }
            }
        });

        // $schedule->command(KonfirmasiBayar::class);
        // $schedule->command(MulaiSewa::class);
        // $schedule->command(PenyewaanSelesai::class);
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
