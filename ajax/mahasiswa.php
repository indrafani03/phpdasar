<?php

sleep(3);
require '../functions.php';
$keyword = $_GET["keyword"];

$query = "SELECT * FROM mahasiswa WHERE nama LIKE '%$keyword%'";

$mahasiswa = query($query);




?>
<table border="1" cellpadding="10" cellspacing="0" width="80%">

<tr>
  <th>no</th>
  <th>gambar</th>
  <th>nama</th>
  <th>nrp</th>
  <th>email</th>
  <th>jurusan</th>
  <th>Action </th>



</tr>
<?php $i = 1 ; ?>
<?php foreach($mahasiswa as $mhs) : ?>

<tr>

  <td><?= $i;  ?></td>
  <td><img src="img/<?= $mhs["gambar"];  ?>" width="10%" ></td>
  <td><?= $mhs["nama"];  ?></td>
  <td><?= $mhs["nrp"];  ?></td>
  <td><?= $mhs["email"];  ?></td>
  <td><?= $mhs["jurusan"];  ?></td>
  <td><a href="ubah.php?id=<?= $mhs['id'];  ?>">ubah</a> ||
  <a href="hapus.php?id=<?= $mhs['id'];  ?>" onclick="return confirm('hapus');">hapus</a></td>
</tr>



      <?php $i++ ?>
      <?php endforeach; ?>
</table>