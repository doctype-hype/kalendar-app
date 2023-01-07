<?php 
	include('server.php');
	
	if (!isset($_SESSION['korisnicko'])) {
  	$_SESSION['msg'] = "Ulogujte se da pristupite stranici";
  	header('location: login.php');
  }

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['korisnicko']);
		header('location: login.php');
	}
?>

