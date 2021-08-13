@extends('layouts.admin')

@section('title', 'FAQ')

@section('konten')
  <div class="dashboard-heading">
  	<h2 class="dashboard-title">Faq</h2>
  	<p class="dashboard-subtitle">
  		<a href="{{ url('admin/faq') }}">Faq </a> / Edit Faq
  	</p>
  </div>
  <div class="dashboard-content">
    <div class="row mt-4">
      <div class="col-10 mb-3">
        <form action="{{ url("admin/faq/update/".$faq->id_faq) }}" method="post">
          @csrf
          <div class="card">
            <div class="card-body" id="tambah">
              <div class="row">
                <div class="col-md-10 col-lg-10">
                  <div class="form-group">
                    <label for="">Judul Faq</label>
                    <input type="text" class="form-control" name="pertanyaan" value="{{ $faq->pertanyaan }}">
                  </div>                 
                </div>
                <div class="col-md-10 mb-4">
                  <div class="form-group">
                    <label for="">Deskripsi</label>
                    <textarea class="form-control" rows="5" id="deskripsi_faq" name="jawaban">{{ $faq->jawaban }}</textarea>
                  </div>                 
                </div>
                <div class="col-md-10 mb-3">
                  <button type="submit" class="btn btn-tambah px-3 btn-block">Simpan Faq</button> 
                </div>
                <br>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
		<script>
			CKEDITOR.replace( 'deskripsi_faq' );
    </script>
@endpush