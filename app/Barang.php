<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    //
    protected $fillable = [
        'barang_nama','barang_deskripsi','barang_harga','barang_jumlah','barang_image','barang_status','kategori_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }

    public function sewa(){
        return $this->hasOne(Sewa::class);
    }
}
