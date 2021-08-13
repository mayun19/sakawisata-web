<?php 
  namespace App;

use Illuminate\Database\Eloquent\Model;

class BukuTamu extends Model {
  protected $table = 'sakwis_bukutamu';

  public $timestamps = false;
  protected $fillable = ['kode_kunjungan', 'nama_tamu', 'nik_tamu', 'telp_tamu', 'email_tamu', 'telp_tamu', 'instagram', 'asal_tamu', 'pesan_tamu'];

  protected $primaryKey ='id_bukutamu';
}