@extends('layouts.app')

@section('title', 'Detail Situs')

@section('konten')   
  <main>
    <!-- Header -->
    <section class="section-detailPaket-header text-center">
    </section>

    <section class="section-detail-site-content">
      <div class="container">
        <div class="row">
          <div class="col-10 p-0">
            <nav>
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Jelajah</li>
                <li class="breadcrumb-item"><a href="{{ url('situs') }}">Situs Jelajah</a></li>
                <li class="breadcrumb-item active">Detail</li>
              </ol>
            </nav>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-8 pl-lg-0">
            <div class="card card-detail-site">
              <h1>{{ $situs->nama_situs }}</h1>
              <div class="gallery">
                <div class="xzoom-container">
                  <img src="{{ asset('img/situs/'.$situs->foto_situs) }}" class="xzoom" id="xzoom-default" xoriginal="{{ asset('img/situs/'.$situs->foto_situs) }}">
                </div>
                <div class="xzoom-thumbs">
                  <a href="{{ asset('img/situs/'.$situs->foto_situs) }}">
                  <img src="{{ asset('img/situs/'.$situs->foto_situs) }}" class="xzoom-gallery" width="128" height="80" xpreview="{{ asset('img/situs/'.$situs->foto_situs) }}">
                  </a>
                  @foreach ($foto as $item)
                  <a href="{{ asset('img/situs/'.$item->situs_foto) }}">
                    <img src="{{ asset('img/situs/'.$item->situs_foto) }}" class="xzoom-gallery" width="128" height="80" xpreview="{{ asset('img/situs/'.$item->situs_foto) }}">
                  </a>     
                  @endforeach
                </div>
              </div>
              <h2>Tentang {{ $situs->nama_situs }}</h2>
              <p>
                {!! $situs->deskripsi_situs !!}.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection

@push('prepend-style')
  <link rel="stylesheet" href="{{ asset('xzoom/xzoom.css') }}">
@endpush

@push('addon-script')
  <script src="{{ asset('xzoom/xzoom.min.js') }}"></script>
  <script>
    $(document).ready(function() {
      $('.xzoom, .xzoom-gallery').xzoom({
        zoomWidth: 500,
        title: false,
        tint: '#333',
        Xoffset: 10 
      });
    });
  </script>
@endpush