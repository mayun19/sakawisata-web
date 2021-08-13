@extends('layouts.admin')

@section('title', 'Pengaturan')

@section('konten')
  <div class="dashboard-heading">
    <h2 class="dashboard-title">Pengaturan</h2>
    <p class="dashboard-subtitle">
      Kelola pengaturan SAKAWISATA
    </p>
  </div>
  <div class="dashboard-content">
    <div class="row">
    	<div class="col-12">
    		<a
    			href="{{ url('admin/pengaturan/tambah') }}"
    			class="btn btn-add-paket"
    			>Tambah Pengaturan
    		</a>
    	</div>
    </div>
    <div class="row mt-4">
      <div class="col-11 mt-2">
        @if (session('pesan'))
          <div class="alert alert-success">
            {{ session('pesan') }}
          </div>
				@endif
        <div class="card mb-3">
          <div class="card-body">
            <div class="table-responsive-xl">
              <table class="table" id="datatable">
                <thead class="thead-dark">
                  <tr class="">
                    <th scope="col">No</th>
                    <th scope="col">Judul</th>
                    <th scope="col" style="width: 200px !important;">Deskripsi</th>
                    <th scope="col" id="aksi">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($setting as $key => $item )
                  <tr class="pemesanan">
                    <th scope="row">{{ $key+1 }}</th>
                    <td>{{ $item->nama_pengaturan }}</td>
                    <td style="width: 300px !important;">{{ $item->isi_pengaturan }}</td>
                    <td class="option" id="aksi">
                      <a class="mr-2" href="{{ url('admin/pengaturan/edit/'.$item->id_pengaturan) }}"><img src="{{ url('img/ic_edit.svg') }}" alt=""></a>
                      <a  onclick="return confirm('Apakah anda yakin hapus paket?')" href="{{ url('admin/pengaturan/hapus/'.$item->id_pengaturan) }}"><img src="{{ url('img/ic_member_delete.svg') }}" alt=""></a>
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
