<?php
error_reporting(0);
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_POST["search_word"])) {
	$jip=$_POST["place_val"];
$query ="SELECT * FROM hotel WHERE hotel_name like '" . $_POST["search_word"] . "%' and place = '".$jip."' ";
$result = $db_handle->runQuery($query);
if(!empty($result)) {
?>
<ul  class="list-group" id="dtaval-list">
<?php
foreach($result as $dtaval) {
?>
<li class="list-group-item"  onClick="select_place('<?php echo $dtaval["hotel_name"] . $dtaval["hotel_id"]; ?>');"><?php echo $dtaval["hotel_name"]; ?>

</li>
<?php } ?>
</ul>
<?php } 
else
{
?>
<ul  class="list-group" id="dtaval-list">

<li class="list-group-item" onClick="select_place('')">No result found</li>

</ul>
<?php
}
} ?>