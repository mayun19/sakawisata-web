<?php 

use Illuminate\Support\Facades\DB;

function pengaturan($nama)
{
	$ambil = DB::table('sakwis_pengaturan')->where('nama_pengaturan', $nama)->first();

	return $ambil->isi_pengaturan;
}
