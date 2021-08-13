@extends('layouts.member')

@section('title', 'Pembatalan Kunjungan')

@section('konten')
  <div class="member">
    <div class="row container d-flex justify-content-center mb-4">
      <div class="col-12 col-lg-9 mb-3">
        @if (session('pesan'))
				  <div class="alert alert-success">
				  	{{ session('pesan') }}
				  </div>
				@endif
        <div class="card">
          <div class="card-body" id="tambah">
            <div class="member-content mt-4 mb-3">
              <div class="konfirmasi-bayar">
                <form action="{{ url('member/pembatalan/konfirmasi') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="container d-flex justify-content-center">
                      <div class="col-md-5">
                        <img class="w-100" src="{{ asset('img/ic_batal.png') }}" alt="">
                      </div>
                      <div class="col-md-7">
                        <div class="member-heading">
                         <h3 class="member-title">Pembatalan Kunjungan #{{ $pemesanan->kode_kunjungan }}</h3>
                         <hr class="member-line mt-0">
                        </div>
                        <br>
                        <div class="pembatalan content mt-4">
                          <h5 class="pembatalan-deskripsi text-left">Apakah kamu yakin, ingin <b>membatalkan kunjungan</b> mu?</h5>
                        </div>
                        <div class="row text-center mt-4">
                          <div class="col-md-6 mb-3">
                            <a class="btn btn-sm btn-success px-2" href="{{ url('member/pemesanan') }}">Tidak, Lanjutkan Kunjungan</a>
                          </div>
                          <div class="col-md-6 mb-3">
                            <a class="btn btn-sm btn-danger px-2" href="{{ url('member/pembatalan/konfirmasi/'.$pemesanan->id_pemesanan) }}">Ya, Batalkan Kunjungan</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
