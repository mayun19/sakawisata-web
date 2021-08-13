<?php 
  namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model {
  protected $table = 'sakwis_admin';

  protected $primaryKey ='id_admin';

  public $timestamps = false;

  protected $fillable = ['username_admin', 'email_admin', 'foto_admin' ];

  protected $hidden = ['password_admin'];
}