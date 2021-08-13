<?php 
  namespace App;

use Illuminate\Database\Eloquent\Model;

class Partners extends Model {
  protected $table = 'sakwis_partners';

  public $timestamps = false;
  protected $fillable = ['nama_partner', 'link_partner', 'foto_partner'];

  protected $primaryKey ='id_partner';
}