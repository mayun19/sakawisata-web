<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<title>SAKAWISATA - Invoice Kunjungan {{$pemesanan->kode_kunjungan}}</title>

		<!--     <link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.css') }}"/> -->
	</head>

	<style type="text/css"></style>

	<body style="font-family: Assistant, Tahoma, Geneva, Verdana, sans-serif">
		<center
			class="wrapper"
			style="
				width: 100%;
				table-layout: fixed;
				background-color: #f6f9fc;
				padding-bottom: 40px;
			"
		>
			<div class="webkit" style="max-width: 600px; background-color: #ffffff">
				<table
					align="center"
					class="outer"
					style="
						margin: 0 auto;
						width: 100%;
						max-width: 600px;
						border-spacing: 0;
						font-family: Assistant, Tahoma, Geneva, Verdana, sans-serif;
						color: rgb(46, 10, 12) !important;
					"
				>
					<tr>
						<td>
							<table width="100%" style="border-spacing: 0">
								<!-- logo sakwis -->
								<tr>
									<td style="padding: 10px; text-align: center">
										<a href=""><img src="images/logo_sakawis.png" alt="" /></a>
									</td>
								</tr>
							</table>
							<hr style="border-style: dashed; color: #b1b1b1" />
						</td>
					</tr>
					<!-- nama wisatawan -->
					<tr>
						<td>
							<table style="padding: 25px 20px; border-spacing: 0" width="100%">
								<!-- deksripsi invoice -->
								<tr>
									<td><h4 style="margin: 0">Hi, {{$member->nama_member}}</h4></td>
								</tr>
								<tr>
									<td>
										<p style="margin-top: 10px">
											Terimakasih telah melakukan pemesanan kunjungan di Kampung Wisata
											Kauman. Pesanan kamu sudah tercatat, silahkan melakukan pembayaran.
										</p>
										<p style="margin-top: 10px">
											PASTIKAN NOMINAL YANG KAMU BAYARKAN SESUAI DENGAN JUMLAH YANG TERTERA
											PADA INVOICE DI BAWAH INI
										</p>
									</td>
								</tr>
								<!-- id booking -->
								<tr>
									<td>Booking ID <strong>#{{$pemesanan->kode_pemesanan}}</strong></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td style="padding: 25px 20px 40px">
							<table style="border-spacing: 0; border: solid 1px #2e2c2c" width="100%">
								<tr>
									<td style="padding: 10px; text-align: center; font-size: 18px; 	font-weight: 600; 	color: #707070; ">
										Detail Pemesanan
									</td>
								</tr>
								<tr>
									<td>
										<table style="padding: 10px 10px 0; border-spacing: 0" width="100%">
											<tr>
												<td style="width: 150px; padding-bottom: 5px">Booking ID</td>
												<td style="width: 15px; padding-bottom: 5px">:</td>
												<td style="padding-bottom: 5px">{{$pemesanan->kode_pemesanan}}</td>
											</tr>
											<tr>
												<td style="width: 150px; padding-bottom: 5px">Nama Pemesan</td>
												<td style="width: 15px; padding-bottom: 5px">:</td>
												<td style="padding-bottom: 5px">{{$member->nama_member}}</td>
											</tr>
											<tr>
												<td style="width: 150px; padding-bottom: 5px">Waktu Kunjungan</td>
												<td style="width: 15px; padding-bottom: 5px">:</td>
												<td style="padding-bottom: 5px">{{$paket['waktu_kunjungan_paket']}}</td>
											</tr>
										</table>
										<table style="padding: 0 10px; border-spacing: 0" width="100%">
											<tr>
												<td>
													Anda harus melakukan pembayaran pemesanan ini paling lambat tanggal
													: <br />
													<span style="color: #a8131f;; font-weight: 500"
														><?php  echo date("d-m-y", strtotime( $pemesanan->batas_pemesanan))?> Pukul <?php  echo date("H.i", strtotime( $pemesanan->batas_pemesanan))?></span
													>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<!-- table pemesanan -->
								<tr>
									<td style="padding: 10px">
										<table
											id="invoice"
											style="border-spacing: 0; border-collapse: collapse; width: 100%"
											width="100%"
										>
											<thead>
												<tr>
													<th style="background-color: rgba(130, 204, 121, 0.98); color: #ffffff;	font-weight: 400; padding-top: 12px; 	padding-bottom: 12px; text-align: left; border: 1px solid #ddd; padding: 8px;"> 
														Paket Kunjungan
													</th>
													<th style="background-color: rgba(130, 204, 121, 0.98); 	color: #ffffff; font-weight: 400; padding-top: 12px; 	padding-bottom: 12px; text-align: left; border: 1px solid #ddd; padding: 8px;">
														Jumlah Tamu
													</th>
													<th style="background-color: rgba(130, 204, 121, 0.98);	color: #ffffff; font-weight: 400; padding-top: 12px; 	padding-bottom: 12px; text-align: left; border: 1px solid #ddd; padding: 8px; "
													>
														Jumlah Paket
													</th>
													<th style=" background-color: rgba(130, 204, 121, 0.98); color: #ffffff; font-weight: 400; padding-top: 12px; padding-bottom: 12px; text-align: left; border: 1px solid #ddd; padding: 8px;
														">
														Harga Paket
													</th>
													<th style=" background-color: rgba(130, 204, 121, 0.98); color: #ffffff; font-weight: 400; padding-top: 12px; padding-bottom: 12px; text-align: left; border: 1px solid #ddd; padding: 8px;">
														Total
													</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td
														style="
															font-weight: 400;
															padding-top: 12px;
															padding-bottom: 12px;
															text-align: left;
															border: 1px solid #ddd;
															padding: 8px;
														"
													>
														{{$paket['nama_paket']}}
													</td>
													<td
														style="
															font-weight: 400;
															padding-top: 12px;
															padding-bottom: 12px;
															text-align: left;
															border: 1px solid #ddd;
															padding: 8px;
														"
													>
														{{$pemesanan->jumlah_wisatawan}} wisatawan
													</td>
													<td
														style="
															font-weight: 400;
															padding-top: 12px;
															padding-bottom: 12px;
															border: 1px solid #ddd;
															padding: 8px;
															text-align: left;
														"
													>
														{{$pemesanan->jumlah_paket}} paket
													</td>
													<td
														style="
															font-weight: 400;
															padding-top: 12px;
															padding-bottom: 12px;
															text-align: left;
															border: 1px solid #ddd;
															padding: 8px;
														"
													>
														Rp {{number_format($pemesanan->biaya_pemesanan)}}
													</td>
													<td
														style="
															font-weight: 400;
															padding-top: 12px;
															padding-bottom: 12px;
															text-align: left;
															border: 1px solid #ddd;
															padding: 8px;
														"
													>
														Rp {{number_format($pemesanan->total_pemesanan)}}
													</td>
												</tr>
											</tbody>
											<tfoot>
												<tr>
													<td
														colspan="4"
														style="font-weight: bold; border: 1px solid #ddd; padding: 8px"
													>
														Subtotal
													</td>
													<td
														style="font-weight: bold; border: 1px solid #ddd; padding: 8px"
													>
														Rp {{number_format($pemesanan->total_pemesanan)}}
													</td>
												</tr>
												<tr>
													<td
														colspan="4"
														style="
															font-weight: 400;
															color: #a8131f;
															border: 1px solid #ddd;
															padding: 8px;
														"
													>
														Min. DP
													</td>
													<td
														style="
															font-weight: 550;
															color: #a8131f;
															border: 1px solid #ddd;
															padding: 8px;
														"
													>
														Rp {{number_format($pemesanan->total_pemesanan * 0.3)}}
													</td>
												</tr>
											</tfoot>
										</table>
										<!-- <hr style="border: solid #82cc79 1px" /> -->
									</td>
								</tr>
								<!-- ket. payment -->
								<tr>
									<td style="padding: 10px">
										<table style="padding: 10px 10px 0; border-spacing: 0" width="400">
											<tr>
												<td style="text-align: justify">
													<p style="margin: 5px 0 7px !important">
														Pembayaran dapat dilakukan dengan DP minimal atau lunas sesuai
														dengan yang tertera pada kolom total.
													</p>
													<p style="margin: 5px 0px 5px !important">
														Pembayaran dapat dilakukan ke nomor rekening yang tertera dibawah
														ini.
													</p>
												</td>
											</tr>
											<tr>
												<td>
													<p
														style="
															margin: 5px 0px 5px !important;
															font-weight: 550;
															color: #a8131f;
														"
													>
														MANDIRI <br />
														An/ Saka Wisata Yogyakarta <br />
														Rekening : 1270010276044
													</p>
												</td>
											</tr>
											<tr>
												<td>
													<p>Pembayaran dapat dilakukan langsung di kantor SAKAWISATA sebelum batas maksimal pembayaran.</p>
													<p>Apabila pemesanan lebih dari waktu maksimal pembayaran belum dibayarkan maka status pemesanan kunjungan menjadi "Kedaluarsa".</p>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<!-- konfirmasi payment -->
								<tr>
									<td>
										<table width="100%" style="padding-bottom: 30px">
											<tr>
												<td align="center" style="padding: 0 10px; border-spacing: 0">
													<p
														style="
															color: rgb(112, 112, 112) !important;
															font-weight: 600;
															padding: 10px;
														"
													>
														Setelah Anda melakukan pembayaran harap melakukan konfirmasi
														pembayaran melalui link dibawah ini
													</p>
													<a
														href="{{url('member/konfirmasi_pembayaran/' . $pemesanan->kode_pemesanan)}}"
														style="
															background-color: #af7c7f;
															color: #f9eef0;
															text-decoration: none;
															padding: 10px 15px;
															border-radius: 5px;
															font-weight: 400;
														"
														>Konfirmasi Pembayaran >></a
													>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
		</center>
	</body>
</html>