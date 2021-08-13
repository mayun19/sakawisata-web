<?php
//deklarasi namespace u/ beritahu letak file controller 
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request; 

// panggil model member, maka harus buat file app/Member.php
// use App\Pemesanan;
use App\Event;

class EventController extends Controller
{  
  function index () {
    $data["event"] = Event::all();

    return view('pages.event', $data);
   }

  function detail (Event $event){
    $data['event'] = $event;

    // dd($event);

    $data['all_event'] = Event::whereNotIn('id_event', [$event->id_event])->limit(2)->orderBy('id_event', 'DESC')->get();

    // dd($data);

    return view('pages/event-detail', $data);
   }

}