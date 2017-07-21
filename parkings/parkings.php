<!--Parking spaces to display here-->
<?php
session_start();
require '../update_slots.php';
require '../mysqlConnect.php';

if($_POST){
$city = $_POST['city'];
$street = $_POST['street'];

if($city == '' && $street==''){
$query_parkings = "SELECT * FROM `parkings`";
}else{


  if($city==''){
    $scity = "`location` != 'null'";
  }else {
    $scity = "`location`='$city'";
  }

  if($street==''){
    $sstreet = "`street` != 'null'";
  }else {
    $sstreet = "`street`='$street'";
  }

$query_parkings = "SELECT * FROM `parkings` WHERE $scity AND $sstreet";
}





$parkings_result = mysqli_query($con, $query_parkings);

while ($parking = mysqli_fetch_array($parkings_result)) {
  $parking_id = $parking['id'];
  $parking_location = $parking['location'];
  $parking_street = $parking['street'];
  $parking_name = $parking['name'];
  $parking_slot = $parking['slot'];
  $parking_price = $parking['price'];
  $parking_remaining = $parking['remaining_slots'];
?>
<div class="panel panel-default parking_text">
  <div class="panel-body">
    <h4 class="Head"><?=$parking_name; ?></h4>
    <hr>
    <ul class="list-group">
      <li class="list-group-item"><span class="glyphicon glyphicon-home"></span> <?=$parking_name; ?> (<?=$parking_remaining;?>)</li>
      <li class="list-group-item"><span class="glyphicon glyphicon-map-marker"></span> <?=$parking_location; ?></li>

    </ul>
    <button class="btn btn-default" data-backdrop="false" type="button" data-toggle="modal" data-target="#reserve<?=$parking_id ; ?>">select Now!!</button>

  </div>
</div>

<div class="modal fade parking_text" id="reserve<?=$parking_id ; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?=$parking_name; ?> Reservation</h4>
      </div>
      <div class="modal-body">
        <ul class="list-group">
          <li class="list-group-item"><span class="glyphicon glyphicon-home"></span> <?=$parking_name; ?></li>
          <li class="list-group-item"><span class="glyphicon glyphicon-tag"></span> <?=$parking_remaining; ?> Remaining Slots</li>
          <li class="list-group-item"><span class="glyphicon glyphicon-credit-card"></span> Ksh. <?=$parking_price; ?> Per Slot Per Hour</li>
          <li class="list-group-item " ><span class="glyphicon">Ksh. </span> <p class="total" id="total<?=$parking_id; ?>"><?=$parking_slot; ?> </p></li>

          <li class="list-group-item">
            <div class="input-group">
              <input type="text" class="form-control"  id="hour<?=$parking_id; ?>" placeholder="Number of Hours" aria-describedby="basic-addon2">
              <span class="input-group-addon" id="basic-addon2">Hours</span>
            </div>
          </li>


        </ul>

                            <h2 data-background-color="green">
                                <span><i class="fa fa-cc-paypal" aria-hidden="true"></i></span>
                               <span><i class="fa fa-cc-mastercard" aria-hidden="true"></i></i></span>
                               <span><i class="fa fa-cc-visa" aria-hidden="true"></i></span>
                               <span><i class="fa fa-google-wallet" aria-hidden="true"></i></i></span>
                               <span><i class="fa fa-cc-discover" aria-hidden="true"></i></span>
                               <span><i class="fa fa-cc-stripe" aria-hidden="true"></i></span>
                            </h2>
        <div id="slot_status<?=$parking_id; ?>"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="select<?=$parking_id; ?>">Select this space</button>
      </div>
    </div>
  </div>
</div>
<script src="assets/js/jquery.js"></script>
<script>
$(function(){
  $('#hour<?=$parking_id; ?>').keyup(function(){
        var hours = $('#hour<?=$parking_id; ?>').val();
        var total='';
        var cost = "<?=$parking_price; ?>";

        var remaining = "<?=$parking_remaining; ?>";

        if( Number(remaining) > 0 ){
           $("#slot_status<?=$parking_id; ?>").html("");
           $("#total<?=$parking_id; ?>").html("Cannot Add A Value");
            $("#select<?=$parking_id;?>").prop('disabled', false).attr('class', 'btn btn-primary').html('Select this space');
        }else{
           $("#slot_status<?=$parking_id; ?>").html("This Parking is Fully Packed and Can Not Hold More Request").css("color", "red");
           $("#select<?=$parking_id;?>").prop('disabled', true).attr('class', 'btn btn-danger').html('Disabled...');
        }
                total = cost * hours ;
                $("#total<?=$parking_id; ?>").html(total);
            total = cost * hours * slot;
            $("#total<?=$parking_id; ?>").html(total);

  });

$("#select<?=$parking_id; ?>").click(function(){
  var slots_cost1 = $("#total<?=$parking_id; ?>").html()  ;
  var slot_id1 = "<?=$parking_id; ?>";
  var slot_hours1 = $("#hour<?=$parking_id; ?>").val();
    if(slots_cost1 > 0){
        if(slot_hours1==''){
             $("#slot_status<?=$parking_id; ?>").html("Fill in input fields first").css("color", "red");
        }else{
          $.post("parkings/book.php",{slots_cost:slots_cost1, slot_hours:slot_hours1, slot_id:slot_id1}, function(data){
             $("#slot_status<?=$parking_id; ?>").html(data);
          })
        }
    }else{
      alert("Invalid Price Value, INput the correct value for hours and slot");
    }
})





});


</script>
<?php


}
}else{






$query_parkings = "SELECT * FROM `parkings` WHERE `remaining_slots` > '0'";

$parkings_result = mysqli_query($con, $query_parkings);

while ($parking = mysqli_fetch_array($parkings_result)) {
  $parking_id = $parking['id'];
  $parking_location = $parking['location'];
  $parking_street = $parking['street'];
  $parking_name = $parking['name'];
  $parking_slot = $parking['slot'];

  $parking_remaining = $parking['remaining_slots'];

  $parking_price = $parking['price'];
?>
<div class="panel panel-default parking_text">
  <div class="panel-body">
    <h4 class="Head"><?=$parking_name; ?></h4>
    <hr>
    <ul class="list-group">
      <li class="list-group-item"><span class="glyphicon glyphicon-home"></span> <?=$parking_name; ?>  (<?=$parking_remaining;?>)</li>

    </ul>
    <button class="btn btn-default" type="button" data-backdrop="false" data-toggle="modal" data-target="#reserve<?=$parking_id ; ?>">select Now!!</button>

  </div>
</div>

<div class="modal fade parking_text" id="reserve<?=$parking_id ; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?=$parking_name; ?> Reservation</h4>
      </div>
      <div class="modal-body">
        <ul class="list-group">
          <li class="list-group-item"><span class="glyphicon glyphicon-home"></span> <?=$parking_name; ?></li>

          <li class="list-group-item"><span class="glyphicon glyphicon-tag"></span> <?=$parking_remaining; ?> Remaining Slots</li>

          <li class="list-group-item"><span class="glyphicon glyphicon-credit-card"></span> Ksh. <?=$parking_price; ?> Per Slot Per Hour</li>
          <li class="list-group-item " ><span class="glyphicon">Ksh. </span> <p class="total" id="total<?=$parking_id; ?>"><?=$parking_slot; ?> </p></li>

          </li>
          <li class="list-group-item">
            <div class="input-group">
              <input type="text" class="form-control"  id="hour<?=$parking_id; ?>" placeholder="Number of Hours" aria-describedby="basic-addon2">
              <span class="input-group-addon" id="basic-addon2">Hours</span>
            </div>
          </li>


        </ul>

                            <h2>
                                <span><i class="fa fa-cc-paypal" aria-hidden="true"></i></span>
                               <span><i class="fa fa-cc-mastercard" aria-hidden="true"></i></i></span>
                               <span><i class="fa fa-cc-visa" aria-hidden="true"></i></span>
                               <span><i class="fa fa-google-wallet" aria-hidden="true"></i></i></span>
                               <span><i class="fa fa-cc-discover" aria-hidden="true"></i></span>
                               <span><i class="fa fa-cc-stripe" aria-hidden="true"></i></span>
                            </h2>
        <div id="slot_status<?=$parking_id; ?>"></div>

        <div id="status1<?=$parking_id; ?>"></div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="select<?=$parking_id; ?>">Select this space</button>
      </div>
    </div>
  </div>
</div>
<script src="assets/js/jquery.js"></script>
<script>
$(function(){
  $('#hour<?=$parking_id; ?>').keyup(function(){
        var hours = $('#hour<?=$parking_id; ?>').val();
        var total='';
        var cost = "<?=$parking_price; ?>";

        var remaining = "<?=$parking_remaining; ?>";

        if( Number(remaining)> 0 ){
           $("#slot_status<?=$parking_id; ?>").html("");
           $("#total<?=$parking_id; ?>").html("Cannot Add A Value");
            $("#select<?=$parking_id;?>").prop('disabled', false).attr('class', 'btn btn-primary').html('Select this space');
        }else{
           $("#slot_status<?=$parking_id; ?>").html("This Parking is Fully Packed and Can Not Hold More Request").css("color", "red");
           $("#select<?=$parking_id;?>").prop('disabled', true).attr('class', 'btn btn-danger').html('Disabled...');
        }
            total = cost * hours ;
            $("#total<?=$parking_id; ?>").html(total);

  });

$("#select<?=$parking_id; ?>").click(function(){
  var slot_id1 = "<?=$parking_id; ?>";
  var slot_hours1 = $("#hour<?=$parking_id; ?>").val();
  var slots_cost1 = $("#total<?=$parking_id; ?>").html()  ;
    
        if(slot_hours1==''){
             $("#slot_status<?=$parking_id; ?>").html("Fill in input fields first").css("color", "red");
        }else{
          if(slots_cost1 > 0){
          $.post("parkings/book.php",{ slots_cost:slots_cost1, slot_hours:slot_hours1, slot_id:slot_id1}, function(data){
             $("#slot_status<?=$parking_id; ?>").html(data);
          })
          }else{
            alert("Invalid Price Value, INput the correct value for hours and slot");
          }          
        }

})





});


</script>
<?php


}
}

 ?>
