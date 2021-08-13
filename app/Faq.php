<?php 
  namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model {
  protected $table = 'sakwis_faq';

  public $timestamps = false;
  protected $fillable = ['pertanyaan', 'jawaban'];

  protected $primaryKey = 'id_faq';


}