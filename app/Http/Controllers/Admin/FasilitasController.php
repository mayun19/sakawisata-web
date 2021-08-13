<?php
//deklarasi namespace u/ beritahu letak file controller 
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

// panggil model member, maka harus buat file app/Member.php
use App\Fasilitas;
use App\Pemandu;

class FasilitasController extends Controller
{
   function index () {

     //gunakan model member u/ ambil data member dari database
    // $fasilitas = Fasilitas::all();
    $data["fasilitas"] = Fasilitas::all();

    //cek data nya sudah berhasil ?
    // echo "<pre>";
    // print_r($fasilitas);
    // echo"</pre>";

     return view ('pages.admin.fasilitas.dashboard-fasilitas', $data);
   }

   function tambah(){
     return view('pages.admin.fasilitas.fasilitas_tambah');
   }

   function simpan(Request $request){
      $file = $request->file("icon_fasilitas");
      $file->move('img/fasilitas',$file->getClientOriginalName());

     $fasilitas['nama_fasilitas'] = $request->nama_fasilitas;
     $fasilitas['icon_fasilitas'] = $file->getClientOriginalName();

     Fasilitas::create($fasilitas);

     return redirect("admin/fasilitas")->with("pesan", "data fasilitas berhasil ditambahkan");
   }

   function simpanfoto (Request $request, Fasilitas $fasilitas){
    $file =$request->file("icon_fasilitas");

    $file->move('img/fasilitas', $file->getClientOriginalName());

    $simpan['id_fasilitas'] = $request->id_fasilitas;
    $simpan['icon_fasilitas'] = $file->getClientOriginalName();

    Fasilitas::create('simpan');

    return redirect("admin/fasilitas/edit/".$fasilitas->id_fasilitas);
   }

   function edit(Fasilitas $fasilitas){
    //   echo "<pre>";
    //   print_r($fasilitas);
    //   echo "</pre>";

    // $fasilitas = Fasilitas::all();
     $data['fasilitas'] = $fasilitas;

     return view("pages.admin.fasilitas.fasilitas_edit", $data);
   }

   function update(Request $request, Fasilitas $fasilitas){
     
     $update['nama_fasilitas'] = $request->nama_fasilitas;
    //  $update['icon_fasilitas'] = $file->getClientOriginalName();
     
     $file =$request->file("icon_fasilitas");

     //mengupdate foto sebelumnya dgn yg terbaru
      if ($file != null){
        $nama_file = $file->getClientOriginalName();
        $file->move('img/fasilitas', $nama_file);
        $update['icon_fasilitas'] = $nama_file;

        $foto_lama = $fasilitas->icon_fasilitas;
        //cek apakah ada foto paket lama di folder public/img/paket/
        $lokasi_file = "img/fasilitas/$foto_lama";

        if(File::exists(public_path($lokasi_file))){
          File::delete(public_path($lokasi_file));
        }
      }

     DB::table('sakwis_fasilitas')->where('id_fasilitas', $fasilitas->id_fasilitas)->update($update);

     return redirect("admin/fasilitas")->with("pesan", "data fasilitas ".$fasilitas->nama_fasilitas. " berhasil diubah");
   }

   function hapus(Fasilitas $fasilitas){
     DB::table('sakwis_fasilitas')->where("id_fasilitas", $fasilitas->id_fasilitas)->delete();

     return redirect('admin/fasilitas')->with("pesan","data fasilitas berhasil dihapus");
   }



}