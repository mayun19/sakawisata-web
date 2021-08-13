<?php 
  namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model {
  protected $table = 'sakwis_pengaturan';

  public $timestamps = false;
  protected $fillable = ['nama_pengaturan', 'isi_pengaturan'];

  protected $primaryKey ='id_pengaturan';
}