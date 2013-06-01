<?php
	require '../conn.php';
	
	if(isset($_GET['id'],$_GET['ou'])){
		$confirmSQL	=	"delete from tbl_orderingusers  where ou_id	= :id";
		$confirmQuery	=	$conn->prepare($confirmSQL);
		$confirmQuery->bindParam("id",$_GET['id'],PDO::PARAM_INT);
		$confirmQuery->execute();
		
		header("location: usermanager.php");
	}
	
	if(isset($_GET['id'],$_GET['bu'])){
		$confirmSQL	=	"delete from tbl_backendusers  where bu_id	= :id";
		$confirmQuery	=	$conn->prepare($confirmSQL);
		$confirmQuery->bindParam("id",$_GET['id'],PDO::PARAM_INT);
		$confirmQuery->execute();
		
		header("location: usermanager.php");
	}
?>