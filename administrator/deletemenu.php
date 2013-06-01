<?php
	require '../conn.php';
	
	if(isset($_GET['id'])){
		$confirmSQL	=	"delete from tbl_meals  where meal_id = :id";
		$confirmQuery	=	$conn->prepare($confirmSQL);
		$confirmQuery->bindParam("id",$_GET['id'],PDO::PARAM_INT);
		$confirmQuery->execute();
		
		header("location: menumanager.php");
	}
	
?>