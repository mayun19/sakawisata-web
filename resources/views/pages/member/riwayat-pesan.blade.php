@extends('layouts.member')

@section('title', 'Riwayat Pemesanan')

@push('addon-style')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
@endpush

@section('konten')
  <div class="col-lg-10 member mt-5 ">
    <div class="member-heading">
     <h3 class="member-title">Riwayat Pemesanan</h3>
     <hr class="member-line mt-0">
    </div>
    @if (session('pesan'))
      <div class="alert alert-success">
      {{ session('pesan') }}  
      </div>  
    @endif
    <div class="member-content mt-5 mb-5">
      <div class="riwayat-pesan mb-4">
        <div class="table-responsive-xl">
          <table class="table">
            <thead class="thead-dark">
              <tr class="">
                <th scope="col">Booking ID</th>
                <th scope="col">Tanggal Pesan</th>
                <th scope="col">Tanggal Kunjungan</th>
                <th scope="col">Paket Kunjungan</th>
                <th scope="col" width="100">Total Bayar</th>
                <th scope="col">Status</th>
                <th scope="col" width="200" id="aksi">Aksi</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($pemesanan as $pesan)
              <tr class="pemesansan">
                <th scope="row">{{ $pesan->kode_pemesanan }}</th>
                <td scope="row"><?php  echo date("d M Y", strtotime($pesan->tgl_pemesanan))?></td>
                <td scope="row"><?php  echo date("d M Y", strtotime($pesan->tgl_kunjungan))?> <br> {{ $pesan->waktu_kunjungan_paket }}</td>
                <td scope="row">{{ $pesan->nama_paket }}</td>
                <td scope="row">Rp{{ number_format($pesan->total_pemesanan) }}</td>
                @if ($pesan->status_reschedule == 'Direkomendasikan')
                <td scope="row">{{ $pesan->status_pemesanan }} - <span class="badge badge-info">rekomendasi</span></td>
                @else
                <td>{{ $pesan->status_pemesanan }}</td>
                @endif
                <td scope="row" id="aksi">
                  <!--btn konfirmasi pembayaran jika status_pemesanan Pending/DP-->
                  @if (($pesan->status_pemesanan)=="Pending" || ($pesan->status_pemesanan)=="DP")
                  <a href="{{ url('member/konfirmasi_pembayaran/'.$pesan->kode_pemesanan) }}" class="btn btn-danger btn-sm " data-toggle="tooltip" title="Konfirmasi Pembayaran"><i class="fas fa-credit-card"></i></a>
                  @endif

                  <!--btn e-tiket jika status_pemesanan != 'PENDING'-->
                  @if (($pesan->status_pemesanan) !== "Pending"  && ($pesan->status_pemesanan) !=='Jadwal Ulang' && ($pesan->status_pemesanan !== 'Kedaluarsa') && ($pesan->status_pemesanan !== 'Batal') &&($pesan->status_pemesanan !== 'Menunggu Konfirmasi Admin'))
                  <a href="{{ url('member/e-tiket/'.$pesan->kode_pemesanan) }}" class="btn btn-success btn-sm" data-toggle="tooltip" title="Lihat E-Tiket"><i class="fas fa-ticket-alt"></i></a>
                  @endif
                  
                  <!--btn reschedule dan btn pembatalan jika status_pemesanan = 'DP' atau 'Proses' -->
                  @if (($pesan->status_pemesanan=="DP" || $pesan->status_pemesanan=="Proses" ) 
                  && ($pesan->status_reschedule != "Diterima"))                   
                  <a href="{{ url('member/reschedule/'.$pesan->id_pemesanan) }}" class="btn btn-info btn-sm" data-toggle="tooltip" title="Reschedule Kunjungan"><i class="fas fa-calendar-alt"></i></a>
                  <a href="{{ url('member/pembatalan/'.$pesan->id_pemesanan) }}" class="btn btn-secondary btn-sm" data-toggle="tooltip" title="Pembatalan Kunjungan"><i class="far fa-calendar-times"></i></a>
                   @elseif($pesan->status_pemesanan=="DP" || $pesan->status_pemesanan=="Proses")
                  <a href="{{ url('member/pembatalan/'.$pesan->id_pemesanan) }}" class="btn btn-secondary btn-sm" data-toggle="tooltip" title="Pembatalan Kunjungan"><i class="far fa-calendar-times"></i></a>
                  @endif

                  @if ($pesan->status_pemesanan=="Kunjungan" )
                    <a href="{{ url('/tamu/form_tamu?kode='.$pesan->kode_kunjungan) }}" class="btn btn-info btn-sm" data-toggle="tooltip" title="Isi Buku Tamu"><i class="fas fa-address-book"></i></a>  
                  @endif

                  @if (($pesan->status_reschedule)=='Pending')
                      -
                  @endif

                  <!--btn rekomendasi reschedule jika jadwal kunjungan reschedule tidak tersedia -->
                  @if (($pesan->status_reschedule)=='Direkomendasikan')    
                  <a href="{{ url('member/reschedule_rekomendasi/' .$pesan->id_reschedule) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Rekomendasi Reschedule"><i class="fas fa-star"></i></a>
                  @endif
                  
                  @if ($pesan->status_pemesanan == 'Batal')
                  <a href="{{ url('member/pembatalan-detail/' . $pesan->id_pemesanan) }}" class="btn btn-secondary btn-sm" data-toggle="tooltip" title="Detail Pembatalan">
                    <i class="fas fa-calendar-times"></i>
                  </a>
                  @endif
                  {{-- btn opsi kedaluarsa --}}
                  @if (($pesan->status_pemesanan == 'Kedaluarsa') || ($pesan->status_pemesanan =="Menunggu Konfirmasi Admin"))
                      -
                  @endif
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
          <hr />  
          {!! $pemesanan->links() !!}   
        </div>
        <div class="notes">
          <p>**Pengajuan <span style="color:#a56c70; font-weight: 650; font-size: 17px;">Reschedule</span>  maksimal H-3 kunjungan dan hanya dilakukan <span style="color: #a56c70; font-weight: 650; font-size: 17px;">satu kali pengajuan</span>.</p>
          <p>**Pengajuan <span style="color:#a56c70; font-weight: 650; font-size: 17px;">Pembatalan</span>  maksimal H-3 kunjungan dan hanya dilakukan <span style="color: #a56c70; font-weight: 650; font-size: 17px;">satu kali pengajuan</span>.</p>
        </div>
      </div>
    </div>
  </div>
@endsection