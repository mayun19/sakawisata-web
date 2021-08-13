<?php
//deklarasi namespace u/ beritahu letak file controller 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

// panggil model member, maka harus buat file app/Member.php
// use App\Pemesanan;

class TentangController extends Controller
{
   function index () {
      
      return view('pages.tentang');
   }
}