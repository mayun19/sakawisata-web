<?php
//deklarasi namespace u/ beritahu letak file controller 
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request; 

// panggil model member, maka harus buat file app/Member.php
// use App\Pemesanan;
use App\Faq;

class FaqController extends Controller
{  
  function index () {
    $data["faq"] = Faq::all();

    return view('pages.faq', $data);
  }

}