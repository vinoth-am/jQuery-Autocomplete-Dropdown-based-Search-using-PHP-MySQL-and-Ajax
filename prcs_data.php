 <?php
 error_reporting(0);
require_once("dbcontroller.php");
$db_handle = new DBController();
 ?>
 <?php

$b=$_POST["sbox"];
preg_match_all('!\d+!', $b, $matches);
foreach ($matches as $value) {
  
}
$a=$value[0] ; 
?> 


<html>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"></link>
<style>
.row{
margin: 0px;
}
</style>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="js/bootstrap.js"></script>
<script type="text/javascript">
$(document).ready(function() {	
	
	
	$('#reg-form').submit(function(e){
		
		e.preventDefault();
		
		$.ajax({
			url: 'rating.php',
			type: 'POST',
			data: $(this).serialize() 
		})
		.done(function(data){
			//$("#myModal").html(data);
			$("#reslt").html(data).fadeIn();
			$("#reslt").fadeOut(10000);
			//alert(data);
			$("#name").val("");
			$("#comment").val("");
			$("#email").val("");
			$("#rating").val("0");
		})
		.fail(function(){
			alert('Ajax Submit Failed ...');	
		});
	});

	
});
</script>
<script>
      $(document).on('input', '#slider', function() {
      $('#slider_value').html( $(this).val() );
      });
</script>
<body>



