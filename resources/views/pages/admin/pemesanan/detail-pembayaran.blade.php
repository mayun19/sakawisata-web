@extends('layouts.admin')

@section('title', 'Pemesanan')

@section('konten')
  <div class="dashboard-heading">
    <h2 class="dashboard-title">Detail Pembayaran</h2>
    <p class="dashboard-subtitle">
			<a href="{{ url('admin/pemesanan') }}">Pemesanan </a> / Detail
		</p>
  </div>
  <div class="dashboard-content">
    <div class="row mt-4">
      <div class="col-11 mt-2">
        <div class="card mb-3">
          <div class="card-body">
            <div class="table-responsive-xl">
              <table class="table pembayaran">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kunjungan ID</th>
                    <th scope="col">Tanggal Kunjungan</th>
                    <th scope="col">Jenis Pembayaran</th>
                    <th scope="col">Pembayaran</th>
                    <th scope="col">Jumlah Bayar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
									// echo "<pre>";
									// 	print_r ($pembayaran);
									// echo"</pre>";	
									?>

                  <?php  $total_bayar = 0;?>

                  @foreach ($pembayaran as $key => $bayar)
                  <?php  $total_bayar+=$bayar->jumlah_pembayaran?>
                    <tr>
                      <th>{{ $key+1 }}</th>
                      <td>{{ $bayar->kode_kunjungan }}</td>
                      <td>{{ $bayar->tgl_kunjungan }}</td>
                      <td>{{ $bayar->jenis_pembayaran }}</td>
                      <td>{{ $bayar->tipe_pembayaran}}</td>
                      <td>Rp {{ number_format($bayar->jumlah_pembayaran)}}</td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th colspan="5">Total Pembayaran</th>
                    <td>Rp <?php echo number_format($total_bayar)?> </td>
                  </tr>
                </tfoot>
              </table>
              <div class="row total-bayar">
                {{-- <div class="col-md-9">
                  <p>Total Pembayaran</p>
                </div>
                <div class="col-md-2">
                  <p>Rp <?php echo number_format($total_bayar)?></p>
                </div> --}}
                <div class="col">
                  <table class="table">

                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection