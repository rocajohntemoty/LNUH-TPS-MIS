<?php require '../conn.php'; ?>
<?php session_start(); if(!isset($_SESSION['bu_id'])){ header("location: login.php"); } ?>
<?php if(isset($_POST['itemName'],$_POST['mealCat'],$_POST['price'])){
	
	$itemName	=	$_POST['itemName'];
	$mealCat	=	$_POST['mealCat'];
	$price		=	$_POST['price'];
	$mealStatus	=	$_POST['mealStatus'];
	
	$sql							=	"Insert into tbl_meals(meal_name,meal_price,meal_category,meal_status) values(:mn,:mp,:mc,:ms)";
		
	$query						=	$conn->prepare($sql);
	
	$query->bindParam(":mn",$itemName,PDO::PARAM_STR,255);
	$query->bindParam(":mp",$price,PDO::PARAM_STR,255);
	$query->bindParam(":mc",$mealCat,PDO::PARAM_INT);
	$query->bindParam(":ms",$mealStatus,PDO::PARAM_INT);
	
	$queryLog					=	$query->execute();
	
	header("location: ".$_SERVER['PHP_SELF']);
}?>
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
<script type="text/javascript">
	$(".collapse").collapse();
</script>
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
            	<?php $getBUser	=	"select bu_name from tbl_backendusers where bu_id = :id "; 
					  $getBUQuery	=	$conn->prepare($getBUser);
					  $getBUQuery->bindParam(":id",$_SESSION['bu_id'],PDO::PARAM_INT);
					  $getBUQuery->execute();
					  $getBUlog	=	$getBUQuery->fetchAll(PDO::FETCH_ASSOC);
				?>
                
            	<p style="margin-left:70px; margin-top:50px;">
                	<?php foreach($getBUlog as $keys => $valueses ){ ?> <b><?php echo $valueses['bu_name']; ?></b> <?php } ?>
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
                <!---->
                <table class="table table-hover table-condensed">
                    <thead>
                    	<tr>
                            <th colspan="5">
                            	<a href="#addnewmeal" role="button" class="btn btn-success btn-mini" data-toggle="modal"> <i class="icon-user icon-white"></i> Add New Meal </a>

                            </th>
                        </tr>
                        <tr>
                            <th> Item Name </th>
                            <th> Price </th>
                            <th> Category </th>
                            <th> Status </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php 
                                $query					=	$conn->query("select meal_id,meal_name,meal_price,meal_status,mc_name from tbl_meals left join tbl_mealCategory on tbl_meals.meal_category = tbl_mealCategory.mc_id");
                                $querylog				=	$query->fetchAll(PDO::FETCH_ASSOC);
       						 ?>
                            <?php if(isset($querylog) && !empty($querylog)){ ?>
									<?php foreach($querylog as $value): ?>
                                            <tr>
                                                <td> <?php echo $value['meal_name']; ?></td>
                                                <td> <?php echo $value['meal_price']; ?></td>
                                                <td> <?php echo $value['mc_name']; ?></td>
                                                <td> <?php if($value['meal_status'] == 1 ){ echo "<p style='color:blue;'>Now Serving...</p>"; }else{ echo "<p style='color:red;'>Not Available...</p>"; }?></td>
                                                <td> 
                                                    <a href="editmenu.php?id=<?php echo $value['meal_id']?>" class="btn btn-mini btn-primary"> <i class="icon-edit icon-white"> </i> Edit  </a>
                                                    <a href="deletemenu.php?id=<?php echo $value['meal_id']?>" class="btn btn-mini btn-danger"> <i class="icon-remove icon-white"> </i> Delete  </a>
                                                </td>
                                            </tr>
                                    <?php endforeach; ?>
                            <?php }else{ ?>
                        		<tr>
                                	<td colspan="5">
                                    	<b style="color:red;">No Menu Found. </b>
                                    </td>
                                </tr>
							<?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <footer class="clearfix">
        	<p>Copyright @Leyte Normal University</p>
        </footer>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div id="addnewmeal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h3 id="myModalLabel"> Add New Meal </h3>
            </div>
        <div class="modal-body">
      	  			<div class=" alert alert-info"> Note All Fields Are Required  <b style="color:red;">( * )</b>
                    <a class='close' data-dismiss='alert' href='#'>&times;</a>
                    </div>
                    <label> Item Name <b style="color:red;">( * )</b></label><input type="text" name="itemName" /> <br/>
                    <label>Price <b style="color:red;">( * )</b></label><input type="text" name="price" /> <br/>
                    <label>Category <b style="color:red;">( * )</b></label>
                        <?php 
                                $query					=	$conn->query("select mc_id,mc_name from tbl_mealcategory");
                                $querylog				=	$query->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                   
                        <?php if(empty($querylog)){ ?>
                        		<select name="mealCat" style="border:1px solid red;">
                        		<option value="0"> Add First a Meal Category </option>
                        <?php }else{ ?>
                        		 <select name="mealCat">
								<?php foreach($querylog as $value): ?>
                                        <option value="<?php echo $value['mc_id']; ?>"><?php echo $value['mc_name']; ?></option>
                                <?php endforeach; ?>
						<?php }?>
                    </select></br>
                    <label> Status <b style="color:red;">( * )</b></label>
                    <select name="mealStatus">
                    	<option value="1"> Now Serving </option>
                        <option value="0"> Not Available </option>
                    </select>
                
        </div>
            <div class="modal-footer">         
                <button class="btn btn-primary" type="submit"> <i class="icon-white icon-ok"></i> Add Meal Item</button>
	            <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true"> <i class="icon-white icon-remove"></i>Close</button>
            </div>
        </div>
        </form>
</body>
</html>
