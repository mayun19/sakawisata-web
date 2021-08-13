<?php
//deklarasi namespace u/ beritahu letak file controller 
namespace App\Http\Controllers\Member;

use App\Admin;
use App\Http\Controllers\Controller;

use App\Member;
use App\Pemesanan;
use App\Pembatalan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use DateTime;

/* kiri email */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



class MemberController extends Controller
{
   public function index() {
     /* mendapatkan id_member yang login */
      $id_member = session('id');

      $data['member'] = DB::table('sakwis_member')->where('id_member', $id_member)->first();

      $pemesanan = DB::table('sakwis_pemesanan')
      ->selectRaw("*, sakwis_pemesanan.id_pemesanan As id_pemesanan")
      ->join('sakwis_pemesanan_paket', 'sakwis_pemesanan_paket.id_pemesanan', '=', 'sakwis_pemesanan.id_pemesanan', 'left')
      ->join('sakwis_reschedule', 'sakwis_reschedule.id_pemesanan', '=', 'sakwis_pemesanan.id_pemesanan', 'left')
      ->where('id_member', $id_member)
      ->orderBy('sakwis_pemesanan.id_pemesanan', 'desc')
      ->skip(0)
      ->take(5)
      ->get();

      foreach ($pemesanan as $item) {
      $this->update_status($item->id_pemesanan);
      }

      $data['pemesanan'] = DB::table('sakwis_pemesanan')
      ->selectRaw("*, sakwis_pemesanan.id_pemesanan As id_pemesanan")
      ->join('sakwis_pemesanan_paket', 'sakwis_pemesanan_paket.id_pemesanan', '=', 'sakwis_pemesanan.id_pemesanan', 'left')
      ->join('sakwis_reschedule', 'sakwis_reschedule.id_pemesanan', '=', 'sakwis_pemesanan.id_pemesanan', 'left')
      ->where('id_member', $id_member)
      ->orderBy('sakwis_pemesanan.id_pemesanan', 'desc')
      ->skip(0)
      ->take(5)
      ->get();


      return view('pages.member.member', $data);
   }

  private function update_status($id_pemesanan){
    $cek_pemesanan = DB::table('sakwis_pemesanan')->where('id_pemesanan', $id_pemesanan)->first();

    if($cek_pemesanan->batas_pemesanan < date("Y-m-d H:i:s") && $cek_pemesanan->status_pemesanan == 'Pending'){
      $update['status_pemesanan'] = 'Kedaluarsa';

      DB::table('sakwis_pemesanan')->where('id_pemesanan', $id_pemesanan)->update($update);
    }
   }

   function editmember(Member $member){
      // echo "<pre>";
      // print_r($member);
      // echo "</pre>";

      // $member = Member::all();

      $data['member'] = $member;
      return view('pages.member.edit-member', $data);
   }

   function updatemember(Request $request, Member $member){
      $data_update['nama_member'] = $request->nama_member;
      $data_update['telp_member'] = $request->telp_member;
      $data_update['email_member'] = $request->email_member;
      $data_update['alamat_member'] = $request->alamat_member;

      $file = $request->file("foto_member");
      //mengupdate foto sebelumnya dgn yg terbaru
      if ($file != null){
        $nama_file = date("Ymdhis") . $file->getClientOriginalName();
        $file->move(public_path('img/member/'), $nama_file);
        $data_update['foto_member'] = $nama_file;

        $foto_lama = $member->foto_member;
        //cek apakah ada foto paket lama di folder public/img/paket/
        $lokasi_file = "img/member/$foto_lama";

        if(File::exists(public_path($lokasi_file))){
          File::delete(public_path($lokasi_file));
        }
      }


      if(!empty($request->password_lama))
      {
          $validasi = $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required',
            'password_baru_konfirmasi' => 'required'
          ]);

          $password_lama = $request->password_lama;
          $password_baru = $request->password_baru;
          $password_baru_konfirmasi = $request->password_baru_konfirmasi;

          // cek apakah password_lama sama dengan password di database
          $cek_password_lama = DB::table('sakwis_member')
          ->where('password_member', sha1($password_lama))
          ->where('email_member', $request->email_member)->get();

          // dd($cek_password_lama);

