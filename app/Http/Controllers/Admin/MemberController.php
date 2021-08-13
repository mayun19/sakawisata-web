<?php
//deklarasi namespace u/ beritahu letak file controller 
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

// panggil model member, maka harus buat file app/Member.php
use App\Member;

class MemberController extends Controller
{
   function index () {

     //gunakan model member u/ ambil data member dari database
    $data["member"] = Member::all();


    //cek data nya sudah berhasil ?
    // echo "<pre>";
    // print_r($member);
    // echo"</pre>";

     return view ('pages.admin.dashboard-member', $data);
   }

   function hapus(Member $member){
    DB::table('sakwis_member')
    ->where("id_member", $member->id_member)
    ->delete();

    return redirect('admin/member')->with("pesan", "data member berhasil di hapus");
   }
}