<div class="container-fluid">
  
  <nav class="navbar navbar-inverse">
   
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">foodmato</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Home</a></li>
    </ul>
   
  </nav>
  
	  <div class="row">
		<div class="col-sm-8" >
		<?php
		$query ="SELECT * FROM hotel where hotel_id =  '".$a."' ";
		$result = $db_handle->runQuery($query);
		foreach($result as $searc) {
		?>
		 
		 <div class="panel panel-default">
		 <div class="panel-heading"><img  src="img/ima/<?php echo $searc['image']; ?>"  class=" img-responsive img-rounded"></div>
		 
		
		 <div class="panel-body">
		 <div class="row">
		 <div class="col-sm-10">
		 <h2><?php echo $searc['hotel_name']; ?></h2><br>
		 <h4><span class="glyphicon glyphicon-map-marker"></span> <?php echo $searc['location']; ?><h4>
		 <?php } ?>
		 </div>
		 <?php
		 $query ="SELECT AVG(rating)as rates FROM review where hotel_id =  '".$a."' ";
		 $result = $db_handle->runQuery($query);
		 foreach($result as $review) {
			
		 
		 ?>
		 <div class="col-sm-2"><button type="button" class="btn-lg btn-danger" disabled><?php echo number_format($review['rates'], 2); ?> / 5  </button></div>
		 <?php } ?>
		 </div>
		 </div>
		 
		 </div>
		
		 <div class="panel panel-default">
		 <div class="panel-heading">
		 
		 
		 <ul class="nav nav-pills">
		<li class="active"><a data-toggle="pill" href="#overview">Overview</a></li>
		<li><a data-toggle="pill" href="#menu1">Menu</a></li>
		<li><a data-toggle="pill" href="#rating">Rating</a></li>
		<li><a data-toggle="pill" href="#review">Review</a></li>
		</ul>
		 
		 
		 
		 </div>
		 <div class="panel-body">
		 
		<div class="tab-content">
			<div id="overview" class="tab-pane fade in active">
			<?php
			$query ="SELECT * FROM hotel where hotel_id =  '".$a."' ";
			$result = $db_handle->runQuery($query);
			foreach($result as $searchs) 
			{
			?>
		 
			<div class="row">
				<div class="col-sm-4">
				<h4> Phone number</h4>
				
				<h4 ><span style="color:green;" class="glyphicon glyphicon-ok"></span> <?php echo $searchs['phone_no']; ?></h4>
				
				</div>
				
				<div class="col-sm-4">
				<h4> Opening hours</h4>
				
				<h4><span style="color:green;" class="glyphicon glyphicon-ok"></span> <?php echo $searchs['open_hrs']; ?></h4>
				
				</div>
				<div class="col-sm-4">
				<h4> Highlights</h4>
				<h4> <span style="color:green;" class="glyphicon glyphicon-ok"></span> <?php echo $searchs['highlts']; ?></h4>
				</div>
			
			</div>
			
			<div class="row">
			
			<div class="col-sm-4">
			<h4> Cost</h4>
			<h4> <span style="color:green;" >&#8377;</span> <?php echo $searchs['cost']; ?> approx</h4>
			</div>
			
			<div class="col-sm-4">
			<h4>Address</h4>
			<h4> <span style="color:green;" ></span> <?php echo $searchs['location']; ?></h4>
			</div>
			
			<div class="col-sm-4">
			<h4>Map</h4>
	
			 <div id="map" style="height: 20%;"></div>
           <script>
          function initMap() {
          var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          
        });
        var geocoder = new google.maps.Geocoder();

          geocodeAddress(geocoder, map);
     
      }

      function geocodeAddress(geocoder, resultsMap) {
        var address = "<?php echo $searchs['location']; ?>";
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: resultsMap,
              position: results[0].geometry.location
            });
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBNojr4L28SemQKIeS9XFRuUwrEgX0BGQ&callback=initMap">
    </script>
			
			
			
	</div>
			
	</div>
			
			
			
	</div>
	<div id="menu1" class="tab-pane fade">
	<h3>Menu</h3>
	<img  src="img/menu/<?php echo $searc['menu']; ?>"  class=" img-responsive img-rounded">
			
	</div>
	 <?php } ?>
			 
			  
			
	<div id="rating" class="tab-pane fade">
			 
	 
			 		 
	<div id="form-content"><br>
	<span id="reslt" ></span>
	</br></br>

	<form method="POST" id="reg-form" autocomplete="off">
	<div class="form-group">
      <label for="name">Name:</label>
      <input type="name" class="form-control" name="name" id="name" placeholder="Enter Name" required>
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required>
    </div>
    
	<div class="form-group" style="width:15%;">
		<label for="rating">Rating out of 5:</label>	
		<input type="range" id="slider"  name="rating" value="1" min="1" max="5" step="0.50" />
		<b style="color:#d9534f;"><span id="slider_value"  >1</span> &#9733;</b>
    </div>
	<div class="form-group">
      <label for="comment">Review:</label>
      <textarea class="form-control" rows="5" name="comment" id="comment" required></textarea>
    </div>
	<div class="form-group">
    <input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo $a ; ?>">
    <button class="btn btn-primary">Submit</button>
	</div>
	<form>
	
			 
		</div>
			 
		</div>
		<div id="review" class="tab-pane fade">
		<h3>Review</h3>
		<?php
			
		 $query ="SELECT * FROM review where hotel_id= '".$a."'";
		 $result = $db_handle->runQuery($query);
		 foreach($result as $review) {
			
		 
		 ?>
			 
		 <div class="media">
			<div class="media-left">
			  <img src="img/avatar.png" class="media-object" style="width:60px">
			</div>
			<div class="media-body">
			  <h4 class="media-heading"><?php echo $review['name']; ?> - <small><i><?php echo $review['rating']; ?>/5 </i><span class="glyphicon glyphicon-star"></span></small></h4>
			  <p><?php echo $review['comment']; ?></p>
			</div>
		 </div><hr>
		 <?php } ?>
	
		 </div>
		 </div>	 
		  </div>
		 </div>		
		 </div>

                <div class="row text-center">
		<div class="col-sm-3" >
		<?php
		$query_rand ="SELECT * FROM hotel ORDER BY RAND() LIMIT 6";
		$result_rand = $db_handle->runQuery($query_rand);
		foreach($result_rand as $rand_hotel) {?>

		<div class="col-sm-12" >
		<div class="thumbnail">
		<img  src="img/ima/<?php echo $rand_hotel['image']; ?>"  class="img-rounded " >
		<p><?php echo $rand_hotel["hotel_name"]; ?></p>
		<p><?php echo $rand_hotel["place"]; ?></p>
		<form method="POST" action="prcs_data.php">
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
	</div>
	</div>

</div>
</div>
</div>
</div>

</body>

</html>			