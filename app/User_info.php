<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_info extends Model
{
    protected $fillable = [
        'user_telp', 'user_bank','user_rek','user_KTP','user_telp','user_foto_ktp','user_image','user_alamat','user_provinsi',
        'user_kecamatan','user_kelurahan','user_nama_rek','user_nama_lengkap',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
