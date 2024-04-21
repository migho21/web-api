<?PHP
session_start();

include("database.php");
if( !verifyAdmin($con) ) 
{
	header( "Location: index.php" );
	return false;
}
?>
<?PHP	
$SQL_view 	= " SELECT * FROM `admin` WHERE `username` =  '". $_SESSION["username"] ."'";
$result 	= mysqli_query($con, $SQL_view);
$data		= mysqli_fetch_array($result);

$tot_user 		= numRows($con, "SELECT * FROM `user`");
$tot_complaint 	= numRows($con, "SELECT * FROM `aduan`");
$tot_pending 	= numRows($con, "SELECT * FROM `aduan` WHERE `status` = 'Pending' ");
$tot_close		= numRows($con, "SELECT * FROM `aduan` WHERE `status` = 'Close' ");
?>
<!DOCTYPE html>
<html>
<title>Shamelin Bestari</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}

body, html {
  height: 100%;
  line-height: 1.8;
}

/* Full height image header */
.bgimg-1 {
  background-position: top;
  background-size: cover;
  min-height: 100%;
  background-image: url(images/bg-red.jpg);
}

.w3-bar .w3-button {
  padding: 16px;
}
</style>

<body>

<?PHP include("menu-admin.php"); ?>


<div class="bgimg-1" >

	<div class="w3-padding-32"></div>
	
	<div class=" w3-center w3-text-blank w3-padding-32">
		<span class="w3-xlarge"><b>Welcome Admin</b></span><br>
	</div>


	<!-- Page Container -->
	<div class="w3-container w3-content" style="max-width:1200px;">    
	  <!-- The Grid -->
	  <div class="w3-row">
	  

		  <div class="w3-padding w3-padding-16">
			<div class="w3-card w3-padding w3-round w3-white">
				<div class="w3-dark-gray w3-xlarge w3-padding-24 w3-padding" >
					<div class="w3-padding">Welcome, Admin</div>
				</div>
				
				<div class="w3-row w3-padding-24">
					<div class="w3-col m3 w3-container">
						<div class=" w3-card w3-round w3-padding-16">
							<div class="w3-container w3-large">
								Users <i class="fa fa-users fa-lg w3-right"></i> 
								<hr style="border-top: 1px dashed; margin: 1px 0 15px !important;">
								<h2 class="w3-center"><?PHP echo $tot_user;?></h2>
							</div>
						</div>
					</div>
					
					<div class="w3-col m3 w3-container">
						<div class="w3-border w3-card w3-round w3-padding-16">
							<div class="w3-container w3-large">
								Complaint <i class="fa fa-comments fa-lg w3-right"></i> 
								<hr style="border-top: 1px dashed; margin: 1px 0 15px !important;">
								<h2 class="w3-center"><?PHP echo $tot_complaint;?></h2>
							</div>
						</div>
					</div>
					
					<div class="w3-col m3 w3-container">
						<div class="w3-yellow w3-card w3-round w3-padding-16">
							<div class="w3-container w3-large">
								Pending <i class="fa fa-hourglass fa-lg w3-right"></i> 
								<hr style="border-top: 1px dashed; margin: 1px 0 15px !important;">
								<h2 class="w3-center"><?PHP echo $tot_pending;?></h2>
							</div>
						</div>
					</div>
					
					<div class="w3-col m3 w3-container">
						<div class="w3-green w3-card w3-round w3-padding-16">
							<div class="w3-container w3-large">
								Close <i class="fa fa-check-square fa-lg w3-right"></i> 
								<hr style="border-top: 1px dashed; margin: 1px 0 15px !important;">
								<h2 class="w3-center"><?PHP echo $tot_close;?></h2>
							</div>
						</div>
					</div>
					

			</div>
		  </div>
		</div>
			  

		
	  <!-- End Grid -->
	  </div>
	  
	<!-- End Page Container -->
	</div>
	
	<div class="w3-padding-24"></div>
	
</div>

<?PHP include("footer.php"); ?>
 
<script>

// Toggle between showing and hiding the sidebar when clicking the menu icon
var mySidebar = document.getElementById("mySidebar");

function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
  } else {
    mySidebar.style.display = 'block';
  }
}

// Close the sidebar with the close button
function w3_close() {
    mySidebar.style.display = "none";
}
</script>

</body>
</html>
