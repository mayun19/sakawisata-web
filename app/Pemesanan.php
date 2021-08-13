<?php 
  namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model {
  protected $table = 'sakwis_pemesanan';

  protected $primaryKey = 'id_pemesanan';
}