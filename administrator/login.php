<?php require '../conn.php'; ?>
<?php 
	
	session_start();
	if(isset($_SESSION['admin_id'])){
		header("location: index.php");
	}
	if(isset($_POST['login'])){
		$username	=	$_POST['username'];
		$password	=	$_POST['password'];
		
		$loginSql	=	"select admin_id from tbl_administrator where username = :username and password = :password ";
		$loginquery	=	$conn->prepare($loginSql);
		$loginquery->bindParam(":username",$username,PDO::PARAM_STR,255);
		$loginquery->bindParam(":password",sha1($password),PDO::PARAM_STR,255);
		$loginquery->execute();
		
		$admin	=	$loginquery->fetchAll(PDO::FETCH_ASSOC);
		
		$admin_id	=	"";
		$error		=	0;
		
		foreach($admin as $key => $values){
			$admin_id = $values['admin_id'];
		}
		
		if(!empty($admin_id)){
			$_SESSION['admin_id']	=	$admin_id;
			
			if(!empty($_SESSION['admin_id'])){
				header("location: index.php");
			}else{
				$error++;
			}
		}else{
			$error++;
		}
	}
?>
<!DOCTYPE html>
<head>
<link rel="icon" href="../images/title.png" type="image/x-icon" />
<link rel="shortcut icon" href="../images/title.png"  type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../assets/css/normalizer.css"/>
<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css"/>
<script type="text/javascript" src="../assets/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
<script type="text/javasrcipt">
	window.onload	=	function(){
		var form 	=	document.getElementById("loginForm");
		console.log(form);
		 $(':input', form)
		 .not(':button, :submit, :reset, :hidden')
		 .val('')
		 .removeAttr('checked')
		 .removeAttr('selected');
	}
</script>
<title>Leyte Normal University House Delivery</title>
<style type="text/css">
	body{
		width:500px;
		margin:50px auto;
	}
	.myContainer, .top, .bottom{
		width:500px;
	}
	form{
		min-height:220px;
		width:500px;
		margin:auto;
	}
	.top, .bottom{
		height:80px;
		text-indent:-99999px;
	}
	.top{
		background-image:url(../images/admin_login.png);
		background-position:top right;
		background-repeat:no-repeat;
		
	}
	.bottom{
		background-image:url(../images/admin_loginFooter.png);
		background-position:bottom right;
		background-repeat:no-repeat;
		margin-top:-20px;
		
	}
	.control-label{
		width:50px;
	}
</style>
</head>
<body>
	<div class="container myContainer">
    	<div class="top">Administrator Login</div>
    	<form id="loginForm" class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        		<?php if(isset($error) && $error != 0){?>
                	<div class="alert alert-danger " style="width:300px; margin:10px auto 20px auto;"> <i class="icon-user"></i> Username and <i class="icon-lock"></i> Password Not Match.</div>
                <?php }else{ ?>
                	<div class="alert alert-info " style="width:300px; margin:10px auto 20px auto;"> <i class="icon-user"></i> Username and <i class="icon-lock"></i> Password Required.</div>
                <?php }?>
                <div class="control-group">
                	<label class="control-label"> <strong>Username</strong></label>
                    <Div class="controls">
                    	<input  type="text" name="username" placeholder="Username here..." />
                    </Div>
                </div>
                <div class="control-group">
                	<label class="control-label"> <strong>Password </strong></label>
                    <Div class="controls">
                    	<input type="password" name="password" placeholder="Password here..." />
                    </Div>
                </div>
                <div class="controls">
                	<button class="btn btn-primary btn-small" name="login" type="submit" value="Login" > <i class="icon-white icon-lock"></i> Login</button>
                </div>
        </form>
        <div class="bottom"> LNU-House Delivery </div>
    </div>
</body>
</html>
