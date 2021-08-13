<?php
//deklarasi namespace u/ beritahu letak file controller 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Facades\File;

/* kirim email */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


// panggil model member, maka harus buat file app/Member.php
use App\Pemesanan;
use App\Pemandu;
use App\Pengaturan;

class PemesananController extends Controller
{
   public function index () {

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

    // dd($data);

    return view ('pages.admin.pemesanan.pemesanan', $data);
   }

   private function update_status($id_pemesanan){
     $cek_pemesanan = DB::table('sakwis_pemesanan')->where('id_pemesanan', $id_pemesanan)->first();

     if($cek_pemesanan->batas_pemesanan < date("Y-m-d H:i:s") && $cek_pemesanan->status_pemesanan == 'Pending'){
       $update['status_pemesanan'] = 'Kedaluarsa';

       DB::table('sakwis_pemesanan')->where('id_pemesanan', $id_pemesanan)->update($update);
     }
   }

   function detailpesan(Pemesanan $pemesanan){
    $data["pemesanan"] = DB::table('sakwis_pemesanan')
    ->join('sakwis_pemesanan_paket', 'sakwis_pemesanan_paket.id_pemesanan', '=', 'sakwis_pemesanan.id_pemesanan')
    ->join('sakwis_member', 'sakwis_member.id_member', '=', 'sakwis_pemesanan.id_member')
    ->where('sakwis_pemesanan.id_pemesanan', $pemesanan->id_pemesanan)
    ->first();

    // dd($data);

    // dd($pemesanan);
     $data['pemandu']= Pemandu::all();
     $data['pemandu_pemesanan'] = DB::table('sakwis_pemesanan_pemandu')
     ->where('id_pemesanan', $pemesanan->id_pemesanan)
     ->get();

    // $jumlah_pemandu = $pemesanan->jumlah_wisatawan

    $data["pembayaran"] = DB::table('sakwis_pembayaran')->where("id_pemesanan", $pemesanan->id_pemesanan)->get();

    $data['telah_dibayar'] = 0;
    //hitung total tagihan yang sudah dibayar dengan perulangan
    foreach ($data['pembayaran'] as $key => $value) {
      if ($value->status_pembayaran =='Diverifikasi') {
        $data['telah_dibayar'] += $value->jumlah_pembayaran;
      }
    }
     
    return view('pages.admin.pemesanan.detail-pemesanan', $data);
   }

   function update_info_pemesanan(Request $request, Pemesanan $pemesanan){

      $messages = [
       'required' => ':attribute wajib disi.'
     ];

      $this->validate($request,[
      'jumlah_wisatawan' => 'required',
      'jumlah_paket' => 'required',
    ], $messages);

    //gunakan model member u/ ambil data member dari database
    $data_update['keterangan_pemesanan'] = $request->keterangan_pemesanan;
    $data_update['jumlah_wisatawan'] = $request->jumlah_wisatawan;
    $data_update['jumlah_paket'] = $request->jumlah_paket;
    $data_update['jumlah_wisatawan_tambahan'] = $request->jumlah_wisatawan_tambahan;
    
    $data_update['biaya_pemesanan'] = $request->biaya_pemesanan;
    $data_update['biaya_tambahan'] = $request->biaya_tambahan;
    $data_update['total_pemesanan'] = $request->total_pemesanan;


    DB::table('sakwis_pemesanan')->where('id_pemesanan', $pemesanan->id_pemesanan)->update($data_update);

    //hapus data pemandu sebelumnya
    $data_pemandu_old = DB::table('sakwis_pemesanan_pemandu')->where('id_pemesanan', $pemesanan->id_pemesanan)->delete();

    $pemandu = $request->id_pemandu;

    //masukkan ulang dgn data pemandu baru
    foreach ($pemandu as $key => $id_pemandu) {
      $data_pemandu[$key]['id_pemandu'] = $id_pemandu;
      $data_pemandu[$key]['id_pemesanan'] = $pemesanan->id_pemesanan;
    }

    DB::table('sakwis_pemesanan_pemandu')->insert($data_pemandu);

    return redirect('admin/pemesanan/detail_pemesanan/'. $pemesanan->id_pemesanan)->with('pesan', 'Pemesanan berhasil diperbaharui');

  }

