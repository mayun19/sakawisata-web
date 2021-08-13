<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');
Route::get('/testimoni', 'HomeController@testimoni');

Route::get('/tentang', 'TentangController@index');

Route::get('/paket', 'PaketController@index');
Route::get('/paket/detail/{paket}', 'PaketController@detail');

Route::get('/situs', 'SitusController@index');
Route::get('/situs/all_situs', 'SitusController@all_situs');
Route::get('/situs/detail/{situs}', 'SitusController@detail');

Route::get('/pemandu', 'PemanduController@index');
Route::get('/pemandu/detail/{pemandu}', 'PemanduController@detail');
Route::get('/pemandu/detail/{pemandu}/tiket', 'PemanduController@detail_tiket');

Route::get('/bukutamu', 'BukuTamuController@index');
Route::post('/bukutamu/cek_kunjungan', 'BukuTamuController@cek_kunjungan');
Route::get('tamu/form_tamu', 'BukuTamuController@formtamu');
Route::post('/tamu/input_tamu', 'BukuTamuController@input_tamu');
Route::get('/tamu/sukses/', 'BukuTamuController@sukses_tamu');

Route::get('/event', 'EventController@index');
Route::get('/event/detail/{event}{nama_event}', 'EventController@detail');

Route::get('/faq', 'FaqController@index');

// Route::get('/admin/login', 'Admin\LoginController@index');

Route::get('/daftar', 'AuthController@daftar');
Route::post('/daftar', 'AuthController@daftar_member');
Route::get('/aktivasi/{kode}', 'AuthController@aktivasi');
Route::get('/login', 'AuthController@login');
Route::post('/login', 'AuthController@proses_login');
Route::post('/logout', 'AuthController@logout');
Route::get('/reset_password', 'AuthController@reset_password');
Route::post('/new_password', 'AuthController@new_password');
Route::get('/new_password/{reset}', 'AuthController@aktivasi_password');
Route::get('/ganti_password', 'AuthController@ganti_password');
Route::post('/password_baru', 'AuthController@simpan_pass');



Route::post('/ajax/cek_tanggal', 'AjaxController@cek_tanggal');
Route::post('/ajax/cek_sesi', 'AjaxController@cek_sesi');

Route::group(['middleware' => ['member']], function () {

	// Member
	Route::get('/member', 'Member\MemberController@index');
	Route::get('/edit_member/{member}', 'Member\MemberController@editmember');
	Route::post('/update_member/{member}', 'Member\MemberController@updatemember');
	Route::get('/member/pemesanan', 'Member\MemberController@riwayatpesan');
	Route::get('/member/konfirmasi_pembayaran/{pemesanan}', 'Member\MemberController@konfirmasibayar');
	Route::post('/member/simpan_pembayaran', 'Member\MemberController@simpanbayar');
	Route::get('/member/e-tiket/{pemesanan}', 'Member\MemberController@tiket');
	Route::get('/member/e-tiket/cetak/{kode_pemesanan}', 'Member\MemberController@cetak_tiket');
	
	Route::get('/member/reschedule/{pemesanan}', 'Member\MemberController@reschedule');
	Route::post('member/proses_reschedule/{pemesanan}', 'Member\MemberController@proses_reschedule');
	Route::get('/member/reschedule_rekomendasi/{id_reschedule}', 'Member\MemberController@reschedule_rekomendasi');
	Route::post('/member/konfirmasi_rekomendasi/{id_reschedule}', 'Member\MemberController@konfirmasi_rekomendasi');
	
	Route::get('/member/pembatalan/{pemesanan}', 'Member\MemberController@pembatalan');
	Route::get('/member/pembatalan/konfirmasi/{pemesanan}', 'Member\MemberController@pembatalan_konfirmasi');
	Route::post('/member/pembatalan/proses/{pemesanan}', 'Member\MemberController@proses_pembatalan');
	Route::get('/member/pembatalan-sukses', 'Member\MemberController@pembatalan_sukses');
	Route::get('/member/pembatalan-detail/{id_pemesanan}', 'Member\MemberController@pembatalan_detail');
	
	
	Route::get('/paket/pesan/{paket}', 'PaketController@pesan');
	Route::post('/paket/proses_pesan/{paket}', 'PaketController@proses_pesan');
	Route::get('/pesan/sukses/{pemesanan}', 'PaketController@sukses');
	
});

