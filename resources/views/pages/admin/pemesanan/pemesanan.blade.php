@extends('layouts.admin')

@section('title', 'Pemesanan')

@section('konten')
  <div class="dashboard-heading">
    <h2 class="dashboard-title">Data Pemesanan</h2>
    <p class="dashboard-subtitle">
      Kelola data pemesanan
    </p>
  </div>
  <div class="dashboard-content">
    <div class="row mt-4">
      <div class="col-11 mt-2">
        @if(session('sukses'))
	      <div class="alert alert-success">
	      	{{session('sukses')}}
	      </div>
	      @endif
        <div class="card mb-3">
          <div class="card-body">
            <div class="table-responsive-xl">
              <table class="table" id="datatable">
                <thead class="thead-dark">
                  <tr class="">
                    <th scope="col">No</th>
                    <th scope="col">Booking ID</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Tanggal Pesan</th>
                    <th scope="col">Tanggal Kunjungan</th>
                    <th scope="col">Paket Kunjungan</th>
                    <th scope="col">Total Bayar</th>
                    <th scope="col">Status</th>
                    <th scope="col" width="100" id="aksi">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($pemesanan as $key => $item )
                  <tr class="pemesanan">
                    <td scope="row">{{ $key+1 }}</td>
                    <td>{{ $item->kode_pemesanan }}</td>
                    <td>{{ $item->nama_member }}</td>
                    <td>{{ $item->tgl_pemesanan }}</td>
                    <td><?php  echo date("d M Y", strtotime($item->tgl_kunjungan))?> <br> {{ $item->waktu_kunjungan_paket }}</td>
                    <td>{{ $item->nama_paket }}</td>
                    <td>Rp {{ number_format($item->total_pemesanan) }}</td>
                    @if ($item->status_reschedule == 'Direkomendasikan')
                    <td scope="row">{{ $item->status_pemesanan }} <br> <span class="badge badge-info">rekomendasi</span></td>
                    @elseif($item->status_pemesanan == 'Batal')
                    <td scope="row">{{ $item->status_pemesanan }} <br> <span class="badge badge-info">{{  $item->status_pembatalan }}</span></td>
                    @else
                    <td>{{ $item->status_pemesanan }}</td>
                    @endif
                    <td id="aksi">
                      @if ($item->status_pemesanan == 'Batal')
                      <a href="{{url('admin/pemesanan/pembatalan/' . $item->id_pemesanan)}}" class="btn btn-secondary btn-sm mb-1" data-toggle="tooltip" title="Pembatalan Kunjungan"><i class="fa fa-calendar-times"></i></a>
                      @endif

                      @if ($item->status_pemesanan == 'Jadwal Ulang')
                      <a href="{{url('admin/pemesanan/reschedule/' . $item->id_pemesanan)}}" class="btn btn-success btn-sm mb-1" data-toggle="tooltip" title="Konfirmasi Reschedule"><i class="fas fa-calendar-alt"></i></a>    
                      @endif
                      @if ($item->status_pemesanan == 'Proses')  
                      <a href="{{ url('admin/pemesanan/checkin/'. $item->id_pemesanan) }}" onclick="return confirm('Apakah anda yakin ingin melakukan checkin kunjungan?')" class="btn btn-success btn-sm mb-1" data-toggle="tooltip" title="Check-In"><i class="fas fa-check"></i></a>
                      @endif

                      @if ($item->status_pemesanan == 'Kunjungan')
                       <a href="{{ url('admin/pemesanan/selesai/'. $item->id_pemesanan) }}" onclick="return confirm('Apakah anda yakin ingin mmenyelesaikan kunjungan?')" class="btn btn-success btn-sm mb-1" data-toggle="tooltip" title="Selesai"><i class="fa fa-suitcase"></i></a>   
                      @endif

                      @if ($item->status_pemesanan == 'Kedaluarsa')
                        -
                      @endif

                      @if (($item->status_pemesanan == 'Pending') || ($item->status_pemesanan == 'Menunggu Konfirmasi Admin') || ($item->status_pemesanan == 'DP') || ($item->status_pemesanan == 'Proses') || ($item->status_pemesanan == 'Kunjungan') || ($item->status_pemesanan == 'Selesai'))
                      <a href="{{url('admin/pemesanan/detail_pemesanan/' . $item->id_pemesanan)}}" class="btn btn-info btn-sm mb-1" data-toggle="tooltip" title="Detail Pemesanan"><i class="fas fa-file-alt"></i></a>
                      <a href="{{url('admin/pemesanan/detail_pembayaran/' . $item->id_pemesanan)}}" class="btn btn-danger btn-sm mb-1" data-toggle="tooltip" title="Detail Pembayaran"><i class="fas fa-credit-card"></i></a>
                      @else
                      @endif
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <hr />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection