@extends('layouts.admin')

@section('title', 'Buku Tamu')

@section('konten')
<div class="dashboard-heading">
  <h2 class="dashboard-title">Buku Tamu</h2>
  <p class="dashboard-subtitle">
    <a href="{{ url('admin/buku-tamu') }}">Tamu</a> / Daftar Tamu
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
                  <th scope="col">Tanggal Kunjungan</th>
                  <th scope="col">Nama Tamu</th>
                  <th scope="col">Kesan Pesan</th>
                  <th scope="col" id="email">Status</th>
                  <th scope="col" id="aksi">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($tamu_list as $key => $tamu )
                <tr class="tamu">
                  <td scope="row">{{ $key+1 }}</td>
                  <td>{{ $tamu->kode_kunjungan }}</td>
                  <td>{{ $tamu->tgl_kunjungan }}</td>
                  <td>{{ $tamu->nama_tamu }}</td>
                  <td>{{ $tamu->pesan_tamu }}</td>
                  <td>{{ $tamu->status}} - {{ $tamu->status_testimoni}}</td>
                  <td class="d-flex flex-row" id="aksi">
                    <form action="{{ url('admin/buku-tamu/update_status/' . $tamu->id_bukutamu) }}" method="post">
                      @csrf
                      <input type="hidden" name="status" value="{{ $tamu->status }}">
                      <input type="hidden" name="kode_kunjungan" value="{{ $tamu->kode_kunjungan }}">
                      @if ($tamu->status=='sembunyikan')
                        @if ($jumlah_testimoni_tampil !== 4)
                          <button class="btn btn-success btn-sm mr-2" onclick="return confirm('Testimoni  yang sudah ditampilkan {{ $jumlah_testimoni_tampil }}/4 slot. Anda masih boleh   menampilkan {{ 4 - $jumlah_testimoni_tampil }} testimoni lagi. Lanjutkan?') ">Tampilkan</button>   
                        @else
                          <button class="btn btn-success btn-sm mr-2" onclick="alert('Testimoni yang sudah  ditampilkan sudah 4 ! Silahkan sembunyikan salah satu terlebih dahulu')  ">Tampilkan</button>   
                        @endif
                      @else
                        <button class="btn btn-success btn-sm mr-2">Sembunyikan</button>   
                      @endif
                    </form>
                    <form action="{{ url('admin/buku-tamu/update_status_testimoni/' . $tamu->id_bukutamu) }}" method="post">
                      @csrf
                      <input type="hidden" name="status_testimoni" value="{{ $tamu->status_testimoni }}">
                      <input type="hidden" name="kode_kunjungan" value="{{ $tamu->kode_kunjungan }}">
                      @if ($tamu->status_testimoni == 'Setujui')
                      <button class="btn btn btn-info btn-sm mr-2" data-toggle="tooltip" title="Tarik Testimoni" onclick="return confirm('Yakin menolak testimoni ini untuk ditampilkan?') ">Tolak</button>   
                      @else
                      <button class="btn btn btn-info btn-sm mr-2" data-toggle="tooltip" title="Terima Testimoni" onclick="return confirm('Setujui testimoni ini untuk ditampilkan ?') ">Terima</button>   
                      @endif
                    </form>
                    <a href="{{ url('admin/buku-tamu/detail_tamu/' . $tamu->id_bukutamu) }}" class="btn btn-detail btn-sm">Detail</a>
                  </td>
                </tr>
                @endforeach
                @if (count($tamu_list) == 0)
                <tr>
                  <td colspan="7" class="text-center">Belum ada tamu yang mengisi</td>
                </tr>
                @endif
              </tbody>
            </table>
            <hr />
            @if (count($tamu_list) != 0)
            <a target="_blank" href="{{ url('admin/buku-tamu/cetak/'.$tamu_list[0]->kode_kunjungan) }}" class="btn btn-success">
              <i class="fa fa-print"> Cetak</i>
            </a>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
