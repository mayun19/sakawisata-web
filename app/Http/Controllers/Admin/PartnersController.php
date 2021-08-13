<?php
//deklarasi namespace u/ beritahu letak file controller 
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

// panggil model member, maka harus buat file app/Member.php
use App\Partners;

class PartnersController extends Controller
{
  function index () {

     //gunakan model member u/ ambil data member dari database
    // $fasilitas = Fasilitas::all();
    $data["partners"] = Partners::all();

    // dd($data);
     return view ('pages.admin.partners.dashboard-partners', $data);
   }

  function tambah(){

    return view('pages.admin.partners.partner_tambah');
  }

  function simpan(Request $request){
    $file = $request->file('foto_partner');
    $file->move('img/partners',$file->getClientOriginalName());
    
    $partners['nama_partner'] = $request->nama_partner;
    $partners['link_partner'] = $request->link_partner;
    $partners['foto_partner'] = $file->getClientOriginalName();
    
    Partners::create($partners);

    return redirect('admin/partners')->with('pesan', 'data partners berhasil tersimpan');
  }

  function simpanfoto(Request $request, Partners $partner){
    $file = $request->file('foto_partner');
    $file->move('img/partners',$file->getClientOriginalName());

    $simpan['id_partner'] = $request->nama_partner;
    $simpan['foto_partner'] = $file->getClientOriginalName();

    Partners::create('simpan');

    return redirect('admin/partners/edit/'.$partner->id_partner)->with('pesan', 'data partners berhasil tersimpan');

  }

  function edit(Partners $partners){
    $data['partners'] = $partners;

    // dd($data);

    return view('pages.admin.partners.partner_edit', $data);
  }

  function update(Request $request, Partners $partners){
    $update['nama_partner'] = $request->nama_partner;

    $file = $request->file('foto_partner');

    /* mengupdate foto sebelumnya dgn yg terbaru */
    if($file != null){
      $nama_file = $file->getClientOriginalName();
      $file->move('img/partners', $nama_file);
      $update['foto_partner'] = $nama_file;

      $foto_lama = $partners->foto_partner;

      /* cek apakah ada foto partner lama di folder public/img/partners/ */

      $lokasi_file = "img/partners/$foto_lama";

      if(File::exists(public_path($lokasi_file))){
        File::delete(public_path($lokasi_file));
      }

      /* Update data partners */
      DB::table('sakwis_partners')->where('id_partner', $partners->id_partner)->update($update);

      return redirect("admin/partners")->with("pesan", "data Partner ".$partners->nama_partner. " berhasil diubah");
    }
  }

  function hapus(Partners $partners){
     DB::table('sakwis_partners')->where("id_partner", $partners->id_partner)->delete();

     return redirect('admin/partners');
    }

}