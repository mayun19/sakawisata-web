@extends('layouts.admin')

@section('title', 'Situs Jelajah')

@section('konten')
<?php 
      // echo "<pre>";
      // print_r($situs);
      // print_r($foto);
      // echo "</pre>";
?>
  <div class="dashboard-heading">
  	<h2 class="dashboard-title">Situs Jelajah</h2>
  	<p class="dashboard-subtitle">
  		<a href="{{ url('admin/situs') }}">Situs</a> / Detail Situs
  	</p>
  </div>
  <div class="dashboard-content">
    <div class="row mt-4 ">
      <div class="col-10">
        @if (session('pesan'))
          <div class="alert alert-success">
            {{ session('pesan') }}
          </div>
        @endif
        <div class="card">
          <div class="card-body" id="tambah">
            <div class="row">
              <div class="col-md-6">
								<div class="form-group">
									<label>Nama Situs</label>
									<input
										type="text"
										name="nama-situs"
                    class="form-control"
                    value="{{ $situs->nama_situs }}"
										readonly
									/>
								</div>
              </div>
							<div class="col-md-12">
								<div class="item-detail-foto">Foto Situs</div>
								<div class="row foto-paket my-2">
									<div class="col-md-3">
										<div class="gallery-container">
											<img
												src="{{ asset('img/situs/'.$situs->foto_situs) }}"
												alt="Card image cap"
												class="w-100 foto-situs"
											/>
										</div>
									</div>
									@foreach ($foto as $item)
									<div class="col-md-3">
										<div class="gallery-container">
											<img
												src="{{ asset('img/situs/'.$item->situs_foto) }}"
												alt="Card image cap"
												class="w-100 foto-situs"
											/>
										</div>
									</div>
									@endforeach
								</div>
              </div>
							<div class="col-md-12">
								<div class="form-group mt-3">
									<label for="">Deskripsi Situs</label>
									<textarea
										rows="5"
                    class="form-control"
										readonly
									>{!! $situs->deskripsi_situs !!}</textarea>
								</div>
							</div>
            </div>
            <div class="row">
              <div class="col text-center">
                <a href="{{ url('admin/situs/edit/'.$situs->id_situs) }}" type="submit" class="btn btn-tambah px-3 btn-block">Edit Situs</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- <div class="col-md-4">
        <table class="table table-sm">
          <tr>
            <td>Situs</td>
            <td>{{ $situs->nama_situs }}</td>
          </tr>
          <tr>
            <td>Deskripsi</td>
            <td>{{ $situs->deskripsi_situs }}</td>
          </tr>
          <tr>
            <td>Gambar Utama</td>
            <td><img src="{{ asset('img/situs/'.$situs->foto_situs) }}" class="img-fluid"></td>
          </tr>
        </table>
      </div>
      <div class="col-md-8">
        <form action="{{ url('admin/situs/simpanfoto/'.$situs->id_situs) }}" method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id_situs" value="{{ $situs->id_situs }}">
          <div class="form-group">
            <label for="">Foto</label>
            <input type="file" name="situs_foto" class="form-control">
          </div>
          <button class="btn btn-primary">Simpan</button>
        </form>
      </div> --}}
    </div>
  </div>
@endsection