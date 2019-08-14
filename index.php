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

    <p> Daftar votingan yang telah dibuat </p>

    <?php

        $display = "SELECT title, slug FROM poll_questions";
        $result = $link->query($display);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {

                $linkslug = "\"http://localhost:8080/votingweb/".$row["slug"]."\"";

              echo " <ul style=\"text-align:center\" class=\"list-group\">";
              echo    "<a href=".$linkslug." class=\"list-group-item list-group-item-action\">". $row["title"] ."</a>";

              echo  "</ul>";

            }
        } else {
            echo "0 results";
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
