@extends('layouts.admin')

@section('title', 'Pemesanan')

@section('konten')
  <div class="dashboard-heading">
    <h2 class="dashboard-title">Daftar Reschedule</h2>
    <p class="dashboard-subtitle">
      Kelola data reschedule
    </p>
  </div>
  <div class="dashboard-content">
    <div class="row mt-4 section-reschedule">
      <div class="col-10 mt-2">
        <div class="card mb-3">
          <div class="card-body">
            <div class="table-responsive-xl">
              <table class="table">
                <thead class="thead-dark">
                  <tr class="">
                    <th scope="col">No</th>
                    <th scope="col"  width="30">Kunjungan ID</th>
                    <th scope="col">Nama</th>
                    <th scope="col"  width="30">Tanggal Kunjungan</th>
                    <th scope="col">Paket Kunjungan</th>
                    <th scope="col" width="50">Jumlah Wisatawan</th>
                    <th scope="col"  width="30">Tanggal Reschelue</th>
                    <th scope="col" width="100" id="aksi">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($reschedule as $key => $list)
                  <tr class="pemesanan">
                    <td scope="row">{{ $key+1 }}</td>
                    <td>{{ $list->kode_kunjungan }}</td>
                    <td>{{ $list->nama_member }}</td>
                    <td>{{ date('d M Y', strtotime($list->tgl_kunjungan)) }}</td>
                    <td>{{$list->nama_paket }}</td>
                    <td>{{ $list->jumlah_wisatawan }}</td>
                    <td>{{ date('d M Y', strtotime($list->tanggal_reschedule)) }}</td>
                    <td id="aksi">
                      <a href="{{ url('admin/pemesanan/reschedule/' . $list->id_pemesanan) }}" class="btn btn-reschedule btn-sm" >Reschedule</a>
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