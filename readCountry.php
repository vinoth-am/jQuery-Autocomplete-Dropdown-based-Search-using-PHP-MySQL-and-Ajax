<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_POST["keyword"])) {
	$jip=$_POST["value2"];
$query ="SELECT * FROM country WHERE hotel like '" . $_POST["keyword"] . "%' and country_name = '".$jip."' ";
$result = $db_handle->runQuery($query);
if(!empty($result)) {
?>
<ul  class="list-group" id="country-list">
<?php
foreach($result as $country) {
?>
<li class="list-group-item" onClick="selectCountry('<?php echo $country["hotel"]; ?>');"><?php echo $country["hotel"]; ?></li>
<?php } ?>
</ul>
<?php } 
else
{
?>
<ul  class="list-group" id="country-list">

<li class="list-group-item" onClick="selectCountry('')">No result found</li>

</ul>
<?php
}
} ?>