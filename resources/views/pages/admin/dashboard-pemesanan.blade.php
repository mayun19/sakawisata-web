@extends('layouts.admin')
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
      <div class="card mb-3">
        <div class="card-body">
          <div class="table-responsive-xl">
            <table class="table">
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
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($pemesanan as $key => $item )
                <tr>
                  <th scope="row">{{ $key+1 }}</th>
                  <td>{{ $item->kode_pemesanan }}</td>
                  <td>{{ $item->nama_member }}</td>
                  <td>{{ $item->tgl_pemesanan }}</td>
                  <td>{{ $item->tgl_kunjungan }}</td>
                  <td>{{ $item->kode_pemesanan }}</td>
                  <td>{{ $item->kode_pemesanan }}</td>
                  <td>{{ $item->kode_pemesanan }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <hr />
            <a href="#">Lihat Semua</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
