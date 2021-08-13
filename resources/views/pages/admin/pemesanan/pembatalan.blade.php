@extends('layouts.admin')

@section('title', 'Pembatalan')

@section('konten')
  <div class="dashboard-heading">
    <h2 class="dashboard-title">Kelola Pembatalan</h2>
    <p class="dashboard-subtitle">
			<a href="{{ url('admin/pemesanan') }}">Pemesanan </a> / Pembatalan
		</p>
  </div>
  <div class="dashboard-content member">
    <div class="row info-payment">
      <div class="col-12 col-lg-10 mt-4 mb-2">
        <div class="card mb-4">
          <div class="card-body" id="tambah">
            <div class="row d-flex justify-content-center">
              <div class="col-12 col-md-5">
                <div class="container timeline-content">
                  <h5 class="mt-2 mb-3 pembatalan-title" id="pembatalan">Riwayat Pembatalan</h5>
                  <div class="timeline admin-pembatalan">
                    <div class="timeline-container primary">
                      <div class="timeline-icon">
                        <img src="{{ asset('img/ic_ajukan_pembatalan.svg') }}" alt="">
                      </div>
                      <div class="timeline-body">
                        <h4 class="timeline-title"><span class="badge">Pembatalan Diajukan</span></h4>
                        <p class="timeline-subtitle"><?php  echo date("d M Y", strtotime( $pembatalan->tanggal_pending))?> &nbsp; <?php  echo date("H:i:s ", strtotime( $pembatalan->tanggal_pending))?></p>
                      </div>
                    </div>
                    @if (!empty($pembatalan->tanggal_proses))
                    <div class="timeline-container danger">
                      <div class="timeline-icon">
                        <img src="{{ asset('img/ic_batal.svg') }}" alt="">
                      </div>
                      <div class="timeline-body">
                        <h4 class="timeline-title"><span class="badge">Pembatalan Diproses</span></h4>
                        <p class="timeline-subtitle"><?php  echo date("d M Y", strtotime( $pembatalan->tanggal_proses))?> &nbsp; <?php  echo date("H:i:s ", strtotime( $pembatalan->tanggal_proses))?></p>
                      </div>
                    </div>
                    @endif
                    @if($pembatalan->status_pembatalan == 'Pembatalan Selesai')
                    <div class="timeline-container success">
                      <div class="timeline-icon">
                        <img src="{{ asset('img/ic_batal_sukses.svg') }}" alt="">
                      </div>
                      <div class="timeline-body">
                        <h4 class="timeline-title"><span class="badge">Pembatalan Selesai</span></h4>
                        <p class="timeline-subtitle"><?php  echo date("d M Y", strtotime( $pembatalan->tanggal_selesai))?> &nbsp; <?php  echo date("H:i:s ", strtotime( $pembatalan->tanggal_selesai))?></p>
                      </div>
                    </div>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-7">
                <div class="pembatalan-content mt-2">
                  <h5 class="mt-2 mb-3 pembatalan-title" id="pembatalan">Pembatalan</h5>
                    <div class="form-group row">
                      <label class="col-5 col-md-4 col-lg-4 col-form-label">Alasan Pembatalan</label>
                      <label class="col-1 col-md-1 col-lg-1">:</label>
                      <div class="col-12 col-md-7 col-lg-7">
                        <textarea name="alasan_pembatalan" id="" rows="4" class="form-control" readonly>{{ $pembatalan->alasan_pembatalan }}</textarea>
                      </div>
                    </div>
                </div>
              </div>
            </div>
            <div class="row section-pemesanan mt-4">
              <div class="col-12 col-lg-6 info-pemesanan">
								<p>Informasi Pemesanan</p>
								<div class="form-group row">
                  <label class="col-5 col-md-4 col-lg-4 col-form-label">Kunjungan ID</label>
                  <label class="col-1 col-md-1 col-lg-1">:</label>
                  <div class="col-12 col-md-7 col-lg-7">
                    <input type="text" name="kode_kunjungan" id="" class="form-control" value="#{{$pemesanan->kode_kunjungan}}" readonly>
                  </div>
								</div>
								<div class="form-group row">
                  <label class="col-5 col-md-4 col-lg-4 col-form-label">Paket Kujungan</label>
                  <label class="col-1 col-md-1 col-lg-1">:</label>
                  <div class="col-12 col-md-7 col-lg-7">
                    <input type="text" name="nama_paket" class="form-control" value="{{ $pemesanan->nama_paket }}" readonly>
                  </div>
								</div>
								<div class="form-group row">
                  <label class="col-5 col-md-4 col-lg-4 col-form-label">Jumlah Wisatawan</label>
                  <label class="col-1 col-md-1 col-lg-1">:</label>
                  <div class="col-12 col-md-7 col-lg-7">
                    <input type="text" name="jumlah_wisatawan" id="" class="form-control" value="{{ $pemesanan->jumlah_wisatawan }} wisatawan" readonly>
                  </div>
								</div>
								<div class="form-group row">
                  <label class="col-5 col-md-4 col-lg-4 col-form-label">Jumlah Paket</label>
                  <label class="col-1 col-md-1 col-lg-1">:</label>
                  <div class="col-12 col-md-7 col-lg-7">
                    <input type="text" name="jumlah_paket" id="" class="form-control" value="{{ $pemesanan->jumlah_paket }} Paket" readonly>
                  </div>
								</div>
                @if (!empty($pemesanan->jumlah_wisatawan_tambahan)) 
								<div class="form-group row">
                  <label class="col-5 col-md-4 col-lg-4 col-form-label">Jumlah Wisatawan Tambahan</label>
                  <label class="col-1 col-md-1 col-lg-1">:</label>
                  <div class="col-12 col-md-7 col-lg-7">
                    <input type="number" name="jumlah_wisatawan_tambahan" value="{{ $pemesanan->jumlah_wisatawan_tambahan }}" class="form-control" readonly>
                  </div>
								</div>
                @else

                @endif
              </div>
              <div class="col-12 col-lg-6 info-pemesanan">
                <p>Informasi Pembayaran</p>
                <div class="form-group row">
                  <label class="col-5 col-md-4 col-lg-4 col-form-label">Harga Paket</label>
                  <label class="col-1 col-md-1 col-lg-1">:</label>
                  <div class="col-12 col-md-7 col-lg-7">
                    <div class="input-group">
                      <div class="input-group-prepend">
												<span class="input-group-text">Rp</span>
											</div>
                      <input type="text" name="biaya_pemesanan" id="" class="form-control" value="{{ number_format( $pemesanan->biaya_pemesanan) }}" readonly>
                    </div>
                  </div>
								</div>
                <div class="form-group row">
                  <label class="col-5 col-md-4 col-lg-4 col-form-label">Biaya Tambahan</label>
                  <label class="col-1 col-md-1 col-lg-1">:</label>
                  <div class="col-12 col-md-7 col-lg-7">
                    <div class="input-group">
                      <div class="input-group-prepend">
												<span class="input-group-text">Rp</span>
											</div>
                      <input type="text" name="biaya_tambahan" id="" class="form-control" value="{{ number_format( $pemesanan->biaya_tambahan) }}" readonly>
                    </div>
                  </div>
								</div>
                <div class="form-group row">
                  <label class="col-5 col-md-4 col-lg-4 col-form-label">Total Tagihan</label>
                  <label class="col-1 col-md-1 col-lg-1">:</label>
                  <div class="col-12 col-md-7 col-lg-7">
                    <div class="input-group">
                      <div class="input-group-prepend">
												<span class="input-group-text">Rp</span>
											</div>
                      <input type="text" name="total_pemesanan" id="" class="form-control" value="{{number_format( $pemesanan->total_pemesanan )}}" readonly>
                    </div>
                  </div>
								</div>
                <div class="form-group row">
                  <label class="col-5 col-md-4 col-lg-4 col-form-label">Telah Dibayar</label>
                  <label class="col-1 col-md-1 col-lg-1">:</label>
                  <div class="col-12 col-md-7 col-lg-7">
                    <div class="input-group">
                      <div class="input-group-prepend">
												<span class="input-group-text">Rp</span>
											</div>
                      <input type="text" name="jumlah_pembayaran" class="form-control" value="{{number_format( $pembayaran->jumlah )}}" readonly>
                    </div>
                  </div>
								</div>
              </div>
            </div>
            @if ($pembatalan->status_pembatalan == 'Pending')  
            <div class="row mt-3">
              <div class="col">
                <form action="{{ url('admin/pemesanan/pembatalan/proses') }}" method="post">
                  @csrf
                  <input type="hidden" name="id_pembatalan"
                  value="{{$pembatalan->id_pembatalan }}">
                  <button class="btn btn-option-hapus px-3 btn-block"> Batalkan</button>
                </form>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col">
                <a class="btn btn-cancel px-3 btn-block" href="{{ url('admin/pemesanan') }}">Tidak, Lanjutkan Kunjungan</a>
              </div>
            </div>
            @endif
          </div>
        </div>
        @if(!empty($pembatalan->tanggal_proses) && empty($pembatalan->tanggal_selesai))
        <div class="card">
          <div class="card-body" id="tambah">
            <form action="{{ url('admin/pemesanan/pembatalan/refund') }}" method="post" enctype="multipart/form-data">
              <div class="row d-flex section-pemesanan">
                @csrf                  
                <input type="hidden" name="id_pembatalan" value="{{$pembatalan->id_pembatalan }}">
                <div class="col-12 col-lg-6 info-refund">
                  <p  class="pembatalan-title">Informasi Pemesanan</p>
                  <div class="info-rekening">
                    <div class="lebel-rekening mt-2">Nomor Rekening Penerima Dana</div>
                    <div class="desk-rekening mt-2">
                      <span class="badge bank px-3 py-2">{{ $pembatalan->nama_bank_refund }}</span> &nbsp; <b>{{ $pembatalan->no_rekening_refund }}</b> &nbsp; An. {{ $pembatalan->nama_pemilik_refund }}
                    </div>
                  </div>
                  <div class="info-refund mt-3">
                    <div class="lebel-refund mt-2">Jumlah Pengembalian Dana</div>
                    <div class="desk-refund mt-2" name="dana_refund">
                      {{-- <b>Rp &nbsp; 150,0000</b> --}}
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Rp</span>
                        </div>
                        <input type="text" name="dana_refund" class="form-control uang" max="{{$pembayaran->jumlah}}" value="{{ $pembayaran->jumlah }}">
                      </div>
                    </div>
                  </div>
                </div> 
                <div class="col-12 col-lg-6 info-refund">
                  <br>
                  <div class="lebel-rekening mt-2 mb-2">Bukti Pembatalan</div>
                  <input type="file" class="form-control-file" name="bukti_refund">
                </div>
              </div>
              <div class="row mt-3">
                <div class="col">
                  <button class="btn btn-tambah px-3 btn-block"> Refund Dana</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        @elseif(!empty($pembatalan->tanggal_selesai))
        <div class="card">
          <div class="card-body" id="tambah">
            <form action="{{ url('member/simpan_pembayaran') }}" method="post" enctype="multipart/form-data">
              <div class="row d-flex section-pemesanan">
                @csrf
                <div class="col-12 col-lg-6 info-refund">
                  <p  class="pembatalan-title">Informasi Pemesanan</p>
								  <div class="info-rekening">
                    <div class="label-rekening mt-2">Nomor Rekening Penerima Dana</div>
                    <div class="desk-rekening mt-2">
                      <span class="badge bank px-3 py-2">{{ $pembatalan->nama_bank_refund }}</span> &nbsp; <b>{{ $pembatalan->no_rekening_refund }}</b> &nbsp; An. {{ $pembatalan->nama_pemilik_refund }}
                    </div>
								  </div>
                  <div class="info-refund mt-3">
                    <div class="label-refund mt-2">Jumlah Pengembalian Dana</div>
                    <div class="desk-refund mt-2" name="dana_refund">
                      <b>Rp &nbsp; {{ number_format($pembatalan->dana_refund) }}</b>
                    </div>
                  </div>
                </div> 
                <div class="col-12 col-lg-6 info-refund">
                  <br>
                  <div class="label-refund mt-2 mb-2">Bukti Pembatalan</div>
                  <!-- lens options start -->
                  <section id="lens" class="info-refund mt-3">
                    <div class="gallery-container">
                      <div class="xzoom-container">
                        <img class="xzoom" src="{{ asset($pembatalan->bukti_refund) }}" xoriginal="{{ asset($pembatalan->bukti_refund) }}" style="object-fit: cover; max-height: 200px"/>
                        <div class="xzoom-thumbs mt-2">
                          <a href="{{ asset($pembatalan->bukti_refund) }}"><img class="xzoom-gallery" width="80" src="{{ asset($pembatalan->bukti_refund) }}"  xpreview="{{ asset($pembatalan->bukti_refund) }}" title="The description goes here" hidden></a>
                          <a href="{{ asset($pembatalan->bukti_refund) }}" target="_blank" rel="noopener noreferrer" download>Download Bukti Refund</a>
                        </div>
                      </div>        
                    </div>
                  <div class="row">
                  </div>
                  </section>   
                  <!-- lens options end -->
                </div>
              </div>
            </form>
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>
@endsection

@push('prepend-style')
  <link rel="stylesheet" href="{{ asset('xzoom/xzoom.css') }}">
@endpush

@push('addon-script')
  <script src="{{ asset('xzoom/xzoom.min.js') }}"></script>
  <script>
    $(document).ready(function() {
      $('.xzoom, .xzoom-gallery').xzoom({
        zoomWidth: 500,
        title: false,
        tint: '#333',
        Xoffset: 10 
      });
    });
  </script>
@endpush