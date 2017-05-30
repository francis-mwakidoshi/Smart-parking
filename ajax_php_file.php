<?php
require 'mysqlConnect.php';

if(isset($_FILES["file"]["type"]))
{
$validextensions = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
$temporary = explode(".", $_FILES["file"]["name"]);
$file_extension = end($temporary);
if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/JPG") || ($_FILES["file"]["type"] == "image/jpeg")
) && ($_FILES["file"]["size"] < 1000000)//Approx. 100000=100kb files can be uploaded.
&& in_array($file_extension, $validextensions)) {
if ($_FILES["file"]["error"] > 0)
{
echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
}
else
{
if (file_exists("images/" . $_FILES["file"]["name"])) {
echo "<div class='alert alert-danger'>
        <button class='close' data-dismiss='alert'>&times;</button>
        <strong>Sorry!</strong>".$_FILES["file"]["name"] ." already exists
         </div>";
}
else
{
$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
$targetPath = "images/".$_FILES['file']['name']; // Target path where file is to be stored

$fileName='images/'.$_FILES["file"]["name"];
$SQL = $con->prepare("INSERT INTO image(image,details) VALUES(?,?)");
  $SQL->bind_param('ss',$fileName,$_POST['details']);
  $SQL->execute();

  if(!$SQL)
  {
   echo $MySQLiconn->error;
  }

move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file

echo "<div class='alert alert-success'>
        <button class='close' data-dismiss='alert'>&times;</button>
        <strong>Success!</strong>.
        <br/><b>File Name:</b> " . $_FILES["file"]["name"] . "<br>
        <b>Type:</b> " . $_FILES["file"]["type"] . "<br>
        <b>Size:</b> " . ($_FILES["file"]["size"] / 1024) . " kB<br>
        <b>Temp file:</b> " . $_FILES["file"]["tmp_name"] . "<br>
         </div>";
}
}
}
else
{
echo "<div class='alert alert-danger'>
        <button class='close' data-dismiss='alert'>&times;</button>
        <strong>Sorry!</strong>Invalid file Size or Type
         </div>";
}
}
?>
