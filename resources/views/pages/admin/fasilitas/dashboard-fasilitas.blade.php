@extends('layouts.admin')

@section('title', 'Fasilitas')

@section('konten')
	<div class="dashboard-heading">
		<h2 class="dashboard-title">Fasilitas</h2>
		<p class="dashboard-subtitle">
			Kelola fasilitas paket yang ada di Kampung Wisata Kauman
		</p>
  </div>
  <div class="dashboard-content">
	  <div class="row">
	  	<div class="col-12">
	  		<a
	  			href="{{ url('admin/fasilitas/tambah') }}"
	  			class="btn btn-add-paket"
	  			>Tambah Fasilitas</a
	  		>
	  	</div>
    </div>
    <div class="row mt-4">
      <div class="col-md-7">
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
                  <th scope="col">No</th>
                  <th scope="col">Nama Fasilitas</th>
                  <th scope="col">Icon Fasilitas</th>
                  <th scope="col" id="aksi">Aksi</th>
                </thead>
                <tbody>
                  @foreach ($fasilitas as $key => $item)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $item->nama_fasilitas }}</td>
                    <td>
                      <img class="icon-fasilitas" src="{{ asset ('img/fasilitas/'.$item->icon_fasilitas) }}" alt="Card image cap">
                    </td>
                    <td class="option" id="aksi">
                      <a class="mr-2" href="{{ url('admin/fasilitas/edit/'.$item->id_fasilitas) }}"><img src="{{ url('img/ic_edit.svg') }}" data-toggle="tooltip" title="Edit Fasilitas" alt=""></a>
                      <a onclick="return confirm('Apakah anda yakin hapus fasilitas?')" href="{{ url('admin/fasilitas/hapus/'.$item->id_fasilitas) }}"><img src="{{ url('img/ic_member_delete.svg') }}" alt="" data-toggle="tooltip" title="Hapus Fasilitas"></a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            {{-- <div class="d-flex justify-content-center text-center">
              {!! $fasilitas->links() !!}   
            </div> --}}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection