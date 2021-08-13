<?php
//deklarasi namespace u/ beritahu letak file controller 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

// panggil model member, maka harus buat file app/Member.php
use App\Situs;
use App\SitusFoto;


class SitusController extends Controller
{
   function index () {

     //gunakan model member u/ ambil data member dari database
    $data["situs"]= Situs::paginate(6);


    //cek data nya sudah berhasil ?
   //  echo "<pre>";
   //  print_r($situs);
   //  echo"</pre>";

     return view ('pages.admin.situs.dashboard-situs', $data);
   }

   function tambah(){
      return view ('pages.admin.situs.situs_tambah');
   }

   function simpan(Request $request){
      // echo "<pre>";
      // print_r($_POST);
      // print_r($_FILES);
      // echo "</pre>";
      $messages = [
        'required' => ':attribute wajib disi.',
        'unique' => ':attribute telah terdaftar.'
      ];

     $this->validate($request,[
       'nama_situs' => 'required|unique:sakwis_situs',
       'foto_situs' => 'required',
       'deskripsi_situs' => 'required'
      ], $messages);


      $file = $request->file("foto_situs");

      $file->move('img/situs',$file->getClientOriginalName());


      $mlebu['nama_situs'] = $request->nama_situs;
      $mlebu['deskripsi_situs'] = $request->deskripsi_situs;
      $mlebu['foto_situs'] = $file->getClientOriginalName();

      // echo "<pre>";
      // print_r($file);
      // echo "</pre>";

      // simpab ke database 
      Situs::create($mlebu);

      return redirect("admin/situs")->with("pesan","Data situs berhasil ditambahkan");
   }

   function detail(Situs $situs){
      // echo "<pre>";
      // print_r($situs);
      // echo "</pre>";

      $data['situs'] = $situs;
      $data['foto'] = DB::table('sakwis_situs_foto')->where('id_situs', $situs->id_situs)->get();

      return view("pages.admin.situs.situs_detail", $data);
   }


   function edit (Situs $situs) {

      // echo "<pre>";
      // print_r($situs);
      // echo "</pre>";

      $data['situs'] = $situs;
      $data['foto'] = DB::table('sakwis_situs_foto')->where("id_situs", $situs->id_situs)->get();


      return view("pages.admin.situs.situs_edit", $data);

   }

   function update (Request $request, Situs $situs) {

      // echo "<pre>";
      // print_r($_POST);
      // print_r($_FILES);
      // print_r($request);
      // print_r($situs);
      // echo "</pre>";
      $mlebu['nama_situs']= $request->nama_situs;
      $mlebu['deskripsi_situs']= $request->deskripsi_situs;

      // $mlebu['foto_situs']= $file->getClientOriginalName();
      $file = $request->file("foto_situs");
      //mengupdate foto sebelumnya dgn yg terbaru
      if($file != null){
         $nama_file = $file->getClientOriginalName();
         $file->move('img/situs',$nama_file);
         $mlebu['foto_situs'] = $nama_file;

         $foto_lama = $situs->foto_situs;
         //cek apakah ada foto paket lama di folder public/img/situs/
         $lokasi_file = "img/situs/$foto_lama";

         if(File::exists(public_path($lokasi_file))){
            File::delete(public_path($lokasi_file));
       }
      }

      DB::table('sakwis_situs')
      ->where('id_situs', $situs->id_situs)
      ->update($mlebu);

      return redirect("admin/situs/detail/". $situs->id_situs)->with("pesan","situs ".$situs->nama_situs." berhasil diubah");
   }

   function hapus_foto(SitusFoto $situs_foto) {

         $foto_lama = $situs_foto->situs_foto;
         //cek apakah ada foto paket lama di folder public/img/situs/
         $lokasi_file = "img/situs/$foto_lama";

         if(File::exists(public_path($lokasi_file))){
            File::delete(public_path($lokasi_file));
       }
      DB::table('sakwis_situs_foto')->where('id_situs_foto', $situs_foto->id_situs_foto)->delete();
      return redirect('admin/situs/edit/'.$situs_foto->id_situs)->with('pesan', 'Data situs berhasil dihapus');
   }

   function simpan_foto(Request $request, Situs $situs){
      $file = $request->file("situs_foto");

      $file->move('img/situs',$file->getClientOriginalName());

      $mlebu['id_situs']= $situs->id_situs;
      $mlebu['situs_foto']= $file->getClientOriginalName();

      SitusFoto::create($mlebu);

      return redirect("admin/situs/edit/".$situs->id_situs)->with("pesan","foto situs tersimpan");
   }

   function hapus(Situs $situs){
      DB::table('sakwis_situs')->where("id_situs", $situs->id_situs)->delete();

      return redirect('admin/situs');
   }
}