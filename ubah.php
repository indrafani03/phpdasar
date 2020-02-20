<?php

session_start();

if(!isset($_SESSION["login"])){
  header("Location:login.php");
  exit;
}

require "functions.php";

//tangkap data id

$id = $_GET["id"];

$result = query("SELECT *  FROM mahasiswa WHERE id=$id")[0];




if( isset($_POST["submit"])){

  if( ubah($_POST) > 0){
      echo "
          <script>
            alert('data berhasil di ubah');
            document.location.href = 'index.php';
          </script>
      ";
   } else {
     echo "
         <script>
           alert('data gagal di ubah');
           document.location.href = 'index.php';
         </script>
     ";
   }
  }



 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form class="" action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $result["id"];  ?>">
      <input type="hidden" name="gambarLama" value="<?= $result["gambar"];  ?>">
          <ul>
            <li><label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" value="<?= $result["nama"]; ?>" ></li>
            <li><label for="nrp">Nrp</label>
            <input type="text" name="nrp" id="nrp"value="<?= $result["nrp"]; ?>" ></li>
            <li><label for="email">Email</label>
            <input type="text" name="email" id="email" value="<?= $result["email"]; ?>" ></li>
            <li><label for="jurusan">Jurusan</label>
            <input type="text" name="jurusan" id="jurusan" value="<?= $result["jurusan"]; ?>"></li>
            <li><label for="gambar">Gambar</label>
              <br>
              <img src="img/<?= $result["gambar"];  ?>" alt="" width="40">
            <input type="file" name="gambar" id="gambar" ></li>
            <li><button type="submit" name="submit">ubah data</button></li>
          </ul>
    </form>


  </body>
</html>
