<?php
//deklarasi namespace u/ beritahu letak file controller 
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

// panggil model member, maka harus buat file app/Member.php
use App\Sesi;

class SesiController extends Controller
{
   function index () {

     //gunakan model member u/ ambil data member dari database
    // $sesi = Sesi::all();
    $data["sesi"] = Sesi::all();


    //cek data nya sudah berhasil ?
    // echo "<pre>";
    // print_r($sesi);
    // echo"</pre>";

     return view ('pages.admin.sesi.dashboard-sesi', $data);
   }

   function tambah(){
     return view('pages.admin.sesi.sesi_tambah');
   }

   function simpan (Request $request){

      // echo "<pre>";
      // print_r($file);
      // echo "</pre>";

      $sesi['nama_sesi'] = $request->nama_sesi;

      Sesi::create($sesi);

      return redirect("admin/sesi")->with("pesan","data sesi berhasil ditambahkan");
   }

   function hapus(Sesi $sesi){
     DB::table('sakwis_sesi')->where("id_sesi", $sesi->id_sesi)->delete();

     return redirect('admin/sesi')->with("pesan","data sesi berhasil dihapus");
   }
}