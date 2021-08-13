@extends('layouts.admin')

@section('title', 'FAQ')

@section('konten')
  <div class="dashboard-heading">
    <h2 class="dashboard-title">FAQ</h2>
    <p class="dashboard-subtitle">
      Kelola faq SAKAWISATA
    </p>
  </div>
  <div class="dashboard-content">
	  <div class="row">
	  	<div class="col-12">
	  		<a href="{{ url('admin/faq/tambah') }}"
	  			class="btn btn-add-paket"
	  			>Tambah FAQ
	  		</a>
	  	</div>
	  </div>
    <div class="row mt-4">
      <div class="col-11 mt-2">
        <div class="card mb-3">
          <div class="card-body">
            <div class="table-responsive-xl">
              <table class="table">
                <thead class="thead-dark">
                  <tr class="">
                    <th scope="col">No</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col" id="aksi">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($faq as $key => $item )
                  <tr>
                    <th scope="row">{{ $key+1 }}</th>
                    <td>{{ $item->pertanyaan }}</td>
                    <td>{!! $item->jawaban !!}</td>
                    <td class="option d-flex flex-row" >
                      <a class="mr-2" href="{{ url('admin/faq/edit/'.$item->id_faq) }}"><img src="{{ url('img/ic_edit.svg') }}" alt=""></a>
                      <a onclick="return confirm('Apakah anda yakin hapus paket?')" href="{{ url('admin/faq/hapus/'.$item->id_faq) }}"><img src="{{ url('img/ic_member_delete.svg') }}" alt=""></a>
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
