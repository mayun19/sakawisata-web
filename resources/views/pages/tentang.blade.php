@extends('layouts.app')

@section('title', 'Profil')

@section('konten')
  <main>
    <!-- Header Page Tentang -->
    <section class="section-tentang-header text-center">
      <h1>Tentang Kami</h1>
    </section>
    <!-- Nav Page Tentang -->
    <section class="section-tentang-nav">
      <div class="container">
        <div class="row-tentang row justify-content-center">
          <ul class="nav nav-tab" id="tentang">
            <li class="nav-item nav-item-active">
              <a href="#kKauman" class="nav-link active" id="kKauman-tab" data-toggle="tab" aria-controls="kKauman" aria-selected="true">Kampung Kauman</a>
            </li>
            <li class="nav-item">
              <a href="#sWisata" class="nav-link" id="sWisata-tab" data-toggle="tab" aria-controls="sWisata" aria-selected="false">Saka Wisata</a>
            </li>
          </ul>
        </div>
      </div>
    </section>
    <!-- Content Page Tentang -->
    <section class="section-tentang-content">
      <div class="tentang-content tab-content" id="tentangContent">
        <div class="tab-pane fade show active" id="kKauman" role="tabpanel" aria-labelledby="kKauman-tab">
          <div class="container">
            <div class="kKauman-content">
              <div class="kKauman-judul">Kampung Kauman</div>
              <div class="kKauman-deskripsi" name="saka_deskripsi" >
                {!! pengaturan('deskripsi_kauman') !!}
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade sWisata" id="sWisata" role="tabpanel" aria-labelledby="sWisata-tab">
          <div class="sWisata-content">
            <div class="container">
              <div class="sWisata-layout" id="lsWisata">
                <div class="sWisata-judul">SAKAWISATA</div>
                <div class="saka_deskripsi">
                  {!! pengaturan('saka_deskripsi') !!}
                </div>
              </div>
            </div>
          </div>
          <div class="vMisi-content">
            <div class="container">
              <div class="vMisi-layout" id="lsWisata">
                <div class="vMisi-judul">Visi & Misi</div>
                <div class="visi_misi">
                  {!! pengaturan('visi_misi') !!}
                </div>
                <div class="sosmed">
                  <b>Ikuti Kami !</b>
                    <li class="list-unstyled mt-3 mb-4">
                      <a href="{{ pengaturan('youtube_saka') }}" name="youtube_saka"><img src="{{ asset('img/youtube-tentang.png') }}" alt=""></a> 
                      <a href="{{ pengaturan('facebook_saka') }}" name="facebook_saka"><img src="{{ asset('img/facebook-tentang.png') }}" alt=""></a>
                      <a href="{{ pengaturan('ig_saka') }}" nama="ig_saka"><img src="{{ asset('img/instagram.png') }}" alt=""></a>
                    </li>
                </div>
                <hr>
              </div>
            </div>
          </div>
          <div class="gmaps">
            <div class="gMaps-judul">Google Maps</div>
            <div class="gmaps-content">
              <iframe src="{{ pengaturan('gmaps_saka') }}" width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0" name="gmaps_saka">
            </iframe>
            </div>
          </div>
          <div class="contact" style="background-image: url('{{ url(pengaturan('bg_profil')) }}'); background-position: center center;">
            <div class="container">
              <div class="contact-layout">
                <div class="alamat">
                  <div class="judul">Alamat</div>
                  <p name="alamat_saka">{{ pengaturan('alamat_saka') }}2</p>
                </div>
                <div class="notelp">
                  <div class="judul">Nomor Telepon</div>
                  <p name="notelp_saka">{{ pengaturan('notelp_saka') }}</p>
                </div>
                <div class="email">
                  <div class="judul">Email</div>
                  <p name="email_saka">{{ pengaturan('email_saka') }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection
    