@extends('layouts.app')

@section('title', 'Paket Kunjungan')

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
        <div class="col-lg-5">
          @if(session('gagal'))
            <div class="alert alert-danger">{{session('gagal')}}</div>
          @endif
          <div class="card reschedule mb-2">
            <div class="card-body" id="tambah">
              <div class="row d-flex justify-content-center">
                <div class="col-8 member-heading">
                  <h3 class="member-title">Buku Tamu</h3>
                  <hr class="member-line mt-0">
                </div>
              </div>
              <form action="{{url('bukutamu/cek_kunjungan/')}}" method="post">
                @csrf
                <div class="row justify-content-center mt-4">
                  <div class="col-10">
                    <div class="form-group">
                      <label for="id_kunjungan">ID Kunjungan</label>
                        <input type="text"class="form-control col-10" id="id_kunjungan" name="id_kunjungan">
                    </div>
                  </div>
                </div>
                <div class="row btn-ajukan">
                  <div class="col-10 text-right">
                    <div class="form-group col-12">
                      <button type="submit" class="btn btn-tambah px-3" disabled>Lanjutkan</button>
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

@push('addon-script')
  <script>
    $(document).ready(function() {
      $("input[name=id_kunjungan]").on("change", function() {
        var kunjungan = $(this).val();

        if (kunjungan == ""){
          $("button").prop('disabled', true);
        }else{
          $("button").prop('disabled', false);
        }

        $("input[name=id_kunjungan]").trigger('input');
      })
    })
  </script> 
@endpush