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
$act 		= (isset($_REQUEST['act'])) ? trim($_REQUEST['act']) : '';	
$id_category = (isset($_REQUEST['id_category'])) ? trim($_REQUEST['id_category']) : '';	

$category 		= (isset($_POST['category'])) ? trim($_POST['category']) : '';	

$success = "";

if($act == "add")
{	
	$SQL_insert = " INSERT INTO `category`(`category`) VALUES ('$category')";	
										
	$result = mysqli_query($con, $SQL_insert);
	
	$success = "Berjaya Daftar";
	
	//print "<script>self.location='a-main.php';</script>";
}


if($act == "edit")
{	
	$SQL_update = " UPDATE `category` SET 
						`category` = '$category'
					WHERE `id_category` =  '$id_category'";	
										
	$result = mysqli_query($con, $SQL_update) or die("Error in query: ".$SQL_update."<br />".mysqli_error($con));
	
	
	$success = "Berjaya Kemaskini";
	//print "<script>alert('Kemaskini Berjaya'); self.location='a-category.php';</script>";
}

if($act == "del")
{
	$SQL_delete = " DELETE FROM `category` WHERE `id_category` =  '$id_category' ";
	$result = mysqli_query($con, $SQL_delete);
	
	$success = "Berjaya Hapus";
	//print "<script>self.location='a-category.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<title>Shamelin Bestari</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link href="css/table.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />

<style>
a { text-decoration : none ;}

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
}

.w3-bar .w3-button {
  padding: 16px;
}
</style>

<body>

<?PHP include("menu-admin.php"); ?>

<!--- Toast Notification -->
<?PHP 
if($success) { Notify("success", $success, "a-category.php"); }
?>	

<div class="bgimg-1" >

	<div class="w3-padding-32"></div>
	
	<div class=" w3-center w3-text-blank w3-padding-32">
		<span class="w3-xlarge"><b>Category List</b></span><br>
	</div>


	<!-- Page Container -->
	<div class="w3-container w3-content" style="max-width:800px;">    
	  <!-- The Grid -->
	  <div class="w3-row w3-white w3-card w3-padding">

		<a onclick="document.getElementById('add01').style.display='block'; " class=" w3-right w3-button w3-blue w3-margin-bottom w3-round "><i class="fa fa-fw fa-lg fa-plus"></i> Add</a>
		
		<div class="w3-row w3-margin ">
		<div class="table-responsive">
		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>#</th>
					<th>Category</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<?PHP
			$bil = 0;
			$SQL_list = "SELECT * FROM `category` ";
			$result = mysqli_query($con, $SQL_list) ;
			while ( $data	= mysqli_fetch_array($result) )
			{
				$bil++;
			?>			
			<tr>
				<td><?PHP echo $bil ;?></td>
				<td><?PHP echo $data["category"] ;?></td>
				<td>
				<a href="#" onclick="document.getElementById('idEdit<?PHP echo $bil;?>').style.display='block'" class=""><i class="fa fa-fw fa-pencil-square-o fa-lg"></i></a>
				
				<a title="Delete" onclick="return confirm('Are you sure ?');" href="?act=del&id_category=<?PHP echo $data["id_category"]; ?>" class=" w3-text-red"><i class="fa fa-fw fa-trash fa-lg"></i></a>
				</td>
			</tr>
			
<div id="idEdit<?PHP echo $bil; ?>" class="w3-modal" style="z-index:10;">
	<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:500px">
      <header class="w3-container "> 
        <span onclick="document.getElementById('idEdit<?PHP echo $bil; ?>').style.display='none'" 
        class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
      </header>

		<div class="w3-container w3-padding">
		
		<form action="" method="post" >
			<div class="w3-padding"></div>
			<b class="w3-large">Update</b>
			<hr>
			  <div class="w3-section " >
				<label>Category *</label>
				<input class="w3-input w3-border w3-round" type="text" name="category" value="<?PHP echo $data["category"]; ?>" required>
			  </div>
			  
			<hr class="w3-clear">
			<input type="hidden" name="id_category" value="<?PHP echo $data["id_category"];?>" >
			<input type="hidden" name="act" value="edit" >
			<button type="submit" class="w3-button w3-wide w3-blue w3-text-white w3-margin-bottom w3-round">SAVE CHANGES</button>

		</form>
		</div>
	</div>
</div>				
			<?PHP } ?>
			</tbody>
		</table>
		</div>
		</div>

		
	  <!-- End Grid -->
	  </div>
	  
	<!-- End Page Container -->
	</div>
	
	<div class="w3-padding-24"></div>
	
</div>

<div id="add01" class="w3-modal" >
    <div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:500px">
      <header class="w3-container "> 
        <span onclick="document.getElementById('add01').style.display='none'" 
        class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
      </header>
	  
      <div class="w3-container w3-padding">
		
		<form action="" method="post">
			<div class="w3-padding"></div>
			<b class="w3-large">Add Category</b>
			<hr>
			  <div class="w3-section " >
				<label>Category *</label>
				<input class="w3-input w3-border w3-round" type="text" name="category" value="" required>
			  </div>
			  
			  <hr class="w3-clear">
			  
			  <div class="w3-section" >
				<input name="act" type="hidden" value="add">
				<button type="submit" class="w3-button w3-wide w3-blue w3-text-white w3-margin-bottom w3-round">SUBMIT</button>
			  </div>
			</div>  
		</form> 
         
      </div>

</div>

<?PHP include("footer.php"); ?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<!--<script src="assets/demo/datatables-demo.js"></script>-->

<script>
$(document).ready(function() {

  
	$('#dataTable').DataTable( {
		paging: true,
		
		searching: true
	} );
		
	
});
</script>

 
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
