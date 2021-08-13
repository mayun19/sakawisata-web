@extends('layouts.success')
@section('title', 'Pembatalan Sukses')

@section('content')
  <main>
  	<div class="section-success d-flex align-items-center">
  		<div class="col text-center">
  			<h1 id="sukses-pembatalan">Pembatalan kamu telah kami terima</h1>
  			<img class="mt-4" src="{{ asset('img/ic_pembatalan_sukses.png') }}" alt="pembatalan_sukses" />
  			<p class="mt-3">
					Pembatalan maksimal kami proses <strong>1x24 jam</strong>. Update pembatalan mu dapat dilihat <br> pada aksi detail pembatalan di halaman member atau halaman riwayat pemesanan.
				</p>
  			<a href="{{ url('/member') }}" class="btn btn-home-page mt-3 px-3"
  				>Kembali ke Halaman Member</a
  			>
  		</div>
  	</div>
  </main>
@endsection
