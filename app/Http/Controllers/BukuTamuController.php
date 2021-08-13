<?php
//deklarasi namespace u/ beritahu letak file controller 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

// panggil model member, maka harus buat file app/Member.php
// use App\Pemesanan;
use App\BukuTamu;

class BukuTamuController extends Controller
{  
   function index () {

      return view('pages.tamu');
   }

   function cek_kunjungan(Request $request){
     $kode_kunjungan = $request->input('id_kunjungan');

     //cek kode kunjungan yg diinputkan ada di db
     $cek_kode = DB::table('sakwis_pemesanan')
     ->where('kode_kunjungan', $kode_kunjungan);

     //jika ada
     if($cek_kode->count() == 1){
       session()->put(['tamu' => $kode_kunjungan]);

       return redirect('tamu/form_tamu');
     }else{
       return redirect('bukutamu')->with('gagal', 'ID Kunjungan tidak ditemukan!');
     }
   }

   function formtamu (){
      return view("pages.tamu-form");
   }

   function input_tamu(BukuTamu $bukuTamu, Request $request) {
      $messages = [
         'required' => ':attribute wajib disi.'
      ];

     $this->validate($request,[
       'nama_tamu' => 'required',
       'telp_tamu' => 'required',
       'asal_tamu' => 'required',
       'pesan_tamu' => 'required'
       ], $messages);
    
    //ambil kode kunjungan dari table sakwis_pemesanan
    if(!empty(session('tamu'))){
       $kode_kunjungan = session('tamu');
    }else {
      $kode_kunjungan = $request->get('kode');
    }

    //siapkan data yang akan diinsertkan
     $tamu['kode_kunjungan'] = $kode_kunjungan;
     $tamu['nama_tamu'] = $request->nama_tamu;
     $tamu['telp_tamu'] = $request->telp_tamu;
     $tamu['email_tamu'] = $request->email_tamu;
     $tamu['instagram'] = $request->instagram;
     $tamu['asal_tamu'] = $request->asal_tamu;
     $tamu['pesan_tamu'] = $request->pesan_tamu;

   $id_bukutamu = DB::table('sakwis_bukutamu')->insertGetId($tamu);

      return redirect("tamu/sukses/");
   }

   function sukses_tamu(){
      return view('pages.tamu-sukses');
   }

}