<?php
//deklarasi namespace u/ beritahu letak file controller 
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;

// panggil model member, maka harus buat file app/Member.php
use App\Paket;
use App\Fasilitas;
use App\Sesi;
use App\Situs;


class PaketController extends Controller
{
   function index () {

     //gunakan model member u/ ambil data member dari database
    $data["paket"]= Paket::paginate(6);


    //cek data nya sudah berhasil ?
   //  echo "<pre>";
   //  print_r($paket);
   //  echo"</pre>";

     return view ('pages.admin.paket.dashboard-paket', $data);
   }

   function tambah() {
     $data['sesi']= Sesi::all();
     $data['fasilitas']= Fasilitas::all();
     $data['situs']= Situs::all();

    //cek data nya sudah berhasil ?
    // echo "<pre>";
    // print_r($data);
    // echo"</pre>";
     
     return view('pages.admin.paket.paket_tambah', $data);
   }

   function simpan (Request $request, Paket $paket) {
    //cek data nya sudah berhasil ?
    // echo "<pre>";
    // print_r($_POST);
    // echo"</pre>";
      $messages = [
        'required' => ':attribute wajib disi.',
        'unique' => ':attribute sudah ada sebelumnya.',
      ];

      $harga_paket_unmask = str_replace(".", "", $request->harga_paket);

     $this->validate($request,[
       'nama_paket' => 'required|unique:sakwis_paket',
       'foto_paket' => 'required',
       'harga_paket' => 'required',
       'deskripsi_paket' => 'required'
       ], $messages);


    $file = $request->file("foto_paket");
    if($file){
      $file->move('img/paket',$file->getClientOriginalName());
      $mlebu['foto_paket'] = $file->getClientOriginalName();
    }
    
      $mlebu['nama_paket'] = $request->nama_paket;
      $mlebu['harga_paket'] = $harga_paket_unmask;
      $mlebu['kapasitas_min_paket'] = $request->kapasitas_min_paket;
      $mlebu['kapasitas_max_paket'] = $request->kapasitas_max_paket;
      $mlebu['deskripsi_paket'] = $request->deskripsi_paket;

      // echo "<pre>";
      // print_r($file);
      // echo "</pre>";

      // simpab ke database 
      Paket::create($mlebu);

      $id_paket_barusan = DB::getPdo()->lastInsertId();

      foreach ($request->id_fasilitas as $key => $value) {
        $masuk['id_fasilitas']= $value;
        $masuk['id_paket']= $id_paket_barusan;

      DB::table('sakwis_paket_fasilitas')
      ->insert($masuk);
      }

      foreach ($request->id_rute as $key => $val) {
        $situs['id_situs']= $val;
        $situs['id_paket']= $id_paket_barusan;

      DB::table('sakwis_paket_situs')
      ->insert($situs);
      }

      foreach ($request->id_sesi as $key => $va) {
        $sesi['id_sesi']= $va;
        $sesi['id_paket']= $id_paket_barusan;

      DB::table('sakwis_paket_sesi')
      ->insert($sesi);
      }

      return redirect('admin/paket')->with('pesan', 'paket telah berhasil ditambahkan');
   }

   function detail (Paket $paket) {
      // echo "<pre>";
      // print_r($paket);
      // echo "</pre>";

      $data['paket']= $paket;
      $data['fasilitas'] = DB::table('sakwis_paket_fasilitas')->join('sakwis_fasilitas', 'sakwis_fasilitas.id_fasilitas', '=', 'sakwis_paket_fasilitas.id_fasilitas')->where('id_paket', $paket->id_paket)->get();
      $data['situs'] = DB::table('sakwis_paket_situs')->join('sakwis_situs', 'sakwis_situs.id_situs', '=', 'sakwis_paket_situs.id_situs')->where('id_paket', $paket->id_paket)->get();
      $data['sesi'] = DB::table('sakwis_paket_sesi')->join('sakwis_sesi', 'sakwis_sesi.id_sesi', '=', 'sakwis_paket_sesi.id_sesi')->where('id_paket', $paket->id_paket)->get();

      // echo "<pre>";
      // print_r($data);
      // echo "</pre>";

      return view ('pages.admin.paket.paket_detail', $data);
   }