   function input_bayar(Request $request, $id_pemesanan){
    // $id_member = session('id');
    date_default_timezone_set('Asia/Jakarta');

    // dd($request->all());
      $jumlah_pembayaran_unmask = str_replace(".", "", $request->jumlah_pembayaran);
      $total_pemesanan_unmask = str_replace(".", "", $request->total_pemesanan);
      $telah_dibayar_unmask = str_replace(".", "", $request->telah_dibayar);
      // $pemesanan->biaya_pemesanan_unmask = str_replace(".", "", $request->biaya_pemesanan);

      // $min_dp = 30 / 100 * ($total_pemesanan_unmask);
      $max = $total_pemesanan_unmask - $telah_dibayar_unmask;

      if($jumlah_pembayaran_unmask > $max){
        return redirect()->back()->with('error', 'jumlah pembayaran berlebih dari jumlah perlu dibayar');
      }

    DB::beginTransaction();
    try{
      $pemesanan = DB::table('sakwis_pemesanan')
      ->join('sakwis_pemesanan_paket', 'sakwis_pemesanan_paket.id_pemesanan', '=', 'sakwis_pemesanan.id_pemesanan')
      ->where('sakwis_pemesanan.id_pemesanan', $id_pemesanan)
      ->first();

      // dd($pemesanan);
  
      // apakah inputan jumlah_pembayaran kurang dari total_pemesanan
      // maka jenis_pembayarannya = DP
      if ($jumlah_pembayaran_unmask < $pemesanan->total_pemesanan) {
        $tipe_pembayaran = 'DP';
      } elseif ($jumlah_pembayaran_unmask == $pemesanan->total_pemesanan) {
        $tipe_pembayaran = 'Lunas';
      } 
      //cek pembayaran per id_pemesanan
      $pembayaran = DB::table('sakwis_pembayaran')->where("id_pemesanan", $pemesanan->id_pemesanan)->get();

      
      $telah_dibayar = 0;
      
      //hitung total tagihan yang sudah dibayar dg perulangan
      
      foreach ($pembayaran as $key => $value) {
        if ($value->status_pembayaran == 'Diverifikasi') {
          $telah_dibayar += $value->jumlah_pembayaran;
        }
      }
      
      $sisa_pembayaran = $pemesanan->total_pemesanan - $telah_dibayar;
      // dd($sisa_pembayaran);
      
      if ($jumlah_pembayaran_unmask == $sisa_pembayaran) {
        $tipe_pembayaran = 'Lunas';
      }

      // dd($jumlah_pembayaran_unmask);

      //siapkan data yang akan diinsertkan
      $data['id_pemesanan'] = $id_pemesanan;

      $data['jumlah_pembayaran'] = $jumlah_pembayaran_unmask;
      $data['tipe_pembayaran'] = $tipe_pembayaran;
      $data['jenis_pembayaran'] = 'Setor tunai';
      $data['bukti_pembayaran'] = "-";
      $data['status_pembayaran'] = 'Diverifikasi';
      $data['nama_bank'] = 'Setor Tunai';
      $data['no_rekening'] = 000;
      $data['nama_rekening'] = 'Setor Tunai';
      $data['tgl_pembayaran'] = date("Y-m-d");
      $data['tgl_konfirmasi'] = date("Y-m-d");
      $data['kode_pembayaran'] = "SW" . $id_pemesanan;
      
      //insertkan data ke tb pembayaran
      DB::table('sakwis_pembayaran')->insert($data);
  
      //ambil id yang barusan diinsertkan
      $id_pembayaran = DB::getPdo()->lastInsertId();
      
      // //ambil id pembayaran
      // $bayar = DB::table('sakwis_pembayaran')->where("id_pembayaran", $id_pembayaran)->first();
  
      //buat kode (kunjungan) bila belum ada kode kunjungan
      if (empty($pemesanan->kode_kunjungan)) {
        $data_update_pemesanan['kode_kunjungan'] = "SW" . $id_pembayaran;
        //update kode kunjungan baru
        DB::table('sakwis_pemesanan')->where("id_pemesanan", $id_pemesanan)->update($data_update_pemesanan);
      }

      
      if ($tipe_pembayaran == 'Lunas') {
        $dataPemesanan['status_pemesanan'] = "Proses";
      } else {
        $dataPemesanan['status_pemesanan'] = "DP";
      }


      //update status_pemesanan dari table pemesanan
      DB::table('sakwis_pemesanan')->where('id_pemesanan', $id_pemesanan)->update($dataPemesanan);
      
      //ambil data
      $data['id_pembayaran'] = $id_pembayaran;

      $data['member'] = DB::table('sakwis_member')->where('id_member', $pemesanan->id_member)->first();
  
      // dd($data['member']);
      $data["cek_pemandu"] = DB::table('sakwis_pemesanan_pemandu')
      ->join("sakwis_pemandu", "sakwis_pemesanan_pemandu.id_pemandu", "=", "sakwis_pemandu.id_pemandu")
      ->where("id_pemesanan", $pemesanan->id_pemesanan)
      ->count();
  
      $data["pemandu"] = DB::table('sakwis_pemesanan_pemandu')
      ->join("sakwis_pemandu", "sakwis_pemesanan_pemandu.id_pemandu", "=", "sakwis_pemandu.id_pemandu")
      ->where("id_pemesanan", $pemesanan->id_pemesanan)
      ->get();
  
      // $data['pengaturan'] = Pengaturan::all();
  
      $data['pemesanan'] = $pemesanan;

      $data["paket"] = DB::table('sakwis_pemesanan_paket')
      ->where("id_pemesanan", $pemesanan->id_pemesanan)
      ->first();
  
      $ada_pembayaran = DB::table('sakwis_pembayaran')->where('id_pemesanan', $pemesanan->id_pemesanan)->where('status_pembayaran', 'Diverifikasi')->count();
      // dd($ada_pembayaran);

      $data['telah_dibayar'] = DB::table('sakwis_pembayaran')->selectRaw('SUM(jumlah_pembayaran) as jumlah')->where('id_pemesanan', $id_pemesanan)->where('status_pembayaran', 'Diverifikasi')->first();
  
      // dd($data);
  
      if($ada_pembayaran == 1){
        $this->kirim_email_tiket($data);
        $this->kirim_email_konfirmasi_bayar($data);
      }else{
        $this->kirim_email_konfirmasi_bayar($data);
  
      }

      DB::commit();

      return redirect('admin/pemesanan/detail_pemesanan/'. $id_pemesanan)->with('pesan', 'Pemesanan berhasil diperbaharui');
    }catch (\Exception $e) {
      DB::rollback();
      echo "Error: " . $e;
       die;
     }

   }

