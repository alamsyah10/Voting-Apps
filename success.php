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

        </ul>
      </div>
    </nav>

    <?php
    session_start();
    var_dump($_SESSION);
    if(isset($_SESSION['title']) && isset($_SESSION['listvote'])){
      $valid = true;
      $votes = explode("\n",$_SESSION['listvote']);
      foreach ($votes as $vote) {

        if(strlen($vote)==0){
          $valid = false;
        }
        // code...
      }
      if(sizeof($votes)==1){
        $valid=false;
      }

      if($valid){
        date_default_timezone_set('Asia/Jakarta');
        $potongJudul = strtolower(str_replace(" ","-",$_SESSION['title']));
      //  echo $potongJudul;
        $slug = $potongJudul . date('m-d-Y', time()).date('his');
        $title = $_SESSION['title'];
  //      echo $slug;

        $iduser = $_SESSION['iduser'];
  ///      echo $newQ ."<br>";
        $query = "INSERT INTO poll_questions (title,slug,created_by)
                  VALUES ('$title','$slug',$iduser)";

        if(mysqli_query($link, $query)){
    //      echo "ok";
          $query2 = "";
          $last_id = mysqli_insert_id($link);
          foreach ($votes as $vote) {

            $query2.= "INSERT INTO poll_answers (title,votes,question_id)
                      VALUES ('$vote',0,'$last_id');";
          }
          if(mysqli_multi_query($link, $query2)){
            echo 'ok';
          }
        }







      //  var_dump($_SESSION);
    //  die($slug);
      // $query = "INSERT INTO "

      // echo '<script type="text/javascript">
      //       window.location = "http://localhost:8080/votingweb/"'.$slug.'
      //       </script>';

      $linkslug = "\"http://localhost:8080/votingweb/".$slug."\"";

      echo "<br/>";
      echo "<h1>Voting Kamu sudah dibuat!</h1>";
      echo "<h4> Silahkan liat disini! </h4> ";
      echo "<a href=". $linkslug ."> Votemu </a>";
    }else{
      echo "Maaf gan, pastikan judul dan daftar votenya telah diinput dengan benar >:)";
    }


  }


    //die($_SESSION["slug"]);

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
