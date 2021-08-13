<?php
//deklarasi namespace u/ beritahu letak file controller 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

// panggil model member, maka harus buat file app/Member.php
// use App\Pemesanan;
use App\Pemandu;

class PemanduController extends Controller
{  
   function index () {
      $data["pemandu"] = Pemandu::paginate(9);

      return view('pages.pemandu', $data);
   }

   function detail (Pemandu $pemandu){
      $data['pemandu'] = $pemandu;
      return view("pages.detail_pemandu", $data);
   }

      function detail_tiket (Pemandu $pemandu){
      $data['pemandu'] = $pemandu;
      return view("pages.detail_pemandu_tiket", $data);
   }


}