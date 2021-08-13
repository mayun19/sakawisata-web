<?php
//deklarasi namespace u/ beritahu letak file controller 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

// panggil model member, maka harus buat file app/Member.php
use App\Pemesanan;

class HomeController extends Controller
{
   function index () {

    // $data["pemesanan"] = Pemesanan::all();
    $member = DB::table('sakwis_member')->where('status_member', 'aktif')->count();
    $data["member"] = $member;

    $kunjungan  = DB::table('sakwis_pemesanan')->where('status_pemesanan', 'Selesai')->count();
    $data["kunjungan"] = $kunjungan;

    $reschedule = DB::table('sakwis_reschedule')->where('status_reschedule', 'Pending')->count();
    $data["reschedule"] = $reschedule;
    
    $pembatalan = DB::table('sakwis_pembatalan')->where('status_pembatalan', 'Pending' || 'Proses Pembatalan')->count();
    $data["pembatalan"] = $pembatalan;

    //gunakan model member u/ ambil data member dari database
    $pemesanan = DB::table('sakwis_pemesanan')
    ->selectRaw("*, sakwis_pemesanan.id_pemesanan As id_pemesanan")
    ->join('sakwis_pemesanan_paket', 'sakwis_pemesanan_paket.id_pemesanan', '=', 'sakwis_pemesanan.id_pemesanan')
    ->join('sakwis_member', 'sakwis_pemesanan.id_member', '=', 'sakwis_member.id_member')
    ->orderBy('sakwis_pemesanan.id_pemesanan', 'desc')
    ->get();

    foreach ($pemesanan as $item) {
      $this->update_status($item->id_pemesanan);
    }

    $data["pemesanan"] = DB::table('sakwis_pemesanan')
    ->selectRaw("*, sakwis_pemesanan.id_pemesanan As id_pemesanan")
    ->join('sakwis_pemesanan_paket', 'sakwis_pemesanan_paket.id_pemesanan', '=', 'sakwis_pemesanan.id_pemesanan')
    ->join('sakwis_member', 'sakwis_pemesanan.id_member', '=', 'sakwis_member.id_member')
    ->join('sakwis_reschedule', 'sakwis_reschedule.id_pemesanan', '=', 'sakwis_pemesanan.id_pemesanan', 'left')
    ->join('sakwis_pembatalan', 'sakwis_pembatalan.id_pemesanan', '=', 'sakwis_pemesanan.id_pemesanan', 'left')
    ->orderBy('sakwis_pemesanan.id_pemesanan', 'desc')
    ->get();

   //  dd($data);

    return view ('home', $data);
  }

    private function update_status($id_pemesanan){
     $cek_pemesanan = DB::table('sakwis_pemesanan')->where('id_pemesanan', $id_pemesanan)->first();

     if($cek_pemesanan->batas_pemesanan < date("Y-m-d H:i:s") && $cek_pemesanan->status_pemesanan == 'Pending'){
       $update['status_pemesanan'] = 'Kedaluarsa';

       DB::table('sakwis_pemesanan')->where('id_pemesanan', $id_pemesanan)->update($update);
     }
  }
}