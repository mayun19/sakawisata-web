@extends('layouts.app')

@section('title', 'Situs Jelajah')
@section('konten')
  <main>
    <!-- Header -->
    <section class="section-situs-header text-center">
    </section>
    
    <section class="section-paket-content">
      <div class="container">
        <div class="row">
          <div class="col-10 p-0">
            <nav>
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Jelajah</li>
                <li class="breadcrumb-item"><a href="{{ url('situs') }}">Situs Jelajah</a></li>
                <li class="breadcrumb-item active">Semua Situs</li>
              </ol>
            </nav>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-11 pl-lg-0">
            <div class="card card-situs">
              <div class="situs-heading text-center">
                <h1>Situs Kunjungan </h1>
                <hr>
                <div class="col-sm-6 col-md-6  col-lg-7  mx-auto situs-deskripsi">
                  <p>
                    Eksplor situs situs sejarah Kesultanan Yogyakarta dan kisah aktivis sosial Ahmad Dahlan Di Kampung Wisata Kauman Bersama Kami SAKAWISATA
                  </p>
                </div>
              </div>
              <div class="content-situs">
                <div class="col-lg-8 mx-auto ">
                 <div class="row row-situs-item justify-content-center">
                  @foreach ($all_situs as $item)
                    <div class="col-sm-5 col-md-5 col-lg-6 situs-item mb-3">
                      <div class="card-item-situs text-center d-flex flex-column">
                        <a href="{{ url('situs/detail/'.$item->id_situs) }}">
                          <img src="{{ asset('/img/situs/'.$item->foto_situs) }}" class="item-situs-bg" alt="">
                          <div class="situs-name">
                            <span>{{ $item->nama_situs }}</span>
                          </div>
                        </a>
                      </div>
                    </div>
                  @endforeach         
                 </div>
                  <div class="row d-flex justify-content-center text-center">
                    {!! $all_situs->links() !!}   
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  @push('addon-style')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

  <style>
    .slider-situs {
      position: relative;
    }

    .owl-nav {
      width: 100%;
      position: absolute;
      top: 50%;
    }

    .card-situs .slider-situs .owl-nav button {
      background-color: rgba(0,0,0,0.5)!important;
      padding: 5px 13px!important;
      border-radius: 50%!important;
      font-size: 20px!important;
    }

    .owl-nav .owl-prev {
      position: absolute;
      left: 0;
    }

    .owl-nav .owl-next {
      position: absolute;
      right: 0;
    }

  </style>

  @endpush

  @push('addon-script')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
      <script>
        $('.slider-situs').owlCarousel({
            loop:true,
            margin:10,
            nav: true,
            dots: false,
            items: 1,
            navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>']

        })
      </script>
  @endpush

@endsection