  function kirim_email_tiket($data){
   //Instantiation and passing `true` enables exceptions
		$mail = new PHPMailer(true);
		// echo "<pre>";
    // print_r($mail);
    // echo "</pre>";

		try {
    //Server settings
    $mail->SMTPDebug = false;                     //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail.sakawisata.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'info@sakawisata.com';                     //SMTP username
    $mail->Password   = 'sakawis2021';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('info@sakawisata.com', 'SAKAWISATA');

    //Recipients
    // $mail->setFrom('sakwis@kafebelajar.com', 'SAKAWISATA');
    $mail->addAddress($data['member']->email_member, $data['member']->nama_member);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Tiket Kunjungan SAKAWISATA';
    $mail->Body    = view('pages.template.email_tiket', $data)->render();
		
    $mail->send();

    return true;

		} catch (Exception $e) {
			/* 	return redirect("daftar")->with("pesan","email tidak valid"); */
		echo "<pre>";
    print_r($e);
    echo "</pre>";
    die;
		}
   }

   function kirim_email_konfirmasi_bayar($data){
    //Instantiation and passing `true` enables exceptions
		$mail = new PHPMailer(true);

    	try {
    //Server settings
    $mail->SMTPDebug = false;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail.sakawisata.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'info@sakawisata.com';                     //SMTP username
    $mail->Password   = 'sakawis2021';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('info@sakawisata.com', 'SAKAWISATA');
    $mail->addAddress($data['member']->email_member, $data['member']->nama_member);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Pembayaran Kunjungan SAKAWISATA Berhasil Diterima';
    $mail->Body    = view('pages.template.email_konfirmasi_bayar', $data)->render();
		
    $mail->send();

    return true;

		} catch (Exception $e) {
			/* 	return redirect("daftar")->with("pesan","email tidak valid"); */
		echo "<pre>";
    print_r($e);
    echo "</pre>";
    die;
		}
   }

   function detailbayar($id_pemesanan){
     $data["pembayaran"] = DB::table('sakwis_pembayaran')
     ->join("sakwis_pemesanan", "sakwis_pemesanan.id_pemesanan", "=", "sakwis_pembayaran.id_pemesanan")
     ->where("sakwis_pemesanan.id_pemesanan", $id_pemesanan)->where("sakwis_pembayaran.status_pembayaran", 'Diverifikasi')
     ->get();

     return view('pages.admin.pemesanan.detail-pembayaran', $data);
   }