   function edit (Paket $paket){
      // echo "<pre>";
      // print_r($paket);
      // echo "</pre>";

      // $Paket = Paket::all();
      $data['sesi']= Sesi::all();
      $data['fasilitas']= Fasilitas::all();
      $data['situs']= Situs::all();

      $data['paket'] = $paket;
      $data['paket_fasilitas'] = DB::table('sakwis_paket_fasilitas')->join('sakwis_fasilitas', 'sakwis_fasilitas.id_fasilitas', '=', 'sakwis_paket_fasilitas.id_fasilitas')->where('id_paket', $paket->id_paket)->get();
      $data['paket_situs'] = DB::table('sakwis_paket_situs')->join('sakwis_situs', 'sakwis_situs.id_situs', '=', 'sakwis_paket_situs.id_situs')->where('id_paket', $paket->id_paket)->get();
      $data['paket_sesi'] = DB::table('sakwis_paket_sesi')->join('sakwis_sesi', 'sakwis_sesi.id_sesi', '=', 'sakwis_paket_sesi.id_sesi')->where('id_paket', $paket->id_paket)->get();

      return view("pages.admin.paket.paket_edit", $data);
   }

   function hapus(Paket $paket) {
    DB::table('sakwis_paket_fasilitas')->where("id_paket", $paket->id_paket)->delete();
    DB::table('sakwis_paket_situs')->where("id_paket", $paket->id_paket)->delete();
    DB::table('sakwis_paket_sesi')->where("id_paket", $paket->id_paket)->delete();
    DB::table('sakwis_paket')->where("id_paket", $paket->id_paket)->delete();

    return redirect('admin/paket');
   }

   function update(Request $request, Paket $paket){

    //unmask harga paket
    $harga_paket_unmask = str_replace(".", "", $request->harga_paket);

    //gunakan model member u/ ambil data member dari database
     $data_update['nama_paket'] = $request->nama_paket;
     $data_update['harga_paket'] = $harga_paket_unmask;
     $data_update['kapasitas_min_paket'] = $request->kap_min_paket;
     $data_update['kapasitas_max_paket'] = $request->kap_max_paket;
     $data_update['deskripsi_paket'] = $request->deskripsi_paket;

     $file = $request->file("foto_paket");

     //mengupdate foto sebelumnya dgn yg terbaru
     if ($file != null){
       $nama_file = $file->getClientOriginalName();
       $file->move('img/paket', $nama_file);
       $data_update['foto_paket'] = $nama_file;


       $foto_lama = $paket->foto_paket;
      //cek apakah ada foto paket lama di folder public/img/paket/
       $lokasi_file = "img/paket/$foto_lama";

       if(File::exists(public_path($lokasi_file))){
         File::delete(public_path($lokasi_file));
       }
     }
     // dd($file);

    //  update data paket
     DB::table('sakwis_paket')->where('id_paket', $paket->id_paket)->update($data_update);

     // hapus fasilitas yang memiliki id_paket yang sedang diupdate
     DB::table('sakwis_paket_fasilitas')->where('id_paket', $paket->id_paket)->delete();

     $fasilitas_paket = $request->id_fasilitas;
     $data = array();

    foreach ($fasilitas_paket as $key => $id_fasilitas) {
        $data[$key]['id_paket'] = $paket->id_paket;
        $data[$key]['id_fasilitas'] = $id_fasilitas;
    }

    // memasukkan(update) fasilitas yang dipilih yg dimiliki id_paket
     DB::table('sakwis_paket_fasilitas')->insert($data);

     //hapus situs yg punya id_paket yang sedang di update
     DB::table('sakwis_paket_situs')->where('id_paket', $paket->id_paket)->delete();

     $situs_paket = $request->id_rute;
     $data_situs = array();

    //  dd($request->all());

     foreach ($situs_paket as $key => $id_situs) {
       $data_situs[$key]['id_paket'] = $paket->id_paket;
       $data_situs[$key]['id_situs'] = $id_situs;
     }
     DB::table('sakwis_paket_situs')->insert($data_situs);

     //hapus sesi yg punya id_paket yang sedang di update
     DB::table('sakwis_paket_sesi')->where('id_paket', $paket->id_paket)->delete();

     $sesi_paket = $request->id_sesi;
     $data_sesi = array();

     foreach ($sesi_paket as $key => $id_sesi) {
       $data_sesi[$key]['id_paket'] = $paket->id_paket;
       $data_sesi[$key]['id_sesi'] = $id_sesi;
     }

    //  data sesi diupdate dengan pilihan terbaru
     DB::table('sakwis_paket_sesi')->insert($data_sesi);


     return redirect('admin/paket/detail/'. $paket->id_paket)->with('pesan', 'Paket berhasil diperbaharui');
   }

}