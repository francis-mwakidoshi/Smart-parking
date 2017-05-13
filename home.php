<?php session_start();
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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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

        .searchbox {
           background: rgba(130,130,130,.7);
          padding: 4% 10px 8%;
          color:#bbdefb !important;
        }

.area{
  margin-bottom: 15px;
}

    </style>
</head>
<body>
<nav class="row bg">
<div class="top">
  <div class="col-md-4"><h1>Smart Parking </h1></div>
  <div class="col-md-4"></div>
  <div class="col-md-4"><br><h4><span class="glyphicon glyphicon-user"></span><?php echo $_SESSION['email']; ?></h4></div>
  </div>
</nav>

<div class="row">
   <div class="container">

   <div class="col-md-6 searchbox">
          <div class="page-header">
            <h1>Find A Parking Spot<br></h1>
            <small>Search for a parking spot near you</small>
          </div>
      <form >

    <div class="input-group area">
      <input type="text" class="form-control" placeholder="Find by Address, Neighborhood or Destination">
      <span class="input-group-btn">
        <button class="btn btn-danger" type="button">SEARCH NOW!</button>
      </span>
    </div><!-- /input-group -->

        <label class="radio-inline">
          <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">DAILY PARKING
        </label>
        <label class="radio-inline">
          <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> MONTHLY PARKING
        </label>
      </form>
   </div>

   <div class="col-md-6">.col-md-4</div>
   </div>
</div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="assets/js/jquery-1.8.3.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>
<?php } ?>