   function verifikasi_pembayaran($id_pembayaran){
    //  $id_member = session('id');
     //dapatkan dulu data detail pembayarannya
    $pembayaran = DB::table('sakwis_pembayaran')->where("id_pembayaran", $id_pembayaran)->first();
    
    $tipe_pembayaran = $pembayaran->tipe_pembayaran;
    $id_pemesanan = $pembayaran->id_pemesanan;
    
    $pemesanan_detail = DB::table('sakwis_pemesanan')->where("id_pemesanan", $id_pemesanan)->first();
    $cek_pembayaran = DB::table('sakwis_pembayaran')->where('id_pemesanan', $id_pemesanan)->where('status_pembayaran', 'Diverifikasi')->count();

    $total_pemesanan = $pemesanan_detail->total_pemesanan;
    $min_dp = 30/100 *($total_pemesanan);

     
     if ($tipe_pembayaran=="Lunas") {
       $masuk["status_pemesanan"] = "Proses";
      }elseif($pembayaran->jumlah_pembayaran < $min_dp && $cek_pembayaran == 0){
        $masuk["status_pemesanan"] = "Pending";
      }else{
        $masuk["status_pemesanan"] = "DP";
      }
      
      // detail pemesanan
      if(empty($pemesanan_detail->kode_kunjungan)) {
         $masuk["kode_kunjungan"] = "SW".$pembayaran->id_pembayaran;
      }
      DB::table('sakwis_pemesanan')->where("id_pemesanan", $id_pemesanan)->update($masuk);

      
      $mlebu['status_pembayaran'] = "Diverifikasi";
      DB::table('sakwis_pembayaran')->where("id_pembayaran", $id_pembayaran)->update($mlebu);

    //ambil pembayaran
     $data['kode_pembayaran'] = $pembayaran->kode_pembayaran;
     $data['id_pembayaran'] = $pembayaran->id_pembayaran;
     $data['tgl_pembayaran'] = $pembayaran->tgl_pembayaran;
     $data['jumlah_pembayaran'] = $pembayaran->jumlah_pembayaran;
     $data['tipe_pembayaran'] = $pembayaran->tipe_pembayaran;
     $data['jenis_pembayaran'] = $pembayaran->jenis_pembayaran;
      //ambil data
    $data['pemesanan'] = DB::table('sakwis_pemesanan')
    ->where('id_pemesanan', $id_pemesanan)->first();
      
    $data['member'] = DB::table('sakwis_member')->join('sakwis_pemesanan', 'sakwis_pemesanan.id_member', '=', 'sakwis_member.id_member')->where('id_pemesanan', $id_pemesanan)->first();

    $data["paket"] = DB::table('sakwis_pemesanan_paket')
    ->where("id_pemesanan", $id_pemesanan)
    ->first();

    $data["cek_pemandu"] = DB::table('sakwis_pemesanan_pemandu')
    ->join("sakwis_pemandu", "sakwis_pemesanan_pemandu.id_pemandu", "=", "sakwis_pemandu.id_pemandu")
    ->where("id_pemesanan", $id_pemesanan)
    ->count();

    $data["pemandu"] = DB::table('sakwis_pemesanan_pemandu')
    ->join("sakwis_pemandu", "sakwis_pemesanan_pemandu.id_pemandu", "=", "sakwis_pemandu.id_pemandu")
    ->where("id_pemesanan", $id_pemesanan)
    ->get();

    // dd($data); 
    
    $ada_pembayaran = DB::table('sakwis_pembayaran')->where('id_pemesanan', $id_pemesanan)->where('status_pembayaran', 'Diverifikasi')->count();

    $data['telah_dibayar'] = DB::table('sakwis_pembayaran')->selectRaw('SUM(jumlah_pembayaran) as jumlah')->where('id_pemesanan', $id_pemesanan)->where('status_pembayaran', 'Diverifikasi')->first();


    // dd($data);
    // dd($pemesanan_pemandu);

     //proses kirim email
     if($pembayaran->jumlah_pembayaran > 0 ){
       if($ada_pembayaran == 1){
         $this->kirim_email_tiket($data);
         $this->kirim_email_konfirmasi_bayar($data);
       }else{
         $this->kirim_email_konfirmasi_bayar($data);
       }
     }else{
       $this->kirim_email_konfirmasi_bayar($data);
     }
    return redirect('admin/pemesanan');
   }

  function ubah_pembayaran(Request $request, $id_pembayaran){
    $pembayaran = DB::table('sakwis_pembayaran')->where('id_pembayaran', $id_pembayaran)->first();

    $data['pembayaran'] = $pembayaran;

    return view('pages.admin.pemesanan.ubah-pembayaran', $data);
  }

  function update_pembayaran(Request $request, $id_pembayaran){
    //cek payment member
    $pemesanan = DB::table('sakwis_pemesanan')->where('id_pemesanan', $request->id_pemesanan)->first();

    //cek pembayaran per id_pemesanan
    $pembayaran = DB::table('sakwis_pembayaran')->where("id_pemesanan", $pemesanan->id_pemesanan)->get();

    $telah_dibayar = 0;

    foreach ($pembayaran as $key => $value) {
      if ($value->status_pembayaran == 'Diverifikasi') {
        $telah_dibayar += $value->jumlah_pembayaran;
      }
    }

    $total_pemesanan = $pemesanan->total_pemesanan;
    $min_dp = 30/100 *($total_pemesanan);

    $sisa_pembayaran = $pemesanan->total_pemesanan - $telah_dibayar;

    $jumlah_pembayaran_unmask = str_replace(".", "", $request->input('jumlah_baru'));

    $data_update['jumlah_pembayaran'] = $jumlah_pembayaran_unmask;

    if($data_update['jumlah_pembayaran'] == $total_pemesanan || $data_update['jumlah_pembayaran'] == $sisa_pembayaran) {
      $data_update['tipe_pembayaran'] = "Lunas";
    }else{
      $data_update['tipe_pembayaran'] = "DP";
    }

    // dd($sisa_pembayaran);

    DB::table('sakwis_pembayaran')->where('id_pembayaran', $id_pembayaran)->update($data_update);
    $this->verifikasi_pembayaran($id_pembayaran);

    $id_pemesanan = $request->input('id_pemesanan');

    return redirect('admin/pemesanan/detail_pemesanan/' . $id_pemesanan);
  }

