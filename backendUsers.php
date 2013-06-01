<?php

	require('conn.php');
	
	if(isset($_POST['backendUser'])){
	
		$username					=	$_POST['username'];
		$fname						=	$_POST['fname'];
		$mname						=	$_POST['mname'];
		$lname						=	$_POST['lname'];
		$password					=	sha1($_POST['username']);
		
		$sql							=	"Insert into tbl_backendusers(bu_username,bu_password,bu_fname,bu_mname,bu_lname) values(?,?,?,?,?)";
		
		$query						=	$conn->prepare($sql);
		
		$arr							=	array($username,$password,$fname,$mname,$lname);
		
		$queryLog					=	$query->execute($arr);
		echo $queryLog;
	}
	
	if(isset($_GET['q'])){
		$sql							=	'delete from tbl_backendusers where bu_id = ?';
		$query						=	$conn->prepare($sql);
		$queryLog					=	$query->execute(array($_GET['q']));
		return $queryLog;
	}
?>
