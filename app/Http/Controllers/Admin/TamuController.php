<?php 
//deklarasi namespace u/ beritahu letak file controller 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  

// panggil model member, maka harus buat file app/Member.php
use App\BukuTamu;
// use App\Pemesanan;
// use App\Member;

class TamuController extends Controller
{
  function index(){
    $data["tamu_pemesanan"] = DB::table('sakwis_pemesanan')
    ->join('sakwis_member', 'sakwis_pemesanan.id_member', '=', 'sakwis_member.id_member')
    ->where('kode_kunjungan', '!=', null)
    ->orderBy('sakwis_pemesanan.id_pemesanan', 'desc')
    ->paginate(10);

    return view ('pages.admin.dashboard-tamu', $data);
  }

  function list_tamu($kode_kunjungan) {
    $data["tamu_list"] = DB::table('sakwis_bukutamu')
    ->join('sakwis_pemesanan', 'sakwis_pemesanan.kode_kunjungan', '=', 'sakwis_bukutamu.kode_kunjungan')
    ->where('sakwis_bukutamu.kode_kunjungan', $kode_kunjungan)
    ->orderBy('sakwis_pemesanan.id_pemesanan', 'desc')
    ->get();

    $data['jumlah_testimoni_tampil'] = DB::table('sakwis_bukutamu')->where('status', 'tampilkan')->count();
     return view ('pages.admin.tamu.list-tamu', $data);
  }

  function detail_tamu(Request $request, $id_bukutamu){
    $data["wisatawan"] = DB::table('sakwis_bukutamu')
    ->join('sakwis_pemesanan', 'sakwis_pemesanan.kode_kunjungan', '=', 'sakwis_bukutamu.kode_kunjungan')
    ->where('sakwis_bukutamu.id_bukutamu', $id_bukutamu)
    ->first();
    
    $data['jumlah_testimoni_tampil'] = DB::table('sakwis_bukutamu')->where('status', 'tampilkan')->count();

    $kode_kunjungan = $request->kode_kunjungan;

    // if ($request->status == 'tampilkan') {
    //   $dataUpdate['status'] = 'sembunyikan';
    // } else {
    //  $dataUpdate['status'] = 'tampilkan';

    //  //cek apakah sudah ada 4 testimoni yang ditampilkan
    //  $cek_testimoni = DB::table('sakwis_bukutamu')->where('status', 'tampilkan')->count();
 
    //  if ($cek_testimoni == 4) {
    //    return redirect('admin/buku-tamu/' . $kode_kunjungan)->with('pesan', 'testimoni yang ditampilkan sudah 4! silahkan sembunyikan salah satu terlebih dahulu.');
    //   }
    // }


      // DB::table('sakwis_bukutamu')->where('id_bukutamu', $id_bukutamu)->update($dataUpdate);


    // dd($data);

    return view ('pages.admin.tamu.detail-tamu', $data);
  }

  function cetak($kode_kunjungan){
    $data['bukutamu'] = DB::table('sakwis_bukutamu')
    ->join('sakwis_pemesanan', 'sakwis_pemesanan.kode_kunjungan', '=', 'sakwis_bukutamu.kode_kunjungan')
    ->join('sakwis_member', 'sakwis_pemesanan.id_member', '=', 'sakwis_member.id_member')
    ->where('sakwis_bukutamu.kode_kunjungan', $kode_kunjungan)
    ->orderBy('sakwis_pemesanan.id_pemesanan', 'desc')
    ->get();

    $data["pemesanan"] = DB::table('sakwis_pemesanan')
    ->join('sakwis_pemesanan_paket', 'sakwis_pemesanan_paket.id_pemesanan', '=', 'sakwis_pemesanan.id_pemesanan')
    ->join('sakwis_member', 'sakwis_pemesanan.id_member', '=', 'sakwis_member.id_member')
    ->first();

    // dd($data);

    return view('pages.admin.tamu.cetak', $data);
  }

  function update_status(Request $request, $id_bukutamu){
    $kode_kunjungan = $request->kode_kunjungan;

    if ($request->status == 'tampilkan') {
      $dataUpdate['status'] = 'sembunyikan';
    } else {
     $dataUpdate['status'] = 'tampilkan';

     //cek apakah sudah ada 4 testimoni yang ditampilkan
     $cek_testimoni = DB::table('sakwis_bukutamu')->where('status', 'tampilkan')->count();
 
     if ($cek_testimoni == 4) {
       return redirect('admin/buku-tamu/' . $kode_kunjungan)->with('pesan', 'testimoni yang ditampilkan sudah 4! silahkan sembunyikan salah satu terlebih dahulu.');
      }
    }

      DB::table('sakwis_bukutamu')->where('id_bukutamu', $id_bukutamu)->update($dataUpdate);

     return redirect('admin/buku-tamu/' . $kode_kunjungan)->with('pesan', 'testimoni tamu berhasil diupdate!');
    
  }

  function update_status_testimoni(Request $request, $id_bukutamu){
    $kode_kunjungan = $request->kode_kunjungan;

    if($request->status_testimoni == 'Setujui'){
      $dataUpdate['status_testimoni'] = 'Tolak';
    }else {
      $dataUpdate['status_testimoni'] = 'Setujui';
    }

    DB::table('sakwis_bukutamu')->where('id_bukutamu', $id_bukutamu)->update($dataUpdate);

    return redirect('admin/buku-tamu/' . $kode_kunjungan)->with('pesan', 'Testimoni tamu berhasil diupdate !');
  }

}