   function proses_checkin($id_pemesanan){
     $data['status_pemesanan'] = 'Kunjungan';

     DB::table('sakwis_pemesanan')->where('id_pemesanan', $id_pemesanan)->update($data);

    //  dd($data);

     return redirect('admin/pemesanan');
   }

    function proses_selesai($id_pemesanan){
     $data['status_pemesanan'] = 'Selesai';

     DB::table('sakwis_pemesanan')->where('id_pemesanan', $id_pemesanan)->update($data);

     return redirect('admin/pemesanan');
   }

    function reschedule(Pemesanan $pemesanan){
         //ambil data yang akan ditampilkan
    $data['pemesanan'] = $pemesanan;
    $data['detail_pengajuan'] = DB::table('sakwis_reschedule')
      ->join('sakwis_sesi', 'sakwis_sesi.id_sesi', '=', 'sakwis_reschedule.sesi_reschedule')
      ->where('id_pemesanan', $pemesanan->id_pemesanan)->first();

    //ambil id_paket dari pemesanan_paket sesuai id_pemesanan
    $pemesanan_paket = DB::table('sakwis_pemesanan_paket')
      ->where('id_pemesanan', $pemesanan->id_pemesanan)->first();

    $id_paket = $pemesanan_paket->id_paket;

    //ambil paket sesi berdasarkan id_paket dipemesanan paket
    $paket_sesi = DB::table('sakwis_paket_sesi')
      ->join('sakwis_sesi', 'sakwis_sesi.id_sesi', '=', 'sakwis_paket_sesi.id_sesi')
      ->where('id_paket', $id_paket)->get();

    //dd($data['detail_pengajuan']);
    $data['id_paket'] = $id_paket;
    $data['paket_sesi'] = $paket_sesi;

    $reschedule = DB::table('sakwis_reschedule')->where('id_pemesanan', $pemesanan->id_pemesanan)->first();
    $data['reschedule'] = $reschedule;
    
    // dd($reschedule);

    $data['rekomendasi'] = DB::table('sakwis_rekomendasi_jadwal')->join('sakwis_sesi', 'sakwis_sesi.id_sesi', '=', 'sakwis_rekomendasi_jadwal.sesi_rekomendasi', 'left')
      ->where('id_reschedule', $reschedule->id_reschedule)->get();


    // KUOTA MAKSIMAL
    $pengaturan = DB::table("sakwis_pengaturan")->where("nama_pengaturan", "kuota_mak_sesi")->first();
    $kuota_mak_sesi = $pengaturan->isi_pengaturan;

    // CEK SESI
    $cek_sesi = DB::select("SELECT SUM(jumlah_wisatawan) as jumlah_wisatawan FROM sakwis_pemesanan WHERE status_pemesanan NOT IN ('Batal', 'Kedaluarsa', 'Jadwal Ulang') AND tgl_kunjungan='$reschedule->tanggal_reschedule' AND waktu_kunjungan_pemesanan='$reschedule->sesi_reschedule' ");

    $sisa_kuota = $kuota_mak_sesi - $cek_sesi[0]->jumlah_wisatawan;

    $data['sisa_kuota'] = $sisa_kuota;

    // AMBIL JARAK TANGGAL PENGAJUAN ke RESCHEDULE
    $tgl_pengajuan = date("d", strtotime($reschedule->tanggal_pengajuan));
    $tgl_reschedule = date("d", strtotime($reschedule->tanggal_reschedule));
    $jarak = $tgl_reschedule - $tgl_pengajuan;

    // dd($tgl_reschedule);

    if ($jarak < 3) {
      $tgl_mulai_rentang = $tgl_pengajuan + 3;
      $tgl_mulai_rentang = date("Y-m", strtotime($reschedule->tanggal_pengajuan)) . "-" . $tgl_mulai_rentang;
      $tgl_akhir_rentang = $tgl_mulai_rentang + 7;
    } else {
      $tgl_mulai_rentang = $tgl_reschedule - 3;
      if ($tgl_mulai_rentang < ($tgl_pengajuan + 3)) {
        $tgl_mulai_rentang = $tgl_pengajuan + 3;
      }
      $tgl_mulai_rentang = date("Y-m", strtotime($reschedule->tanggal_pengajuan)) . "-" . $tgl_mulai_rentang;
      $tgl_akhir_rentang = date("Y-m-d", strtotime($reschedule->tanggal_reschedule . "+7 days"));
    }


    // AMBIL RENTANG 7 HARI DARI TGL MULAI RENTANG
    $rentang = new \DatePeriod(
      new \DateTime($tgl_mulai_rentang),
      new \DateInterval('P1D'),
      new \DateTime(date('Y-m-d', strtotime($tgl_akhir_rentang)))
    );

    // dd($rentang);

    $semua_sesi_dalam_rentang = array();
    foreach ($rentang as $key => $value) {
      $tanggal = $value->format("Y-m-d");
      // ambil semua sesi tersedia 
      $sesis = DB::table("sakwis_sesi")->get();
      foreach ($sesis as $kuy => $tiap) {
        //cek apakah sesi ini penuh di tanggal ini
        $cek = DB::select("SELECT SUM(jumlah_wisatawan) as jumlah_wisatawan FROM sakwis_pemesanan WHERE status_pemesanan NOT IN ('Batal', 'Kedaluarsa', 'Jadwal Ulang') AND tgl_kunjungan='$tanggal' AND waktu_kunjungan_pemesanan='$tiap->id_sesi' ");

        if (isset($cek[0]) && $cek[0]->jumlah_wisatawan == null) {
          $cek[0]->jumlah_wisatawan = 0;
        }

        $tiap->tanggal = $tanggal;
        $tiap->sisa_kuota = $kuota_mak_sesi - $cek[0]->jumlah_wisatawan;
        $semua_sesi_dalam_rentang[$key][] = $tiap;
      }
    }

    // dd($semua_sesi_dalam_rentang);

    $data['rentang_sesi'] = $semua_sesi_dalam_rentang;


    return view('pages.admin.pemesanan.reschedule', $data);
   }

