<?php

	require('conn.php');
	
	if(isset($_POST['department'])){
		$depname						=	$_POST['depName'];
		$depContactDetails	=	$_POST['depContatDetails'];
		$sql					=	"Insert into tbl_department(dep_name,dep_contactDetails) values(?,?)";
		
		$query				=	$conn->prepare($sql);
		
		$arr					=	array($depname,$depContactDetails);
		$queryLog			=	$query->execute($arr);
		
		echo $queryLog;
	}
	if(isset($_GET['q'])){
		$sql							=	'delete from tbl_department where dep_id = ?';
		$query						=	$conn->prepare($sql);
		$queryLog					=	$query->execute(array($_GET['q']));
		return $queryLog;
	}
?>
