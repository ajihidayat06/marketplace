<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    //
    protected $fillable = [
        'kategori_nama','kategori_status'
    ];

    public function barang(){
        return $this->hasMany(Barang::class);
    }
}
