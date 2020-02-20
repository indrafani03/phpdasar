
<?php
session_start();

if(!isset($_SESSION["login"])) {

header('Location:login.php');
exit;

}
require "functions.php";


//  //pagenation
//  $jumlahDataPerhalaman = 2;
//  $jumlahData = count(query("SELECT * FROM mahasiswa"));
//  $jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);
//  $halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;

// $awalData =($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;

$mahasiswa = query("SELECT * FROM mahasiswa");




if(isset($_POST["cari"])){

  $mahasiswa = cari($_POST["keyword"]);
}


 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>daftar mahasiswa</title>
     <style>

          .loading {

            width: 40px;
            margin-top: 0px;
            margin-left: 0px;
            position: absolute;
            z-index: 1px;
            display: none;

          }

     </style>
   </head>
   <body>

     <a href="logout.php"> logout </a>
     <br>
     <br>
     <br>
     <a href="tambah.php">tambah data masiswa</a>
      <br>
     <form class="" action="" method="post">
       <br>
       <input type="text" name="keyword" size="40%" placeholder="cari data...." autofocus autocomplete="off" id="keyword">
       <button type="submit" name="cari" id="tombol-cari">cari</button>
       <img src="img/loading.gif" class="loading" alt="">
     </form>



      <br>
      <div id="container">
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
     </div>
     <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/script.js"></script>
   </body>
 </html>
