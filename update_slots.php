<?php
@require 'mysqlConnect.php';

$select_reserved = "SELECT * FROM `requests` WHERE `status`='requested'";
$reserved_result = mysqli_query($con, $select_reserved);

while ($parking_request = mysqli_fetch_array($reserved_result)) {
    $request_id = $parking_request['id'];
    $request_slots = $parking_request['slots'];
    $request_hours = $parking_request['hours'];
    $request_time = $parking_request['time'];
    $request_parking_id = $parking_request['parking_id'];


  $time = time();
  $minutes = $request_hours * 60;

  $diff = $time-strtotime($request_time);
  $mins = round(abs($diff) / 60);  

  if($mins > $minutes){
    
     
   $update_request = "UPDATE `requests` SET `status`='Completed' WHERE `id`='$request_id'";
   $update_parkings = "UPDATE `parkings` SET `remaining_slots`=`remaining_slots`+'$request_slots' WHERE `id`='$request_parking_id'";

    if (mysqli_query($con, $update_request) && mysqli_query($con, $update_parkings)) {
        
    }



  } 


}


?>