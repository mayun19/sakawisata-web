<?php 
  namespace App;

use Illuminate\Database\Eloquent\Model;

class Situs extends Model {
  protected $table = 'sakwis_situs';

  public $timestamps = false;
  protected $fillable = ['nama_situs', 'deskripsi_situs', 'foto_situs'];

  protected $primaryKey ='id_situs';
}