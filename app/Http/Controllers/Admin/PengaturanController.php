<?php
//deklarasi namespace u/ beritahu letak file controller 
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


// panggil model member, maka harus buat file app/Member.php
use App\Pengaturan;

class PengaturanController extends Controller
{
   function index () {

     //gunakan model member u/ ambil data member dari database
    $data["setting"]= Pengaturan::where('tipe_pengaturan', 'umum')->get();


    //cek data nya sudah berhasil ?
   //  echo "<pre>";
   //  print_r($setting);
   //  echo"</pre>";

     return view ('pages.admin.pengaturan.dashboard-pengaturan', $data);
   }

   function tambah () {
     return view('pages.admin.pengaturan.pengaturan_tambah');
   }

   function simpan(Request $request){
     $setting['nama_pengaturan'] = $request->nama_pengaturan;
     $setting['isi_pengaturan'] = $request->isi_pengaturan;

     Pengaturan::create($setting);

     return redirect('admin/pengaturan')->with('pesan','data pengaturan tersimpan');
   }

   function edit(Pengaturan $pengaturan){
     $data['pengaturan'] = $pengaturan;

     return view('pages.admin.pengaturan.pengaturan_edit', $data);
   }

   function update(Request $request, Pengaturan $pengaturan){
     $update['nama_pengaturan'] = $request->nama_pengaturan;
     $update['isi_pengaturan'] = $request->isi_pengaturan;

     DB::table('sakwis_pengaturan')->where('id_pengaturan', $pengaturan->id_pengaturan)->update($update);

     return redirect("admin/pengaturan")->with('pesan', 'data pengaturan berhasil diubah');
   }

   function hapus(Pengaturan $pengaturan){
     DB::table('sakwis_pengaturan')->where("id_pengaturan", $pengaturan->id_pengaturan)->delete();

     return redirect('admin/pengaturan')->with('pesan', 'data pengaturan berhasil dihapus');
   }

   function profil(){
    return view('pages.admin.profil-kaumansaka.dashboard-profil');
   }

   function update_kauman(Request $request){
    $update['isi_pengaturan'] = $request->deskripsi_kauman;

    DB::table('sakwis_pengaturan')->where('nama_pengaturan', 'deskripsi_kauman')->update($update);

    return redirect("admin/profil-kauman")->with("pesan","Profil berhasul diupdate");
   }

   function update_saka(Request $request){
      $inputan = $request->except('_token');
      
      $file = $request->file("bg_profil");

      //mengupdate foto sebelumnya dgn yg terbaru
      if($file != null){
         $nama_file = $file->getClientOriginalName();
         $file_upload = $file->move('img/pengaturan',$nama_file);

         $file_upload = str_replace("\\", "/", $file_upload);
         $inputan['bg_profil'] = $file_upload;

         $foto_lama = pengaturan('bg_profil');
         //cek apakah ada foto paket lama di folder public/img/situs/
         $lokasi_file = "img/prngaturan/$foto_lama";

         if(File::exists(public_path($lokasi_file))){
            File::delete(public_path($lokasi_file));
       }
      }

      foreach ($inputan as $nama_pengaturan => $isi_pengaturan) {
        $update_saka['isi_pengaturan'] = $isi_pengaturan;
        DB::table('sakwis_pengaturan')->where('nama_pengaturan', $nama_pengaturan)->update($update_saka);
      }


      // DB::table('sakwis_pengaturan')
      // ->where('id_pengaturan', $pengaturan->id_pengaturan)
      // ->update($update_saka);

      return redirect('admin/profil-kauman')->with('pesan', 'Profil berhasil diperbarui');
   }
}