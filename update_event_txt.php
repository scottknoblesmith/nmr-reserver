<?php



//run manual test  uncomment below and comment the next two lines
  //echo "here<br>";
  //$title = "new tileXX";
  //$eventId = "11";
  //$clist = array("title", "eol" );
  //echo $clist[0];
  
  $eventId=$_POST['eventId'];
  $title=$_POST['title'];
  $clist=$_POST['clist'];
  //$start=$_POST['start'];
  //$stop=$_POST['stop'];
  //$resource=$_POST['resource'];
  
  
  
  $host = "127.0.0.1";
  $dbname = "serc_nmr_lab";
  $port  = "3306";

  $Update_request = "UPDATE " . $dbname . ".events SET ";
  $Values ='';
  unset($val);
  foreach($clist as $val) {
     if ($Values == '') {
      $Values = " $val = '${$val}' ";
    }else{
      if ($val != "eol") {
        $Values = $Values . ", $val = '${$val}'";
      }
    } 
    //echo "<br>" . $val;
  }
  //echo $val;
  unset($val);
  //echo $Values; 
  //echo $val;
  //echo "done \n";
  $Where = " WHERE events.id = '$eventId' ";
  //echo $Where;
  $FullRequest = $Update_request . $Values . $Where;
  // connect to the database ///
  //echo  $FullRequest;
  //echo "<br> ::here in update_event";
  try {
    $link = mysqli_connect('localhost', 'root', 'root', $dbname);
    if($link === false){
      die("ERROR: Could not connect. " . mysqli_connect_error());
    }
  } catch (Exception $e) {
      echo "Caught exception:   $e";
  }

  if ($q = mysqli_query($link, $FullRequest)) {
    echo "True";
  }else{ 
    echo "False";
    echo json_encode("<br> ERROR: Could not execute ". $q . " :(Message):" . mysqli_error($link));
  }
  echo json_encode("<br>close the query");
  mysqli_close($link);
 
?>