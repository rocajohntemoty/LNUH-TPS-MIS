<?php
	session_start();
	unset($_SESSION['bu_id']);
	session_destroy();
	
	header('location: index.php');
?>