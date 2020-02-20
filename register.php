<?php
session_start();

if(!isset($_SESSION["login"])){
  header("Location:login.php");
  exit;
}

require 'functions.php';

if( isset($_POST["register"])){

  if(register($_POST) > 0){
    echo "
      <script>
        alert('user baru di tambahkan');
      </script>

    ";
  } else {
    echo mysqli_error($conn);
  }

}


 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>registrasi</title>
    <style>
      label {
        display: block;
      }
    </style>
  </head>
  <body>
    <form class="" action="" method="post">
      <ul>
        <li>
          <label for="username">username</label>
          <input type="text" name="username" id="username">
        </li>
        <li>
          <label for="password">password</label>
          <input type="password" name="password" id="password">
        </li>
        <li>
          <label for="password2">confirmasi password</label>
          <input type="password" name="password2" id="password2">
        </li>
        <li>
          <button type="submit" name="register">register</button>
        </li>
      </ul>
    </form>
  </body>
</html>
