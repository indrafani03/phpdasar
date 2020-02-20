<?php

session_start();
require 'functions.php';
if(isset($_COOKIE['id']) && isset($_COOKIE['key'])){

    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $result = mysqli_query($conn, "SELECT username FROM user WHERE id= $id");

    $row = mysqli_fetch_assoc($result);

    //cek cookie dan $username
    if( $key === hash('sha256', $row['username'])){

      $_SESSION['login'] = true;
    } else {
      echo "gagal login";
    }


  }


if(isset($_SESSION["login"])){
  header("Location:index.php");

}


if(isset($_POST["login"])){

  $username = $_POST["username"];
  $password = $_POST["password"];

  $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

  if(mysqli_num_rows($result) === 1) {
  $row = mysqli_fetch_assoc($result);

  if( password_verify($password, $row["password"])) {
    //CEK session
    $_SESSION["login"] = true;
    //cek remember me

    if( isset($_POST["remember"])){

      setcookie('id',$row['id'],time() + 60);
      setcookie('key',hash('sha256', $row['username']),time() + 60);
    }
    header("Location:index.php");
    exit;
   }
  }

  $error = true;
}



 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>halaman login</title>
    <?php if(isset($error)) : ?>
      <p style="color:red; font-style:italic;">username / password salah</p>
    <?php endif; ?>
  </head>
  <body>
    <form class="" action="" method="post">
        <ul>
          <li>
            <label for="username">username</label>
            <input type="text" name="username" id="password">
          </li>
          <li>
            <label for="password">password</label>
            <input type="password" name="password" id="password">
          </li>
          <li>
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">remember me</label>
          </li>
          <li>
            <button type="submit" name="login">login</button>
          </li>
        </ul>
    </form>
  </body>
</html>
