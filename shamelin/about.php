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
  line-height: 1.5;
}

/* Full height image header */
.bgimg-1 {
  background-position: top;
  background-size: cover;
  min-height: 100%;
  background-image: url(images/banner.jpg);
}

.w3-bar .w3-button {
  padding: 16px;
}

img[alt="www.000webhost.com"]{display:none}
</style>

<body>

<?PHP include("menu.php"); ?>


<div class="bgimg-1" >

	<div class="w3-padding-24"></div>
		
	<div class=" w3-center w3-text-white w3-padding-24">
		<span class="w3-xlarge">About</span><br>
	</div>


<div class="w3-container w3-padding-16" id="contact">
    <div class="w3-content w3-container w3-white w3-round w3-card" style="max-width:600px">
		<div class="w3-padding">
			<p>Shamelin Bestari (juga dikenali sebagai Shamelin Bistari) ialah sebuah kondominium pegangan bebas yang terletak di Taman Shamelin Perkasa, Taman Maluri. Binaan yang terdapat pada kondominium ini ialah 1,001 sf hingga 1,050 sf. Perkembangan jiran lain yang berdekatan adalah Arena Shamelin, Astaka Heights, Bukit Pandan 2, Bustan Shamelin, Parc 3, Perdana Villa, Sky Vista Residensi, The Sky Residence, Vila Tropika dan Vista Perdana.</p>
<p>Kondominium ini mempunyai beberapa kemudahan berdekatan, seperti, universiti dan sekolah. Berikut adalah beberapa universiti utama di sini:

Malaysian Hospitality College,
Meridian Saito College (Msc),
Universiti Kuala Lumpur Malaysia Italy Design Institute (UniKL Midi),
Universiti Poly Tech Malaysia,
Wawasan Open University,
Ypc International College</p>  
		</div>
    </div>
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
