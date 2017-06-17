
<?php
session_start();
@require '../update_slots.php';
require '../mysqlConnect.php';
?>

<style>
.custom {
    color: #006064;
}
</style>
<div class="panel panel-success custom">
<div class="panel-body ">

</div class="table-responsive ">
<table class="table  table-bordered table-striped table-hover " >
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
$customer = $_SESSION['driver_email'];  
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
  <td></td>
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
$url = "print1.php?request_id=".urlencode($id);
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
  <td><a href="<?=$url;?> " class="btn btn-default" type="submit"><span class="glyphicon glyphicon-save-file"></span> Print</a></td>
</tr>

<?php    

}
}



?>
<script>
$(function () {
    $('.table').DataTable();
} );

  function loadData(){
    $(".table").Datatable();
  }

  document.onready = function(){
    loadData();
  }

  
</script>
</tbody>
</table>
</div>
  </div>
</div>
