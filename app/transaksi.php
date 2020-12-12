<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    protected $primaryKey = 'id';
    protected $hidden = ['pivot','updated_at','created_at'];
    protected $fillable = [
        'code','tanggal','nilai','dompet_id','kategori_id','status_id','deskripsi'
    ];

    public function dompet(){
        return $this->belongsTo('App\dompet','dompet_id', 'id');
    }

    public function kategori(){
        return $this->belongsTo('App\kategori','kategori_id', 'id');
    }
}
