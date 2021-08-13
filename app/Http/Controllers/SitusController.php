<?php
//deklarasi namespace u/ beritahu letak file controller 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

// panggil model member, maka harus buat file app/Member.php
// use App\Pemesanan;
use App\Situs;

class SitusController extends Controller
{  
   function index () {
      $data["situs"] = Situs::all();

      $data['all_situs'] = Situs::paginate(4);

      return view('pages/situs', $data);
   }

   function all_situs(){
      $data['all_situs'] = Situs::paginate(10);

      return view("pages/situs-all", $data);
   }

   function detail(Situs $situs){
      $data['situs'] = $situs;
      $data['foto'] = DB::table('sakwis_situs_foto')->where('id_situs', $situs->id_situs)->get();

      return view("pages/detail_situs", $data);
   }
}