  function terima_reschedule($id_reschedule)
  {
    $dataTerima['status_reschedule'] = 'Diterima';

    $pengajuan = DB::table('sakwis_reschedule')->where('id_reschedule', $id_reschedule);
    // update status reschedule
    $pengajuan->update($dataTerima);

    // ambil detail pengajuan
    $detail_pengajuan = $pengajuan->first();

    // cek status pembayaran terakhir
    $cek_pembayaran = DB::table('sakwis_pembayaran')
      ->join("sakwis_pemesanan", "sakwis_pemesanan.id_pemesanan", "=", "sakwis_pembayaran.id_pemesanan")
      ->where("sakwis_pemesanan.id_pemesanan", $detail_pengajuan->id_pemesanan)
      ->where("sakwis_pembayaran.tipe_pembayaran", 'Lunas')
      ->count();

    if ($cek_pembayaran == 0) {
      $dataPemesanan['status_pemesanan'] = "DP";
    } else {
      $dataPemesanan['status_pemesanan'] = "Proses";
    }

    $dataPemesanan['waktu_kunjungan_pemesanan'] = $detail_pengajuan->sesi_reschedule;
    $dataPemesanan['tgl_kunjungan'] = $detail_pengajuan->tanggal_reschedule;


    DB::table('sakwis_pemesanan')->where('id_pemesanan', $detail_pengajuan->id_pemesanan)->update($dataPemesanan);

    //ambil data update kunjungan
    $data['pemesanan'] = DB::table('sakwis_pemesanan')
    ->join('sakwis_member', 'sakwis_member.id_member', '=', 'sakwis_pemesanan.id_member')
    ->join('sakwis_sesi', 'sakwis_sesi.id_sesi', '=', 'sakwis_pemesanan.waktu_kunjungan_pemesanan')
    ->where('id_pemesanan', $detail_pengajuan->id_pemesanan)->first();

    $data["paket"] = DB::table('sakwis_pemesanan_paket')
    ->where("id_pemesanan", $detail_pengajuan->id_pemesanan)
    ->first();


    /* kirim email reschedule diterima */
    $this->email_reschedule_diterima($data);

    return redirect('admin/pemesanan')->with('sukses', 'Jadwal kunjungan berhasil diganti!');
  }

  function email_reschedule_diterima($data){
  //Instantiation and passing `true` enables exceptions
	$mail = new PHPMailer(true);

  try {
    //Server settings
    $mail->SMTPDebug = false;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail.sakawisata.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'info@sakawisata.com';                     //SMTP username
    $mail->Password   = 'sakawis2021';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('info@sakawisata.com', 'SAKAWISATA');
    $mail->addAddress($data['pemesanan']->email_member, $data['pemesanan']->nama_member);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Reschedule Kunjungan SAKAWISATA Diterima';
    $mail->Body    = view('pages.template.email_member_reschedule', $data)->render();
		
    $mail->send();

    return true;

		} catch (Exception $e) {
			/* 	return redirect("daftar")->with("pesan","email tidak valid"); */
		echo "<pre>";
    print_r($e);
    echo "</pre>";
    die;
		}

  }
    
