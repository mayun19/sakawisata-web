<p>
  RESET PASSWORD MEMBER SAKAWISATA
</p>

<table class="table" border="1">
  <tr>
    <td>Email</td>
    <td>{{ $member['email'] }}</td>
  </tr>
  <tr>
    <td>Nama Member</td>
    <td>{{ $member['nama'] }}</td>
  </tr>
</table>

<a href="https://sakawisata.com/create_password/{{ $member['kode'] }}" class="btn btn-info">Aktivasi</a>