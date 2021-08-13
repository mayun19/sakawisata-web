@extends('layouts.admin')

@section('title', 'Pembatalan')

@section('konten')
  <div class="dashboard-heading">
    <h2 class="dashboard-title">Daftar Pembatalan</h2>
    <p class="dashboard-subtitle">
      Kelola data pembatalan kunjungan
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
                    <th scope="col">Nama Pemesan</th>
                    <th scope="col"  width="30">Tanggal Kunjungan</th>
                    <th scope="col">Paket Kunjungan</th>
                    <th scope="col" width="50">Jumlah Wisatawan</th>
                    <th scope="col"  width="30">Status Pembatalan</th>
                    <th scope="col" width="100" id="aksi">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($pembatalan as $key => $list)
                  <tr class="pemesanan">
                    <td scope="row">{{ $key+1 }}</td>
                    <td>{{ $list->kode_kunjungan }}</td>
                    <td>{{ $list->nama_member }}</td>
                    <td>{{ date('d M Y', strtotime($list->tgl_kunjungan)) }}</td>
                    <td>{{$list->nama_paket }}</td>
                    <td>{{ $list->jumlah_wisatawan }}</td>
                    <td>{{ $list->status_pembatalan }}</td>
                    <td id="aksi">
                      @if ($list->status_pembatalan == 'Pending')
                      <a href="{{ url('admin/pemesanan/pembatalan/' . $list->id_pemesanan) }}" class="btn btn-danger btn-sm" >Batalkan</a>
                      @elseif($list->status_pembatalan == 'Proses Pembatalan')
                      <a href="{{ url('admin/pemesanan/pembatalan/' . $list->id_pemesanan) }}" class="btn btn-option-hapus btn-sm" >pembatalan</a>
                      @else
                      -
                      @endif
                    </td>
                  </tr>
                  @endforeach
                  @if (count($pembatalan) == 0)
                  <tr>
                    <td colspan="7" class="text-center">Belum ada pembatalan kunjungan</td>
                  </tr>
                  @endif
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