@extends('layouts.app')

@section('title', 'Pemandu')

@section('konten')
  <main class="detail_pemandu">
    <!-- Header Page Tentang -->
    <section class="section-pemandu-header text-center">
      <div class="container">
        <h1>Tim SAKAWISATA</h1>
        <p>Nikmatillah jelajah wisata di kampung kami "Kampung Kauman" <br> sebuah kampung yang menjadi saksi perjalanan Kasultanan Kraton Ngayogyakarta sejak tahun 1700an sampai sekarang</p>
      </div>
    </section>

    <!-- Nav Page Tentang -->
    <section class="section-pemandu-nav">
      <div class="container">
        <nav>
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Tentang</li>
                <li class="breadcrumb-item"><a href="{{ url('pemandu') }}">Pemandu</a></li>
                <li class="breadcrumb-item active">Detail Pemadu</li>
              </ol>
        </nav>
      </div>
    </section>

    <!-- Content Page Pemandu -->
    <section class="section-pemandu-content-detail pb-2">
      <div class="container">
        <div class="pemandu-judul row py-4 justify-content-center">
          <h2>Pemandu</h2>
        </div>
        <div class="content-pemandu-detail row d-flex justify-content-center">
          <div class="col-sm-3 my-4 d-flex justify-content-center">
            <img class="foto-pemandu my-auto rounded-circle" src="{{ asset('img/pemandu/'.$pemandu->foto_pemandu) }}" alt="Card image cap">
          </div>
          <div class="col-sm-6 my-3">
            <div class="pemandu-detail px-0 pb-0 text-left">
              <h4 class="sapa-pemandu mb-2">Hai, {{ $pemandu->nama_pemandu }} di sini!</h4>
              <p class="pemandu-bahasa">Bahasa: {{ $pemandu->bahasa_pemandu }}</p>
              <p class="pemandu-tahun">Tahun bergabung:     {{ $pemandu->tahun_gabung_pemandu }}</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection