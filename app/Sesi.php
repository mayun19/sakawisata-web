<?php 
  namespace App;

use Illuminate\Database\Eloquent\Model;

class Sesi extends Model {
  protected $table = 'sakwis_sesi';

  public $timestamps = false;
  protected $fillable = ['nama_sesi'];

  protected $primaryKey ='id_sesi';
}