<?php
//deklarasi namespace u/ beritahu letak file controller 
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

// panggil model member, maka harus buat file app/Member.php
use App\Faq;

class FaqController extends Controller
{
   function index () {

     //gunakan model member u/ ambil data member dari database
    $data["faq"]= Faq::all();


    //cek data nya sudah berhasil ?
   //  echo "<pre>";
   //  print_r($faq);
   //  echo"</pre>";

     return view ('pages.admin.faq.dashboard-faq', $data);
   }

   function tambah() {
     return view('pages.admin.faq.faq_tambah');
   }

   function simpan (Request $request){
    $faq['pertanyaan'] = $request->pertanyaan;
    $faq['jawaban'] = $request->jawaban;

    Faq::create($faq);

    return redirect("admin/faq")->with("pesan","data faq tersimpan");
   }

   function edit(Faq $faq) {
      //cek data nya sudah berhasil ?
      // echo "<pre>";
      // print_r($faq);
      // echo "</pre>";

      // $faq = Faq::all();
      $data['faq'] = $faq;

     return view('pages.admin.faq.faq_edit', $data);
   }

   function update (Request $request, Faq $faq) {
     $update['pertanyaan'] = $request->pertanyaan;
     $update['jawaban'] = $request->jawaban;

     DB::table('sakwis_faq')->where('id_faq', $faq->id_faq)->update($update);

     return redirect("admin/faq");
   }

   function hapus(Faq $faq){
    DB::table('sakwis_faq')->where("id_faq", $faq->id_faq)->delete();

    return redirect('admin/faq');
   }
}