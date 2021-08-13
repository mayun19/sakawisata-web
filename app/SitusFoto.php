<?php 
  namespace App;

use Illuminate\Database\Eloquent\Model;

class SitusFoto extends Model {
  protected $table = 'sakwis_situs_foto';

  public $timestamps = false;
  protected $fillable = ['id_situs', 'situs_foto'];

  protected $primaryKey ='id_situs_foto';
}