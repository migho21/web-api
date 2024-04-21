<?PHP
	/*	-----------------------------
		Developed by : BelajarPHP.com
		Date : 21 Mar 2023
		-----------------------------	*/
	//https://shamelin.000webhostapp.com/
	date_default_timezone_set('Asia/Kuala_Lumpur');
	
	if($_SERVER['HTTP_HOST']=="localhost" or $_SERVER['HTTP_HOST']=="192.168.0.171")
	{	
		//localhost
		$dbHost = "localhost";	// Database host
		$dbName = "shamelin";		// Database name
		$dbUser = "root";		// Database user
		$dbPass = "";			// Database password
	}
	else
	{
		//local live @ hosting
		$dbHost = "localhost";			// Database host
		$dbName = "id20484205_shamelin";		// Database name
		$dbUser = "id20484205_root";		// Database user
		$dbPass = "IhdJgzS3/W+NJM@}";		// Database password
	}
	
	$con = mysqli_connect($dbHost,$dbUser ,$dbPass,$dbName);
	
	
	function verifyAdmin($con)
	{
		if ($_SESSION['username'] && $_SESSION['password'] ) 
		{
		  $result=mysqli_query($con,"SELECT  `username`, `password` FROM `admin` WHERE `username`='$_SESSION[username]' AND `password`='$_SESSION[password]' " ) ;

          if( mysqli_num_rows( $result ) == 1 ) 
	  	  return true;
		}
		return false;
	}
	
	function verifyUser($con)
	{
		if ($_SESSION['username'] && $_SESSION['username'] ) 
		{
		  $result=mysqli_query($con,"SELECT  `username`, `password` FROM `user` WHERE `username`='$_SESSION[username]' AND `password`='$_SESSION[password]' " ) ;

          if( mysqli_num_rows( $result ) == 1 ) 
	  	  return true;
		}
		return false;
	}

	function numRows($con, $query) {
        $result  = mysqli_query($con, $query);
        $rowcount = mysqli_num_rows($result);
        return $rowcount;
    }
	
	function Notify($status, $alert, $redirect)
	{
		$color = ($status == "success") ? "w3-green" : "w3-blue";

		echo '<div class="'.$color.' w3-top w3-card w3-padding-24" style="z-index=999">
			<span onclick="this.parentElement.style.display=\'none\'" class="w3-button w3-large w3-display-topright">&times;</span>
				<div class="w3-padding w3-center">
				<div class="w3-large">'.$alert.'</div>
				</div>
			</div>';
		//header( "refresh:1;url=$redirect" );
		print "<script>self.location='$redirect';</script>";
	}
	
?>