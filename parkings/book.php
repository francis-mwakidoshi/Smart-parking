<?php
session_start();
require '../mysqlConnect.php';
require '../update_slots.php';

if($_POST){

  $slot_no = 1;
  $slots_cost = $_POST['slots_cost'];
  $slot_id = $_POST['slot_id'];
  $slot_hours = $_POST['slot_hours'];
  $customer = $_SESSION['driver_email'];

$check_cust = "SELECT * FROM `requests` WHERE `customer`='$customer' AND `status`='requested'";
$result_cust = mysqli_query($con, $check_cust);
if(mysqli_num_rows($result_cust)>0){
  echo '<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-warning-sign"></span>  ALERT!! It seems you have a pending request that have not been approved yet, be patient your packing request will be approved soon!! <span class="glyphicon glyphicon-warning-sign"></span> </div>';
}else{


        $check_avail = "SELECT  `slot`, `remaining_slots` FROM `parkings` WHERE `id`='$slot_id' AND `remaining_slots` !=''";
        $result_avail = mysqli_query($con , $check_avail);

        if (mysqli_num_rows($result_avail)>0) {
              while($avail = mysqli_fetch_array($result_avail)){
                $slots = 1;
                $remaining_slots = $avail['remaining_slots'];
              }

              $now_slots = $remaining_slots - $slot_no;
              $update = "UPDATE `parkings` SET `remaining_slots`='$now_slots' WHERE `id`='$slot_id'";
              $book = "INSERT INTO `requests`(`id`, `parking_id`, `slots`, `hours`, `cost`, `customer`,`status`) VALUES (NULL,'$slot_id','$slot_no','$slot_hours','$slots_cost','$customer','requested')";

              if (mysqli_query($con, $book) && mysqli_query($con, $update)) {
              echo "You have successfully Reserved this space";
              }else{
                echo "Failed to Reserve this parking space";
              }

        }else {
          echo "ERROR!! Number of slots exceeds the remaining slots";
        }

}
}

 ?>
