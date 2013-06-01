<?php require '../conn.php'; ?>
<?php if(isset($_GET['id'])){
			$getMealSQL		=	"select * from tbl_meals where meal_id = :mealid limit 1";
			$getMealQuery	=	$conn->prepare($getMealSQL);
			$getMealQuery->bindParam(":mealid",$_GET['id'],PDO::PARAM_INT);
			$getMealQuery->execute();
			$queryMeal		=	$getMealQuery->fetchAll(PDO::FETCH_ASSOC);
			
	   }else{
		   header("location: index.php");
	   }
	   
	   if(isset($_POST['meal_id'],$_POST['status'],$_POST['mealCat'],$_POST['price'],$_POST['name'])){
		   $meal_id		=	$_POST['meal_id'];
		   $status		=	$_POST['status'];
		   $mealCat		=	$_POST['mealCat'];
		   $name		=	$_POST['name'];
		   $price		=	$_POST['price'];
		   
		   $editMenuSql	=	"Update tbl_meals set meal_name	=	:mn , meal_price	=	:mp, meal_category	=	:mc, meal_status = :ms where meal_id	=	:mid";	
		   
		   $editMenuQuery	=	$conn->prepare($editMenuSql);
		   $editMenuQuery->bindParam(":mn",$name,PDO::PARAM_STR,255);
		   $editMenuQuery->bindParam(":mp",$price,PDO::PARAM_STR,255);
		   $editMenuQuery->bindParam(":mc",$mealCat,PDO::PARAM_INT);
		   $editMenuQuery->bindParam(":ms",$status,PDO::PARAM_INT);
		   $editMenuQuery->bindParam(":mid",$meal_id,PDO::PARAM_INT);
		   $editMenuLog	=	$editMenuQuery->execute();
		   
		   header("location: menumanager.php");
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
                    	<li> <a href="categorymanager.php"><i class="icon icon-tags"></i> Category Manager </a> </li>
                        <li> <a href="menumanager.php"><i class="icon icon-list"></i>  Menu Manager </a> </li>
                        <li> <a href="logout.php"><i class="icon icon-flag"></i> Logout </a> </li>
                    </ul>
            </div>
            <div class="Homeright pull-right">
               <?php if(!empty($queryMeal)){ ?>
               <?php foreach($queryMeal as $key => $values ){
				   $meal_name		=	$values['meal_name'];
				   $meal_price		=	$values['meal_price'];
				   $meal_category 	=	$values['meal_category'];
				   $meal_status		=	$values['meal_status'];
				   $meal_id			=	$values['meal_id'];
			   }?>
               <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
               	<input type="hidden" value="<?php echo $meal_id; ?>" name="meal_id"/>
               	<fieldset>
                	<legend> Meals </legend>
                    <Div class="control-group">
                    	<label class="control-label"> Name </label>
                        <div class="controls">
                        	<input type="text" value="<?php echo $meal_name; ?>" name="name"/>
                        </div>
                    </Div>
                    <Div class="control-group">
                    	<label class="control-label"> Price </label>
                        <div class="controls">
                        	<input type="text" value="<?php echo $meal_price; ?>" name="price"/>
                        </div>
                    </Div>
                    <Div class="control-group">
                    	<label class="control-label"> Category </label>
                        <div class="controls">
                    	<?php 
                                $query					=	$conn->query("select mc_id,mc_name from tbl_mealcategory");
                                $querylog				=	$query->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                            <select name="mealCat">
                                <?php foreach($querylog as $valueses): ?>
                                        <?php if( $valueses['mc_id'] == $meal_category){ ?>
                                                <option selected value="<?php echo $valueses['mc_id']; ?>"><?php echo $valueses['mc_name']; ?></option>	
                                        <?php }else{ ?>
                                                <option value="<?php echo $valueses['mc_id']; ?>"><?php echo $valueses['mc_name']; ?></option>
                                        <?php }?>
                                        
                                <?php endforeach; ?>
                              </select>
                        </div>
                    </Div>
                    <Div class="control-group">
                    	<label class="control-label"> Status </label>
                        <div class="controls">
                        	<select name="status">
                            	<?php if($meal_status == 0){ ?>
                                	<option selected="selected"  value="0"> Not Available... </option>
                                    <option value="1"> Now Serving... </option>
								<?php }else{ ?>
                                	<option  selected="selected" value="1"> Now Serving... </option>
                                    <option value="0"> Not Available... </option>
                                <?php } ?>
                            </select>
                        </div>
                    </Div>
                </fieldset>
                <button type="submit" class="btn btn-primary" > <i class="icon-white icon-ok"></i> Save </button>
                <a class="btn btn-danger" href="menumanager.php"> <i class="icon-white icon-arrow-left"></i> Back </a>
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