          // jika cocok
          if (count($cek_password_lama) == 1) {
             
             // cocokan password baru dan konfirmasinya
            if ($password_baru == $password_baru_konfirmasi) {
               $data_update['password_member'] = sha1($password_baru);
            } else {
               return redirect("edit_member/$member->id_member")->with('gagal', 'Konfirmasi password salah, mohon ulangi kembali!');
            }
          } else {
               return redirect("edit_member/$member->id_member")->with('gagal', 'Password lama yang anda masukkan salah, mohon ulangi kembali!');

          }

      } 

      DB::table('sakwis_member')->where('id_member', $member->id_member)->update($data_update);
      
      if($file != null){
         session()->put(['foto' => $nama_file]);
      }

      return redirect("edit_member/$member->id_member")->with('sukses', 'Data profil kamu telah berhasil diperbarui!');
   }

   function riwayatpesan(){
     /* mendapatkan id_member yang login */
      $id_member = session('id');

      $data['member'] = DB::table('sakwis_member')->where('id_member', $id_member)->first();

      $pemesanan = DB::table('sakwis_pemesanan')
      ->selectRaw("*, sakwis_pemesanan.id_pemesanan As id_pemesanan")
      ->join('sakwis_pemesanan_paket', 'sakwis_pemesanan_paket.id_pemesanan', '=', 'sakwis_pemesanan.id_pemesanan', 'left')
      ->join('sakwis_reschedule', 'sakwis_reschedule.id_pemesanan', '=', 'sakwis_pemesanan.id_pemesanan', 'left')
      ->where('id_member', $id_member)
      ->orderBy('sakwis_pemesanan.id_pemesanan', 'desc')
      ->skip(0)
      ->take(5)
      ->get();

      foreach ($pemesanan as $item) {
      $this->update_status($item->id_pemesanan);
      }

      $data["pemesanan"]  = DB::table('sakwis_pemesanan')
      ->selectRaw("*, sakwis_pemesanan.id_pemesanan As id_pemesanan")
      ->join('sakwis_pemesanan_paket', 'sakwis_pemesanan_paket.id_pemesanan', '=', 'sakwis_pemesanan.id_pemesanan', 'left')
      ->join('sakwis_reschedule', 'sakwis_reschedule.id_pemesanan', '=', 'sakwis_pemesanan.id_pemesanan', 'left')
      ->where('id_member', $id_member)
      ->orderBy('sakwis_pemesanan.id_pemesanan', 'desc')
      ->paginate(5);

      return view('pages.member.riwayat-pesan', $data);
   }

   function konfirmasibayar($kode_pemesanan){
     /* mendapatkan id_member yang login */
      $id_member = session('id');
      $pemesanan = DB::table('sakwis_pemesanan')->where('kode_pemesanan', $kode_pemesanan)->first();

      //jika member yg login tidak = member yg pesan 
      if($id_member !== $pemesanan->id_member){
        return redirect("member")->with("pesan", "tidak sesuai");
      }

      $data['pemesanan'] = $pemesanan;
      
      $data["pembayaran"] = DB::table('sakwis_pembayaran')->where("id_pemesanan", $data['pemesanan']->id_pemesanan)->get();

      $data['paket'] = DB::table('sakwis_pemesanan_paket')
      ->where("id_pemesanan", $data["pemesanan"]->id_pemesanan)
      ->first();

      //cek ada pembayaran sebelumnya
      $data['cek_pembayaran'] = DB::table('sakwis_pembayaran')->where("id_pemesanan", $data['pemesanan']->id_pemesanan)->count();

      //ambil data pembayaran - jumlah telah di bayar
      $data['telah_dibayar'] = DB::table('sakwis_pembayaran')->selectRaw('SUM(jumlah_pembayaran) as jumlah')->where('id_pemesanan', $pemesanan->id_pemesanan)->where('status_pembayaran', 'Diverifikasi')->first();

      // dd($data);

      return view('pages.member.konfirmasi-bayar', $data);
   }

   function simpanbayar(Request $request){
     date_default_timezone_set('Asia/Jakarta');
     $messages = [
       'required' => ':attribute wajib disi.'
     ];

    //  dd($request->all());
    //unmask format
    $jumlah_pembayaran_unmask = str_replace(".", "", $request->jumlah_pembayaran);

      $this->validate($request,[
        'nama_rekening' => 'required',
        'no_rekening' => 'required',
        'nama_bank' => 'required',
        'tipe_pembayaran' => 'required',
        'jumlah_pembayaran' => 'required',
        'tgl_pembayaran' => 'required',
        'bukti_pembayaran' => 'required'
      ], $messages);

     DB::beginTransaction();
     try {
      $id_member = session('id');


       $file = $request->file("bukti_pembayaran");
       if($file){
         $file->move('img/pemesanan',$file->getClientOriginalName());
         $mlebu['bukti_pembayaran'] = $file->getClientOriginalName();
       }

         $mlebu['id_pemesanan'] = $request->id_pemesanan;
         $mlebu['kode_pembayaran'] = $request->kode_pembayaran;
         $mlebu['nama_rekening'] = $request->nama_rekening;
         $mlebu['no_rekening'] = $request->no_rekening;
         if($request->nama_bank == 'lainnya') 
         {
           $mlebu['nama_bank'] = $request->nama_bank_lainnya;
          } else {
            $mlebu['nama_bank'] = $request->nama_bank;
         }
         $mlebu['tipe_pembayaran'] = $request->tipe_pembayaran;
         $mlebu['jumlah_pembayaran'] = $jumlah_pembayaran_unmask;
         $mlebu['tgl_pembayaran'] = date("Y-m-d H:i:s");
         $mlebu['tgl_konfirmasi'] = date("Y-m-d H:i:s");
         $mlebu['status_pembayaran'] = "Pending";
   
         // simpan ke database 
         DB::table('sakwis_pembayaran')
         ->insert($mlebu);

         //ambil id_pembayaran yg baru di insertkan
         $id_pembayaran_barusan = DB::getPdo()->lastInsertId();
   
         //insert status_pemesanan
        $data_pemesanan['status_pemesanan'] = "Menunggu Konfirmasi Admin";
         
        //update status_pemesanan dari table pemesanan
        DB::table('sakwis_pemesanan')->where('id_pemesanan', $request->id_pemesanan)->update($data_pemesanan);
   
       //ambil data
       $data['member'] = DB::table('sakwis_member')->where('id_member', $id_member)->first();

       $data['pemesanan'] = DB::table('sakwis_pemesanan')
       ->join('sakwis_pemesanan_paket', 'sakwis_pemesanan_paket.id_pemesanan', '=', 'sakwis_pemesanan.id_pemesanan')
       ->where('sakwis_pemesanan.id_pemesanan', $request->id_pemesanan)->first();
   
   
       $data['pembayaran'] = DB::table('sakwis_pembayaran')->where("id_pembayaran", $id_pembayaran_barusan)->first();

       //ambil data admin
       $data['admin'] = Admin::where('id_admin', 1)->first();
      //  $data['admin'] = DB::table('sakwis_admin')->where('id_admin', $admin->id_admin)->get();
   
      //  dd($data);
   
       //proses kirim email
        $this->kirim_email_konfirmasi_bayar($data);
        DB::commit();
   
        return redirect("member/pemesanan")->with("pesan", "Konfirmasi Pembayaran Berhasil ! Pembayaran Menunggu Dikonfirmasi Admin.");

     } catch (\Exception $e) {
      DB::rollback();
      echo "Error: " . $e;
       //throw $th;
     }
   }

   function kirim_email_konfirmasi_bayar($data){
    try {
      //Instantiation and passing `true` enables exceptions
      $mail = new PHPMailer(true);
      // echo "<pre>";
      // print_r($mail);
      // echo "</pre>";
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
      $mail->addAddress($data['admin']->email_admin, $data['admin']->username_admin);     //Add a recipient

      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = 'Konfirmasi Pembayaran Kunjungan';
      $mail->Body    = view('pages.template.email_pembayaran_verifikasi', $data)->render();

      $mail->send();
      echo "Message has been sent successfully";

      return true;

    } catch (Exception $e) {
      echo "Mailer Error: " . $e;
      die;
    }
  }

   function tiket($kode_pemesanan){
    $data["pemesanan"] = DB::table('sakwis_pemesanan')
    ->join("sakwis_member", "sakwis_member.id_member", "=", "sakwis_pemesanan.id_member")
    ->where("kode_pemesanan", $kode_pemesanan)
    ->first();

    $data["paket"] = DB::table('sakwis_pemesanan_paket')
    ->where("id_pemesanan", $data["pemesanan"]->id_pemesanan)
    ->first();

    $data["pemandu"] = DB::table('sakwis_pemesanan_pemandu')
    ->join("sakwis_pemandu", "sakwis_pemesanan_pemandu.id_pemandu", "=", "sakwis_pemandu.id_pemandu")
    ->where("id_pemesanan", $data["pemesanan"]->id_pemesanan)
    ->get();

    // dd($data);
    return view('pages.member.ticket', $data);
   }

   function cetak_tiket($kode_pemesanan){
    $data["pemesanan"] = DB::table('sakwis_pemesanan')
    ->join("sakwis_member", "sakwis_member.id_member", "=", "sakwis_pemesanan.id_member")
    ->where("kode_pemesanan", $kode_pemesanan)
    ->first();

    $data["paket"] = DB::table('sakwis_pemesanan_paket')
    ->where("id_pemesanan", $data["pemesanan"]->id_pemesanan)
    ->first();

    $data["pemandu"] = DB::table('sakwis_pemesanan_pemandu')
    ->join("sakwis_pemandu", "sakwis_pemesanan_pemandu.id_pemandu", "=", "sakwis_pemandu.id_pemandu")
    ->where("id_pemesanan", $data["pemesanan"]->id_pemesanan)
    ->get();

      // dd($data);
    return view('pages.member.cetak_ticket', $data);

   }

   function reschedule(Pemesanan $pemesanan){
    //ambil selisih hari
    $tgl_sekarang = new DateTime(date("Y-m-d H:i:s"));
    $tgl_kunjungan = new DateTime($pemesanan->tgl_kunjungan);
    $selisih = $tgl_sekarang->diff($tgl_kunjungan);

    //cek tgl skg lebih dari h-3 kunjungan
    if($selisih->days < 2 || $tgl_sekarang >= $tgl_kunjungan  ){
      return redirect('member')->with('gagal', 'Penjadwalan ulang tidak boleh kurang dari H-3 kunjungan.');
    }

    //ambil id_paket dari pemesanan_paket berdasarkan id_pemesanan 
    $pemesanan_paket = DB::table('sakwis_pemesanan_paket')->where('id_pemesanan', $pemesanan->id_pemesanan)->first();

    $id_paket = $pemesanan_paket->id_paket;

    //ambil paket sesi yg sesuai dg id_paket di pemesanan_paket
    $paket_sesi = DB::table('sakwis_paket_sesi')->join('sakwis_sesi', 'sakwis_sesi.id_sesi', '=', 'sakwis_paket_sesi.id_sesi')->where('id_paket', $id_paket)->get();

    $data['paket_sesi'] = $paket_sesi;
    $data['pemesanan'] = $pemesanan;
    $data['id_paket'] = $id_paket;
    
    return view('pages.member.reschedule', $data);
   }

   function proses_reschedule(Request $request, Pemesanan $pemesanan){
      $dataInsert['id_pemesanan'] = $request->id_pemesanan;
      $dataInsert['tanggal_reschedule'] = $request->tanggal_reschedule;
      $dataInsert['sesi_reschedule'] = $request->sesi_reschedule;
      $dataInsert['status_reschedule'] = 'Pending';
      $dataInsert['tanggal_pengajuan'] = date("Y-m-d H:i:s");

      DB::table('sakwis_reschedule')->insert($dataInsert);
      DB::table('sakwis_pemesanan')->where('id_pemesanan', $pemesanan->id_pemesanan)->update(['status_pemesanan' => 'Jadwal Ulang']);

      /* ambil data */
      // $data['pemesanan'] = $pemesanan;

      $data['pemesanan'] = DB::table('sakwis_pemesanan')->join('sakwis_member', 'sakwis_member.id_member', '=', 'sakwis_pemesanan.id_member')->where('id_pemesanan', $pemesanan->id_pemesanan)->first();

      $data["paket"] = DB::table('sakwis_pemesanan_paket')
      ->where("id_pemesanan", $pemesanan->id_pemesanan)
      ->first();

      $data['reschedule'] = DB::table('sakwis_reschedule')      ->join('sakwis_sesi', 'sakwis_sesi.id_sesi', '=', 'sakwis_reschedule.sesi_reschedule')->where('id_pemesanan', $pemesanan->id_pemesanan)->first();

      //ambil data admin
      $data['admin'] = Admin::where('id_admin', 1)->first();

      // dd($data);

      /* kirim email ajukan reschedule */
      $this->kirim_email_reschedule($data);

      return redirect('member')->with('sukses', 'Jadwal ulang kunjungan <b>(' . $pemesanan->kode_pemesanan . ')</b> berhasil diajukan!');
   }

   function kirim_email_reschedule($data){
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
    $mail->addAddress($data['admin']->email_admin, $data['admin']->username_admin);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Pengajuan Reschedule Kunjungan';
    $mail->Body    = view('pages.template.email_admin_reschedule', $data)->render();
		
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

   function reschedule_rekomendasi($id_reschedule){

      $data['rekomendasi'] = DB::table('sakwis_rekomendasi_jadwal')
      ->join('sakwis_sesi', 'sakwis_sesi.id_sesi', '=', 'sakwis_rekomendasi_jadwal.sesi_rekomendasi', 'left')
      ->where('id_reschedule', $id_reschedule)->get();

      $data['id_reschedule'] = $id_reschedule;
      return view('pages.member.reschedule-rekomendasi', $data);
   }

   function konfirmasi_rekomendasi(Request $request, $id_reschedule){
     $id_rekomendasi = $request->id_rekomendasi_jadwal;

     $reschedule = DB::table('sakwis_reschedule')->where('id_reschedule', $id_reschedule)->first();

     $rekomendasi = DB::table('sakwis_rekomendasi_jadwal')
     ->join('sakwis_sesi', 'sakwis_sesi.id_sesi', '=', 'sakwis_rekomendasi_jadwal.sesi_rekomendasi')->where('id_rekomendasi_jadwal', $id_rekomendasi)->first();

     $updateReschedule['status_reschedule'] = 'Diterima';

     //update reschedule menjadi diterima
     DB::table('sakwis_reschedule')->where('id_reschedule', $id_reschedule)->update($updateReschedule);
     
     //update pemesanan paket
     DB::table('sakwis_pemesanan_paket')->where('id_pemesanan', $reschedule->id_pemesanan)->update(['waktu_kunjungan_paket' => $rekomendasi->nama_sesi]);

     //update status pemesanan
     //cek status_pembayaran terakhir

     $cek_pembayaran = DB::table('sakwis_pembayaran')
     ->join('sakwis_pemesanan', 'sakwis_pemesanan.id_pemesanan', '=', 'sakwis_pembayaran.id_pemesanan')
     ->where('sakwis_pemesanan.id_pemesanan', $reschedule->id_pemesanan)
     ->where('sakwis_pembayaran.tipe_pembayaran', 'Lunas')
     ->count();

    //  dd($cek_pembayaran);

     if($cek_pembayaran == 0){
       $dataPemesanan['status_pemesanan'] = "DP";
     }else{
       $dataPemesanan['status_pemesanan'] = "Proses";
     }

     $dataPemesanan['tgl_kunjungan'] = $rekomendasi->tanggal_rekomendasi;
     $dataPemesanan['waktu_kunjungan_pemesanan'] = $rekomendasi->sesi_rekomendasi;

     DB::table('sakwis_pemesanan')->where('id_pemesanan', $reschedule->id_pemesanan)->update($dataPemesanan);
     
     /* ambil data u/email */
     $data['pemesanan'] = DB::table('sakwis_pemesanan')->join('sakwis_member', 'sakwis_member.id_member', '=', 'sakwis_pemesanan.id_member')->where('id_pemesanan', $reschedule->id_pemesanan)->first();

      $data['rekomendasi'] = DB::table('sakwis_pemesanan')
      ->join('sakwis_sesi', 'sakwis_sesi.id_sesi', '=', 'sakwis_pemesanan.waktu_kunjungan_pemesanan', 'left')
      ->where('id_pemesanan', $reschedule->id_pemesanan)->first();

    $data["paket"] = DB::table('sakwis_pemesanan_paket')
    ->where("id_pemesanan", $reschedule->id_pemesanan)
    ->first();
    
    //ambil data admin
    $data['admin'] = Admin::where('id_admin', 1)->first();

    // dd($data);
     /* kirim email reschedule sukses */
    $this->email_reschedule_sukses($data);

    return redirect('member/pemesanan')->with('pesan', 'Rekomendasi jadwal berhasil diterima!');

   }

   function email_reschedule_sukses($data){
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
    $mail->addAddress($data['admin']->email_admin, $data['admin']->username_admin);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Perubahan Jadwal Kunjungan SAKAWISATA';
    $mail->Body    = view('pages.template.email_admin_reschedule_sukses', $data)->render();
		
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

   function pembatalan(Pemesanan $pemesanan){
    //ambil selisih hari
    $tgl_sekarang = new DateTime(date("Y-m-d H:i:s"));
    $tgl_kunjungan = new DateTime($pemesanan->tgl_kunjungan);
    //  $tgl_kunjungan = new DateTime("2021-05-03");
    $selisih = $tgl_sekarang->diff($tgl_kunjungan);

    //  dd($selisih);

    //cek tgl skg lebih dari h-3 kunjungan
    if($selisih->days < 2 || $tgl_sekarang >= $tgl_kunjungan  ){
    return redirect('member')->with('gagal', 'Pengajuan pembatalan tidak boleh kurang dari H-3 kunjungan.');
    }

    $pemesanan = DB::table('sakwis_pemesanan')->where('id_pemesanan', $pemesanan->id_pemesanan)->first();
    $data['pemesanan'] = $pemesanan;

    return view('pages.member.pembatalan', $data);
   }

   function pembatalan_konfirmasi($id_pemesanan){
    $id_member = session('id');

    $data['member'] = DB::table('sakwis_member')->where('id_member', $id_member)->first();

    $data["pemesanan"]  = DB::table('sakwis_pemesanan')
    ->join('sakwis_pemesanan_paket', 'sakwis_pemesanan_paket.id_pemesanan', '=', 'sakwis_pemesanan.id_pemesanan')
    ->where("sakwis_pemesanan.id_pemesanan", $id_pemesanan)->first();

    // dd($data);

    return view('pages.member.pembatalan-konfirmasi', $data);
   }

   function proses_pembatalan(Request $request, Pemesanan $pemesanan){
      $messages = [
       'required' => ':attribute wajib disi.',
       'numeric' => ':attribute diisi berupa angka.'
     ];

    //  dd($request->all());

    $this->validate($request,[
      'nama_bank_refund' => 'required',
      'no_rekening_refund' => 'required|numeric',
      'nama_pemilik_refund' => 'required',
      'alasan_pembatalan' => 'required'
    ], $messages);

    $dataInsert['id_pemesanan'] = $pemesanan->id_pemesanan;
    $dataInsert['nama_bank_refund'] = $request->nama_bank_refund;
    $dataInsert['no_rekening_refund'] = $request->no_rekening_refund;
    $dataInsert['nama_pemilik_refund'] = $request->nama_pemilik_refund;
    $dataInsert['alasan_pembatalan'] = $request->alasan_pembatalan;
    $dataInsert['status_pembatalan'] = 'Pending';
    $dataInsert['tanggal_pending'] = date("Y-m-d H:i:s");

    // dd($dataInsert);

    DB::table('sakwis_pembatalan')->insert($dataInsert);
    DB::table('sakwis_pemesanan')->where('id_pemesanan', $pemesanan->id_pemesanan)->update(['status_pemesanan' => 'Batal']);

    /* ambil data u/ email pembatalan */
    $data['pemesanan'] = DB::table('sakwis_pemesanan')->join('sakwis_member', 'sakwis_member.id_member', '=', 'sakwis_pemesanan.id_member')->where('id_pemesanan', $pemesanan->id_pemesanan)->first();

    $data["paket"] = DB::table('sakwis_pemesanan_paket')
    ->where("id_pemesanan", $pemesanan->id_pemesanan)
    ->first();

    $data['pembatalan'] = DB::table('sakwis_pembatalan')->where('id_pemesanan', $pemesanan->id_pemesanan)->first();

    //ambil data admin
    $data['admin'] = Admin::where('id_admin', 1)->first();

    /* kirim email notif pengajuan pembatalan */
    $this->email_pembatalan($data);

    return redirect('member/pembatalan-sukses');
   }

   function email_pembatalan($data){
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
    $mail->addAddress($data['admin']->email_admin, $data['admin']->username_admin);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Pembatalan Jadwal Kunjungan SAKAWISATA';
    $mail->Body    = view('pages.template.email_admin_pembatalan', $data)->render();
		
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

   function pembatalan_sukses(){
     return view('pages.member.pembatalan-sukses');
   }

   function pembatalan_detail($id_pemesanan){
    $id_member = session('id');
 
    $data['member'] = DB::table('sakwis_member')->where('id_member', $id_member)->first();

    $data["pemesanan"]  = DB::table('sakwis_pemesanan')
    ->join('sakwis_pemesanan_paket', 'sakwis_pemesanan_paket.id_pemesanan', '=', 'sakwis_pemesanan.id_pemesanan')
    ->where("sakwis_pemesanan.id_pemesanan", $id_pemesanan)->first();

    $data['pembayaran'] = DB::table('sakwis_pembayaran')->selectRaw('SUM(jumlah_pembayaran) as jumlah')->where('id_pemesanan', $id_pemesanan)->where('status_pembayaran', 'Diverifikasi')->first();

    $data['pembatalan'] = DB::table('sakwis_pembatalan')->where('id_pemesanan', $id_pemesanan)->first();
    // dd($data);

    return view('pages.member.pembatalan-detail', $data);
   }
   
}