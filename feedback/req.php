<?php
session_start();
require '../mysqlConnect.php';
?>

<style>
.custom {
    color: #006064;
}
</style>
<div class="panel panel-success custom">
<div class="panel-body">

<table class="table teble-hover">
<thaed>
  <th>#</th>
  <th>Parking</th>
  <th>Location</th>
  <th>Street</th>
  <th>Slots</th>
  <th>Hours</th>
  <th>Cost</th>
  <th>When</th>
  <th>Status</th>
  <th>Action</th>
 


</thead>
<tbody>
<?php
$customer = $_SESSION['email'];  
if ($_POST) {
    $stat = $_POST['status'];
       
    $req = "SELECT `requests`.`id`, `parking_id`, `slots`, `hours`, `cost`, `time`, `status`,`location`, `street`, `name` FROM `requests`,`parkings` WHERE `requests`.`parking_id`=`parkings`.`id` AND `requests`.`customer`='$customer' AND `requests`.`status`='$stat'";

    $res = mysqli_query($con, $req);

while ($request = mysqli_fetch_array($res)) {
    $id = $request['id'];
    $parking = $request['name'];
    $slots= $request['slots'];
    $hours = $request['hours'];
    $cost = $request['cost'];
    $time = $request['time'];
    $stat = $request['status'];
    $location = $request['location'];
    $street = $request['street'];

?>
<tr>
  <td>#</td>
  <td><?=$parking; ?></td>
  <td><?=$location; ?></td>
  <td><?=$street; ?></td>
  <td><?=$slots; ?></td>
  <td><?=$hours; ?> hours</td>
  <td>Ksh. <?=$cost; ?></td>
  <td><?=$time; ?></td>
  <td><?=$stat; ?></td>
  <td><button class="btn btn-default" type="submit">Cancel Request</button></td>
</tr>

<?php    

}

}else {





 $status = 'requested';    
    $req = "SELECT `requests`.`id`, `parking_id`, `slots`, `hours`, `cost`, `time`, `status`,`location`, `street`, `name` FROM `requests`,`parkings` WHERE `requests`.`parking_id`=`parkings`.`id` AND `requests`.`customer`='$customer' AND `requests`.`status`='$status'";

    $res = mysqli_query($con, $req);

while ($request = mysqli_fetch_array($res)) {
    $id = $request['id'];
    $parking = $request['name'];
    $slots= $request['slots'];
    $hours = $request['hours'];
    $cost = $request['cost'];
    $time = $request['time'];
    $stat = $request['status'];
    $location = $request['location'];
    $street = $request['street'];

?>
<tr>
  <td>#</td>
  <td><?=$parking; ?></td>
  <td><?=$location; ?></td>
  <td><?=$street; ?></td>
  <td><?=$slots; ?></td>
  <td><?=$hours; ?> hours</td>
  <td>Ksh. <?=$cost; ?></td>
  <td><?=$time; ?></td>
  <td><?=$stat; ?></td>
  <td>Mod</td>
</tr>

<?php    

}
}



?>
</tbody>
</table>
  </div>
</div>