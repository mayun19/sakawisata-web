<?php 
  namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembatalan extends Model {
  protected $table = 'sakwis_pembatalan';

  protected $primaryKey = 'id_pembatalan';
}