  function kirim_rekomendasi(Request $request, $id_reschedule){
      foreach ($request->tanggal_rekomendasi as $key => $value) {
        $tgl = $value;
        $sesi = $request->sesi_rekomendasi[$key];

        $cek = DB::table('sakwis_rekomendasi_jadwal')->where('tanggal_rekomendasi', $tgl)->where('sesi_rekomendasi', $sesi)->count();

        if ($value != null && $cek == 0) {
          $data_insert['id_reschedule'] = $id_reschedule;
          $data_insert['tanggal_rekomendasi'] = $value;
          $data_insert['sesi_rekomendasi'] = $request->sesi_rekomendasi[$key];
          DB::table('sakwis_rekomendasi_jadwal')->insert($data_insert) ;
        }
      }

      //ambil id_pemesanan dari id_reschedule
      $reschedule = DB::table('sakwis_reschedule')->where('id_reschedule', $id_reschedule)->first();

      $id_pemesanan = $reschedule->id_pemesanan;

      $data_update['status_reschedule'] = 'Direkomendasikan';

      DB::table('sakwis_reschedule')->where('id_reschedule', $id_reschedule)->update($data_update);

      /* ambil data rekomendasi reschedule */
      $data['pemesanan'] = DB::table('sakwis_pemesanan')->join('sakwis_member', 'sakwis_member.id_member', '=', 'sakwis_pemesanan.id_member')->where('id_pemesanan', $id_pemesanan)->first();

      // $data['sesi'] = DB::table('sakwis_pemesanan')->join('sakwis_sesi', 'sakwis_sesi.id_sesi', '=', 'sakwis_pemesanan.waktu_kunjungan_pemesanan')->where('id_pemesanan', $id_pemesanan)->first();

      $data['reschedule'] = $reschedule;

      // dd($data);

      /* kirim email rekomendasi reschedule ke member */
      $this->email_reschedule_rekomendasi($data);

      return redirect("admin/pemesanan/reschedule/$id_pemesanan")->with('pesan', "Rekomendasi berhasil dikirimkan!");
  }

  function email_reschedule_rekomendasi($data){
  $mail = new PHPMailer(true);

  try {
    //Server settings
    $mail->SMTPDebug = false;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail.sakawisata.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'info@sakawisata.com';                     //SMTP username
    $mail->Password   = 'sakawis2021';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('info@sakawisata.com', 'SAKAWISATA');
    $mail->addAddress($data['pemesanan']->email_member, $data['pemesanan']->nama_member);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Reschedule Kunjungan SAKAWISATA Ditolak';
    $mail->Body    = view('pages.template.email_member_reschedule_tolak', $data)->render();
		
    $mail->send();

    return true;

		} catch (Exception $e) {
			/* 	return redirect("daftar")->with("pesan","email tidak valid"); */
		echo "<pre>";
    print_r($e);
    echo "</pre>";
    die;
		}

  }

  function reschedule_list(){
     $data['reschedule'] = DB::table('sakwis_pemesanan')
     ->join('sakwis_pemesanan_paket', 'sakwis_pemesanan_paket.id_pemesanan', '=', 'sakwis_pemesanan.id_pemesanan')
     ->join('sakwis_member', 'sakwis_pemesanan.id_member', '=', 'sakwis_member.id_member')
     ->join('sakwis_reschedule', 'sakwis_reschedule.id_pemesanan', '=', 'sakwis_pemesanan.id_pemesanan')
     ->where('status_reschedule', 'Pending')
     ->orderBy('sakwis_reschedule.id_reschedule', 'desc')
     ->get();

     return view('pages.admin.pemesanan.reschedule-list', $data);
   }

   function pembatalan_list(){
     $data['pembatalan'] = DB::table('sakwis_pemesanan')
      ->join('sakwis_pemesanan_paket', 'sakwis_pemesanan_paket.id_pemesanan', '=', 'sakwis_pemesanan.id_pemesanan')
      ->join('sakwis_member', 'sakwis_pemesanan.id_member', '=', 'sakwis_member.id_member')
      ->join('sakwis_pembatalan', 'sakwis_pembatalan.id_pemesanan', '=', 'sakwis_pemesanan.id_pemesanan')
      ->where('status_pemesanan', 'Batal')
      ->orderBy('sakwis_pembatalan.id_pembatalan', 'desc')
      ->get();

      // dd($data);
    return view('pages.admin.pemesanan.pembatalan-list', $data);
   }

   function pembatalan($id_pemesanan){
    $data['pembatalan'] = DB::table('sakwis_pembatalan')->where('id_pemesanan', $id_pemesanan)->first();

    $id_member = session('id');
 
    $data['member'] = DB::table('sakwis_member')->where('id_member', $id_member)->first();

    $data["pemesanan"]  = DB::table('sakwis_pemesanan')
    ->join('sakwis_pemesanan_paket', 'sakwis_pemesanan_paket.id_pemesanan', '=', 'sakwis_pemesanan.id_pemesanan')
    ->where("sakwis_pemesanan.id_pemesanan", $id_pemesanan)->first();

    $data['pembayaran'] = DB::table('sakwis_pembayaran')->selectRaw('SUM(jumlah_pembayaran) as jumlah')->where('id_pemesanan', $id_pemesanan)->where('status_pembayaran', 'Diverifikasi')->first();

    // dd($data);
    
    // $data['pembatalan'] = DB::table('sakwis_pembatalan')->where('id_pemesanan', $id_pemesanan)->first();

    return view('pages.admin.pemesanan.pembatalan', $data);
   }

