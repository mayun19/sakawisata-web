<?php
//deklarasi namespace u/ beritahu letak file controller 
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request; 

/* kirim email */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


// panggil model member, maka harus buat file app/Member.php
// use App\Pemesanan;
use App\Paket;
use App\Sesi;
use App\Member;
use App\Pemesanan;

class PaketController extends Controller
{  
  function index () {
    $data["paket"] = Paket::with('sesi')->paginate(6);
    $data['sesi'] = Sesi::all();
    // dd($data);
    // cek data
    // echo $data["paket"];
    // dd($data);
    return view('pages.paket', $data);
   }

  function detail (Paket $paket) {
    $data['paket'] = $paket;

    $data['fasilitas'] = DB::table('sakwis_paket_fasilitas')->join('sakwis_fasilitas', 'sakwis_fasilitas.id_fasilitas', '=', 'sakwis_paket_fasilitas.id_fasilitas')->where('id_paket', $paket->id_paket)->get();

    $data['situs'] = DB::table('sakwis_paket_situs')->join('sakwis_situs', 'sakwis_situs.id_situs', '=', 'sakwis_paket_situs.id_situs')->where('id_paket',$paket->id_paket)->get();
    
    $data['sesi'] = DB::table('sakwis_paket_sesi')->join('sakwis_sesi', 'sakwis_sesi.id_sesi', '=', 'sakwis_paket_sesi.id_sesi')->where('id_paket',$paket->id_paket)->get();
      
    return view('pages.paket_detail', $data);
  }

	function pesan(Paket $paket){
		$id_member = session('id');
		$member = Member::find($id_member);
    
		$data['member'] = $member;
		$data['paket'] = Paket::with('sesi')->where('id_paket',$paket->id_paket)->first();

    // dd($data);
		
		return view('pages.paket_pemesanan', $data);
	}

  function proses_pesan(Paket $paket, Request $request){
    date_default_timezone_set('Asia/Jakarta');
    //validasi form yg wajib diisi 
    $messages = [
       'required' => ':attribute wajib disi.'
     ];

    $biaya_pemesanan_unmask = str_replace(".", "", $request->input('biaya_pemesanan'));
    $biaya_tambahan_unmask = str_replace(".", "", $request->input('biaya_tambahan'));
    $total_pemesanan_unmask = str_replace(".", "", $request->input('total_pemesanan'));

    $this->validate($request,[
          'asal_instansi_pemesanan' => 'required',
          'tgl_kunjungan' => 'required',
          'waktu_kunjungan_pemesanan' => 'required',
          'jumlah_wisatawan' => 'required',
          'jumlah_paket' => 'required'
      ], $messages);

     $id_member = session('id');
     $tgl_pemesanan = date("Y-m-d H:i:s");
     $batas_pemesanan = date("Y-m-d H:i:s", strtotime($tgl_pemesanan . "1 days"));

     $data_pemesanan = array(
      'id_member' => $id_member,
      'tgl_pemesanan' => $tgl_pemesanan,
      'batas_pemesanan' => $batas_pemesanan,
      'tgl_kunjungan' => date("Y-m-d", strtotime($request->tgl_kunjungan)),
      'waktu_kunjungan_pemesanan' => $request->input('waktu_kunjungan_pemesanan'),
      'asal_instansi_pemesanan' => $request->input('asal_instansi_pemesanan'),
      'nama_tl_pemesanan' => $request->has('nama_tl_pemesanan') ? $request->input('nama_tl_pemesanan') : null,
      'status_pemesanan' => 'Pending',
      'jumlah_wisatawan' => $request->input('jumlah_wisatawan'),
      'jumlah_paket' => $request->input('jumlah_paket'),
      'jumlah_wisatawan_tambahan' => $request->input('jumlah_wisatawan_tambahan'),
      'biaya_pemesanan' => $biaya_pemesanan_unmask,
      'biaya_tambahan' => $biaya_tambahan_unmask,
      'total_pemesanan' => $total_pemesanan_unmask,
      'keterangan_pemesanan' => $request->input('keterangan_pemesanan'),
      'kode_pemesanan' => null,
     );

    //  print_r($data_pemesanan);
     //ambil sesi per waktu_kunjungan_pemesanan
     $id_sesi = $request->input('waktu_kunjungan_pemesanan');
     $sesi = DB::table('sakwis_sesi')->where('id_sesi', $id_sesi)->first();

     $id_pemesanan = DB::table('sakwis_pemesanan')->insertGetId($data_pemesanan);

     $data_paket = array(
      'id_pemesanan' => $id_pemesanan,
      'id_paket' => $paket->id_paket,
      'nama_paket' => $paket->nama_paket,
      'harga_paket' => $paket->harga_paket,
      'waktu_kunjungan_paket' => $sesi->nama_sesi,
      'kapasitas_min' => $paket->kapasitas_min_paket,
      'kapasitas_max' => $paket->kapasitas_max_paket,
      'deskripsi_paket' => $paket->deskripsi_paket
     );

     DB::table('sakwis_pemesanan_paket')->insert($data_paket);

     //update kode_pemesanan
     $mlebu['kode_pemesanan'] = "SW".$id_pemesanan;
     DB::table('sakwis_pemesanan')->where('id_pemesanan', $id_pemesanan)->update($mlebu);

     //ambil data pemesanan wisatawan
     $data['member'] = DB::table('sakwis_member')->where('id_member', $id_member)->first();
     $data['pemesanan'] = DB::table('sakwis_pemesanan')->where('id_pemesanan', $id_pemesanan)->first();
     $data['paket'] = $data_paket;

     //proses kirim email
     $this->kirim_email_invoice($data);

      return redirect("pesan/sukses/$id_pemesanan");
  }

  function kirim_email_invoice($data){
    //Instantiation and passing `true` enables exceptions
		$mail = new PHPMailer(true);
		// echo "<pre>";
    // print_r($mail);
    // echo "</pre>";

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
    $mail->Subject = 'Invoice Pemesanan Paket Kunjungan SAKAWISATA';
    $mail->Body    = view('pages.template.email_invoice', $data)->render();
		
    $mail->send();

    return true;

		} catch (Exception $e) {
			/* 	return redirect("daftar")->with("pesan","email tidak valid"); */
		echo "<pre>";
    print_r($e);
    echo "</pre>";
		}

  }

  function sukses(Pemesanan $pemesanan) {

    $data['pemesanan'] = $pemesanan;
    return view('pages.success', $data);
  }
}