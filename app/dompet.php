<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dompet extends Model
{
    protected $primaryKey = 'id';
    protected $hidden = ['pivot','updated_at','created_at'];
    protected $fillable = [
        'nama','referensi','deskripsi','status_id'
    ];

    public function transaksi(){
        return $this->hasMany('App\transaksi','id', 'dompet_id');
    }
}
