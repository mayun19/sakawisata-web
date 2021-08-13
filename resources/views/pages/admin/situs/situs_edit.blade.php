@extends('layouts.admin')

@section('title', 'Situs Jelajah Kampung Kauman')

@section('konten')
	<div class="dashboard-heading">
		<h2 class="dashboard-title">Situs Jelajah</h2>
		<p class="dashboard-subtitle">
			<a href="{{ url('admin/situs') }}">Situs</a> / Edit Situs
		</p>
  </div>
  <div class="dashboard-content">
    <?php 
      //       echo "<pre>";
      // print_r($foto);
      // echo "</pre>";
      ?>
    <div class="row mt-4">
      <div class="col-12 col-md-11 col-xl-10 mb-3">
        <form action="{{ url("admin/situs/update/".$situs->id_situs) }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="card">
            <div class="card-body" id="tambah">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" name="nama_situs" value="{{     $situs->nama_situs }}">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="item-situs-foto">Foto Cover Situs</div>
                  <div class="row foto-situs my-2">
                    <div class="col-md-12">
                      <div class="gallery-container">
                        <img src="{{ asset('img/situs/'.$situs->foto_situs) }}" class="img-fluid w-100" alt="" style="max-height: 200px; object-fit: cover;">
                      </div>
                    </div> 
                    <br>
                  </div>
                  <div class="row mt-3">
                    <div class="col-md-12">
                      <span class="btn btn-gallery btn-block">
                      Ganti Foto Situs
                      <input type="file" name="foto_situs" id="">
                      </span>
                    </div> 
                  </div> 
                </div>
                <div class="col-md-12 mt-3">
                  <div class="form-group">
                    <label for="">Deskripsi</label>
                    <textarea class="form-control" rows="5" name="deskripsi_situs" id="editor">{{ $situs->deskripsi_situs }}</textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <button class="btn btn-tambah px-3 btn-block">Simpan Situs</button>
                </div>
              </div>
            </div>
          </div>
        </form>
        <div class="row mt-3">
          <div class="col-12">
            <div class="card">
              <div class="card-body" id="tambah">
                <div class="item-situs-gallery">
                    Situs Gallery
                </div>
                <div class="row situs-gallery">
                  @foreach ($foto as $item)
                    <div class="col-md-3 my-2">
                      <div class="gallery-container">
                        <img src="{{ asset('img/situs/'.$item->situs_foto) }}" class="w-100 situs-foto" alt="">
                        <a href="{{ url('admin/situs/hapus_foto/'.$item->id_situs_foto) }}" class="delete-gallery  foto">
                    		  <img
                    		  	src="{{ asset('img/ic_delete.svg') }}"
                    		  	alt=""
                    		  	width="28"/>
                        </a>
                      </div>
                    </div>  
                  @endforeach
                </div>
                @if(count($foto) < 8)
                <form action="{{ url('admin/situs/simpan_foto/'.$situs->id_situs) }}" method="post" enctype="multipart/form-data">
                  @csrf
                  @method('post')
                  <div id="letak_foto">
                  </div>
                  <div class="form-group">
                    <span class="btn btn-gallery">
                      Tambah Foto <input type="file" name="situs_foto" id="">
                    </span>
                  </div>
                  <button class="btn btn-tambah btn-block">Kirim</button>
                </form>
                @endif
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
@endsection

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
		<script>
			CKEDITOR.replace( 'editor' );
    </script>
@endpush