@extends('layouts.app')
{{-- @extends('theme') --}}
@section('title', 'Kampung Wisata Kauman Yogyakarta')

@section('konten')
  <!-- Header -->
  <header class="text-center" id="hero-area">
    <h1>
        Selamat Datang <br/>
        di Kampung Wisata <span>Kauman</span>
    </h1>
    <p class="mt-3">
      {!! pengaturan('heading_situs') !!}
    </p>
    <a href="#hl-paket" class="btn btn-jelajahi px-4 mt-4">Jelajahi!</a>
  </header>
  <main data-spy="scroll">
    <section class="section-hl-paket" id="hl-paket">
      <div class="container">
        <div class="row">
          <div class="col text-center section-hl-paket-heading">
            <h2>Paket Kunjungan</h2>
            <p>{!! pengaturan('hl_paket_deskripsi') !!}</p>
          </div>
        </div>
      </div>
    </section>
    <section class="section-hl-paket-content" id="hlpaketContent">
      <div class="container">
        <div class="section-hl-paket-row row justify-content-center">
          @foreach ($paket as $key => $item)
            <div class="col-sm-6 col-md-4 col-lg-3">
              <div class="card-paket text-center d-flex flex-column"
                style="background-image: url('{{ asset('img/paket/'. $item->foto_paket) }}')">
                <div class="paket-hl">PAKET</div>
                <div class="hl-paket-name">{{ $item->nama_paket }}</div>
                <div class="hl-paket-button mt-auto">
                  <a href="{{ url('paket/detail/'.$item->id_paket) }}" class="btn btn-hl-paket-detail px-3">
                    Lihat Detail
                  </a>
                </div>
              </div>
            </div>                  
          @endforeach
        </div>
        <div class="link-page-paket row justify-content-center">
          <a href="{{ url('paket/') }}" class="btn btn-link-page-paket px-4 mt-4">
            Lihat Lainnya <img src="{{ asset('img/ic_arrowright.png') }}" alt=""/>
          </a>
        </div>
      </div>
    </section>
    <section class="section-hl-situs" id="hl-situs">
      <div class="container">
        <div class="hl-situs-row row justify-content-center">
          <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="heading-hl-situs text-center d-flex flex-column">
              <h2>Situs Jelajah</h2>
              <p>
                {{pengaturan('deskripsi_hl_situs')}}
              </p>
            </div>
            <div class="link-page-situs row justify-content-center">
              <a href="{{ url('/situs') }}" class="btn btn-link-page-situs px-5 mt-4"
                >Telusuri...</a
              >
            </div>
          </div>
          @foreach ($situs as $key => $item)
            @if ($key < 3)   
            <div class="col-sm-6 col-md-4 col-lg-3">
              <div class="card-hl-situs text-center d-flex flex-column"> 
                <a href="{{ url('situs/detail/'.$item->id_situs) }}">
                  <img src="{{ asset('img/situs/'.$item->foto_situs) }}" class="hl-situs-bg" alt="">
                  <div class="hl-situs-content">
                    <div class="hl-situs-name">
                       <span>{{ $item->nama_situs }}</span>
                    </div>
                  </div>
                </a>
              </div>
            </div>
            @endif         
          @endforeach
        </div>
      </div>
    </section>
    <section class="wa-popup" id="wa-popup">
      <div class="container">
        <div class="wa-popup-row row">
          <div class="col wa-pop">
            <a href="{{ pengaturan('link_wa') }}" target="_blank">
              <img src="{{ asset('img/pop_wa.png') }}" alt=""/>
            </a>
          </div>
        </div>
      </div>
    </section>
    <section class="section-ig" id="ig">
      <div class="container">
        <div class="ig-heading-row row justify-content-center">
          <div class="col text-center ig-heading">
            <h2>Instagram</h2>
            <p>
              {!! pengaturan('deskripsi_ig') !!}
              <a href="{{ pengaturan('ig_saka') }}">@sakawisata</a>
            </p>
          </div>
        </div>
        <div class="ig-content-row row justify-content-center">
        <!-- LightWidget WIDGET -->
          <script src="https://cdn.lightwidget.com/widgets/lightwidget.js"></script>
          <iframe src="{{ pengaturan('widget_ig') }}" scrolling="no" allowtransparency="true" class="lightwidget-widget" style="width:100%;border:0;overflow:hidden;"></iframe>
        </div>
      </div>
    </section>
    <section class="testimoni" id="testimoni">
      <div class="container">
        <div class="ig-heading-row row justify-content-center">
          <div class="col text-center ig-heading">
            <h2>Testimoni</h2>
            <p>
               {!! pengaturan('deskripsi_testi') !!}
            </p>
          </div>
        </div>
        <div class="row testimoni-content">
          @foreach ($testimoni as $testi)
          <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card mb-3 d-flex flex-column">
              <div class="container card-testimoni">
                <p>"{{ Str::limit($testi->pesan_tamu, 100)}}"</p>
                <h4>{{ $testi->nama_tamu }}</h4>
                <h5>{{ $testi->asal_tamu }}</h5>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        <div class="link-page-testimoni row justify-content-center">
          <a href="{{ url('testimoni/') }}" class="btn btn-link-page-testimoni px-4 mt-4">
            Lihat Testimoni Lainnya &ensp; <i class="fas fa-long-arrow-alt-right"></i>
          </a>
        </div>
      </div>
    </section>
    <section class="section-partner" id="partner">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <h2>Partnership</h2>
            <p>
              {!! pengaturan('deskripsi_partner') !!}
            </p>
          </div>
          <div class="col-md-8 text-center">
            <div class="row">
              @foreach ($partners as $partners)
              <div class="col-md-3">
                <a href="{{ url($partners->link_partner) }}">
                <img class="img-fluid" src="{{ asset('img/partners/'.$partners->foto_partner) }}" alt="">
                </a>
              </div>
            @endforeach
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer class="section-footer mb-2 border-top">
      <div class="container pt-5 pb-3">
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="row">
              <div class="col-12 col-lg-6">
                <div class="container">
                  <img
                    src="{{ asset('img/logo_sakawisata.png') }}"
                    alt="logoFooter"
                  />
                  <ul class="list-unstyled mt-4 mb-4">
                    <li>
                      <a href="{{ pengaturan('link_gmaps') }}"
                        > {!! pengaturan('deskripsi_alamat') !!}</a
                      >
                    </li>
                    <li>
                      <a href="{{ pengaturan('link_wa') }}"
                        ><img
                          src="{{ asset('img/ic_wa_footer.png') }}"
                          alt="footerWa"
                          class="img-footer-wa mr-3"
                        />{{ pengaturan('notelp_saka') }}</a
                      >
                    </li>
                    <li>
                      <a href="{{ pengaturan('link_email') }}"
                        ><img
                          src="{{ asset('img/ic_mail_footer.png') }}"
                          alt="footerMail"
                          class="img-footer-mail mr-3"
                        />{{ pengaturan('email_saka') }}</a
                      >
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-12 col-lg-6">
                <div class="container">
                  <h3>Ikuti Kami!</h3>
                  <div class="footer-ic-socmed">
                    <li class="list-unstyled mt-1 mb-2">
                      <a href="{{ pengaturan('ig_saka') }}"
                        ><img src="{{ asset('img/ic_ig.png')}}" alt="footerIg"
                      /></a>
                      <a href="{{ pengaturan('youtube_saka') }}"
                        ><img
                          src="{{ asset('img/ic_youtube.png') }}"
                          alt="footerYt"
                      /></a>
                      <a href="{{ pengaturan('facebook_saka') }}"
                        ><img src="{{ asset('img/ic_fb.png') }}" alt="footerFb"
                      /></a>
                    </li>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      @push('addon-script')
        
        <script>
          var hero = document.getElementById("hero-area");
          var waPopup = document.getElementById("wa-popup");
          var tinggiHero = hero.offsetHeight - 200;
          var posisiScroll = window.pageYOffset;

          window.onscroll = function() {

            var posisiScroll = window.pageYOffset;

            console.log('hero', tinggiHero)
            console.log('scroll skrg', posisiScroll)

            // jika posisi scroll saat ini melebihi tinggi Hero area
            // maka wa-popup nya muncul, sebaliknya wa-popup disembunyikan
            if(posisiScroll > tinggiHero)
            {
              waPopup.style = 'opacity: 1';
            } else {
              waPopup.style = 'opacity: 0';
            }

          }
        </script>
      @endpush
@endsection