   function pembatalan_proses(Request $request){
    date_default_timezone_set("Asia/Jakarta");
    $data_update['status_pembatalan'] = 'Proses Pembatalan';
    $data_update['tanggal_proses'] = date('Y-m-d H:i:s');
    // update pembatalan jadi proses dengan mengisi tanggal_proses
    DB::table('sakwis_pembatalan')->where('id_pembatalan', $request->id_pembatalan)->update($data_update);

    /* ambil data u/ kirim email */
    $pembatalan = DB::table('sakwis_pembatalan')->where('id_pembatalan', $request->id_pembatalan)->first();

    // dd($pembatalan);

    $data['pemesanan'] = DB::table('sakwis_pemesanan')->join('sakwis_member', 'sakwis_member.id_member', '=', 'sakwis_pemesanan.id_member')->where('id_pemesanan', $pembatalan->id_pemesanan)->first();

    // dd($data);

    /* kirim email ke member pembatalan diterima */
    $this->email_pembatalan_diterima($data);

    return redirect()->back()->with('pesan', 'Pembatalan berhasil diproses! Silakan lakukan refund dan unggah bukti refund.');
   }
   
   function email_pembatalan_diterima($data){
  $mail = new PHPMailer(true);

  try {
    //Server settings
    $mail->SMTPDebug = false;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail.sakawisata.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'info@sakawisata.com';                     //SMTP username
    $mail->Password   = 'sakawis2021';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('info@sakawisata.com', 'SAKAWISATA');
    $mail->addAddress($data['pemesanan']->email_member, $data['pemesanan']->nama_member);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Pembatalan Jadwal Kunjungan SAKAWISATA';
    $mail->Body    = view('pages.template.email_member_batal', $data)->render();
		
    $mail->send();

    return true;

		} catch (Exception $e) {
			/* 	return redirect("daftar")->with("pesan","email tidak valid"); */
		echo "<pre>";
    print_r($e);
    echo "</pre>";
    die;
		}

   }

   function pembatalan_refund(Request $request){
    date_default_timezone_set("Asia/Jakarta");

      $messages = [
       'required' => ':attribute wajib disi.'
    ];

    $dana_refund_unmask = str_replace(".", "", $request->dana_refund);

    $this->validate($request,[
      'dana_refund' => 'required',
      'bukti_refund' => 'required'
    ], $messages);

    $data['dana_refund'] = $dana_refund_unmask;
    $data['tanggal_selesai'] = date('Y-m-d H:i:s');
    $data['status_pembatalan'] = 'Pembatalan Selesai';

    $file = $request->file("bukti_refund");
    //mengupdate foto sebelumnya dgn yg terbaru
    if($file != null){
       $nama_file = $file->getClientOriginalName();
       $file_upload = $file->move('img/bukti_refund',$nama_file);
       $file_upload = str_replace("\\", "/", $file_upload);
       $data['bukti_refund'] = $file_upload;
    }
    DB::table('sakwis_pembatalan')->where('id_pembatalan', $request->id_pembatalan)->update($data);

    /* ambil data u/ kirim email */
    $pembatalan = DB::table('sakwis_pembatalan')->where('id_pembatalan', $request->id_pembatalan)->first();

    // dd($pembatalan);

    $data['pemesanan'] = DB::table('sakwis_pemesanan')->join('sakwis_member', 'sakwis_member.id_member', '=', 'sakwis_pemesanan.id_member')->where('id_pemesanan', $pembatalan->id_pemesanan)->first();

    // dd($data);

    /* kirim email ke member pembatalan diterima */
    $this->email_pembatalan_refund($data);

    return redirect()->back()->with('pesan', 'Pembatalan selesai ! Refund telah Di kirimkan.');;
   }

   function email_pembatalan_refund($data){
  
  $mail = new PHPMailer(true);

  try {
    //Server settings
    $mail->SMTPDebug = false;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail.sakawisata.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'info@sakawisata.com';                     //SMTP username
    $mail->Password   = 'sakawis2021';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('info@sakawisata.com', 'SAKAWISATA');
    $mail->addAddress($data['pemesanan']->email_member, $data['pemesanan']->nama_member);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Refund Pembatalan Kunjungan SAKAWISATA';
    $mail->Body    = view('pages.template.email_member_batal_selesai', $data)->render();
		
    $mail->send();

    return true;

		} catch (Exception $e) {
			/* 	return redirect("daftar")->with("pesan","email tidak valid"); */
		echo "<pre>";
    print_r($e);
    echo "</pre>";
    die;
		}
   }
    
}