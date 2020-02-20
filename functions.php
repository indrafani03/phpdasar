<?php

//connect ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");


//buat sebuah functionquery
function query($query){
    global $conn;

    //lakuakan query
    $result = mysqli_query($conn, $query);

    //buat sebuah wadah
    $rows = [];

    //masukan semua ke dalam wadah
    while ($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
    }
    return $rows;
}

function tambah($data){

    global $conn;
    $nama = htmlspecialchars($data["nama"]);
    $nrp = htmlspecialchars($data["nrp"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    //jalankan fungsi upload gambar
    $gambar = upload();
    if(!$gambar){
        return false;
    }


    $query= "INSERT INTO mahasiswa VALUES ('','$nama', '$nrp', '$email', '$jurusan','$gambar')";
    $result = mysqli_query($conn,$query);


  return mysqli_affected_rows($conn);

}

function upload(){
  $namaFile = $_FILES["gambar"]["name"];
  $ukuranFile = $_FILES["gambar"]["size"];
  $error = $_FILES["gambar"]["error"];
  $tmpName = $_FILES["gambar"]["tmp_name"];

  //apakah gambar tidak di is_uploaded_file

  if($error === 4){
    echo "
        <script>
        alert('gambar belum di masukan');
        </script>
    ";
    return false;
  }
//yang boleh di upload hanya gambar
  $ekstensiGambarValid = ['jpg','jpeg','png'];
  $ekstensiGambar = explode('.',$namaFile);
  $ekstensiGambar = strtolower(end($ekstensiGambar));

  //cek array dlam variabel
  if( !in_array($ekstensiGambar, $ekstensiGambarValid)){

    echo "
        <script>
        alert('yang anda upload bukan gambar');
        </script>
    ";
    return false;

  }
  //cek jika ukran terlalu besar
  $ekstensiFile = ['> 2000000'];
  if(in_array($ukuranFile, $ekstensiFile)){
    echo "
        <script>
        alert('file gambar terlalu besar');
        </script>
    ";
    return false;
  }
    $namaFileBaru =uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;


  move_uploaded_file($tmpName, 'img/'.$namaFileBaru);

  return $namaFileBaru;
}

function hapus($id){
    global $conn;

    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id=$id");

    return mysqli_affected_rows($conn);
}


function ubah($data){

    global $conn;
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $nrp = htmlspecialchars($data["nrp"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    //cek apakah user pilih gambar baru atau tidak

    if($_FILES["gambar"]["error"] === 4){
      $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }



    $query= "UPDATE mahasiswa
SET nama = '$nama', nrp = '$nrp', email = '$email', jurusan = '$jurusan', gambar = '$gambar'
WHERE id = $id;";
    $result = mysqli_query($conn,$query);


  return mysqli_affected_rows($conn);

}
function cari($data){

  $query = "SELECT * FROM mahasiswa WHERE nama LIKE '%$data%'";

  return query($query);
}

function register($data){

  global $conn;

  $username = strtolower(stripslashes($data["username"]));
  $password = mysqli_real_escape_string($conn,$data["password"]);
  $password2 = mysqli_real_escape_string($conn,$data["password2"]);

  if($password !== $password2) {
    echo "
          <script>
              alert('password yang anda masukan tidak sama');
          </script>

    ";
    return false;
  }
  //engkripsi dulu passwordnya
$password = password_hash($password,  PASSWORD_DEFAULT);
//tambahkan ke database
mysqli_query($conn, "INSERT INTO user VALUES('','$username','$password')");

return mysqli_affected_rows($conn);

}
 ?>
