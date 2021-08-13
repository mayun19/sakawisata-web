<?php 
  namespace App;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model {
  protected $table = 'sakwis_fasilitas';

  public $timestamps = false;
  protected $fillable = ['nama_fasilitas', 'icon_fasilitas'];

  protected $primaryKey ='id_fasilitas';
}