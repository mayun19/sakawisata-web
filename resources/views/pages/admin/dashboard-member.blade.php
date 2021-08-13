@extends('layouts.admin')

@section('title', 'Member')

@section('konten')
<div class="dashboard-heading">
  <h2 class="dashboard-title">Daftar Member</h2>
  <p class="dashboard-subtitle">
    Kelola data member
  </p>
</div>
<div class="dashboard-content">
  <div class="row mt-4">
    <div class="col-12 col-md-11 col-lg-11 mt-2">
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
                  <th scope="col">Nama</th>
                  <th scope="col">Username</th>
                  <th scope="col" id="email">Email</th>
                  <th scope="col">Telp</th>
                  <th scope="col">Alamat</th>
                  <th scope="col" id="foto">Foto</th>
                  <th scope="col">Status</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($member as $key => $item )
                <tr>
                  <td scope="row">{{ $key+1 }}</td>
                  <td>{{ $item->nama_member }}</td>
                  <td>{{ $item->username_member }}</td>
                  <td id="email">{{ $item->email_member }}</td>
                  <td>{{ $item->telp_member }}</td>
                  <td>{{ $item->alamat_member }}</td>
                  <td id="foto">{{ $item->foto_member }}</td>
                  <td>{{ $item->status_member }}</td>
                  <td class="d-flex flex-row">
                    <a class="mr-2" onclick="return confirm('Apakah anda yakin hapus akun member?')" href="{{ url('admin/member/hapus/'.$item->id_member) }}" data-toggle="tooltip" title="Hapus Member"><img src="{{ url('img/ic_member_delete.svg') }}" alt="" ></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{-- <hr />
            <a class="link-detail" href="#">Lihat Semua</a> --}}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
