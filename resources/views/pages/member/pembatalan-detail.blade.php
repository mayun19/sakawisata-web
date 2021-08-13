@extends('layouts.member')

@section('title', 'Detail Pembatalan')

@section('konten')
<div class="row member d-flex mb-4">
  <div class="col-12 col-lg-10 mb-3">
    @if (session('pesan'))
      <div class="alert alert-success">
        {{ session('pesan') }}
      </div>
    @endif
    <div class="row d-flex justify-content-center">
      <div class="member-heading container">
        <h3 class="member-title">Detail Pembatalan Kunjungan</h3>
        <hr class="member-line mt-0">
      </div>
    </div>
    
    <div class="card">
      <div class="card-body" id="tambah">
        <div class="member-content mt-2 mb-3">
          <div class="container ">
            <div class="row d-flex">
              <div class="col-12 col-md-5"> 
                <div class="container timeline-content">
                  <h5 class="mt-2 mb-3 pembatalan-title">Status Pembatalan</h5>
                  <div class="timeline">
                    <div class="timeline-container primary">
                      <div class="timeline-icon">
                        <img src="{{ asset('img/ic_ajukan_pembatalan.svg') }}" alt="">
                      </div>
                      <div class="timeline-body">
                        <h4 class="timeline-title"><span class="badge">Pending</span></h4>
                        <p>Pembatalan Sedang Diverifikasi</p>
                        <p class="timeline-subtitle"><?php  echo date("d M Y", strtotime( $pembatalan->tanggal_pending))?> &nbsp; <?php  echo date("H:i:s ", strtotime( $pembatalan->tanggal_pending))?>
                        </p>
                      </div>
                    </div>
                    @if (!empty($pembatalan->tanggal_proses))
                    <div class="timeline-container danger">
                      <div class="timeline-icon">
                        <img src="{{ asset('img/ic_batal.svg') }}" alt="">
                      </div>
                      <div class="timeline-body">
                        <h4 class="timeline-title"><span class="badge">Proses Pembatalan</span></h4>
                        <p><b>Pembatalan Berhasil</b> <br> Pengembalian dana kunjungan sedang diproses.</p>
                        <p class="timeline-subtitle"><?php  echo date("d M Y", strtotime( $pembatalan->tanggal_proses))?> &nbsp; <?php  echo date("H:i:s ", strtotime( $pembatalan->tanggal_proses))?></p>
                      </div>
                    </div>
                    @endif
                    @if (!empty($pembatalan->tanggal_selesai))     
                    <div class="timeline-container success">
                      <div class="timeline-icon">
                        <img src="{{ asset('img/ic_batal_sukses.svg') }}" alt="">
                      </div>
                      <div class="timeline-body">
                        <h4 class="timeline-title"><span class="badge">Pembatalan Selesai</span></h4>
                        <p>Dana kunjungan telah dikirimkan</p>
                        <p class="timeline-subtitle"><?php  echo date("d M Y", strtotime( $pembatalan->tanggal_selesai))?> &nbsp; <?php  echo date("H:i:s ", strtotime( $pembatalan->tanggal_selesai))?></p>
                      </div>
                    </div>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-7">
                <div class="konfirmasi-bayar table-responsive pembatalan-content mt-2">
                  <h5 class="mt-2 mb-3 pembatalan-title">Kunjungan Dibatalkan</h5>
                  <table class="table-borderless detail-alasan-batal mb-2" style="width:100%">
                    <tr>
                      <td><b>Alasan Pembatalan</b></td>
                    </tr>
                    <tr>
                      <td class="alasan-batal">{{ $pembatalan->alasan_pembatalan }}.</td>
                    </tr>
                  </table>
                  <hr id="pembatalan">
                  <table class="table-borderless detail-pengembalian mb-2" style="width:100%">
                    <tr>
                      <td><b>Detail Pengembalian</b></td>
                    </tr>
                    <tr>
                      <td>Rekening Tujuan Refund</td>
                      <td style="text-align: right"><span class="badge bank px-3 py-2">{{ $pembatalan->nama_bank_refund }}</span> &nbsp; <b>{{ $pembatalan->no_rekening_refund }}</b></td>
                    </tr>
                    <tr>
                      <td>Nama Pemilik Rekening Refund</td>
                      <td style="text-align: right">{{ $pembatalan->nama_pemilik_refund }}</td>
                    </tr>
                    <tr>
                      <td>Total Pembayaran</td>
                      <td style="text-align: right">Rp. &nbsp;{{ number_format($pembayaran->jumlah) }}</td>
                    </tr>
                    <tr>
                      <td>Dana Pengembalian</td>
                      @if ($pembatalan->status_pembatalan != 'Pembatalan Selesai')
                      <td style="text-align: right">-</td>
                      @else
                      <td style="text-align: right">Rp. &nbsp;{{ number_format($pembatalan->dana_refund) }}</td>
                      @endif
                    </tr>
                  </table>
                  <hr id="pembatalan">
                  <table class="table table-borderless detail-pemesanan" style="width:100%">
                    <tr>
                      <td><b>Detail Pemesanan</b></td>
                    </tr>
                    <tr>
                      <td>ID Kunjungan</td>
                      <td style="text-align: right"><b>#{{$pemesanan->kode_kunjungan}}</b></td>
                    </tr>
                    <tr>
                      <td>Tanggal Kunjungan</td>
                      <td style="text-align: right"><?php  echo date("d M Y", strtotime( $pemesanan->tgl_kunjungan))?></td>
                    </tr>
                    <tr>
                      <td>Sesi Kunjungan</td>
                      <td style="text-align: right">{{ $pemesanan->waktu_kunjungan_paket }}</td>
                    </tr>
                    <tr>
                      <td>Paket Kunjungan</td>
                      <td style="text-align: right">{{ $pemesanan->nama_paket }}</td>
                    </tr>
                    <tr>
                      <td>Jumlah Paket </td>
                      <td style="text-align: right">{{ $pemesanan->jumlah_paket }}&nbsp; Paket</td>
                    </tr>
                    <tr>
                      <td>Total Pemesanan </td>
                      <td style="text-align: right">Rp &nbsp; {{number_format( $pemesanan->total_pemesanan) }}</td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
  <div class="member">
  </div>
@endsection

@push('addon-style')
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">

  <style>



  </style>
@endpush
