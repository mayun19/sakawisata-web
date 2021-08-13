@extends('layouts.admin')

@section('title', 'Buku Tamu')

@section('konten')
<div class="dashboard-heading">
  <h2 class="dashboard-title">Buku Tamu</h2>
  <p class="dashboard-subtitle">
    Kelola data tamu Kampung Kauman
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
        <div class="card-body">
          <div class="table-responsive table-responsive-lg">
            <table class="table">
              <thead class="thead-dark">
                <tr class="">
                  <th scope="col">No</th>
                  <th scope="col">Kunjungan ID#</th>
                  <th scope="col">Nama Pemesan</th>
                  <th scope="col" id="aksi">Jumlah Wisatawan</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($tamu_pemesanan as $key => $tamu )
                <tr class="tamu">
                  <td scope="row">{{ $key+1 }}</td>
                  <td>{{ $tamu->kode_kunjungan }}</td>
                  <td>{{ $tamu->nama_member }}</td>
                  <td id="aksi">{{ $tamu->jumlah_wisatawan}}</td>
                  <td class="d-flex flex-row" id="aksi">
                      <a href="{{ url('admin/buku-tamu/' . $tamu->kode_kunjungan) }}" class="detail-tamu" >Detail</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <hr />
            {!! $tamu_pemesanan->links() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
