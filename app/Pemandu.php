<?php 
  namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemandu extends Model {
  protected $table = 'sakwis_pemandu';

  public $timestamps = false;
  protected $fillable = ['nama_pemandu', 'link_wa_pemandu', 'bahasa_pemandu', 'tahun_gabung_pemandu','foto_pemandu'];
  protected $primaryKey = 'id_pemandu';
}