<?php
	require 'conn.php';
	
	if(isset($_POST['login'])){
	
		$username	=	$_POST['ouusername'];
		$password	=	sha1($_POST['password']);
		
		$sql			=	"SELECT ou_id from tbl_orderingusers where ou_username = ? and ou_password	=	? and ou_status = 1";
		
		$queryLog	=	$conn->prepare($sql);
		
		$queryLog->execute(array($username,$password));
		
		foreach($queryLog->fetchAll(PDO::FETCH_ASSOC) as $key ){
			$ou_id	=	(int)$key['ou_id'];
		}
		
		if(isset($ou_id) && !empty($ou_id)){
			$userType		=	1;
			$ipAddress	=	$_SERVER['REMOTE_ADDR'];
			$userDate		=	date('Y-m-d, H-i-s');
			$sql				=	"insert into tbl_logindetails( ld_user_id, ld_user_type, ld_datetime, ld_IPAddress ) values(?,?,?,?)";
			
			$query			=	$conn->prepare($sql);
			
			$ins				=	$query->execute(array( $ou_id, $userType, $userDate, $ipAddress ));
			
			
			session_Start();
			
			$_SESSION['userId']	=	$ou_id;
			
			if(!empty($_SESSION['userId'])){
				header('location: home.php');
			}
		}
		$logs	=	$queryLog->fetchAll(PDO::FETCH_ASSOC);
		if(empty($logs)){
			header("location: index.php");
		}
		
	}
?>