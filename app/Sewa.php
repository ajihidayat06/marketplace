<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sewa extends Model
{
    //
    protected $fillable = [
        'sewa_total','sewa_tanggal_mulai','sewa_tanggal_berakhir','sewa_kode_booking','konfirmasi_penerimaan_barang',
        'konfirmasi_pengembalian_barang'
    ];

    public function konfirmasi_pembayaran(){
        return $this->hasOne(konfirmasi_pembayaran::class);
    }

    public function barang(){
        return $this->belongsTo(Barang::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function pemilik(){
        return $this->belongsTo(User::class, 'pemilik_id', 'id');
    }
}
