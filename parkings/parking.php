<!--Parking spaces to display here-->
<?php
require '../update_slots.php';
$query_parkings = "SELECT * FROM `parkings`";
$parkings_result = mysqli_query($con, $query_parkings);

while ($parking = mysqli_fetch_array($parkings_result)) {
  $parking_id = $parking['id'];
  $parking_location = $parking['location'];
  $parking_street = $parking['street'];
  $parking_name = $parking['name'];
  $parking_slot = $parking['slot'];
  $parking_price = $parking['price'];
?>
<div class="panel panel-default parking_text">
  <div class="panel-body">
    <h4 class="Head"><?=$parking_name; ?></h4>
    <hr>
    <ul class="list-group">
      <li class="list-group-item"><span class="glyphicon glyphicon-home"></span> <?=$parking_name; ?></li>
      <li class="list-group-item"><span class="glyphicon glyphicon-map-marker"></span> <?=$parking_location; ?></li>
      <li class="list-group-item"><span class="glyphicon glyphicon-map-marker"></span> <?=$parking_street; ?></li>
      <li class="list-group-item"><span class="glyphicon glyphicon-tags"></span> <?=$parking_slot; ?></li>
    </ul>
    <button class="btn btn-default" type="button" data-toggle="modal" data-target="#reserve<?=$parking_id ; ?>">select Now!!</button>

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
          <li class="list-group-item"><span class="glyphicon glyphicon-tags"></span> <?=$parking_slot; ?> total slots </li>
          <li class="list-group-item"><span class="glyphicon glyphicon-tag"></span> <?=$parking_slot; ?> Remaining Slots</li>
          <li class="list-group-item"><span class="glyphicon glyphicon-credit-card"></span> Ksh. <?=$parking_price; ?> Per Slot Per Hour</li>
          <li class="list-group-item total"  ><div id="total<?=$parking_id; ?>"> Ksh.<?=$parking_slot; ?> Total cost</div></li>

          <li class="list-group-item">
            <div class="input-group">
              <input type="text" class="form-control"  id="hour<?=$parking_id; ?>" placeholder="Number of Hours" aria-describedby="basic-addon2">
              <span class="input-group-addon" id="basic-addon2">Hours</span>
            </div>
          </li>


        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Select this space</button>
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
           $("#status1<?=$parking_id; ?>").html("");

            $("#select<?=$parking_id;?>").prop('disabled', false).attr('class', 'btn btn-primary').html('Select this space');
        }else{
           $("#status1<?=$parking_id; ?>").html("This Parking is Fully Packed and Can Not Hold More Request").css("color", "red");
           $("#select<?=$parking_id;?>").prop('disabled', true).attr('class', 'btn btn-danger').html('Disabled...');
        }

            total = cost * hours * slot;
            $("#total<?=$parking_id; ?>").html("KSH. "+total+" TOTAL COST");

  });





  function filter_park(){
    var city1 = $("#city").val();
    var street1 = $("#street").val();


  }

});


</script>
<?php


}

 ?>
