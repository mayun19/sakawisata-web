<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>SAKAWISATA - Aktivasi Pendaftaran Akun</title>
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
									font-weight: 550;
									font-size: 18px;
								"
							>
								Reset Password
							</p>
						</td>
					</tr>
					<tr>
						<td>
							<table style="padding: 10px; border-spacing: 0" width="100%">
								{{-- <tr>
									<td>
										<p style="margin: 5px 10px 0">Hai, <strong>{{ $member['nama_member'] }} !</strong></p>
									</td>
								</tr> --}}
								<tr>
									<td>
										<p style="margin: 5px 10px 0">
											Klik tombol dibawah untuk mengatur ulang password mu. Jika kamu tidak
											meminta password baru, kamu dapat mengabaikan email ini.
										</p>
									</td>
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
										<a
											href="{{ url('new_password/'.$member['kode']) }}"
											style="
												background-color: #a56c70;
												color: #fafafa;
												text-decoration: none;
												padding: 10px 15px;
												border-radius: 5px;
												font-weight: 400;
											"
											>Reset Password</a
										>
									</td>
								</tr>
								<tr>
									<td>
										<p style="margin: 10px 10px 0">
											Salam, <br />
											<span style="font-weight: 500; color: #c18b8f">SAKAWISATA</span>
										</p>
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
