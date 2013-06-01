<?php 
	require_once '../conn.php';
	if(isset($_GET['id'])){
		$sql							=	'delete from tbl_department where dep_id = :id';     
		$query						=	$conn->prepare($sql);
		$query->bindParam(":id",$_GET['id'],PDO::PARAM_INT);
		$queryLog					=	$query->execute();
		
		header("location: lnudeptofficeunitmanager.php");
	}
?>