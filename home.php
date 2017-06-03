<?php
session_start();
require 'mysqlConnect.php';
if (!$_SESSION['email']) {
  header("location: index.php");
}
else {

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Smart Parking Web Portal</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <style>
        body {
          font-family: "Open Sans Condensed", sans-serif;
          background: url(assets/img/1.jpg) no-repeat center center fixed;
          background-size: cover;
        }

        .top {
          width: 90%;
          margin: 0px auto;
          color:#bbdefb !important;

        }
        .bg {
          background: rgba(130,130,130,.7);
          border-bottom: 1px solid #eeff41;
        }

        .box {
           background: rgba(130,130,130,.7);
          padding: 4% 10px 8%;
          color:#bbdefb ;
          border-radius: 20px;
        }

.area{
  margin-bottom: 15px;
}

.cart-nav ul li {
  margin:3%;
  padding: 3%;
  color: #0000 !important;
}

.Head {
  text-transform: uppercase;
   text-shadow: 2px 2px	#DEB887;
   color: 	#556B2F !important;
}

.parking_text {
  color: #2F4F4F !important;
  text-transform: uppercase;
}

.total {
  color: #FF0000 !important;
}
    </style>
</head>
<body>
<nav class="row bg">
<div class="top">
  <div class="col-md-4"><h1>Smart Parking </h1></div>
  <div class="col-md-4"></div>
  <div class="col-md-4">
    <div class="dropdown">
      <br><h4 class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        <span class="glyphicon glyphicon-user"></span><?php echo $_SESSION['email']; ?>
        <span class="caret"></span>
      </h4 >
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
              <li class="dropdown-header">User Action!!</li>
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>

    </div>

  </div>


  </div>
</nav>

<div class="row">
   <div class="container">
     <div class="box row">
         <div class="cart-nav col-xs-4">
           <ul>
             <li class="list-group-item">
               <select class="form-control">
                 <option>----[Search Cartegory 1]----</option>
                 <option>2</option>
                 <option>3</option>
                 <option>4</option>
                 <option>5</option>
               </select>
             </li>

             <li class="list-group-item">
               <select class="form-control">
                 <option>----[Search Cartegory 2]----</option>
                 <option>2</option>
                 <option>3</option>
                 <option>4</option>
                 <option>5</option>
               </select>
             </li>

             <li class="list-group-item">Notifications</li>
             <li class="list-group-item">Porta ac consectetur ac</li>
             <li class="list-group-item">Vestibulum at eros</li>
           </ul>
         </div>

         <div class="content col-xs-8">

<!--Parking spaces to display here-->
<?php
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
              <input type="text" class="form-control" id="slot<?=$parking_id ; ?>" placeholder="Number of slots" aria-describedby="basic-addon2">
              <span class="input-group-addon" id="basic-addon2">Slots</span>
            </div>
          </li>
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
        var slot = $('#slot<?=$parking_id; ?>').val();
        var hours = $('#hour<?=$parking_id; ?>').val();
        var total='';
        var cost = "<?=$parking_price; ?>";

        if (slot=='' || hours=='') {
             $("#total<?=$parking_id; ?>").html("FILL NUMBER OF SLOTS VALUES");
        }else{
            total = cost * hours * slot;
            $("#total<?=$parking_id; ?>").html("KSH. "+total+" TOTAL COST");
        }
  });



  $('#slot<?=$parking_id; ?>').keyup(function(){
        var slot = $('#slot<?=$parking_id; ?>').val();
        var hours = $('#hour<?=$parking_id; ?>').val();
        var total='';
        var cost = "<?=$parking_price; ?>";

        if (slot=='' || hours=='') {
             $("#total<?=$parking_id; ?>").html("FILL HOURS VALUES");
        }else{
            total = cost * hours * slot;
            $("#total<?=$parking_id; ?>").html("KSH. "+total+" TOTAL COST");
        }
  });

});


</script>
<?php


}

 ?>

         </div>
     </div>
   </div>
</div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>
<?php } ?>
