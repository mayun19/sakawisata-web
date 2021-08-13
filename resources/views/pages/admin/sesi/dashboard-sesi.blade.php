@extends('layouts.admin')

@section('title', 'Sesi Kunjungan')

@section('konten')
	<div class="dashboard-heading">
		<h2 class="dashboard-title">Sesi Kunjungan</h2>
		<p class="dashboard-subtitle">
			Kelola sesi kunjungan yang ada di Kampung Wisata Kauman
		</p>
  </div>
  <div class="dashboard-content">
	  <div class="row">
	  	<div class="col-12">
	  		<a href="{{ url('admin/sesi/tambah') }}" class="btn btn-add-paket" >Tambah Sesi</a>
        @if (session('pesan'))
          <div class="alert alert-success mt-2">
            {{ session('pesan') }}
          </div>
        @endif
	  	</div>
    </div>
    <div class="row mt-2">
    </div>
    <div class="row mt-4">
      <div class="col-5">
        <div class="card mb-3">
          <div class="card-body">
            <div class="table-responsive-xl">
              <table class="table">
                <thead class="thead-dark">
                  <th scope="col">No</th>
                  <th scope="col">Nama Sesi</th>
                  <th scope="col" id="aksi">Aksi</th>
                </thead>
                <tbody>
                  @foreach ($sesi as $key => $item)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $item->nama_sesi }}</td>
                    <td class="option" id="aksi">
                      <a href="{{ url('admin/sesi/hapus/'.$item->id_sesi) }}" class="btn btn-option-hapus" onclick="return confirm('Apakah anda yakin ingin menghapus nama sesi ?')">Hapus</a>
                    </td>
                  </tr>
                      
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection