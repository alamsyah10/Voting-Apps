<?php

$link = mysqli_connect('localhost','root','','votingweb');

if(!$link){
  die('ada error' . mysqli_connect_error());
}

?>
