<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //
    protected $fillable = [
    'status_value'];

    public function sewa(){
        return $this->hasOne(Sewa::class);
    }
}
