<?php require '../conn.php'; ?>
<?php session_start(); if(!isset($_SESSION['admin_id'])){ header("location: login.php");} ?>
<?php if(isset($_GET['id'])){
			$getCatSQL		=	"select * from tbl_mealcategory where  	mc_id = :mc_id limit 1";
			$getCatQuery	=	$conn->prepare($getCatSQL);
			$getCatQuery->bindParam(":mc_id",$_GET['id'],PDO::PARAM_INT);
			$getCatQuery->execute();
			$queryCat		=	$getCatQuery->fetchAll(PDO::FETCH_ASSOC);
	   }else{
		   header("location: index.php");
	   }
	   if(isset($_POST['mc_id'],$_POST['name'])){
		   $editCategorySQL	=	"update tbl_mealcategory set mc_name = :name where mc_id = :mid";
		   $editCategoryQuery	=	$conn->prepare($editCategorySQL);
		   $editCategoryQuery->bindParam(":name",$_POST['name'],PDO::PARAM_STR,255);
		   $editCategoryQuery->bindParam(":mid",$_POST['mc_id'],PDO::PARAM_INT);
		   $editCategoryQuery->execute();
		   
		   header('location: categorymanager.php');
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
				   $mc_name		=	$values['mc_name'];
				   $mc_id		=	strtolower($values['mc_id']);
			   }?>
               <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
               	<input type="hidden" value="<?php echo $mc_id; ?>" name="mc_id"/>
               	<fieldset>
                	<legend> Category </legend>
                    <Div class="control-group">
                    	<label class="control-label"> Name </label>
                        <div class="controls">
                        	<input type="text" value="<?php echo $mc_name; ?>" name="name"/>
                        </div>
                    </Div>
                </fieldset>
                <button type="submit" class="btn btn-primary" > <i class="icon-white icon-ok"></i> Save </button>
                <a class="btn btn-danger" href="categorymanager.php"> <i class="icon-white icon-arrow-left"></i> Back </a>
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
