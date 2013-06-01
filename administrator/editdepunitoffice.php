<?php require '../conn.php'; ?>
<?php session_start(); if(!isset($_SESSION['admin_id'])){ header("location: login.php");} ?>
<?php if(isset($_GET['id'])){
			$getCatSQL		=	"select * from tbl_department where  	dep_id = :mc_id limit 1";
			$getCatQuery	=	$conn->prepare($getCatSQL);
			$getCatQuery->bindParam(":mc_id",$_GET['id'],PDO::PARAM_INT);
			$getCatQuery->execute();
			$queryCat		=	$getCatQuery->fetchAll(PDO::FETCH_ASSOC);
	   }
	   
	   if(isset($_POST['dep_id'],$_POST['dep_name'],$_POST['dep_contact'])){
		   
		   $editCategorySQL	=	"update tbl_department set dep_name = :dep_name,  	dep_contactDetails = :dep_contact where dep_id = :dep_id";
		   $editCategoryQuery	=	$conn->prepare($editCategorySQL);
		   $editCategoryQuery->bindParam(":dep_name",$_POST['dep_name'],PDO::PARAM_STR,255);
		   $editCategoryQuery->bindParam(":dep_contact",$_POST['dep_contact'],PDO::PARAM_STR,255);
		   $editCategoryQuery->bindParam(":dep_id",$_POST['dep_id'],PDO::PARAM_INT);
		   $editCategoryQuery->execute();
		   
		   header('location: lnudeptofficeunitmanager.php');
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
               <?php if(!empty($queryCat)){ ?>
               <?php foreach($queryCat as $key => $values ){
				   $dep_name		=	$values['dep_name'];
				   $dep_contact	=	$values['dep_contactDetails'];
				   $dep_id		=	strtolower($values['dep_id']);
			   }?>
               <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
               	<input type="hidden" value="<?php echo $dep_id; ?>" name="dep_id"/>
               	<fieldset>
                	<legend> Category </legend>
                    <Div class="control-group">
                    	<label class="control-label"> Department / Unit / Office Name </label>
                        <div class="controls">
                        	<input type="text" value="<?php echo $dep_name; ?>" name="dep_name"/>
                        </div>
                    </Div>
                    <Div class="control-group">
                    	<label class="control-label"> Contact </label>
                        <div class="controls">
                        	<input type="text" value="<?php echo $dep_contact; ?>" name="dep_contact"/>
                        </div>
                    </Div>
                </fieldset>
                <button type="submit" class="btn btn-primary" > <i class="icon-white icon-ok"></i> Save </button>
                <a class="btn btn-danger" href="lnudeptofficeunitmanager.php"> <i class="icon-white icon-arrow-left"></i> Back </a>
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
