@extends('layouts.success')
@section('title', 'Checkout Success')

@section('content')
  <main>
  	<div class="section-success d-flex align-items-center">
  		<div class="col text-center">
  			<h1>Yay! Pemesanan Sukses</h1>
  			<img src="{{ asset('img/ic_sukses.png') }}" alt="pemesanan_sukses" />
  			<p>
  				Kami akan menginformasikan invoice <br />
  				pemesanan kunjunganmu via email
  			</p>
  			<a href="{{ url('/member/pemesanan') }}" class="btn btn-home-page mt-3 px-3"
  				>Lihat Detail Pemesanan</a
  			>
  		</div>
  	</div>
  </main>
@endsection
