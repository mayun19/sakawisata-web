@extends('layouts.admin')

@section('title', 'Koreksi Nominal Pembayaran')

@section('konten')
<div class="dashboard-heading">
    <h2 class="dashboard-title">Koreksi Nominal Pembayaran</h2>
    <p class="dashboard-subtitle">
        <a href="{{ url('admin/pemesanan') }}">Pemesanan </a> / <a href="{{ url('admin/pemesanan/detail_pemesanan/'.$pembayaran->id_pemesanan) }}"> Detail </a>/ <b>Ubah</b>
    </p>
</div>
<div class="dashboard-content">
  <div class="row mt-4">
    <div class="col-12 col-md-10 col-xl-10 mb-3">
      <div class="card">
        <div class="card-body" id="tambah">
          <div class="row section-pemesanan">
            <div class="col-12 col-md-12 col-xl-6 info-pemesanan">
              <p>Ubah Pembayaran</p>
            </div>
          </div>
          <form action="{{ url("admin/pemesanan/update_pembayaran/".$pembayaran->id_pembayaran) }}" method="post">
            @csrf
            <input type="hidden" name="id_pemesanan" value="{{$pembayaran->id_pemesanan}}">
            <div class="row mb-4">
                <div class="col-md-6 mb-2">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Rp</span>
                    </div>
                    <input	type="text"	name="jumlah_pembayaran"	class="form-control"	value="{{number_format($pembayaran->jumlah_pembayaran)}}" readonly/>
                  </div>
                </div>
                <div class="col-md-6 mb-2">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" class="form-control uang" name="jumlah_baru" placeholder="Masukkan jumlah pembayaran yang benar" id="jumlah_baru" required oninvalid="this.setCustomValidity('Wajib diisikan')">
                  </div>
                </div>
            </div>
            <div class="row">
              <div class="col text-right">
                <button type="submit" class="btn btn-tambah px-3">
                    Update Pembayaran
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection