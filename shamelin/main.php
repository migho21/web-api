<?PHP
session_start();

include("database.php");
if( !verifyUser($con) ) 
{
	header( "Location: index.php" );
	return false;
}
?>
<?PHP
$act 		= (isset($_REQUEST['act'])) ? trim($_REQUEST['act']) : '';	
$id_user = (isset($_REQUEST['id_user'])) ? trim($_REQUEST['id_user']) : '';	

$name 		= (isset($_POST['name'])) ? trim($_POST['name']) : '';	
$username 	= (isset($_POST['username'])) ? trim($_POST['username']) : '';
$password 	= (isset($_POST['password'])) ? trim($_POST['password']) : '';
$email 		= (isset($_POST['email'])) ? trim($_POST['email']) : '';

$success = "";

if($act == "edit")
{	
	$SQL_update = " UPDATE `user` SET 
						`name` = '$name',
						`username` = '$username',
						`email` = '$email',
						`password` = '$password'
					WHERE `id_user` =  '$id_user'";	
										
	$result = mysqli_query($con, $SQL_update) or die("Error in query: ".$SQL_update."<br />".mysqli_error($con));
	
	$success = "Berjaya Kemaskini";
}


$SQL_view 	= " SELECT * FROM `user` WHERE `username` =  '". $_SESSION["username"] ."'";
$result 	= mysqli_query($con, $SQL_view);
$data		= mysqli_fetch_array($result);
$name 		= $data["name"];
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
  background-image: url(images/bg.jpg);
}

.w3-bar .w3-button {
  padding: 16px;
}
</style>

<body>

<?PHP include("menu-user.php"); ?>

<!--- Toast Notification -->
<?PHP 
if($success) { Notify("success", $success, "main.php"); }
?>	

<div class="bgimg-1" >

	<div class="w3-padding-64"></div>


	<!-- Page Container -->
	<div class="w3-container w3-content" style="max-width:800px;">    
	  <!-- The Grid -->
	  <div class="w3-row">
	  

		  <div class="w3-padding w3-padding-32">
			<div class="w3-card w3-padding w3-round w3-white">
				<div class="w3-dark-gray w3-xlarge w3-padding-24 w3-padding" >
					<div class="w3-padding">Welcome, <br><?PHP echo $name;?></div>
				</div>
				
				<div class="w3-row w3-padding-24 w3-large">
					<div class="w3-col m4 w3-container">
						<a onclick="document.getElementById('idEdit').style.display='block'; " class="w3-padding-32 w3-block w3-button w3-blue w3-margin-bottom w3-round ">
						<i class="fa fa-fw fa-4x fa-user"></i> 
						<br>
						My Profile</a>
					</div>
					
					<div class="w3-col m4 w3-container">
						<a  href="complaint-add.php" class="w3-padding-32 w3-block w3-button w3-blue w3-margin-bottom w3-round "><i class="fa fa-fw fa-4x fa-comments"></i> 
						<br>
						Submit Complaint</a>
					</div>
					
					<div class="w3-col m4 w3-container">
						<a  href="complaint.php" class="w3-padding-32 w3-block w3-button w3-blue w3-margin-bottom w3-round "><i class="fa fa-fw fa-4x fa-list"></i> 
						<br>
						Complaint History</a>
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


<div id="idEdit" class="w3-modal" style="z-index:10;">
	<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:500px">
      <header class="w3-container "> 
        <span onclick="document.getElementById('idEdit').style.display='none'" 
        class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
      </header>

		<div class="w3-container w3-padding">
		
		<form action="" method="post">
			<div class="w3-padding">
			<b class="w3-large">Update Profile</b>
			<hr>
			  <div class="w3-section " >
				<label>Name *</label>
				<input class="w3-input w3-border w3-round" type="text" name="name" value="<?PHP echo $data["name"]; ?>" required>
			  </div>
			  
			  <div class="w3-section " >
				<label>Username *</label>
				<input class="w3-input w3-border w3-round" type="text" name="username" value="<?PHP echo $data["username"]; ?>" required>
			  </div>
			  
			  <div class="w3-section " >
				<label>Password  *</label>
				<input class="w3-input w3-border w3-round" type="password" name="password" value="<?PHP echo $data["password"]; ?>" required>
			  </div>
			  
			  <div class="w3-section " >
				<label>Email *</label>
				<input class="w3-input w3-border w3-round" type="text" name="email" value="<?PHP echo $data["email"]; ?>" required>
			  </div>
			    

			<hr class="w3-clear">
			<input type="hidden" name="id_user" value="<?PHP echo $data["id_user"];?>" >
			<input type="hidden" name="act" value="edit" >
			<button type="submit" class="w3-button w3-wide w3-blue w3-text-white w3-margin-bottom w3-round">SAVE CHANGES</button>

		</form>
		</div>
	</div>
</div>
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
