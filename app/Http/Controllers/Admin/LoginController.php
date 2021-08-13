<?php
//deklarasi namespace u/ beritahu letak file controller 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

// panggil model member, maka harus buat file app/Member.php
// use App\Login;

class LoginController extends Controller
{
   function index () {

     return view ('admin/login');
   }
}