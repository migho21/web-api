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
$id_aduan 	= (isset($_REQUEST['id_aduan'])) ? trim($_REQUEST['id_aduan']) : '';	

$status 	= (isset($_POST['status'])) ? trim($_POST['status']) : '';	

$success = "";


if($act == "edit")
{	
	$SQL_update = " UPDATE `aduan` SET 
						`status` = '$status'
					WHERE `id_aduan` =  '$id_aduan'";	
										
	$result = mysqli_query($con, $SQL_update) or die("Error in query: ".$SQL_update."<br />".mysqli_error($con));
	
	
	$success = "Berjaya Kemaskini";
	//print "<script>alert('Kemaskini Berjaya'); self.location='a-aduan.php';</script>";
}

if($act == "del")
{
	$SQL_delete = " DELETE FROM `aduan` WHERE `id_aduan` =  '$id_aduan' ";
	$result = mysqli_query($con, $SQL_delete);
	
	$success = "Berjaya Hapus";
	//print "<script>self.location='a-aduan.php';</script>";
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
if($success) { Notify("success", $success, "a-complaint.php"); }
?>	

<div class="bgimg-1" >

	<div class="w3-padding-32"></div>
	
	<div class=" w3-center w3-text-blank w3-padding-32">
		<span class="w3-xlarge"><b>Complaints List</b></span><br>
	</div>


	<!-- Page Container -->
	<div class="w3-container w3-content" style="max-width:1400px;">    
	  <!-- The Grid -->
	  <div class="w3-row w3-white w3-card w3-padding">

		<div class="w3-row w3-margin ">
		<div class="table-responsive">
		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>#</th>
					<th>Pengadu </th>
					<th>Tarikh </th>
					<th>No Aduan</th>
					<th>Aduan</th>
					<th>Lampiran</th>
					<th>Status</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<?PHP
			$bil = 0;
			$SQL_list = "SELECT * FROM `aduan`,`user` WHERE aduan.id_user = user.id_user ";
			$result = mysqli_query($con, $SQL_list) ;
			while ( $data	= mysqli_fetch_array($result) )
			{
				$bil++;
				$lampiran	= $data["lampiran"];
				$status		= $data["status"];
			?>			
			<tr>
				<td><?PHP echo $bil ;?></td>
				<td><?PHP echo $data["name"] ;?></td>
				<td><?PHP echo $data["tarikh"] ;?></td>
				<td><?PHP echo $data["no_aduan"] ;?></td>
				<td><?PHP echo $data["aduan"] ;?></td>	
				<td>
				<?PHP if($lampiran) { ?>
				<a class="w3-text-blue" target="_blank" href="lampiran/<?PHP echo $lampiran;?>"><i class="fa fa-fw fa-file-pdf-o fa-lg"></i><a>
				<?PHP } ?>
				</td>
				<td><?PHP echo $status ;?></td>
				<td>
				<a href="#" onclick="document.getElementById('idEdit<?PHP echo $bil;?>').style.display='block'" class=""><i class="fa fa-fw fa-pencil-square-o fa-lg"></i></a>
				
				<a title="Delete" onclick="return confirm('Are you sure ?');" href="?act=del&id_aduan=<?PHP echo $data["id_aduan"]; ?>" class="w3-text-red"><i class="fa fa-fw fa-trash fa-lg"></i></a>
				</td>
			</tr>
			
<div id="idEdit<?PHP echo $bil; ?>" class="w3-modal" style="z-index:10;">
	<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:500px">
      <header class="w3-container "> 
        <span onclick="document.getElementById('idEdit<?PHP echo $bil; ?>').style.display='none'" 
        class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
      </header>

		<div class="w3-container w3-padding">
		
		<form action="" method="post" enctype = "multipart/form-data" >
			<div class="w3-padding"></div>
			<b class="w3-large">Update Status</b>
			<hr>
			  
			  <div class="w3-section " >
				<label>Status *</label>
				<select class="w3-select w3-border w3-round w3-padding" name="status" value="<?PHP echo $status; ?>" required>
					<option value="Pending" <?PHP if($status == "Pending") echo "selected";?>>Pending</option>
					<option value="Progress" <?PHP if($status == "Progress") echo "selected";?>>Progress</option>
					<option value="Close" <?PHP if($status == "Close") echo "selected";?>>Close</option>
				</select>
			  </div>


			<hr class="w3-clear">
			<input type="hidden" name="id_aduan" value="<?PHP echo $data["id_aduan"];?>" >
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
	
	<div class="w3-padding-64"></div>
	
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
