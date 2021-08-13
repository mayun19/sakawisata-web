<?php
//deklarasi namespace u/ beritahu letak file controller 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
	function cek_tanggal (Request $request) {
		date_default_timezone_set("Asia/Jakarta");

		$period = new \DatePeriod(
			new \DateTime(date("Y-m-d")),
			new \DateInterval('P1D'),
			new \DateTime(date('Y-m-d', strtotime(date("Y-m-d") . ' +30 day')) ) );

		$data['disable_date'] = array();
		$out = array();
		foreach ($period as $key => $value) 
		{
			$tanggal = $value->format('Y-m-d');

			$cek_sesi = array();
			$sesis = DB::table("sakwis_sesi")->get();
			foreach ($sesis as $kuy => $tiap) 
			{
        //cek apakah sesi ini penuh di tanggal ini
				$cek = DB::select("SELECT SUM(jumlah_wisatawan) as jumlah_wisatawan FROM sakwis_pemesanan WHERE status_pemesanan NOT IN ('Batal', 'Kedaluarsa') AND tgl_kunjungan='$tanggal' AND waktu_kunjungan_pemesanan='$tiap->id_sesi' ");

				if(isset($cek[0]) && $cek[0]->jumlah_wisatawan == null){
					$cek[0]->jumlah_wisatawan = 0;
				}
			
				$pengaturan = DB::table("sakwis_pengaturan")->where("nama_pengaturan","kuota_mak_sesi")->first();
				
				$kuota_mak_sesi = $pengaturan->isi_pengaturan;

				$tiap->kuota_mak_sesi = $kuota_mak_sesi;
				$tiap->sisa_kuota = $kuota_mak_sesi - $cek[0]->jumlah_wisatawan;
        
				$tiap->status_ketersediaan = ($tiap->sisa_kuota - $request->rombonganku) >= 0 ? "tersedia" : "penuh";

				$cek_sesi[] = $tiap->status_ketersediaan;

				$out[$key]['sesi'][] = $tiap;

			}
			$out[$key]['tanggal'] = $value->format('Y-m-d');
			$out[$key]['status_tanggal'] = in_array("tersedia", $cek_sesi) ? "tersedia" : "penuh";
		}

		$disable_date = array();
		foreach ($out as $key => $per_tanggal) 
		{
			if ($per_tanggal['status_tanggal']=="penuh"){
				$disable_date[] = $per_tanggal['tanggal'];
			}
		}
		return response()->json($disable_date, 200);
    
	}

	function cek_sesi(Request $request){
		$tanggal = date("Y-m-d", strtotime($request->tanggal));
		$cek_sesi = array();
		$sesis = DB::table("sakwis_paket_sesi")
		->join("sakwis_sesi", "sakwis_paket_sesi.id_sesi", "=", "sakwis_sesi.id_sesi")
		->where("id_paket", "=",$request->id_paket)
		->get();

		foreach ($sesis as $kuy => $tiap) {
			//cek apakah sesi penuh pada tanggal tsb
			$cek = DB::select("SELECT SUM(jumlah_wisatawan) as jumlah_wisatawan FROM sakwis_pemesanan WHERE status_pemesanan NOT IN ('Batal', 'Kedaluarsa') AND tgl_kunjungan='$tanggal' AND waktu_kunjungan_pemesanan='$tiap->id_sesi' ");

			
			$pengaturan = DB::table("sakwis_pengaturan")->where("nama_pengaturan","kuota_mak_sesi")->first();
			$kuota_mak_sesi = $pengaturan->isi_pengaturan;
			$tiap->kuota_mak_sesi = $kuota_mak_sesi;
			$tiap->sisa_kuota = $kuota_mak_sesi - $cek[0]->jumlah_wisatawan;
      
			$tiap->status_ketersediaan = ($tiap->sisa_kuota-$request->jumlah) >= 0 ? "tersedia":"penuh";
			$cek_sesi[] = $tiap;

		}

		echo json_encode($cek_sesi);
	}
}