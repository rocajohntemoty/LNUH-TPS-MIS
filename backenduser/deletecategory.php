<?php
	require '../conn.php';
	
	if(isset($_GET['id'])){
		$confirmSQL	=	"delete from tbl_mealcategory where mc_id = :id";
		$confirmQuery	=	$conn->prepare($confirmSQL);
		$confirmQuery->bindParam("id",$_GET['id'],PDO::PARAM_INT);
		$confirmQuery->execute();
		
		header("location: categorymanager.php");
	}
	
?>