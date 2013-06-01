<?php require_once('conn.php'); ?>
<?php
	session_start();
	if(!isset($_SESSION['userId'])){
		header('location: index.php');
	}
?>
<?php
	if(isset($_POST)){
		$mealId			=	$_POST['mealId'];
		$mealQuantity	=	$_POST['quantity'];
		$mealPrice		=	$_POST['mealPrice'];
		$location		=	$_POST['location'];
		$sql	=	"Insert into tbl_orders(order_meal_name, order_price, order_date, order_quantity, meal_user_id, location ,order_status) values";
		$orderStack	=	array();
		for($index	=	0;	$index <= sizeOf($mealQuantity) -1; $index++ ){
			
			if($mealQuantity[$index] != 0 && $mealQuantity != "" ){
				$meals[$index]	=	$mealQuantity[$index];
				$orderStack[]		=	$mealId[$index];
				$orderStack[]		=	$mealPrice[$index];
				$orderStack[]		=	date("Y-m-d, H-i-s");
				$orderStack[]		=	$mealQuantity[$index];
				$orderStack[]		=	$_SESSION['userId'];
				$orderStack[]		=	$location;
				$orderStack[]		=	0;
			}
		}
		for($indexes	=	0 ; $indexes <= sizeof($meals) - 1; $indexes++){
			if($indexes == sizeOf($meals) - 1 ){
					$sql	.= "(?,?,?,?,?,?,?) ";
				}else{
					$sql	.= "(?,?,?,?,?,?,?), ";
				}
		}
		
		$takeOrderLog	=	$conn->prepare($sql);
		
		$query	=	$takeOrderLog->execute($orderStack);
		
		if($query == 1){
			header('location: myhistory.php');
		}
		
	}
?>