@extends('layouts.admin')

@section('title', 'Reschedule')

@section('konten')
    <div class="dashboard-heading">
        <h2 class="dashboard-title">Reschedule Kunjungan</h2>
        <p class="dashboard-subtitle">
            <a href="{{ url('admin/pemesanan') }}">Pemesanan </a> / <strong>Reschedule</strong>
        </p>
    </div>
    <div class="dashboard-content">
        <div class="row mt-4">
            <div class="col-12 col-md-8 col-xl-5 mb-3">
                @if (session('pesan'))
                    <div class="alert alert-success">
                        {{ session('pesan') }}
                    </div>
                @endif
                <div class="section-reschedule">
                    <h5>Penjadwalan ulang {{ $pemesanan->kode_pemesanan }}</h5>
                    <form action="{{ url('admin/pemesanan/terima_reschedule/' . $detail_pengajuan->id_reschedule) }}"
                        method="post">
                        @csrf
                        <div class="row mt-3">
                            <div class="col-12 col-lg-10">
                                <div class="form-group">
                                    <label for="tanggal_pengajuan">Tanggal Pengajuan</label>
                                    <input type="date" id="tanggal_pengajuan" class="form-control col-12 "
                                        name="tanggal_pengajuan" value="{{ $detail_pengajuan->tanggal_pengajuan }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-12 col-lg-10">
                                <div class="form-group">
                                    <label for="tanggal_reschedule">Tanggal Reschedule</label>
                                    <input type="date" id="tanggal_reschedule" class="form-control col-12 "
                                        name="tanggal_reschedule" value="{{ $detail_pengajuan->tanggal_reschedule }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-12 col-lg-10">
                                <div class="form-group">
                                    <label for="waktu-ajuan">Waktu Kunjungan</label>
                                    <input class="form-control col-12" name="sesi_reschedule" id="sesi_reschedule"
                                        value="{{ $detail_pengajuan->nama_sesi }}" disabled>
                                </div>
                            </div>
                            <div class="col-12 col-lg-10">
                                <div class="h5">Wisatawan : <b>{{ $pemesanan->jumlah_wisatawan }} orang</b></div>
                                <div class="h5">Sisa : <b>{{ $sisa_kuota }} slot</b></div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-10">
                            <div class="row mt-4 justify-content-between pl-3 pr-3">
                                @if ($reschedule->status_reschedule == 'Pending')
                                    <button id="tombol-tolak" type="button" class="btn btn-tolak px-3">Beri
                                        Rekomendasi</button>
                                    <button type="submit" id="tombol-terima" class="btn btn-reschedule px-2">Terima
                                        Reschedule</button>
                                @elseif($reschedule->status_reschedule != 'Diterima')
                                    <button id="tombol-tolak" type="button" class="btn btn-tolak px-3">Beri
                                        Rekomendasi</button>
                                @elseif($reschedule->status_reschedule == 'Diterima')
                                @endif
                            </div>
                        </div>
                    </form>
                    {{-- @if ($reschedule->status_reschedule == 'Pending')
                        <div class="col-12 col-lg-10 mt-2">
                            <form action="" method="POST">
                                <input type="hidden" name="status_reschedule" value="Ditolak">
                                <button type="submit" class="btn btn-danger">Tolak Reschedule /Penuh</button>
                            </form>
                        </div>
                    @endif --}}
                </div>
            </div>
            <div class="col-12 col-md-8 col-xl-7 mt-5 mb-3">
                <ul class="card card-body" id="rekomendasi"  style="display: none;">
                    {{-- @foreach ($rentang_sesi as $sesi)
                        <li>Tgl {{ date('d/m/Y', strtotime($sesi->tanggal)) }} - {{ $sesi->nama_sesi }} - Sisa
                            {{ $sesi->sisa_kuota }}</li>
                    @endforeach --}}
                    @foreach ($rentang_sesi as $tanggal)
                        <li>Tgl {{ date('d/m/Y', strtotime($tanggal[0]->tanggal)) }}
                            @foreach ($tanggal as $sesi)
                                [{{ $sesi->nama_sesi }} - Sisa {{ $sesi->sisa_kuota }}]
                            @endforeach
                        </li>
                    @endforeach
                </ul>
                <form action="{{ url('admin/pemesanan/kirim_rekomendasi/' . $detail_pengajuan->id_reschedule) }}"
                    method="POST" id="form-rekomendasi" style="display: none;">
                    @csrf
                    <div class="table-responsive-xl">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Sesi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($x = 1; $x <= 3; $x++)
                                    <tr>
                                        <td>{{ $x }}</td>
                                        <td><input type="date" class="form-control tanggal_rekomendasi"
                                                min="{{ date('Y-m-d', strtotime(date('Y-m-d') . '+ 3 days')) }}"
                                                name="tanggal_rekomendasi[]"></td>
                                        <td>
                                            <select name="sesi_rekomendasi[]" class="form-control sesi_rekomendasi">
                                                <option value="">--Pilih--</option>
                                                @foreach ($paket_sesi as $sesi)
                                                    <option value="{{ $sesi->id_sesi }}">{{ $sesi->nama_sesi }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-primary" id="kirim-rekomendasi" disabled>Kirim Rekomendasi</button>
                </form>
            </div>
            @if ($reschedule->status_reschedule == 'Direkomendasikan')
                <div class="col-12 col-md-8 col-xl-7 mt-3 mb-3">
                    <div class="table-responsive-xl">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Sesi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rekomendasi as $i => $item)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $item->tanggal_rekomendasi }}</td>
                                        <td>{{ $item->nama_sesi }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        $(document).ready(function() {
            $("#tombol-tolak").on('click', function() {
                $("#form-rekomendasi").show(200);
                $("#rekomendasi").show(200);
                $("#tombol-terima").hide();
                cek_inputan();
            });

            var inputTerisi;

            $("input[name='tanggal_rekomendasi[]']").on('change keyup', cek_inputan);
            $("select[name='sesi_rekomendasi[]']").on('change keyup', cek_inputan);

            function cek_inputan() {
                /* validasi cek inputan sdh diisi atau belum */
                var banyak_inputan = $(".tanggal_rekomendasi").length;

                for (var index = 0; index < banyak_inputan; index++) {
                    var tanggal = $(".tanggal_rekomendasi")[index].value;
                    var sesi = $(".sesi_rekomendasi")[index].value;

                    console.log(tanggal, sesi)

                    if (tanggal != "" && sesi != "") {
                        inputTerisi = "Ya";
                    }
                }
                console.log(inputTerisi);

                if (inputTerisi == "Ya") {
                    $("#kirim-rekomendasi").prop('disabled', false);
                } else {
                    $("#kirim-rekomendasi").prop('disabled', true);
                }
            }
        })
    </script>
@endpush
