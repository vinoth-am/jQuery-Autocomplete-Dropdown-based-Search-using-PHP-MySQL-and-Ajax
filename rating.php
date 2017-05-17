<?php
error_reporting(0);
require_once("dbcontroller.php");
$db_handle = new DBController();
$name=$_POST['name'];
$email=$_POST['email'];
$rating=$_POST['rating'];
$comment=$_POST['comment'];
$hotel_id=$_POST['hotel_id'];
$query ="insert into review(name,email,comment, rating,hotel_id) values ('$name', '$email', '$comment','$rating', '$hotel_id')";
$result = $db_handle->runQuery($query);
echo"	<span id='reslt' class='label label-success'>Rating and review successfully submitted</span>";
?>