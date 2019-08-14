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
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="style2.css" rel="stylesheet">
</head>

<body>
  <?php
    $link = mysqli_connect('localhost','root','','votingweb');

    if(!$link){
      die('ada error' . mysqli_connect_error());
    }
   ?>

  <div  class="container container-fluid">
    <?php
    session_start();
    //  echo $_SESSION['user'];
      if(!isset($_SESSION['user'])){
      ?>
      <nav class="mb-1 navbar navbar-expand-lg navbar-dark info-color">
        <a class="navbar-brand" href="index.php">Voting Apps</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
          aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">
                <i class="fab"></i> Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="create.php">
                <i class="fab"></i> New Poll</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="auth_php/login.php">
                <i class="fab"></i>Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="auth_php/register.php">
                <i class="fab"></i>Register</a>
            </li>

          </ul>
        </div>
      </nav>
      <?php
    }else{
     ?>
     <nav class="mb-1 navbar navbar-expand-lg navbar-dark info-color">
       <a class="navbar-brand" href="index.php">Voting Apps</a>
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
         aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
       </button>
       <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
         <ul class="navbar-nav ml-auto">
           <li class="nav-item active">
             <a class="nav-link" href="index.php">
               <i class="fab"></i> Home
               <span class="sr-only">(current)</span>
             </a>
           </li>
           <li class="nav-item">
             <a class="nav-link" href="create.php">
               <i class="fab"></i> New Poll</a>
           </li>
           <li class="nav-item">
             <a class="nav-link">
               <i class="fab"></i><?php echo "Hi ".$_SESSION['user']."!" ?> </a>
           </li>
           <li class="nav-item">
             <a class="nav-link" href="auth_php/logout.php">
               <i class="fab"></i>Logout</a>
           </li>

         </ul>
       </div>
     </nav>
     <?php

   }

      ?>
    <br/>
    <h1>Voting gadungan</h1>
    <?php

    if(isset($_SESSION['user'])){

     ?>
        <?php


        echo "Inputkan judul hanya alfabet atau angka saja!";

        $oldtitle = isset($_POST['title']) ? $_POST['title'] : '';
        echo "<form  action = \"create.php\" method=\"post\">";
        echo  "<div class=\"md-form\">";
        echo     "<label for=\"inputPrefilledEx\">Judul Vote</label>";
        echo     "<input" . " value = \"" . $oldtitle . "\"" . "name =\"title\" type=\"text\" id=\"inputPrefilledEx\" class=\"form-control\">";

        $oldlist = isset($_POST['listvote']) ? $_POST['listvote'] : '';
        echo   "</div>";
        echo   "<div class=\"form-group\">";
        echo     "<label for=\"exampleFormControlTextarea3\">Masukan daftar vote dipisahkan oleh sebuah baris baru</label>";
        echo     "<textarea name = \"listvote\"class=\"form-control\" id=\"exampleFormControlTextarea3\" rows=\"7\">". $oldlist  ."</textarea>";
        echo   "</div>";

        echo   "<input class=\"btn btn-primary\" type=\"submit\" value=\"submit\">";
        echo "</form>";


        if(isset($_POST['title']) && isset($_POST['listvote'])){
          $_SESSION['title'] = $_POST['title'];
          $_SESSION['listvote'] = $_POST['listvote'];
          $valid = true;
          $votes = explode("\n",$_POST['listvote']);
          foreach ($votes as $vote) {

            if(strlen($vote)==0){
              $valid = false;
            }
            // code...
          }
          if(sizeof($votes)==1){
            $valid=false;
          }
          if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_SESSION['title']))
          {
            $valid = false;
          }
          if($valid){
            date_default_timezone_set('Asia/Jakarta');
            $slug = $_POST['title'] . date('m-d-Y', time()).date('his');
            $linkslug = "\"http://localhost:8080/votingweb/".$slug."\"";
        
            header('Location: success.php');

          //  var_dump($_SESSION);
        //  die($slug);
          // $query = "INSERT INTO "

          // echo '<script type="text/javascript">
          //       window.location = "http://localhost:8080/votingweb/"'.$slug.'
          //       </script>';


        }else{
          echo "Maaf gan, pastikan judul dan daftar votenya telah diinput dengan benar >:)";
        }

    }
            // echo $slug;
            //
            //   echo ($_POST['title']);

}else{


    ?>

    Anda harus login untuk membuat vote baru!
    <br>

    <?php
  }

     ?>



  </div>


  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
</body>

</html>
