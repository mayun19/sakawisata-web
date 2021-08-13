<?php 
  namespace App;

use Illuminate\Database\Eloquent\Model;

class Paket extends Model {
  protected $table = 'sakwis_paket';

  public $timestamps = false;
  protected $fillable = ['nama_paket', 'harga_paket', 'kapasitas_min_paket', 'kapasitas_max_paket', 'deskripsi_paket', 'foto_paket'];

  protected $primaryKey ='id_paket';

  public function sesi() {
    return $this->belongsToMany('App\Sesi', 'sakwis_paket_sesi',  'id_paket', 'id_sesi');
  }
}