<?php
//deklarasi namespace u/ beritahu letak file controller 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

// panggil model member, maka harus buat file app/Member.php
use App\Pemesanan;

class LaporanController extends Controller
{
   function index (Request $req) {
      //ambil data dari fungsi
      $data = $this->ambil_data_transaksi($req);
   //  dd($data);
     return view ('pages.admin.laporan.dashboard-transaksi', $data);
   //   pages.admin.tamu.list-tamu
   }

   function cetak_transaksi(Request $req){
     //ambil data dari fungsi
      $data = $this->ambil_data_transaksi($req);
   //  dd($data);
      return view('pages.admin.laporan.cetak-transaksi', $data);
   }

   function ambil_data_transaksi($req){
      //ambil query GET
      $tipe = $req->get('tipe');
      $tanggal_mulai = $req->get('tanggal_mulai');
      $tanggal_selesai = $req->get('tanggal_selesai');
      $bulan_thn = explode("-", $req->get('bulan'));
      $bulan = @$bulan_thn[0];
      $tahun = @$bulan_thn[1];

      // dd($bulan_thn);

    // $data["pemesanan"] = Pemesanan::all();
    if ($tipe == 'semua' || empty($tipe)) {
       $data['total_pendapatan'] = DB::table('sakwis_pemesanan')->select(DB::raw('SUM(total_pemesanan) as total_pendapatan'))->where('status_pemesanan', 'selesai')->first()->total_pendapatan;
 
       $data['paket_favorit'] = DB::table('sakwis_pemesanan_paket')->select(DB::raw(' id_paket, nama_paket, COUNT(id_paket) as jumlah_dipesan'))->groupBy('id_paket')->first()->nama_paket;
 
       $data['tot_transaksi'] = DB::table('sakwis_pemesanan')->where('status_pemesanan', 'selesai')->count();
 
       //tampilkan data transaksi dengan status selesai
       $data['transaksi'] = DB::table('sakwis_pemesanan')
       ->join('sakwis_pemesanan_paket', 'sakwis_pemesanan_paket.id_pemesanan', '=', 'sakwis_pemesanan.id_pemesanan')
       ->join('sakwis_member', 'sakwis_pemesanan.id_member', '=', 'sakwis_member.id_member')
       ->where('status_pemesanan', 'selesai')->paginate(10);

    } elseif ($tipe == 'mingguan') {
       //tampilkan data transaksi dengan status selesai
       $data['transaksi'] = DB::table('sakwis_pemesanan')
       ->join('sakwis_pemesanan_paket', 'sakwis_pemesanan_paket.id_pemesanan', '=', 'sakwis_pemesanan.id_pemesanan')
       ->join('sakwis_member', 'sakwis_pemesanan.id_member', '=', 'sakwis_member.id_member')
       ->where('status_pemesanan', 'selesai')
       ->whereRaw("tgl_kunjungan >= '$tanggal_mulai' ")
       ->whereRaw("tgl_kunjungan <= '$tanggal_selesai' ")
       ->paginate(10);

      $data['total_pendapatan'] = DB::table('sakwis_pemesanan')->select(DB::raw('SUM(total_pemesanan) as total_pendapatan, tgl_kunjungan'))
      ->where('status_pemesanan', 'selesai')
      ->whereRaw("tgl_kunjungan >= '$tanggal_mulai' ")
      ->whereRaw("tgl_kunjungan <= '$tanggal_selesai' ")
      ->first()->total_pendapatan;

      $paket_favorit= DB::table('sakwis_pemesanan_paket')
      ->select(DB::raw(' id_paket, nama_paket, COUNT(id_paket) as jumlah_dipesan, tgl_kunjungan'))
      ->join('sakwis_pemesanan', 'sakwis_pemesanan.id_pemesanan', '=', 'sakwis_pemesanan_paket.id_pemesanan', 'left')
      ->whereRaw("tgl_kunjungan >= '$tanggal_mulai' ")
      ->whereRaw("tgl_kunjungan <= '$tanggal_selesai' ")
      ->groupBy('id_paket')->first();

      $data['paket_favorit'] = $paket_favorit ? $paket_favorit->nama_paket : "-";

      $data['tot_transaksi'] = DB::table('sakwis_pemesanan')
      ->where('status_pemesanan', 'selesai')
      ->whereRaw("tgl_kunjungan >= '$tanggal_mulai' ")
      ->whereRaw("tgl_kunjungan <= '$tanggal_selesai' ")
      ->count();
    } elseif ($tipe == 'bulanan') {
       //tampilkan data transaksi dengan status selesai
       $data['transaksi'] = DB::table('sakwis_pemesanan')
       ->join('sakwis_pemesanan_paket', 'sakwis_pemesanan_paket.id_pemesanan', '=', 'sakwis_pemesanan.id_pemesanan')
       ->join('sakwis_member', 'sakwis_pemesanan.id_member', '=', 'sakwis_member.id_member')
       ->where('status_pemesanan', 'selesai')
       ->whereRaw("MONTH(tgl_kunjungan) = '$bulan' ")
       ->paginate(10);

      $data['total_pendapatan'] = DB::table('sakwis_pemesanan')->select(DB::raw('SUM(total_pemesanan) as total_pendapatan, tgl_kunjungan'))
      ->where('status_pemesanan', 'selesai')
      ->whereRaw("MONTH(tgl_kunjungan) = '$bulan' ")
      ->first()->total_pendapatan;

      $paket_favorit= DB::table('sakwis_pemesanan_paket')
      ->select(DB::raw(' id_paket, nama_paket, COUNT(id_paket) as jumlah_dipesan, tgl_kunjungan'))
      ->join('sakwis_pemesanan', 'sakwis_pemesanan.id_pemesanan', '=', 'sakwis_pemesanan_paket.id_pemesanan', 'left')
      ->whereRaw("MONTH(tgl_kunjungan) = '$bulan' ")
      ->groupBy('id_paket')->first();

      $data['paket_favorit']  = $paket_favorit ? $paket_favorit->nama_paket : "-";

      $data['tot_transaksi'] = DB::table('sakwis_pemesanan')
      ->where('status_pemesanan', 'selesai')
      ->whereRaw("MONTH(tgl_kunjungan) = '$bulan' ")
      ->count();
    }elseif ($tipe == 'tahunan') {
       $tahun = $req->input('tahun');

      //tampilkan data transaksi dengan status selesai
       $data['transaksi'] = DB::table('sakwis_pemesanan')
       ->join('sakwis_pemesanan_paket', 'sakwis_pemesanan_paket.id_pemesanan', '=', 'sakwis_pemesanan.id_pemesanan')
       ->join('sakwis_member', 'sakwis_pemesanan.id_member', '=', 'sakwis_member.id_member')
       ->where('status_pemesanan', 'selesai')
       ->whereRaw("YEAR(tgl_kunjungan) = '$tahun' ")
       ->paginate(10);

      $data['total_pendapatan'] = DB::table('sakwis_pemesanan')->select(DB::raw('SUM(total_pemesanan) as total_pendapatan, tgl_kunjungan'))
      ->where('status_pemesanan', 'selesai')
      ->whereRaw("YEAR(tgl_kunjungan) = '$tahun' ")
      ->first()->total_pendapatan;

      $paket_favorit = DB::table('sakwis_pemesanan_paket')
      ->select(DB::raw(' id_paket, nama_paket, COUNT(id_paket) as jumlah_dipesan, tgl_kunjungan'))
      ->join('sakwis_pemesanan', 'sakwis_pemesanan.id_pemesanan', '=', 'sakwis_pemesanan_paket.id_pemesanan', 'left')
      ->whereRaw("YEAR(tgl_kunjungan) = '$tahun' ")
      ->groupBy('id_paket')->first();

      $data['paket_favorit']  = $paket_favorit ? $paket_favorit->nama_paket : "-";

      $data['tot_transaksi'] = DB::table('sakwis_pemesanan')
      ->where('status_pemesanan', 'selesai')
      ->whereRaw("YEAR(tgl_kunjungan) = '$tahun' ")
      ->count();
    }else {
       $data['transaksi'] = DB::table('sakwis_pemesanan')
       ->join('sakwis_pemesanan_paket', 'sakwis_pemesanan_paket.id_pemesanan', '=', 'sakwis_pemesanan.id_pemesanan')
       ->join('sakwis_member', 'sakwis_pemesanan.id_member', '=', 'sakwis_member.id_member')
       ->where('status_pemesanan', 'selesai')
       ->paginate(10);

       $data['total_pendapatan'] = 0;
       $data['paket_favorit'] = 0;
       $data['tot_transaksi'] = 0;
    }

    return $data;

   }

