<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>SAKAWISATA - Pembatalan Kunjungan ID Pemesanan</title>
	</head>

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
					<!-- Judul -->
					<tr>
						<td style="padding: 10px; text-align: center">
							<p
								style="
									font-family: Kalam, cursive;
									color: #a56c70;
									font-weight: 650;
									font-size: 18px;
								"
							>
								Pengajuan Pembatalan Kunjungan SAKAWISATA
							</p>
						</td>
					</tr>

					<tr>
						<td>
							<table style="padding: 10px; border-spacing: 0" width="100%">
								<tr>
									<td><h4 style="margin: 10px 10px 0">Hi, Admin SAKAWISATA</h4></td>
								</tr>
								<tr>
									<td>
										<p style="margin: 10px 10px 0">
											Kunjungan dengan ID <strong>#{{ $pemesanan->kode_kunjungan }}</strong> mengajukan <strong>pembatalan kunjungan</strong>. <br />
											Berikut adalah detailnya:
										</p>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<!-- detail paket -->
					<tr>
						<td style="padding: 10px 20px 10px">
							<table
								width="80%"
								style="
									border: solid 1px #f2e8e9;
									border-radius: 7px;
									padding: 10px;
									border-spacing: 0;
								"
							>
								<tr>
									<td style="width: 150px;"">
										<p style="font-weight: 500; margin-bottom: 5px; color: #c18b8f">
											Informasi Pembatalan
										</p>
									</td>
								</tr>
								<tr>
                  <td style="width: 150px; padding-bottom: 5px">Alasan</td>
									<td style="width: 10px; padding-bottom: 5px">:</td>
									<td style="padding-bottom: 5px">{{ $pembatalan->alasan_pembatalan }}</td>
								</tr>
								<tr>
									<td>
										<p style="font-weight: 500; margin: 10px 0 5px; color: #c18b8f">
											Detail Kunjungan
										</p>
									</td>
								</tr>
								<tr>
									<td style="width: 150px; padding-bottom: 5px">ID Pemesanan</td>
									<td style="width: 10px; padding-bottom: 5px">:</td>
									<td style="padding-bottom: 5px">#{{ $pemesanan->kode_pemesanan }}</td>
								</tr>
								<tr>
									<td style="width: 150px; padding-bottom: 5px">Nama Pemesan</td>
									<td style="width: 10px; padding-bottom: 5px">:</td>
									<td style="padding-bottom: 5px">{{ $pemesanan->nama_member }}</td>
								</tr>
								<tr>
									<td style="width: 120px; padding-bottom: 5px">Nama Paket</td>
									<td style="width: 10px; padding-bottom: 5px">:</td>
									<td style="padding-bottom: 5px">{{ $paket->nama_paket }}</td>
								</tr>
								<tr>
									<td style="width: 150px; padding-bottom: 5px">Jumlah Wisatawan</td>
									<td style="width: 10px; padding-bottom: 5px">:</td>
									<td style="padding-bottom: 5px">{{ $pemesanan->jumlah_wisatawan }} orang</td>
								</tr>
								<tr>
									<td style="width: 150px; padding-bottom: 5px">Tanggal Kunjungan</td>
									<td style="width: 10px; padding-bottom: 5px">:</td>
									<td style="padding-bottom: 5px"><?php  echo date("d M Y", strtotime( $pemesanan->tgl_kunjungan))?></td>
								</tr>
								<tr>
									<td style="width: 150px; padding-bottom: 5px">Sesi Kunjungan</td>
									<td style="width: 10px; padding-bottom: 5px">:</td>
									<td style="padding-bottom: 5px">{{ $paket->waktu_kunjungan_paket }}</td>
								</tr>
							</table>
						</td>
					</tr>
					<!-- keterangan -->
					<tr>
						<td style="padding: 10px 20px 20px">
							<table width="100%">
								<tr>
									<td align="center" style="padding: 10px; border-spacing: 0">
										<p
											style="
												color: rgb(112, 112, 112) !important;
												font-weight: 600;
												padding: 10px;
											"
										>
										Klik tombol dibawah ini untuk <br> konfirmasi pembatalan kunjungan wisatawan
										</p>
										<a
											href="{{ url('admin/pemesanan/pembatalan/'.$pemesanan->id_pemesanan) }}"
											style="
												background-color: #a56c70; color: #fafafa; text-decoration: none; padding: 10px 15px; border-radius: 5px; font-weight: 400;
											"
											>Pembatalan Kunjungan</a
										>
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
