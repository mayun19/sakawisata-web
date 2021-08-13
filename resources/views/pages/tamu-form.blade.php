@extends('layouts.app')

@section('title', 'Buku Tamu')

@section('konten')
  <main>
    <!-- Header Page Tentang -->
    <section class="section-tamu-header text-center">
      <div class="container">
        <h1>Buku Tamu</h1>
        <p>Nikmatillah jelajah wisata di kampung kami "Kampung Kauman" <br> sebuah kampung yang menjadi saksi perjalanan Kasultanan Kraton Ngayogyakarta sejak tahun 1700an sampai sekarang</p>
      </div>
    </section>

    <!-- Nav Page Tentang -->
    <section class="section-pemandu-nav">
      <div class="container">
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item">Jelajah</li>
            <li class="breadcrumb-item active">Buku Tamu</li>
          </ol>
        </nav>
      </div>
    </section>

    <!-- Content Page Pemandu -->
    <section class="section-tamu-content mt-4 mb-4 pb-2">
      <div class="container d-flex justify-content-center">
        <div class="col-lg-8">
          <div class="card reschedule mt-3 mb-2">
            <div class="card-body" id="tambah">
              <div class="row d-flex justify-content-center">
                <div class="col-8 member-heading">
                  <h3 class="member-title">Buku Tamu</h3>
                  <hr class="member-line mt-0">
                  {{-- <p>Isi buku tamu untuk ID kunjungan : {{$kunjungan->kode_kunjungan}}</p> --}}
                </div>
              </div>
              @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>    
                  @endforeach
                </ul>
              </div>
              @endif
              <form action="{{ url('tamu/input_tamu/?kode='.request()->query('kode')) }}" method="post">
                @csrf
                <div class="row justify-content-center mt-4">
                  <div class="col-11 col-lg-8">
                    <div class="form-group">
                      <label for="id_kunjungan">Nama Lengkap *</label>
                      <input type="text"class="form-control col-10 " name="nama_tamu">
                    </div>
                    <div class="form-group">
                      <label for="id_kunjungan">Nomor Handphone *</label>
                      <small class="form-text text-muted">(Nomor yang terkoneksi dengan WhatsApp)</small>
                      <input type="tel" class="form-control col-10 " name="telp_tamu">
                    </div>
                    <div class="form-row">
                      <div class="form-group col-10 col-md-5">
                        <label for="id_kunjungan">Email</label>
                        <input type="email" class="form-control" name="email_tamu">
                      </div>
                      <div class="form-group col-10 col-md-5">
                        <label for="id_kunjungan">Instagram</label>
                        <input type="text" class="form-control" name="instagram">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="id_kunjungan">Asal Wisatawan *</label>
                      <input type="text" class="form-control col-10 " name="asal_tamu">
                    </div>
                    <div class="form-group">
                      <label for="id_kunjungan">Kesan Pesan *</label>
                      <textarea class="form-control col-10" name="pesan_tamu" id="" rows="5"></textarea>
                    </div>
                    <div class="row">
                      <div class="form-group col-10 text-right">
                        <button type="submit" class="btn btn-tambah px-3">Kirim</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection