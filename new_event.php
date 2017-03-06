<?php

//Degug input
  //$title="this";
  //$start



  $title=$_POST['title'];
  $start=$_POST['start'];
  $stop=$_POST['stop'];
  $resource=$_POST['resource'];
  $username=$_POST['username'];
  
  $host = "127.0.0.1";
  $dbname = "serc_nmr_lab";
  $port  = "3306";
  
  $Insert_request = "INSERT INTO events ( title, start, stop, resource, username )";
  $Values = " VALUES ( '$title', '$start', '$stop', '$resource', '$user' )";
  $FullRequest = $Insert_request . $Values;
  echo $FullRequest;
  // connect to the database ///
  try {
    $link = mysqli_connect('localhost', 'root', 'root', $dbname);
    if($link === false){
      die("ERROR: Could not connect. " . mysqli_connect_error());
    }
  } catch (Exception $e) {
      echo "Caught exception:   $e";
  }

  if ($q = mysqli_query($link, $FullRequest)) {
    $newID = mysqli_insert_id($link);
    if ($newID>0) {
      echo json_encode($newID);
    }
  } else { 
    echo json_encode("<br> ERROR: Could not execute ". $q . " :(Message):" . mysqli_error($link));
  }
  mysqli_close($link);
?>