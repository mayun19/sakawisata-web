<?php 
  namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model {
  protected $table = 'sakwis_member';

  protected $primaryKey ='id_member';

  public $timestamps = false;

  protected $fillable = ['nama_member', 'email_member', 'username_member','password_member', 'alamat_member', 'kode_member', 'status_member', 'telp_member', 'foto_member'];

  protected $hidden = ['password_member'];
}