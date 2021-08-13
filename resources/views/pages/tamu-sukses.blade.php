@extends('layouts.success')
@section('title', 'Buku Tamu Sukses')

@section('content')
  <main>
  	<div class="section-success d-flex align-items-center">
  		<div class="col text-center">
  			<h1>Terimakasih! <br>
					 Telah berkunjung di Kampung Wista Kauman
				</h1>
  			<img class="mt-4" src="{{ asset('img/ic_tamu.png') }}" alt="tamu_sukses" />
  			<p class="mt-3">
  				Abadikan momen jelajah kamu dengan mention <br>
					dan follow kami <a href="{{ pengaturan('ig_saka') }}">@sakawisata</a> di Instagram
  			</p>
  			<a href="{{ url('/') }}" class="btn btn-home-page mt-3 px-3"
  				>Halaman Beranda</a
  			>
  		</div>
  	</div>
  </main>
@endsection
