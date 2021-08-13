@extends('layouts.admin')

@section('title', 'Partners')

@section('konten')
	<div class="dashboard-heading">
		<h2 class="dashboard-title">Partners SAKAWISATA</h2>
		<p class="dashboard-subtitle">
			Kelola Partners dari di Kampung Wisata Kauman
		</p>
  </div>
  <div class="dashboard-content">
	  <div class="row">
	  	<div class="col-12">
	  		<a href="{{ url('admin/partners/tambah') }}" class="btn btn-add-paket">Tambah Partner</a>
	  	</div>
    </div>
    <div class="row mt-4">
      <div class="col-12 col-lg-8">
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
                  <th scope="col">Nama Partner</th>
                  <th scope="col">Icon Partner</th>
                  <th scope="col">Link Partner</th>
                  <th scope="col" width="150" id="aksi">Aksi</th>
                </thead>
                <tbody>
                  @foreach ($partners as $key => $partners)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $partners->nama_partner }}</td>
                    <td>
                      <img class="icon-fasilitas img-fluid " src="{{ asset ('img/partners/'.$partners->foto_partner) }}" alt="Card image cap">
                    </td>
                    <td>{{ $partners->link_partner }}</td>
                    <td class="option" id="aksi">
                      <a class="" href="{{ url('admin/partners/edit/'.$partners->id_partner) }}"><img src="{{ url('img/ic_edit.svg') }}" alt=""></a>
                      <a class="" onclick="return confirm('Apakah anda yakin hapus Partners?')" href="{{ url('admin/partners/hapus/'.$partners->id_partner) }}"><img src="{{ url('img/ic_member_delete.svg') }}" alt=""></a>
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