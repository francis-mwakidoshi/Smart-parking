<?php
session_start();
require 'mysqlConnect.php';
require 'update_slots.php';
if (!$_SESSION['driver_email']) {
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

    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="datatable/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="datatable/keyTable.bootstrap.min.css" rel="stylesheet">
    
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

.top a {
  color: color:#bbdefb !important;
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
  <div class="col-md-4"><h1 ><a  href="home.php"><span class="glyphicon glyphicon-home"></span> Smart Parking </h1></a></div>
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
             <li class="list-group-item" >
               <select class="form-control" onchange="filter_park()" id="city">
                 <option value="">----[Search City]----</option>
                 <option value="Nairobi">Nairobi</option>
                 <option value="Kisumu">Kisumu</option>
                 <option value="Eldoret">Eldoret</option>
                 <option value="Mombasa">Mombasa</option>
               </select>
             </li>

             <li class="list-group-item">
               <select class="form-control" onchange="filter_park()" id="street">
                 <option value="">----[Search Street]----</option>
                 <option value="Tudor">Tudor</option>
                 <option value="Kizingo">Kizingo</option>
                 <option value="Mwembe Tayari">Mwembe Tayari</option>
                 <option value="Tononoka">Tononoka</option>
                 <option value="Poster">Poster</option>
                 <option value="Docks">Docks</option>
                 <option value="Moi Avenue">Moi Avenue</option>
               </select>
             </li>

             <li class="list-group-item" id="requests"><a><span class="glyphicon glyphicon-envelope"></span> Notifications</a></li>
           </ul>
         </div>

         <div class="content col-xs-8">
<div id = "home">

</div>

         </div>
     </div>
   </div>
</div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="jquery/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="datatable/dataTables.bootstrap.min.js"></script>
    <script src="datatable/dataTables.keyTable.min.js"></script>
    <script>
$("#home").load("parkings/parkings.php");

  function filter_park(){
    var city1 = $("#city").val();
    var street1 = $("#street").val();
 $.post("parkings/parkings.php", {city:city1, street:street1}, function(data){
    $("#home").html(data);
 })

  }

  $("#requests").click(function(){
    $("#home").load("feedback/requests.php");  
  });

  $("#receipt").click(function(){
    $("#home").load("receipt/new.php");  
  });

    </script>
  </body>
</html>
<?php } ?>
