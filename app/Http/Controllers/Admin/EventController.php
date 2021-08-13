<?php
//deklarasi namespace u/ beritahu letak file controller 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

// panggil model member, maka harus buat file app/Member.php
use App\Event;

class EventController extends Controller
{
   function index (Event $event) {

  //gunakan model member u/ ambil data member dari database
  $data["event"]= Event::all();
  $data['deskripi_event'] = $event->deskripsi_event;

  return view ('pages.admin.event.dashboard-event', $data);
  }

  function tambah_event(){

  return view('pages.admin.event.event-tambah');
  }

  function simpan_event(Request $request){
  date_default_timezone_set('Asia/Jakarta');
  
  $validasi = $request->validate([
    'nama_event' => 'required',
    'foto_event' => 'required',
    'tgl_mulai_event' => 'required',
    'deskripsi_event' => 'required',
  ]);
  
  $event['nama_event'] = $request->nama_event;
  $event['tgl_mulai_event'] = date("Y-m-d");
  $event['tgl_selesai_event'] = date("Y-m-d");
  $event['jam_event'] = date("H:i");
  $event['deskripsi_event'] = $request->deskripsi_event;
  $event['twitter_event'] = $request->twitter_event;
  $event['wa_event'] = $request->wa_event;
  $event['fb_event'] = $request->fb_event;
  $event['author_event'] = $request->author_event;

  $file = $request->file("foto_event");
  if($file){
    $file->move('img/event',$file->getClientOriginalName());
    $event['foto_event'] = $file->getClientOriginalName();
  }
  Event::create($event);

  return redirect("admin/event")->with("pesan","event baru berhasil ditambahkan");
  }

  function edit_event(Event $event){
    $data['event'] = $event;

    return view('pages.admin.event.event-edit', $data);
  }

  function update_event(Request $request, Event $event){
    // dd($request->all());

    $update['nama_event'] = $request->nama_event;
    $update['tgl_mulai_event'] = $request->tgl_mulai_event;
    $update['tgl_selesai_event'] = $request->tgl_selesai_event;
    $update['jam_event'] = $request->jam_event;
    $update['author_event'] = $request->author_event;
    $update['twitter_event'] = $request->twitter_event;
    $update['wa_event'] = $request->wa_event;
    $update['fb_event'] = $request->fb_event;
    $update['deskripsi_event'] = $request->deskripsi_event;

    // dd($update);

    $file = $request->file('foto_event');
    
    /* mengupdate foto sebelumnya dgn yg terbaru */
    if($file != null){
      $nama_file = $file->getClientOriginalName();
      $file->move('img/event', $nama_file);
      $update['foto_event'] = $nama_file;

      $foto_lama = $event->foto_event;

      /* cek apakah ada foto event lama di folder public/img/event/ */
     $lokasi_file = "img/event/$foto_lama";

      if(File::exists(public_path($lokasi_file))){
        File::delete(public_path($lokasi_file));
      }
    
      
    }

  /* Update data partners */
  DB::table('sakwis_event')->where('id_event', $event->id_event)->update($update);
  
  return redirect("admin/event")->with("pesan", "data event ".$event->nama_event. " berhasil diubah");  
  }

  function hapus(Event $event){

    DB::table('sakwis_event')->where('id_event', $event->id_event)->delete();
    
    return redirect("admin/event")->with("pesan", "data Partner ".$event->nama_event. " berhasil dihapus");  
  }

}