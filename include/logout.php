<?php
	session_start();
	//destroy session
	if(session_destroy()){
		header("Location: ..\index.php");
	}
	//echo "<script>alert('Sucessfully Logged Out');</script>";
?>
