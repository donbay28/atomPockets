<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
  protected $primaryKey = 'id';
  protected $hidden = ['pivot','updated_at','created_at'];
  protected $fillable = [
      'nama','deskripsi','status_id'
  ];

  public function transaksi(){
    return $this->hasMany('App\transaksi','id', 'kategori_id');
    }
}
