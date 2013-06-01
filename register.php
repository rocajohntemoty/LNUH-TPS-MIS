<?php require 'conn.php'; ?>
<?php session_start(); if(isset($_SESSION['userId'])){ header('location: home.php'); } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<link rel="icon" href="images/title.png" type="image/x-icon" />
<link rel="shortcut icon" href="images/title.png"  type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="assets/css/normalizer.css"/>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="css/templateCss.css"/>
<script type="text/javascript" src="assets/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.js"></script>
<script type="text/javascript">
	$(".collapse").collapse();
</script>
<title>Leyte Normal University House Delivery</title>

</head>
<body>
	<header class="clearfix">
        	<h1 class="pull-left"> LNU HOUSE Delivery </h1>
            <h2 class="pull-right" style="background:url(images/register.png)"> Register here</h2>
        </header>
        <div class="container clearfix" id="container">
        	<div style="margin:auto; width:500px;">
	<?php 
		$getdepartmentSQL		 =	"Select * from tbl_department";
		$getDepartmentQuery	   =	$conn->query($getdepartmentSQL);
		$departmentlog			=	$getDepartmentQuery->fetchAll(PDO::FETCH_ASSOC);
		
        if(isset($_POST['registration'])){
            $username	=	$_POST['username'];
			$password	=	$_POST['password'];
			$cpassword	=	$_POST['cpassword'];
			$captcha	=	$_POST['captcha'];
			$name		=	$_POST['name'];
			$department	=	$_POST['department'];
			$contact	=	$_POST['contact'];
			
			$error	=	"";
			
			if( $captcha == $_SESSION['code']){
				
				if( empty($username) ){
					$error	=	"Please Input Username.";
				}
				if( empty($password) ){
					$error	.=	"Please Input Password.";
				}
				if( empty($cpassword) ){
					$error	.=	"Please Input Confirm Password.";
				}
				if( empty($name) ){
					$error	.=	"Please Input Name.";
				}
				if( empty($department) ){
					$error	.=	"Please Input Department.";
				}
				if( empty($contact) ){
					$error	.=	"Please Input Contact Number.";
				}
				
				if( $password != $cpassword ){
					$error	.=	"Password Do not Match.";
				}
				
				if(!empty($error)){
					$error	=	explode('.',$error);
				
					if(is_array($error)){
						array_pop($error);
						
						foreach($error as $key => $values){
							echo "<div class='alert alert-danger'>{$values} <a class='close' data-dismiss='alert' href='#'>&times;</a></div>";
						}
					}else{
						echo "<div class='alert alert-danger'>{$error} <a class='close' data-dismiss='alert' href='#'>&times;</a></div>";
					}
					
					echo form($departmentlog);
				}else{
					$sql		=	"insert into tbl_orderingusers(ou_username, ou_password, ou_name, ou_department, ou_contact, ou_status, ou_dateRegistered,  ou_IPAddress) values(?,?,?,?,?,?,now(),?)";
					
					$query		=	$conn->prepare($sql);
					
					$queryLog	=	$query->execute(
								array(
									$username, 
									sha1($password),
									$name,
									$department,
									$contact,
									0,
									$_SERVER['REMOTE_ADDR'] 
								)
						);
						
					if($queryLog){
						echo "<div class='alert alert-success'> Please wait for the administrator to confirm your registration. 
						<a class='close' data-dismiss='alert' href='#'>&times;</a> </div>";
						
						
						echo "  <script type='text/javascript'>
											window.setTimeout(function() {
												location.href = 'index.php';
											}, 10000);
								</script>";
					}else{
						echo "<div class='alert alert-danger'> Registration Failed! 
						<a class='close' data-dismiss='alert' href='#'>&times;</a></div>";
					}
				}
				
				
				
			}else{
				$error	=	"Wrong Security";
				echo "<div class='alert alert-danger'> {$error}
				<a class='close' data-dismiss='alert' href='#'>&times;</a>
				</div>";
				echo form($departmentlog);
			}
			
      		  }else{
           	
				echo form($departmentlog);
			}
		?>
      	  </div>
        </div>
        
    	<footer class="clearfix">
        	<p>Copyright @Leyte Normal University</p>
        </footer>
</body>
</html>
<?php
	function form( $departmentlog ){
		?>
        	<form class=" form-horizontal" method="post" action="register.php">
            		<div class=" alert alert-info"> Note All Fields Are Required  <b style="color:red;">( * )</b>
                    <a class='close' data-dismiss='alert' href='#'>&times;</a>
                    </div>
                	<fieldset>
                    	<legend> User Information </legend>
                        <div class="control-group">
                    		<label class="control-label"> Name <b style="color:red;">( * )</b></label>
                            <div class="controls">
                                <input type="text" class="span4" name="name" placeholder="Username" value="<?php if(isset($_POST['name'])){echo $_POST['name']; } ?>" />
                            </div>
                        </div>
                        <div class="control-group">
                    		<label class="control-label"> Office / Dept / Unit <b style="color:red;">( * )</b></label>
                            <div class="controls">
                                <select name="department">
									<?php if(!empty($departmentlog)){
                                            foreach( $departmentlog as $v ){
                                    ?>
                                        <option value="<?php echo $v['dep_id']; ?>"> <?php echo $v['dep_name']; ?></option>
                                    <?php } ?>
                                    <?php  }else{ ?>
                                    	 <option value="0"> No location Found. </option>
                                    <?php  } ?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                    		<label class="control-label"> Cellphone Number </label>
                            <div class="controls">
                                <input type="text" class="span4" name="contact" placeholder="Cellphone Number" value="<?php if(isset($_POST['contact'])){echo $_POST['contact'];} ?>" />
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                    	<legend> Login Information </legend>
                        <div class="control-group">
                    		<label class="control-label"> Username <b style="color:red;">( * )</b></label>
                            <div class="controls">
                                <input type="text" class="span4" name="username" placeholder="Username" value="<?php if(isset($_POST['username'])){echo $_POST['username'];} ?>" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"> Password <b style="color:red;">( * )</b></label>
                            <div class="controls">
                                <input type="password" class="span4" name="password" placeholder="Password" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"> Confirm Password <b style="color:red;">( * )</b></label>
                            <div class="controls">
                                <input type="password" class="span4" name="cpassword" placeholder="Confirm Password" />
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                    	<legend> Security </legend>
                        <img src="imageCaptcha.php" width="512" height="365" title="Security Check!" alt="Are you a robot?" />
                        <div class="control-group">
                            <label class="control-label"> Enter Text <b style="color:red;">( * )</b></label>
                            <div class="controls">
                                <input type="text" class="span4" name="captcha" placeholder="Enter Text Above..." />
                            </div>
                        </div>
                    </fieldset>
                    <input type="hidden" name="registration"  value="Register" />
                    <button type="submit" class="btn btn-primary" > <i class="icon-white icon-ok"></i> Register </button>
                    <a href="index.php" class="btn btn-danger"> <i class="icon-white icon-backward"></i> Back </a>
                </form>
        <?php
	}
?>
