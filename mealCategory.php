<?php

	require('conn.php');
	
	if(isset($_POST['mealCatgeroy'])){
		$mealCategory	=	$_POST['mealCat'];
		$sql					=	"Insert into tbl_mealCategory(mc_name) values(?)";
		
		$query				=	$conn->prepare($sql);
		
		$queryLog			=	$query->execute(array($mealCategory));
		
		echo $queryLog;
	}
	
	if(isset($_GET['q'])){
		$sql							=	'delete from tbl_mealCategory where mc_id = ?';
		$query						=	$conn->prepare($sql);
		$queryLog					=	$query->execute(array($_GET['q']));
		return $queryLog;
	}
	
?>