Route::group(['middleware' => ['admin']], function () {
	
	// Admin
	Route::get('/admin', 'Admin\HomeController@index');
	
	Route::get('/admin/member', 'Admin\MemberController@index');
	Route::get('/admin/member/hapus/{member}', 'Admin\MemberController@hapus');
	
	Route::get('/admin/paket', 'Admin\PaketController@index');
	Route::get('/admin/paket/tambah', 'Admin\PaketController@tambah');
	Route::get('/admin/paket/detail/{paket}', 'Admin\PaketController@detail');
	Route::post('/admin/paket/simpan', 'Admin\PaketController@simpan');
	Route::get('/admin/paket/edit/{paket}', 'Admin\PaketController@edit');
	Route::post('/admin/paket/update/{paket}', 'Admin\PaketController@update');
	Route::get('/admin/paket/hapus/{paket}', 'Admin\PaketController@hapus');
	
	Route::get('/admin/situs', 'Admin\SitusController@index');
	Route::get('/admin/situs/tambah', 'Admin\SitusController@tambah');
	Route::post('/admin/situs/simpan', 'Admin\SitusController@simpan');
	Route::get('/admin/situs/detail/{situs}', 'Admin\SitusController@detail');
	Route::post('/admin/situs/simpanfoto/{situs}', 'Admin\SitusController@simpanfoto');
	Route::get('/admin/situs/edit/{situs}', 'Admin\SitusController@edit');
	Route::post('/admin/situs/update/{situs}', 'Admin\SitusController@update');
	Route::get('/admin/situs/hapus_foto/{situs_foto}', 'Admin\SitusController@hapus_foto');
	Route::post('/admin/situs/simpan_foto/{situs}', 'Admin\SitusController@simpan_foto');
	Route::get('/admin/situs/hapus/{situs}', 'Admin\SitusController@hapus');
	
	Route::get('/admin/profil-kauman', 'Admin\PengaturanController@profil');
	Route::post('/admin/profil-kauman/update/kauman', 'Admin\PengaturanController@update_kauman');
	Route::post('/admin/profil-kauman/update/saka', 'Admin\PengaturanController@update_saka');
	
	Route::get('/admin/pemandu', 'Admin\PemanduController@index');
	Route::get('/admin/pemandu/tambah', 'Admin\PemanduController@tambah');
	Route::post('/admin/pemandu/simpan', 'Admin\PemanduController@simpan');
	Route::get('/admin/pemandu/detail/{pemandu}', 'Admin\PemanduController@detail');
	Route::get('/admin/pemandu/edit/{pemandu}', 'Admin\PemanduController@edit');
	Route::post('/admin/pemandu/update/{pemandu}', 'Admin\PemanduController@update');
	Route::get('/admin/pemandu/hapus/{pemandu}', 'Admin\PemanduController@hapus');
	
	Route::get('/admin/sesi', 'Admin\SesiController@index');
	Route::get('/admin/sesi/tambah', 'Admin\SesiController@tambah');
	Route::post('/admin/sesi/simpan', 'Admin\SesiController@simpan');
	Route::get('/admin/sesi/hapus/{sesi}', 'Admin\SesiController@hapus');
	
	Route::get('/admin/fasilitas', 'Admin\FasilitasController@index');
	Route::get('/admin/fasilitas/tambah', 'Admin\FasilitasController@tambah');
	Route::post('/admin/fasilitas/simpan', 'Admin\FasilitasController@simpan');
	Route::get('/admin/fasilitas/edit/{fasilitas}', 'Admin\FasilitasController@edit');
	Route::post('/admin/fasilitas/update/{fasilitas}', 'Admin\FasilitasController@update');
	Route::post('/admin/fasilitas/simpanfoto/{fasilitas}', 'Admin\FasilitasController@simpanfoto');
	Route::get('/admin/fasilitas/hapus/{fasilitas}', 'Admin\FasilitasController@hapus');
	
	Route::get('/admin/pemesanan', 'Admin\PemesananController@index');
	Route::get('/admin/pemesanan/detail_pemesanan/{pemesanan}', 'Admin\PemesananController@detailpesan');
	Route::post('/admin/pemesanan/simpan_pemesanan/{pemesanan}', 'Admin\PemesananController@update_info_pemesanan');
	Route::get('/admin/pemesanan/verifikasi_pembayaran/{pembayaran}', 'Admin\PemesananController@verifikasi_pembayaran');
	Route::get('/admin/pemesanan/ubah_pembayaran/{pembayaran}', 'Admin\PemesananController@ubah_pembayaran');
	Route::post('/admin/pemesanan/update_pembayaran/{pembayaran}', 'Admin\PemesananController@update_pembayaran');
	Route::get('/admin/pemesanan/detail_pembayaran/{pemesanan}', 'Admin\PemesananController@detailbayar');
	Route::post('/admin/pemesanan/input_pembayaran/{pemesanan}', 'Admin\PemesananController@input_bayar');
	
	Route::get('/admin/pemesanan/reschedule/{pemesanan}', 'Admin\PemesananController@reschedule');
	Route::post('/admin/pemesanan/terima_reschedule/{id_reschedule}', 'Admin\PemesananController@terima_reschedule');
	Route::post('/admin/pemesanan/kirim_rekomendasi/{id_reschedule}', 'Admin\PemesananController@kirim_rekomendasi');
	Route::get('/admin/pemesanan/reschedule_rekomendasi', 'Admin\PemesananController@reschedule_rekomendasi');
	Route::get('/admin/pemesanan/reschedule_list', 'Admin\PemesananController@reschedule_list');
	
	Route::get('/admin/pemesanan/pembatalan_list', 'Admin\PemesananController@pembatalan_list');
	Route::get('/admin/pemesanan/pembatalan/{id_pemesanan}', 'Admin\PemesananController@pembatalan');
	Route::post('/admin/pemesanan/pembatalan/proses', 'Admin\PemesananController@pembatalan_proses');
	Route::post('/admin/pemesanan/pembatalan/refund', 'Admin\PemesananController@pembatalan_refund');
	Route::get('/admin/pemesanan/pembatalan/selesai', 'Admin\PemesananController@pembatalan_selesai');
	
	Route::get('admin/pemesanan/checkin/{pemesanan}', 'Admin\PemesananController@proses_checkin');
	Route::get('admin/pemesanan/selesai/{pemesanan}', 'Admin\PemesananController@proses_selesai');
	
	Route::get('admin/buku-tamu', 'Admin\TamuController@index');
	Route::get('admin/buku-tamu/{kode_kunjungan}', 'Admin\TamuController@list_tamu');
	Route::get('admin/buku-tamu/detail_tamu/{id_bukutamu}', 'Admin\TamuController@detail_tamu');
	Route::get('admin/buku-tamu/cetak/{kode_kunjungan}', 'Admin\TamuController@cetak');
	Route::post('admin/buku-tamu/update_status/{id_bukutamu}', 'Admin\TamuController@update_status');
	Route::post('admin/buku-tamu/update_status_testimoni/{id_bukutamu}', 'Admin\TamuController@update_status_testimoni');
	
	Route::get('admin/laporan/transaksi', 'Admin\LaporanController@index');
	Route::get('admin/laporan/transaksi/cetak', 'Admin\LaporanController@cetak_transaksi');
	Route::get('admin/laporan/kunjungan', 'Admin\LaporanController@kunjungan');
	Route::get('admin/laporan/kunjungan/cetak', 'Admin\LaporanController@cetak_kunjungan');
	
	Route::get('/admin/partners', 'Admin\PartnersController@index');
	Route::get('/admin/partners/tambah', 'Admin\PartnersController@tambah');
	Route::post('/admin/partners/simpan', 'Admin\PartnersController@simpan');
	Route::get('/admin/partners/edit/{partners}', 'Admin\PartnersController@edit');
	Route::post('/admin/partners/update/{partners}', 'Admin\PartnersController@update');
	Route::post('/admin/partners/simpanfoto/{partners}', 'Admin\PartnersController@simpanfoto');
	Route::get('/admin/partners/hapus/{partners}', 'Admin\PartnersController@hapus');
	
	Route::get('/admin/event', 'Admin\EventController@index');
	Route::get('/admin/event/tambah', 'Admin\EventController@tambah_event');
	Route::post('/admin/event/simpan', 'Admin\EventController@simpan_event');
	Route::get('/admin/event/edit/{event}', 'Admin\EventController@edit_event');
	Route::post('/admin/event/update/{event}', 'Admin\EventController@update_event');
	Route::get('/admin/event/hapus/{event}', 'Admin\EventController@hapus');
	
	Route::get('/admin/faq', 'Admin\FaqController@index');
	Route::get('/admin/faq/tambah', 'Admin\FaqController@tambah');
	Route::post('/admin/faq/simpan', 'Admin\FaqController@simpan');
	Route::get('/admin/faq/edit/{faq}', 'Admin\FaqController@edit');
	Route::post('/admin/faq/update/{faq}', 'Admin\FaqController@update');
	Route::get('/admin/faq/hapus/{faq}', 'Admin\FaqController@hapus');

	Route::get('/admin/pengaturan', 'Admin\PengaturanController@index');
	Route::get('/admin/pengaturan/tambah', 'Admin\PengaturanController@tambah');
	Route::post('/admin/pengaturan/simpan', 'Admin\PengaturanController@simpan');
	Route::get('/admin/pengaturan/edit/{pengaturan}', 'Admin\PengaturanController@edit');
	Route::post('/admin/pengaturan/update/{pengaturan}', 'Admin\PengaturanController@update');
	Route::get('/admin/pengaturan/hapus/{pengaturan}', 'Admin\PengaturanController@hapus');
	
	Route::get('/admin/profil-admin', 'Admin\ProfilController@index');
	Route::post('/admin/profil-admin/update', 'Admin\ProfilController@ubah_profil');
	// Route::post('/update_member/{member}', 'Member\MemberController@updatemember');
});