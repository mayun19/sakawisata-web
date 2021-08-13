@extends('layouts.app')

@section('title', 'Pemandu')

@section('konten')
  <main>
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
                <li class="breadcrumb-item active">Pemandu</li>
              </ol>
        </nav>
      </div>
    </section>

    <!-- Content Page Pemandu -->
    <section class="section-pemandu-content pb-2">
      <div class="container">
        <div class="pemandu-judul row py-4 justify-content-center">
          <h2>Pemandu</h2>
        </div>
        <div class="content-pemandu row justify-content-center">
          @foreach ($pemandu as $item)
          <div class="col-sm-3 my-3">
            <div class="card-pemandu card d-flex flex-column text-center">
              <a href="{{ url('pemandu/detail/'.$item->id_pemandu) }}">
                <img class="card-img-top my-auto rounded-circle" src="{{ asset('img/pemandu/'.$item->foto_pemandu) }}" alt="Card image cap">
                <div class="card-body px-0 pb-0">
                  <h5 class="pemandu-nama">{{ $item->nama_pemandu }}</h5>
                  <p class="pemandu-job">Pemandu</p>
                </div>
              </a>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>
  </main>
@endsection