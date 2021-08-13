<p>
  Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime obcaecati voluptatibus magnam nostrum pariatur vitae sapiente totam incidunt? Excepturi aspernatur cupiditate ad dolor maiores rem voluptate at officiis illo voluptates.
</p>

<table class="table" border="1">
  <tr>
    <td>Email</td>
    <td>{{ $member['email'] }}</td>
  </tr>
  <tr>
    <td>Password</td>
    <td>{{ $member['password'] }}</td>
  </tr>
</table>

<a href="{{ url('aktivasi/'.$member['kode'])}}" class="btn btn-info">Aktivasi</a>