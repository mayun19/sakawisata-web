<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>SAKAWISATA - Reschedule Kunjungan ID Pemesanan</title>
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
									color: rgb(130, 204, 121);
									font-weight: 650;
									font-size: 18px;
								"
							>
								Reschedule Kunjungan SAKAWISATA
							</p>
						</td>
					</tr>

					<tr>
						<td>
							<table style="padding: 10px; border-spacing: 0" width="100%">
								<tr>
									<td><h4 style="margin: 10px 10px 0">Hi, {{$pemesanan->nama_member}}!</h4></td>
								</tr>
								<tr>
									<td>
										<p style="margin: 10px 10px 0">
											Pengajuan reschedule kunjungan dengan ID <strong>#{{ $pemesanan->kode_kunjungan }}</strong> telah
											kami terima.
										</p>
										<p style="margin: 10px 10px 0">
											Berikut detail perubahan jadwal kunjungan mu :
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
								width="100%"
								style="
									border: solid 1px #f2e8e9;
									border-radius: 7px;
									padding: 10px;
									border-spacing: 0;
								"
							>
								<tr>		
									<td>
										<p style="font-weight: 500; margin: 10px 0 5px; color: #c18b8f">
											Detail Kunjungan
										</p>
									</td>
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
                    <td style="width: 150px; padding-bottom: 5px"><strong>Tanggal Kunjungan</strong></td>
                    <td style="width: 10px; padding-bottom: 5px">:</td>
                    <td style="padding-bottom: 5px"><strong><?php  echo date("d M Y", strtotime( $pemesanan->tgl_kunjungan))?></strong></td>
								</tr>
								<tr>
									<td style="width: 150px; padding-bottom: 5px"><strong>Sesi Kunjungan</strong></td>
									<td style="width: 10px; padding-bottom: 5px">:</td>
									<td style="padding-bottom: 5px"><strong>{{ $pemesanan->nama_sesi }}</strong></td>
								</tr>
							</table>
						</td>
					</tr>
          	<!-- Regret -->
					<tr>
						<td width="100%">
							<table style="margin-bottom: 50px; border-spacing: 0">
								<p style="padding: 10px 10px; margin: 15px 10px 0">
									Terimakasih, <br />
									<span style="color: #a56c70; font-weight: 550"
										>SAKAWISATA Kampung Kauman Yogykarta</span
									>
								</p>
							</table>
						</td>
					</tr>
				</table>
			</div>
		</center>
	</body>
</html>
