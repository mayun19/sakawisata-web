<?php
//deklarasi namespace u/ beritahu letak file controller 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Member;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class AuthController extends Controller
{
  	function login(){
			//cek cookie apakah member sudah login

			$data['username'] = "";
			$data['password'] = "";

			if(isset($_COOKIE['remember']) && $_COOKIE['remember']=="ya"){
				$data['username'] = $_COOKIE['username'];
				$data['password'] = $_COOKIE['password'];
			}

			if(session('level')!=null){
				if (session('level')=='member') {
					return redirect('member');
				}else {
					return redirect('admin');
				}
			}
		return view('pages.auth.login', $data);
	}

	function logout()
	{	
		// hapus session login
		session(['level'=>null]);

		return redirect('/');
	}

	function proses_login(Request $request)
	{
		//cek cookie
		$username = $request->input('username');
		$password = sha1($request->input('password'));

		$remember = $request->input('remember');
		if($remember){
			setcookie("remember", "ya", time() + (86400 * 30), "/"); //1 day
			setcookie("username", $request->username, time() + (86400 * 30), "/"); //1 day
			setcookie("password", $request->password, time() + (86400 * 30), "/"); //1 day

		}

		$admin = DB::table('sakwis_admin')->where('username_admin', $username)->where('password_admin', $password)->first();

		if ($admin) {

			$data_login = array(
				'id' => $admin->id_admin,
				'name' => 'Admin',
				'username' => $admin->username_admin,
				'foto' => $admin->foto_admin,
				'level' => 'admin',
			);

			// simpan data admin ke session
			session()->put($data_login);
		

			return redirect('admin');

		} else {

			$member = DB::table('sakwis_member')->where('username_member', $username)->where('password_member', $password)->first();

			if ($member) {

				$data_login = array(
					'id' => $member->id_member,
					'name' => $member->nama_member,
					'username' => $member->username_member,
					'foto' => $member->foto_member,
					'level' => 'member',
				);

				// simpan data member ke session
				session()->put($data_login);
				
				if ($request->has('redirect') && !empty($request->redirect)) {
					$redirect= urldecode($request->get('redirect')); 
					// $redirect = $request->get('redirect');
				}else{
					$redirect = 'member';
				}
				
				return redirect($redirect);
				// return redirect('member');


			} else {
				return redirect('login')->with('gagal', 'Username/password salah!');
			}
			
		}
	}
  
	function daftar(){

		return view('pages.auth.daftar');
	}

	function daftar_member(Request $request){
		//cek validasi email
		$messages = [
        'required' => ':attribute wajib disi.',
        'unique' => ':attribute sudah ada sebelumnya.',
    ];

		$this->validate($request,[
      'email_member' => 'required|unique:sakwis_member,email_member',
      'nama_member' => 'required',
      'username_member' => 'required|unique:sakwis_member,username_member',
      'password_member' => 'required',
      'telp_member' => 'required'
    ], $messages);

		$member['nama_member'] = $request->nama_member;
		$member['username_member'] = $request->username_member;
		$member['email_member'] = $request->email_member;
		$member['password_member'] = sha1($request->password_member);
		$member['telp_member'] = $request->telp_member;
		$member['alamat_member'] = $request->alamat_member;


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
    $mail->addAddress($request->email_member, $request->nama_member);     //Add a recipient

		$data['member']['email'] = $request->email_member;
		$data['member']['password'] = sha1($request->password_member);
		$data['member']['kode'] = sha1($request->nama_member.$request->email_member);

		$data['member']['nama_member'] = $request->nama_member;

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Aktivasi Akun Pendaftaran SAKAWISATA';
    $mail->Body    = view('pages.template.email_daftar_aktivasi', $data)->render();
		
    $mail->send();
		
		$member['status_member'] = "non-aktif";
		$member['kode_member'] = sha1($request->nama_member.$request->email_member);
		$member['foto_member'] = "-";
		$member['reset_member'] = "-";
		
		DB::table('sakwis_member')->insert($member);
    // Member::create($member);
		return redirect("login")->with("pesan","pendaftaran berhasil, silahkan cek aktivasi di email anda");

		} catch (Exception $e) {
				return redirect("daftar")->with("gagal","email tidak valid");
		// echo "<pre>";
    // print_r($e);
    // echo "</pre>";
		}
	}

	function aktivasi($kode){
		$cek = DB::table('sakwis_member')->where('kode_member', $kode)->first();

		if (empty($cek)) {
			return redirect('/')->with("gagal", "aktivasi gagal, kode tidak diketahui");
		}else{
			$member['status_member'] = "aktif";
			DB::table('sakwis_member')
			->where("kode_member", $kode)
			->update($member);

			$data_login = array(
				'id' => $cek->id_member,
				'name' => $cek->nama_member,
				'username' => $cek->username_member,
				'level' => 'member',
			);

			// simpan data member ke session
				session()->put($data_login);
				
				return redirect('member');
		}
	}

	function reset_password(){
		return view('pages.auth.reset-password');
	}

	function new_password(Request $request){
		$cek = DB::table('sakwis_member')->where("email_member", $request->email_member)->first();

		// data member belum mau diambil
		// $data = DB::table('sakwis_member')->where('id_member', $request->id_member)->first();
		// dd($data);

		if (empty($cek)) {
			return redirect('reset_password')->with("pesan","Maaf, email mu belum terdaftar di website kami.");
		}else {

			//buatkan password baru
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$reset = '';
			for ($i = 0; $i < 5; $i++) {
				$reset .= $characters[rand(0, $charactersLength - 1)];
			}
   		$reset_member = sha1($reset);
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
    $mail->addAddress($cek->email_member, $request->nama_member);     //Add a recipient

		$data['member']['email'] = $request->email_member;
		$data['member']['nama'] = $request->nama_member;
		$data['member']['kode'] = $reset_member;

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Reset Password Member SAKAWISATA';
    $mail->Body    = view('pages.template.email_link_reset_pass', $data)->render();
		
    $mail->send();
		
		$member['reset_member'] = $reset_member;
		
		DB::table('sakwis_member')
		->where("email_member", $request->email_member)
		->update($member);

    // Member::create($member);
		return redirect("login")->with("pesan","Link reset password telah dikirim ke email mu.");

		} catch (Exception $e) {
				return redirect("daftar")->with("gagal","email tidak valid");
		// echo "<pre>";
    // print_r($e);
    // echo "</pre>";
		}
		}
	}

	function aktivasi_password($reset){
			$cek = DB::table('sakwis_member')->where('reset_member', $reset)->first();

			/* dd($cek); */

		if (empty($cek)) {
			return redirect('/')->with("gagal", "aktivasi gagal, kode tidak diketahui");
		}else{

			$data['cek'] = $cek;
			return view('pages.auth.new-password', $data);
				// return redirect("ganti_password?email=$cek->email_member");
		}
	}

	function ganti_password(){
	}

	function simpan_pass (Request $request){
		
		$update['password_member'] = sha1($request->password_member);
		$email_member = $request->email;

		// echo $email_member; die;

		DB::table('sakwis_member')->where('email_member', $email_member)->update($update);

		// $data_login = array(
		// 	'id' => $member->id_member,
		// 	'name' => $member->nama_member,
		// 	'username' => $member->username_member,
		// 	'level' => 'member',
		// );

		// // simpan data member ke session
		// 	session()->put($data_login);

		return redirect("login")->with('pesan', 'password berhasil diperbaharui');

	}
}