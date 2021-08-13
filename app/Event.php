<?php 
  namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model {
  protected $table = 'sakwis_event';

  protected $primaryKey ='id_event';

  public $timestamps = false;

  protected $fillable = ['nama_event', 'author_event', 'foto_event', 'tgl_mulai_event', 'tgl_selesai_event', 'jam_event', 'deskripsi_event', 'twitter_event', 'wa_event', 'fb_event'];
}