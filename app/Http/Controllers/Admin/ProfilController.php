<?php
//deklarasi namespace u/ beritahu letak file controller 
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

// panggil model member, maka harus buat file app/Member.php
use App\Admin;

class ProfilController extends Controller
{
   function index () {
    $id_admin = session('id');

    $data["profil"] = DB::table('sakwis_admin')->where('id_admin', $id_admin)->first();

    //  $data['password'] = sha1());

    // dd($data);

     return view ('pages.admin.profil', $data);
   }

   function ubah_profil(Request $request){
    $id_admin = session('id');

    $profil = DB::table('sakwis_admin')->where('id_admin', $id_admin)->first();
    
     $data_profil['username_admin'] = $request->username_admin;
     $data_profil['email_admin'] = $request->email_admin;

     //cek jk pass admin kosong, maka masukkan ke array data profil
     if($request->password_admin != null){
       $data_profil['password_admin'] = sha1($request->password_admin); 
     }

    $file = $request->file("foto_admin");
    //mengupdate foto sebelumnya dgn yg terbaru
    if ($file != null){
      $nama_file = date("Ymdhis") . $file->getClientOriginalName();
      $file->move(public_path('img/profil/'), $nama_file);
      $data_profil['foto_admin'] = $nama_file;
      $foto_lama = $profil->foto_admin;
      //cek apakah ada foto paket lama di folder public/img/paket/
      $lokasi_file = "img/profil/$foto_lama";
      if(File::exists(public_path($lokasi_file))){
        File::delete(public_path($lokasi_file));
      }
    }

    DB::table('sakwis_admin')->where('id_admin', $id_admin)->update($data_profil);

    if($file != null){
         session()->put(['foto' => $nama_file]);
    }

    return redirect("admin/profil-admin")->with('pesan', 'Data anda berhasil diperbarui!');
     
  }
}