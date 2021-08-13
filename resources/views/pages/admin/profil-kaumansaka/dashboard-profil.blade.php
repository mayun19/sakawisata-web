@extends('layouts.admin')

@section('title', 'Profil Kampung Kauman')

@section('konten')
<div class="dashboard-heading">
  <h2 class="dashboard-title">Profil Kampung Kauman</h2>
  <p class="dashboard-subtitle">
    Kelola data Profil
  </p>
</div>
<div class="dashboard-content">
  <div class="row mt-4">
    <div class="col-12 col-md-10 col-lg-10 mt-2">
      @if (session('pesan'))
        <div class="alert alert-success">
        {{ session('pesan') }}  
        </div>  
      @endif
      <div class="card mb-3">
        <div class="card-body container" id="tambah">
          <section class="section-tentang-nav">
            <div class="row-tentang row justify-content-start">
              <ul class="nav nav-tab" id="tentang">
                <li class="nav-item nav-item-active">
                  <a href="#kKauman" class="nav-link active" id="kKauman-tab" data-toggle="tab" aria-controls="kKauman" aria-selected="true">Kampung Kauman</a>
                </li>
                <li class="nav-item">
                  <a href="#sWisata" class="nav-link" id="sWisata-tab" data-toggle="tab" aria-controls="sWisata" aria-selected="false">SAKAWISATA</a>
                </li>
              </ul>
            </div>
          </section>
          <section class="section-tentang-content">
            <div class="tentang-content tab-content" id="tentangContent">
              <div class="tab-pane fade show active" id="kKauman" role="tabpanel" aria-labelledby="kKauman-tab">
                <div class="col-md-12">
                  <form action="{{ url('admin/profil-kauman/update/kauman') }}" method="post">
                    @csrf
                    <div class="form-group mt-2">
                      <label for="">Deskripsi</label>
                      <textarea name="deskripsi_kauman" id="editor1" rows="15" class="form-control">
                        {{ pengaturan('deskripsi_kauman') }}
                      </textarea>
                    </div>
                    <div class="row">
                      <div class="col text-center">
                        <button class="btn btn-tambah px-3 btn-block"> Simpan Profil </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="tab-pane fade sWisata" id="sWisata" role="tabpanel" aria-labelledby="sWisata-tab">
                <div class="col-md-12">
                  <form action="{{ url('admin/profil-kauman/update/saka') }}" method="post"  enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="">Deskripsi SAKAWISATA</label>
                      <textarea name="saka_deskripsi" class="form-control" id="editor2" rows="7">
                        {{ pengaturan('saka_deskripsi') }}
                      </textarea>
                    </div>
                    <div class="form-group mt-2">
                      <label for="">Visi & Misi</label>
                      <textarea name="visi_misi" id="editor3" rows="7" class="form-control">
                        {{ pengaturan('visi_misi') }}
                      </textarea>
                    </div>
                    <h5 class="section">-Sosial Media-</h5>
                    <div class="form-row">
                      <br>
                      <div class="form-group col-4 col-md-4">
                        <label for="sosmed-yt">Youtube</label>
                        <input type="url" name="youtube_saka" id="sosmed-yt" class="form-control" value="{{ pengaturan('youtube_saka') }}">
                      </div>
                      <div class="form-group col-4 col-md-4">
                        <label for="sosmed-fb">Facebook</label>
                        <input type="url" name="facebook_saka" id="sosmed-fb" class="form-control" value="{{ pengaturan('facebook_saka') }}">
                      </div>
                      <div class="form-group col-4 col-md-4">
                        <label for="sosmed-ig">Instagram</label>
                        <input type="url" name="ig_saka" id="ig_saka" class="form-control" value="{{ pengaturan('ig_saka') }}">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="gmaps">Google Maps Lokasi</label>
                      <textarea name="gmaps_saka" class="form-control" id="gmaps" rows="5">{{ pengaturan('gmaps_saka') }}</textarea>
                    </div>
                    <h5 class="section">-Kontak-</h5>
                    <div class="form-group">
                      <label for="alamat">Alamat</label>
                       <textarea name="alamat_saka" id="alamat" class="form-control" rows="4">{{ pengaturan('alamat_saka') }}</textarea>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="">No Telepon</label>
                        <input type="tel" name="notelp_saka" id="saka-no-telp" class="form-control" value="{{ pengaturan('notelp_saka') }}">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="">Email SAKAWISATA</label>
                        <input type="email" name="email_saka" id="email_saka" class="form-control" value="{{ pengaturan('email_saka') }}" >
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="item-situs-foto">Foto Background Profil Kontak</div>
                        <div class="row foto-situs my-2">
                          <div class="col-md-6">
                            <div class="gallery-container">
                              <img src="{{ url(pengaturan('bg_profil'))}}" class="img-fluid" alt="image cap" style="max-height: 200px; object-fit: cover;">
                            </div>
                          </div> 
                          <br>
                        </div>
                        <div class="row mt-3 text-center">
                          <div class="col-md-6">
                            <span class="btn btn-sm btn-block btn-gallery">
                              Background Profil Kontak
                            <input type="file" name="bg_profil" id="">
                            </span>
                          </div> 
                        </div>
                      </div>
                    </div>
                    <div class="row mt-4">
                      <div class="col text-center">
                        <button class="btn btn-tambah px-3 btn-block"> Simpan Profil </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
		<script>
			CKEDITOR.replace( 'editor1' );
			CKEDITOR.replace( 'editor2' );
			CKEDITOR.replace( 'editor3' );
    </script>
@endpush