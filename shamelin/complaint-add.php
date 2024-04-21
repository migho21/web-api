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
$act 		= (isset($_POST['act'])) ? trim($_POST['act']) : '';	
$id_category= (isset($_POST['id_category'])) ? trim($_POST['id_category']) : '';
$aduan= (isset($_POST['description'])) ? trim($_POST['description']) : '';

$aduan	=	mysqli_real_escape_string($con, $aduan);

$no_aduan 	= rand(1000,9000);

$SQL_view 	= " SELECT * FROM `user` WHERE `username` = '". $_SESSION["username"] ."'";
$result 	= mysqli_query($con, $SQL_view);
$data		= mysqli_fetch_array($result);
$name 		= $data["name"];
$email 		= $data["email"];

if($act == "add")
{	
	$SQL_insert = " INSERT INTO `aduan`(`id_user`, `tarikh`, `no_aduan`, `aduan`, `id_category`,  `status`) 
	VALUES ('".$_SESSION["id_user"]."', NOW(), '$no_aduan', '$aduan', '$id_category', 'Pending')";	
										
	$result = mysqli_query($con, $SQL_insert) or die("Error in query: ".$SQL_insert."<br />".mysqli_error($con));
	
	$id_aduan = mysqli_insert_id($con);
	
	// -------- Lampiran  -----------------
	if(isset($_FILES['lampiran'])){
		 
		if($_FILES["lampiran"]["error"] == 4) {
				//means there is no file uploaded
		} else {

			$file_name = $_FILES['lampiran']['name'];
			$file_size = $_FILES['lampiran']['size'];
			$file_tmp = $_FILES['lampiran']['tmp_name'];
			$file_type = $_FILES['lampiran']['type'];
			
			$fileNameCmps = explode(".", $file_name);
			$file_ext = strtolower(end($fileNameCmps));

			$extensions= array("pdf","doc","jpg","png");

			if(in_array($file_ext,$extensions)=== false){
				$errors="extension not allowed, please choose a PDF, DOC, JPG, PNG";
			}

			if($file_size > 12097152) {
				$errors='File size must be smaller than 12 MB';
			}

			if(empty($errors)==true) {
				move_uploaded_file($file_tmp,"lampiran/".$file_name);
				
				$query = "UPDATE `aduan` SET `lampiran`='$file_name' WHERE `id_aduan` = '$id_aduan'";			
				$result = mysqli_query($con, $query) or die("Error in query: ".$query."<br />".mysqli_error($con));
			}else{
				print_r($errors);
			}  
		}
	}
	// -------- End Lampiran -----------------
	
	
// -------- Hantar Email ke START --------------
	$name_admin	= "Admin";
	$email_admin = "noreply@u-ji.com ";

	$header ="";
	$header .= "Reply-To: $name <" . $email . ">\r\n"; 
	$header .= "Return-Path: $name <" . $email . ">\r\n";  
	$header .= "From: Support $name <" . $email . ">\r\n"; 
	$header .= "Organization: $name\r\n"; 
	$header .= "Content-Type: text/plain\r\n"; 

	$subject = "Aduan Baru";		
	$message = "
Unit anda telah menerima satu aduan baru yang dihantar oleh $name.
Sila login sistem untuk semak dan kemaskini status aduan tersebut dengan kadar segera.


-Mesej ini dihantar secara automatik oleh Sistem eAduan-
";
			
// hantar emel ke Admin

mail( $name_admin ." < " .$email_admin . " >", $subject, $message, "From: ". $name . " < " .$email. " >\r\nReply-To: ".$email."\r\nReturn-Path: ".$email."\r\n Content-Type: text/plain\r\n");
// -------- Hantar Email END --------------

// salinan pada pengadu


$message2 = "
Terima kasih

No Aduan anda adalah: $no_aduan

Sila simpan No Aduan ini. No ini diperlukan sebagai rujukan untuk membuat semakan status aduan.


-Mesej ini dihantar secara automatik oleh Sistem eAduan-
";

mail( $name ." < " .$email . " >", $subject, $message2, "From: ". $name_admin . " < " .$email_admin. " >\r\nReply-To: ".$email_admin."\r\nReturn-Path: ".$email_admin."\r\n Content-Type: text/plain\r\n");

// ----------------	
	
	print "<script>alert('Successfully Add'); self.location='main.php';</script>";
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

<style>
a {
  text-decoration: none;
}

body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}

body, html {
  height: 100%;
  line-height: 1.8;
}

/* Full height image header */
.bgimg-1 {
  background-position: top;
  background-size: cover;
  background-image: url("images/banner.jpg");
  min-height: 100%;
}

.w3-bar .w3-button {
  padding: 16px;
}
</style>

<body>

<?PHP include("menu-user.php"); ?>

<div class="bgimg-1x" >

	<div class="w3-padding-32"></div>
	
	<div class=" w3-center w3-text-blank w3-padding-32">
		<span class="w3-xlarge"><b>Borang Aduan</b></span><br>
	</div>
		
	
<div class="w3-container w3-padding" id="contact">
    <div class="w3-content w3-container w3-white w3-round w3-card" style="max-width:600px">
		<div class="w3-padding">
		
			<form method="post" action="" enctype = "multipart/form-data" >
				<h3>Borang Aduan</h3>

				Sebarang aduan, sila hantar borang aduan ini.
			
				<div class="w3-section" >
					<label>Kategori *</label>
					<select class="w3-select w3-border w3-round w3-padding" name="id_category" required>
						<option value="">- Sila pilih - </option>
					<?PHP 
					$rst = mysqli_query($con , "SELECT * FROM `category`");
					while ($dat = mysqli_fetch_array($rst) )
					{
					?>
						<option value="<?PHP echo $dat["id_category"];?>"><?PHP echo $dat["category"];?></option>
					<?PHP } ?>
					</select>
				</div>
				
				<div class="w3-section" >
					<label>Description </label>
					<textarea class="w3-input w3-border w3-round" rows="4" name="description"></textarea>
				</div>
				
				<div class="w3-section" >
					<label>Lampiran </label>
					<div class="custom-file">
						<input type="file" class="w3-input w3-border w3-round" name="lampiran" id="lampiran" accept=".pdf, .doc, .jpg,.png">
						<small>  only PDF, DOC, JPG or PNG allowed </small>
					</div>
				</div>
				
				<hr class="w3-clear">
				<input type="hidden" name="act" value="add" >
				<button type="submit" class="w3-button w3-wide w3-faculty w3-padding-large w3-blue w3-margin-bottom w3-round">SUBMIT</button>
				
				<div class="w3-right"><a href="main.php" class="w3-button w3-wide w3-padding-large w3-light-gray w3-round">BACK</a>

			</form>
		</div>
    </div>
</div>


<div class="w3-padding-64"></div>
	
</div>

	
<?PHP include("footer.php"); ?>


<script>

// Toggle between showing and hiding the sidebar when clicking the menu icon
var mySidebar = document.getElementById("mySidebar");

function w3_open() {
  if (mySidebar.style.display === 'faculty') {
    mySidebar.style.display = 'none';
  } else {
    mySidebar.style.display = 'faculty';
  }
}

// Close the sidebar with the close button
function w3_close() {
    mySidebar.style.display = "none";
}
</script>

</body>
</html>