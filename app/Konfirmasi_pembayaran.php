<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konfirmasi_pembayaran extends Model
{
    //
    protected $fillable = [
        'konfirmasi_pembayaran_nama','konfirmasi_pembayaran_jumlah','konfirmasi_pembayaran_foto','konfirmasi_pembayaran_value'
    ];

    public function sewa(){
        return $this->belongsTo(Sewa::class);
    }
}
