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
   $ambil = explode("/",$_SERVER['REQUEST_URI']);
 //  var_dump($ambil); echo "<br>";
   $slug = $ambil[2];
//    echo $slug;

   // $display = "SELECT title, id FROM poll_questions WHERE slug = '$slug'";
   //
   // $result = $link->query($display);
   // $row = $result->fetch_assoc();

   $display = "SELECT title, id FROM poll_questions WHERE slug = ?";
   $result = $link->prepare($display);
   $result->bind_param("s", $slug);
   $result->execute();
   $row = $result->get_result()->fetch_assoc();

 //  var_dump($row);
   $linkslug = "\"http://localhost:8080/votingweb/".$slug."\"";


   $idtitle = $row["id"];
   $displayvote = "SELECT * FROM poll_answers WHERE question_id = '$idtitle' GROUP BY id";
   $resultvote = $link->query($displayvote);
   //var_dump($resultvote);
   $rowvotes = $resultvote->fetch_all(MYSQLI_ASSOC);
   //var_dump($rowvotes);

   $displayvote = "SELECT * FROM poll_answers WHERE question_id = '$idtitle' GROUP BY id";
   $resultvote = $link->query($displayvote);
   //var_dump($resultvote);
   $rowvotes = $resultvote->fetch_all(MYSQLI_ASSOC);
   $dataPoints = array(
     array("label" => $rowvotes[0]['title'], "y" => $rowvotes[0]['votes'])
   );
   for ($i=1; $i < sizeof($rowvotes); $i++) {
     $jdul = $rowvotes[$i]['title'];

     $rowvotes[$i]['title'] = preg_replace('~[\r\n]+~', '', $jdul);
     $dataPoints[$i]["label"] = $rowvotes[$i]['title'];
     $dataPoints[$i]["y"] = $rowvotes[$i]['votes'];


   }
    session_start();
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
echo  "<div id=\"chartContainer\" style=\"height: 370px; width: 100%;\"></div>";
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

echo  "<div id=\"chartContainer\" style=\"height: 370px; width: 100%;\"></div>";

  echo "<div style=\"text-align:center; margin:auto; display : block\" class=\"btn-group-vertical\" role=\"group\" aria-label=\"Vertical button group\">";
  foreach ($rowvotes as $rowvote) {
    $voteid = $rowvote["id"];
    $votetitle = $rowvote["title"];
//      var_dump($voteid);
    echo "<form style=\"margin: 0 auto; width:25%;\" action=\"$linkslug\" method=\"post\">";
        echo "<input class=\"btn btn-light\" type=\"submit\" name=\"".$voteid."\" value=\"".$votetitle."\" />";

    echo "</form>";


  }
  echo "<form  style=\"margin: 0 auto; width:25%;\" action=\"$linkslug\" method=\"post\">";
  echo "<input name=\"newoption\" id=\"defaultContactFormName\" type=\"text\" class = \"form-control\" placeholder = \"Input opsi baru...\">";

  echo "</form>";


  if(isset($_POST))
  {
    if(isset($_POST['newoption'])){
        echo $_POST['newoption']."<br>";
        $simpan = $_POST['newoption'];
        $newQuery = "INSERT INTO poll_answers(title, votes,  question_id) VALUES ('$simpan',1,'$idtitle')";
        mysqli_query($link, $newQuery);
        header('Location: '.$slug);
    }

    foreach($_POST as $key=>$value)
     {
       echo $key." ".$value."<br>";
       $newQuery = "UPDATE poll_answers SET votes = votes+1 WHERE id = '$key'";
       $resultNewQuery = $link -> query($newQuery);
               header('Location: '.$slug);
     }

  }
}

    ?>


    <br/>

    <?php
      echo "</div>";
     ?>
     <script>
       window.onload = function () {

       var chart = new CanvasJS.Chart("chartContainer", {
       	animationEnabled: true,
       	exportEnabled: true,
       	title:{
       		text: "<?php echo $row["title"] ?>"
       	},
       	subtitles: [{
       		text: "Hasil Vote Sementara"
       	}],
       	data: [{
       		type: "pie",
       		showInLegend: "true",
       		legendText: "{label}",
       		indexLabelFontSize: 16,
       		indexLabel: "{label} - #percent%",
       		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
       	}]
       });
       chart.render();

       }
       </script>

    <script src="canvasjs-2.3.2/canvasjs.min.js"></script>

  </div>


  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>

</html>
