<?php


  $request = "SELECT id, level, start, stop, resource, username, title  FROM events";
  //echo "<br> $request";
 
  $json = array();
  $host = "127.0.0.1";
  $dbname = "serc_nmr_lab";
  $port  = "3306";
  $thisis = "mysql:host=$host; dbname='$dbname' ;port=$port, 'root', 'root'";

  try {
    $link = mysqli_connect('localhost', 'root', 'root', $dbname);
    if($link === false){
       die("ERROR: Could not connect. " . mysqli_connect_error());
    }
  } catch (Exception $e) {
      echo "Caught exception:   $e";
  }

  
  if ($resultt = mysqli_query($link, $request)) {
    while($row = mysqli_fetch_array($resultt)){
      //echo "here";
      $e = array();
      $e['id'] = $row['id'];
      $e['level'] = $row['level'];
      $e['start'] = $row['start'];
      $e['stop'] = $row['stop'];
      $e['resourceId'] = $row['resource'];
      $e['username'] = $row['username'];
      $e['title'] = $row['title'];
      array_push($json, $e);
    
    //echo json_encode($json, JSON_PRETTY_PRINT);
    //Need error protection for malformed dateTimes etc...
      if ($row['start'] = '' || $row['stop'] = '') {
        echo "ERROR: Malformed times!";
        exit;
      }
    }

    echo json_encode($json, JSON_PRETTY_PRINT);      
  }else{
    echo "ERROR: Could not execute $request. " . mysqli_error($link);
  }
  mysqli_close($link);
?>