@extends('layouts.admin')

@section('title', 'Buku Tamu')

@section('konten')
<div class="dashboard-heading">
  <h2 class="dashboard-title">Buku Tamu</h2>
  <p class="dashboard-subtitle">
    Detail data tamu Kampung Kauman
  </p>
</div>
<div class="dashboard-content">
  <div class="row mt-4">
    <div class="col-12 col-md-11 col-lg-8 mt-2">
      @if (session('pesan'))
        <div class="alert alert-success">
        {{ session('pesan') }}  
        </div>  
      @endif
      <div class="card mb-3">
        <div class="card-body">
          <div class="table table-borderless">
            <table style="width:100%">
              <tbody>
                <tr>
                  <td width="200">ID Kunjungan</td>
                  <td width="20">:</td>
                  <td >{{ $wisatawan->kode_kunjungan }}</td>
                </tr>
                <tr>
                  <td width="200">Tanggal Kunjungan</td>
                  <td width="20">:</td>
                  <td >{{ $wisatawan->tgl_kunjungan }}</td>
                </tr>
                <tr>
                  <td width="200">Nama Lengkap</td>
                  <td width="20">:</td>
                  <td >{{ $wisatawan->nama_tamu }}</td>
                </tr>
                <tr>
                  <td width="200">No HP</td>
                  <td width="20">:</td>
                  <td >{{ $wisatawan->telp_tamu }}</td>
                </tr>
                <tr>
                  <td width="200">Email</td>
                  <td width="20">:</td>
                  <td >{{ $wisatawan->email_tamu }}</td>
                </tr>
                <tr>
                  <td width="200">Instagram</td>
                  <td width="20">:</td>
                  <td >{{ $wisatawan->instagram }}</td>
                </tr>
                <tr>
                  <td width="200">Asal</td>
                  <td width="20">:</td>
                  <td >{{ $wisatawan->asal_tamu }}</td>
                </tr>
                <tr>
                  <td width="200">Kesan Pesan</td>
                  <td width="20">:</td>
                  <td rowspan="3">{{ $wisatawan->pesan_tamu }}</td>
                </tr>
              </tbody>
            </table>

            <div class="row mt-2 d-flex justify-content-between">
              <div class="col-start">
                <a href="{{ url('admin/buku-tamu/' .$wisatawan->kode_kunjungan) }}" class="btn btn-dark ml-2">Kembali</a>
              </div>
              <div class="col-end">
                <form action="{{ url('admin/buku-tamu/update_status/' . $wisatawan->id_bukutamu) }}" method="post">
                  @csrf
                  <input type="hidden" name="status" value="{{ $wisatawan->status }}">
                  <input type="hidden" name="kode_kunjungan" value="{{ $wisatawan->kode_kunjungan }}">
                    @if ($wisatawan->status=='sembunyikan')
                      @if ($jumlah_testimoni_tampil !== 4)
                      <button class="btn btn-success mr-2" onclick="return confirm('Testimoni yang sudah ditampilkan {{ $jumlah_testimoni_tampil }}/4 slot. Anda masih boleh menampilkan {{ 4 - $jumlah_testimoni_tampil }} testimoni lagi. Lanjutkan?')">Tampilkan</button>   
                      @else
                      <button class="btn btn-success mr-2" onclick="alert('Testimoni yang sudah ditampilkan sudah 4 ! Silahkan sembunyikan salah satu terlebih dahulu')">Tampilkan</button>   
                      @endif
                     @else
                     <button class="btn btn-success mr-2">Sembunyikan</button>   
                    @endif
                </form>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
