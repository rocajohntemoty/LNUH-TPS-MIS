<?php

	require('conn.php');
	
	if(isset($_POST['mealSubmit'])){
	
		$itemName					=	$_POST['itemName'];
		$price						=	$_POST['price'];
		$mealCat					=	$_POST['mealCat'];
		$mealStatus					=	1;
		
		$sql							=	"Insert into tbl_meals(meal_name,meal_price,meal_category,meal_status) values(?,?,?,?)";
		
		$query						=	$conn->prepare($sql);
		
		$arr							=	array($itemName,$price,$mealCat,$mealStatus);
		
		$queryLog					=	$query->execute($arr);
		echo $queryLog;
	}
	
	if(isset($_GET['q'])){
		$sql							=	'delete from tbl_meals where meal_id = ?';
		$query						=	$conn->prepare($sql);
		$queryLog					=	$query->execute(array($_GET['q']));
		return $queryLog;
	}
?>
