<?php
error_reporting(0);
require_once("dbcontroller.php");
$db_handle = new DBController();

$query ="SELECT DISTINCT place FROM hotel ORDER BY place ASC";
$result = $db_handle->runQuery($query);
?>

<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"></link>
<style>
li:hover {
background-color: #c6cace;
}

.der{
background-image: url('img/front4.jpg'); 
}
</style>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="js/bootstrap.js"></script>
<script>
$(document).ready(function(){
	
	$("#search-box").keyup(function(){
		$.ajax({
		type: "POST",
		url: "gethotel.php",
		data:'search_word='+$(this).val() +'&place_val='+$("#place_select option:selected").val() ,
		
		beforeSend: function(){
			$("#search-box").css("background","#FFF url(img/loader.gif) no-repeat 400px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
	});
});

function select_place(val) {
$("#search-box").val(val.replace(/[0-9]/g, ''));
$("#picoutput").val(val);
$("#suggesstion-box").hide();
}

 function optionCheck() {
$("#search-box").val("");
 }
</script>

</head>
<body>
<div class="container-fluid">


  
<div class="der">

	<br><br><br><br><br>
	<img src="img/logo.jpg"  class="img-rounded center-block" alt="Cinque Terre" width="120" height="120" > 
	<br><br>
		<h1 style="color:white; text-align:center;">Find the best restaurants in your city </h1>
		<br><br>


<div class="row">
<div class="col-lg-2"></div>
<div class="col-lg-4" >
    
	<div class="form-group"  >
	<div class="col-xs-10">
	<form method="POST" action="prcs_data.php">
	  <select name="sbox1" class="form-control input-lg  " id="place_select" onchange="optionCheck();" required>
		<option value="">Select your city</option>
		<?php
		foreach($result as $hotl) {
		?>
		<option value="<?php echo $hotl["place"]; ?>"><?php echo $hotl["place"]; ?></option>
		<?php
		}
		?>
	</select>
	</div>
</div>
</div>
	<div class="col-lg-6">
	 <div class="col-xs-10">
		<div class="input-group">
			<input type="text" id="search-box"  class="form-control input-lg"  placeholder="Search the hotel here" autocomplete="off" required/>
			<div class="input-group-btn">
				<button class="btn btn-default btn-lg" type="submit">Go!</button>
			</div>
			</div>
		<input type="hidden" id ="picoutput" name="sbox">
		<div id="suggesstion-box"></div>
<br><br><br><br><br><br><br><br><br>
	</form>
	</div>
	</div>
</div>
	</div>
	
	
	
	</div>
	
	
	<div class="container  bg-grey">
  <h2>Suggestion</h2>
  <h4>We suggest hotels for you</h4>
  <div class="row text-center">
<?php
    $query_rand ="SELECT * FROM hotel ORDER BY RAND() LIMIT 4";
	$result_rand = $db_handle->runQuery($query_rand);
	foreach($result_rand as $rand_hotel)
	{
?>


    <div class="col-sm-3">
      <div class="thumbnail">
        <img  src="img/ima/<?php echo $rand_hotel['image']; ?>"  class="img-rounded " >
		<form id="addpf"  method="POST" action="prcs_data.php">
        <p><b><?php echo $rand_hotel["hotel_name"]; ?></b></p>
        <p><?php echo $rand_hotel["place"]; ?></p>
		<input type="hidden" name="sbox" value='<?php echo $rand_hotel["hotel_id"]; ?>'>
		<div class="btn-group btn-group-xs">
		<input type="submit" class="btn btn-danger" value="Click here">
		</div>
		</form>

      </div>
    </div>
	<?php } ?>
    
   
</div>
</div>

<footer class="container-fluid text-center" style="border-style:groove;">
  <a href="index.php">Foodmato</a>
</footer>

	
	

</body>
</html>