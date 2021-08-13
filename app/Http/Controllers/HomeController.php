<?php
//deklarasi namespace u/ beritahu letak file controller 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

// panggil model member, maka harus buat file app/Member.php
// use App\Pemesanan;
use App\Pengaturan;
use App\Situs;
use App\Partners;

class HomeController extends Controller
{
   function index () {

    //menmapilkan hl paket = paket yang banyak dipesan
      $data['paket'] = DB::table('sakwis_pemesanan_paket')
      ->select(DB::raw(' *, COUNT(sakwis_pemesanan_paket.id_paket) as jumlah_dipesan, sakwis_paket.foto_paket AS foto_paket'))
      ->join('sakwis_pemesanan', 'sakwis_pemesanan.id_pemesanan', '=', 'sakwis_pemesanan_paket.id_pemesanan', 'left')
      ->join('sakwis_paket', 'sakwis_paket.id_paket', '=', 'sakwis_pemesanan_paket.id_paket', 'left')
      ->whereRaw("status_pemesanan != 'pending'")
      ->orderByDesc('jumlah_dipesan')
      ->groupBy('sakwis_pemesanan_paket.id_paket')
      ->limit(3)
      ->get();

      // dd($data);

      $data['situs'] = Situs::all();
      
      $data['testimoni'] =  DB::table('sakwis_bukutamu')->where('status', 'tampilkan')->get();

      $data['situs'] = Situs::all();

      $data['partners'] = Partners::all();
      
      $data['pengaturan'] = Pengaturan::all();

      return view('index', $data);
   }

   function testimoni(){

     $data['testimoni'] =  DB::table('sakwis_bukutamu')->where('status_testimoni', 'Setujui')->paginate(6);

     return view("pages/testimoni-all", $data);
   }
}