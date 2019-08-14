<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Voting-Weebs</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="../css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="../style2.css" rel="stylesheet">
</head>

<body>
  <?php

    require_once 'core/init.php';

    //validasi register
    if(isset($_POST['submit'])){
       $nama = $_POST['username'];
       $pass = $_POST['password'];

       if(!empty(trim($nama)) && !empty(trim($pass))){
         if(register_cek_nama($nama)){
           //input ke database
           if(register_user($nama, $pass)){
             echo 'berhasil';
           }else{
             echo 'gagal daftar';
           }
         }else{
           echo "Nama sudah ada, tidak bisa daftar";
         }
       }else{
         echo 'tidak boleh kosong';
       }
    }

   ?>
<div  class="container container-fluid">
  <nav class="mb-1 navbar navbar-expand-lg navbar-dark info-color">
    <a class="navbar-brand" href="../index.php">Voting Apps</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
      aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="../index.php">
            <i class="fab"></i> Home
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../create.php">
            <i class="fab"></i> New Poll</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php">
            <i class="fab"></i>Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.php">
            <i class="fab"></i>Register</a>
        </li>

      </ul>
    </div>
  </nav>

    <form action="register.php" method="post">
      <label for="">Nama</label><br>
      <input type="text" name="username" > <br><br>

      <label for="">Password</label><br>
      <input type="password" name="password" > <br><br>

      <input type="submit" name="submit" value="daftar">
    </form>
  </div>