   function kunjungan(Request $request){
      //ambil data dari fungsi
      $data = $this->ambil_data_kunjungan($request) ;
   
   //  dd($data);

      return view('pages.admin.laporan.dashboard-kunjungan', $data);
   }

   function cetak_kunjungan(Request $request){
    //ambil data dari fungsi
      $data = $this->ambil_data_kunjungan($request) ;
   
   //  dd($data);

      return view('pages.admin.laporan.cetak-kunjungan', $data);
   }

   function ambil_data_kunjungan($request){
      $tipe = $request->get('tipe');
      $status = $request->get('status');
      $tanggal_mulai = $request->get('tanggal_mulai');
      $tanggal_selesai = $request->get('tanggal_selesai');
      $bulan_thn = explode("-", $request->get('bulan'));
      $bulan = @$bulan_thn[0];
      $tahun = @$bulan_thn[1];

      // dd($bulan_thn);

    // $data["pemesanan"] = Pemesanan::all();
    $query_where_status = "";
    if (!empty($status)) {
      if ($status == 'semua') {
        $query_where_status = "status_pemesanan IN ('selesai', 'batal')";
      } else {
        $query_where_status = "status_pemesanan = '$status'";
      }
    } else {
      $query_where_status = "status_pemesanan IN ('selesai', 'batal')";
    }
    
    if ($tipe == 'semua' || empty($tipe)) {
       //data total kunjungan/ yg status selesai
       $data['tot_kunjungan'] = DB::table('sakwis_pemesanan')->where('status_pemesanan', 'selesai')->count();

       //data total kunjungan/ yg status batal
       $data['tot_kunjungan_batal'] = DB::table('sakwis_pemesanan')->where('status_pemesanan', 'batal')->count();

       //data total wisatawan yg status selesai
       $data['tot_wisatawan'] = DB::table('sakwis_pemesanan')->select(DB::raw('SUM(jumlah_wisatawan) as tot_wisatawan'))->where('status_pemesanan', 'selesai')->first()->tot_wisatawan;

       //data total wisatawan yg status batal
       $data['tot_wisatawan_batal'] = DB::table('sakwis_pemesanan')->select(DB::raw('SUM(jumlah_wisatawan) as tot_wisatawan'))->where('status_pemesanan', 'batal')->first()->tot_wisatawan;

      //tampilkan table data kunjungan dengan status selesai & batal
        $query_kunjungan = DB::table('sakwis_pemesanan')
       ->join('sakwis_pemesanan_paket', 'sakwis_pemesanan_paket.id_pemesanan', '=', 'sakwis_pemesanan.id_pemesanan')
       ->join('sakwis_member', 'sakwis_pemesanan.id_member', '=', 'sakwis_member.id_member');

       if (!empty($query_where_status)) {
        $query_kunjungan = $query_kunjungan->whereRaw($query_where_status);
       }

       $data['kunjungan'] = $query_kunjungan->paginate(10);
 
    } elseif ($tipe == 'mingguan') {
       //tampilkan table data transaksi dengan status selesai & batal
       $query_kunjungan= DB::table('sakwis_pemesanan')
       ->join('sakwis_pemesanan_paket', 'sakwis_pemesanan_paket.id_pemesanan', '=', 'sakwis_pemesanan.id_pemesanan')
       ->join('sakwis_member', 'sakwis_pemesanan.id_member', '=', 'sakwis_member.id_member')
       ->whereRaw("tgl_kunjungan >= '$tanggal_mulai' ")
       ->whereRaw("tgl_kunjungan <= '$tanggal_selesai' ");

       if (!empty($query_where_status)) {
        $query_kunjungan = $query_kunjungan->whereRaw($query_where_status);
       }
       $data['kunjungan'] = $query_kunjungan->paginate(10);


      //data total kunjungan/ yg status selesai
       $data['tot_kunjungan'] = DB::table('sakwis_pemesanan')
      ->where('status_pemesanan', 'selesai')
      ->whereRaw("tgl_kunjungan >= '$tanggal_mulai' ")
      ->whereRaw("tgl_kunjungan <= '$tanggal_selesai' ")
      ->count();

      //data total kunjungan/ yg status batal
       $data['tot_kunjungan_batal'] = DB::table('sakwis_pemesanan')
      ->where('status_pemesanan', 'batal')
      ->whereRaw("tgl_kunjungan >= '$tanggal_mulai' ")
      ->whereRaw("tgl_kunjungan <= '$tanggal_selesai' ")
      ->count();

       //data total wisatawan yg status selesai
       $data['tot_wisatawan'] = DB::table('sakwis_pemesanan')->select(DB::raw('SUM(jumlah_wisatawan) as tot_wisatawan, tgl_kunjungan'))
       ->where('status_pemesanan', 'selesai')
       ->whereRaw("tgl_kunjungan >= '$tanggal_mulai' ")
      ->whereRaw("tgl_kunjungan <= '$tanggal_selesai' ")
      ->first()->tot_wisatawan ?? 0;

       //data total wisatawan yg status batal
       $data['tot_wisatawan_batal'] = DB::table('sakwis_pemesanan')->select(DB::raw('SUM(jumlah_wisatawan) as tot_wisatawan, tgl_kunjungan'))
       ->where('status_pemesanan', 'batal')
       ->whereRaw("tgl_kunjungan >= '$tanggal_mulai' ")
      ->whereRaw("tgl_kunjungan <= '$tanggal_selesai' ")
      ->first()->tot_wisatawan ?? 0;

    } elseif ($tipe == 'bulanan') {
      //tampilkan data kunjungan dengan status selesai & batal
        $query_kunjungan = DB::table('sakwis_pemesanan')
       ->join('sakwis_pemesanan_paket', 'sakwis_pemesanan_paket.id_pemesanan', '=', 'sakwis_pemesanan.id_pemesanan')
       ->join('sakwis_member', 'sakwis_pemesanan.id_member', '=', 'sakwis_member.id_member');

       $query_kunjungan->whereRaw("MONTH(tgl_kunjungan) = '$bulan' ");

       if (!empty($query_where_status)) {
        $query_kunjungan->whereRaw($query_where_status);
       }
       
       $data['kunjungan'] = $query_kunjungan->paginate(10);

      //data total kunjungan/ yg status selesai
       $data['tot_kunjungan'] = DB::table('sakwis_pemesanan')
      ->where('status_pemesanan', 'selesai')
      ->whereRaw("MONTH(tgl_kunjungan) = '$bulan' ")
      ->count();

      //data total kunjungan/ yg status batal
       $data['tot_kunjungan_batal'] = DB::table('sakwis_pemesanan')
      ->where('status_pemesanan', 'batal')
      ->whereRaw("MONTH(tgl_kunjungan) = '$bulan' ")
      ->count();

       //data total wisatawan yg status selesai
       $data['tot_wisatawan'] = DB::table('sakwis_pemesanan')->select(DB::raw('SUM(jumlah_wisatawan) as tot_wisatawan, tgl_kunjungan'))
       ->where('status_pemesanan', 'selesai')
      ->whereRaw("MONTH(tgl_kunjungan) = '$bulan' ")
      ->first()->tot_wisatawan;

       //data total wisatawan yg status batal
       $data['tot_wisatawan_batal'] = DB::table('sakwis_pemesanan')->select(DB::raw('SUM(jumlah_wisatawan) as tot_wisatawan, tgl_kunjungan'))
       ->where('status_pemesanan', 'batal')
      ->whereRaw("MONTH(tgl_kunjungan) = '$bulan' ")
      ->first()->tot_wisatawan;

    }elseif ($tipe == 'tahunan') {
       $tahun = $request->input('tahun');

      //tampilkan data table kunjungan dengan status selesai & batal
       $query_kunjungan = DB::table('sakwis_pemesanan')
       ->join('sakwis_pemesanan_paket', 'sakwis_pemesanan_paket.id_pemesanan', '=', 'sakwis_pemesanan.id_pemesanan')
       ->join('sakwis_member', 'sakwis_pemesanan.id_member', '=', 'sakwis_member.id_member');

       $query_kunjungan->whereRaw("YEAR(tgl_kunjungan) = '$tahun' ");

      if (!empty($query_where_status)) {
        $query_kunjungan->whereRaw($query_where_status);
      }

       $data['kunjungan'] = $query_kunjungan->paginate(10);

      //data total kunjungan yg status selesai
       $data['tot_kunjungan'] = DB::table('sakwis_pemesanan')
      ->where('status_pemesanan', 'selesai')
       ->whereRaw("YEAR(tgl_kunjungan) = '$tahun' ")
      ->count();

      //data total kunjungan yg status batal
       $data['tot_kunjungan_batal'] = DB::table('sakwis_pemesanan')
      ->where('status_pemesanan', 'batal')
       ->whereRaw("YEAR(tgl_kunjungan) = '$tahun' ")
      ->count();

       //data total wisatawan yg status selesai
       $data['tot_wisatawan'] = DB::table('sakwis_pemesanan')->select(DB::raw('SUM(jumlah_wisatawan) as tot_wisatawan, tgl_kunjungan'))
       ->where('status_pemesanan', 'selesai')
       ->whereRaw("YEAR(tgl_kunjungan) = '$tahun' ")
      ->first()->tot_wisatawan;

       //data total wisatawan yg status batal
       $data['tot_wisatawan_batal'] = DB::table('sakwis_pemesanan')->select(DB::raw('SUM(jumlah_wisatawan) as tot_wisatawan, tgl_kunjungan'))
       ->where('status_pemesanan', 'batal')
       ->whereRaw("YEAR(tgl_kunjungan) = '$tahun' ")
      ->first()->tot_wisatawan;

    }else {
       $data['kunjungan'] = DB::table('sakwis_pemesanan')
       ->join('sakwis_pemesanan_paket', 'sakwis_pemesanan_paket.id_pemesanan', '=', 'sakwis_pemesanan.id_pemesanan')
       ->join('sakwis_member', 'sakwis_pemesanan.id_member', '=', 'sakwis_member.id_member')
       ->where('status_pemesanan', 'selesai')
       ->paginate(10);

       $data['tot_kunjungan'] = 0;
       $data['tot_wisatawan'] = 0;

       $data['tot_kunjungan_batal'] = 0;
       $data['tot_wisatawan_batal'] = 0;
    }

    return $data;

   }

}