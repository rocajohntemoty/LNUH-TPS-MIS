<?php require '../conn.php'; ?>
<?php session_start(); if(!isset($_SESSION['admin_id'])){ header("location: login.php");} ?>
<?php 
		
		if(isset($_POST['userid'],$_POST['username'],$_POST['contact'],$_POST['password'],$_POST['cpassword'],$_POST['department'],$_POST['name'])){
		 	
			
			$getpasswordSQL 	=	"select ou_password from tbl_orderingusers where ou_id = ? limit 1";
			$getPasswordQuery	=	$conn->prepare($getpasswordSQL);
			$getPasswordQuery->execute(array($_POST['userid']));
			$password			=	$getPasswordQuery->fetchAll(PDO::FETCH_ASSOC);
		
			$thepassword 		=	"";
			foreach( $password as $keys => $valueses){
				$password	=	$valueses['ou_password'];
			}
			
			if(empty($_POST['password'])){
				$edituserSql	=	"update tbl_orderingusers set ou_username = :username, ou_department = :department , ou_contact	=	:contact, ou_dateRegistered = now(), ou_name = :name where ou_id = :id";
				$edituserQuery	=	$conn->prepare($edituserSql);
			}else{
				$edituserSql	=	"update tbl_orderingusers set ou_username = :username, ou_password = :password, ou_department = :department , ou_dateRegistered = now(), ou_contact	=	:contact, ou_name = :name where ou_id = :id";
				$edituserQuery	=	$conn->prepare($edituserSql);
				$edituserQuery->bindParam(":password",sha1($_POST['cpassword']),PDO::PARAM_STR,255);
			}
			//if(sha1($_POST['password']) == $password){
				 
					 
			//}
			
			 $edituserQuery->bindParam(":username",$_POST['username'],PDO::PARAM_STR,255);
			 $edituserQuery->bindParam(":department",$_POST['department'],PDO::PARAM_STR,255);
			 $edituserQuery->bindParam(":contact",$_POST['contact'],PDO::PARAM_STR,255);
			 $edituserQuery->bindParam(":name",$_POST['name'],PDO::PARAM_STR,255);
			 $edituserQuery->bindParam(":id",$_POST['userid'],PDO::PARAM_INT);
			 $edituserlog	=	$edituserQuery->execute();
			 
			 header("location: usermanager.php");
	   }
		
		if(isset($_GET['id'])){
			$getUserSQL	=	"select * from tbl_orderingusers where ou_id = :userid limit 1";
			$getUserQuery	=	$conn->prepare($getUserSQL);
			$getUserQuery->bindParam(":userid",$_GET['id'],PDO::PARAM_INT);
			$getUserQuery->execute();
			$queryUsers		=	$getUserQuery->fetchAll(PDO::FETCH_ASSOC);
			
	   }else{
		   header("location: usermanager.php");
	   }
	   
?>
<!DOCTYPE html>
<head>
<link rel="icon" href="../images/title.png" type="image/x-icon" />
<link rel="shortcut icon" href="../images/title.png"  type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../assets/css/normalizer.css"/>
<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="../css/admintemplateCss.css"/>
<link rel="stylesheet" type="text/css" href="../css/adminhome.css"/>
<script type="text/javascript" src="../assets/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../js/script.js"></script>
<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
<style type="text/css">
	.welcome{
		background:url(../images/welcome.png);
		position:relative; 
		height:90px; 
		width:290px;
		right:10px; 
		top:30px;
		background-repeat:no-repeat;
	}
</style>
<title>Leyte Normal University House Delivery</title>

</head>
<body>
    	<header class="clearfix">
        	<h1 class="pull-left"> LNU HOUSE Delivery </h1>
            <div class="welcome pull-right">
            	<p style="margin-left:70px; margin-top:50px;">
                	Administrator
                </p>
            </div>
        </header>
        <div class="container clearfix" id="container">
        	<div class="Homeleft pull-left">
                    <ul class="nav nav-tabs nav-stacked" style="width:300px;">
                    	<li> <a href="index.php"> <i class="icon icon-exclamation-sign"></i> Notification </a> </li>
	                    <li> <a href="usermanager.php"> <i class="icon icon-user"></i> User Manager </a> </li>
                    	<li> <a href="categorymanager.php"><i class="icon icon-tags"></i> Category Manager </a> </li>
                        <li> <a href="menumanager.php"><i class="icon icon-list"></i>  Menu Manager </a> </li>
                        <li> <a href="reports.php"><i class="icon icon-book"></i>  Reports </a> </li>
                        <li> <a href="logout.php"><i class="icon icon-flag"></i> Logout </a> </li>
                    </ul>
            </div>
            <div class="Homeright pull-right">
               <?php if(!empty($queryUsers)){ ?>
               <?php foreach($queryUsers as $key => $values ){
				   $username	=	$values['ou_username'];
				   $department	=	$values['ou_department'];
				   $password	=	$values['ou_password'];
				   $contact		=	$values['ou_contact'];
				   $name		=	$values['ou_name'];
				   $id			=	$values['ou_id'];
			   }?>
               <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
               	<input type="hidden" value="<?php echo $id; ?>" name="userid"/>
               	<fieldset>
                	<legend> Login Details </legend>
                    <Div class="control-group">
                    	<label class="control-label"> Username </label>
                        <div class="controls">
                        	<input type="text" value="<?php echo $username; ?>" name="username"/>
                        </div>
                    </Div>
                    <Div class="control-group">
                    	<label class="control-label"> Old Password </label>
                        <div class="controls">
                        	<input type="password" name="password"/>
                        </div>
                    </Div>
                    <Div class="control-group">
                    	<label class="control-label"> New Password </label>
                        <div class="controls">
                        	<input type="password" name="cpassword"/>
                        </div>
                    </Div>
                </fieldset>
                <fieldset>
                	<legend> User Details </legend>
                    <div class="control-group">
                    	<label class="control-label"> Name </label>
                        <div class="controls">
                        	<input type="text" value="<?php echo $name; ?>" name="name"/>
                        </div>
                    </div>
                    <div class="control-group">
                    	<label class="control-label"> Department </label>
                        <div class="controls">
                        	<input type="text" value="<?php echo $department; ?>" name="department"/>
                        </div>
                    </div>
                    <div class="control-group">
                    	<label class="control-label"> Contact Number </label>
                        <div class="controls">
                        	<input type="text" value="<?php echo $contact; ?>" name="contact"/>
                        </div>
                    </div>
                </fieldset>
                <button type="submit" class="btn btn-primary" > <i class="icon-white icon-ok"></i> Save </button>
                <a class="btn btn-danger" href="usermanager.php"> <i class="icon-white icon-arrow-left"></i> Back </a>
               </form>
			   <?php }else{?>
               		<p style="color:red;"> No User Found !</p>
			   <?php }?>
            </div>
        </div>
        <footer class="clearfix">
        	<p>Copyright @Leyte Normal University</p>
        </footer>
</body>
</html>
