<?php
//deklarasi namespace u/ beritahu letak file controller 
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

// panggil model member, maka harus buat file app/Member.php
use App\Pemandu;

class PemanduController extends Controller
{
   function index () {

     //gunakan model member u/ ambil data member dari database
    $data["pemandu"]= Pemandu::paginate(6);


    //cek data nya sudah berhasil ?
    // echo "<pre>";
    // print_r($pemandu);
    // echo"</pre>";

     return view ('pages.admin.pemandu.dashboard-pemandu', $data);
   }

   function tambah () {
     return view('pages.admin.pemandu.pemandu_tambah');
   }

   function simpan (Request $request){
      // echo "<pre>";
      // print_r($_POST);
      // print_r($_FILES);
      // echo "</pre>";
      $messages = [
        'required' => ':attribute wajib disi.'
      ];

     $this->validate($request,[
       'nama_pemandu' => 'required',
       'link_wa_pemandu' => 'required',
       'bahasa_pemandu' => 'required',
       'tahun_gabung_pemandu' => 'required',
       'foto_pemandu' => 'required'
      ], $messages);

      $file = $request->file("foto_pemandu");

      $file->move('img/pemandu',$file->getClientOriginalName());

      $pemandu['nama_pemandu'] = $request->nama_pemandu;
      $pemandu['link_wa_pemandu'] = $request->link_wa_pemandu;
      $pemandu['bahasa_pemandu'] = $request->bahasa_pemandu;
      $pemandu['tahun_gabung_pemandu'] = $request->tahun_gabung_pemandu;
      $pemandu['foto_pemandu'] = $file->getClientOriginalName();

      Pemandu::create($pemandu);

      return redirect("admin/pemandu")->with("pesan","data pemandu berhasil ditambahkan");
   }

   function detail (Pemandu $pemandu) {
      //cek data nya sudah berhasil ?
      // echo "<pre>";
      // print_r($pemandu);
      // echo "</pre>";

      // $pemandu = Pemandu::all();

      $data['pemandu'] = $pemandu;
      return view("pages.admin.pemandu.pemandu_detail", $data);
      
   }

   function simpanFoto (Request $request, Pemandu $pemandu) {
      // echo "<pre>";
      // print_r($_POST);
      // print_r($_FILES);
      // echo "</pre>";

      $file = $request->file("foto_pemandu");

      $file->move('img/pemadu', $file->getClientOriginalName());

      $simpan['id_pemandu'] = $request->id_pemandu;
      $simpan['foto_pemandu'] = $file->getClientOriginalName();

      Pemandu::create('simpan');

      return redirect("admin/pemandu/detail/".$pemandu->id_pemandu)->with("pesan","foto pemandu tersimpan");

   }

   function edit (Pemandu $pemandu) {
      //cek data nya sudah berhasil ?
      // echo "<pre>";
      // print_r($pemandu);
      // echo "</pre>";

     // $pemandu = Pemand u::all();

      $data['pemandu'] = $pemandu;

      return view("pages.admin.pemandu.pemandu_edit", $data);
   }

   function update (Request $request, Pemandu $pemandu) {
      // echo "<pre>";
      // print_r($_POST);
      // print_r($_FILES);
      // // print_r($request);
      // // print_r($pemandu);
      // echo "</pre>";

      
      $update['nama_pemandu'] = $request->nama_pemandu;
      $update['link_wa_pemandu'] = $request->link_wa_pemandu;
      $update['bahasa_pemandu'] = $request->bahasa_pemandu;
      $update['tahun_gabung_pemandu'] = $request->tahun_gabung_pemandu;
      
      $file = $request->file("foto_pemandu");

      //mengupdate foto sebelumnya dgn yg terbaru
      if ($file != null){
        $nama_file = $file->getClientOriginalName();
        $file->move('img/pemandu', $nama_file);
        $update['foto_pemandu'] = $nama_file;

        $foto_lama = $pemandu->foto_pemandu;
        //cek apakah ada foto paket lama di folder public/img/paket/
        $lokasi_file = "img/pemandu/$foto_lama";

        if(File::exists(public_path($lokasi_file))){
          File::delete(public_path($lokasi_file));
        }
      }

      DB::table('sakwis_pemandu')->where('id_pemandu', $pemandu->id_pemandu)->update($update);

      return redirect("admin/pemandu/detail/".$pemandu->id_pemandu);
   }

   function hapus(Pemandu $pemandu){
      DB::table('sakwis_pemandu')->where("id_pemandu", $pemandu->id_pemandu)->delete();

      return redirect('admin/pemandu')->with("pesan","data pemandu berhasil dihapus");
   }

}