<?php require '../conn.php'; ?>
<?php session_start(); if(!isset($_SESSION['admin_id'])){ header("location: login.php");} ?>
<?php

	if(isset($_GET['confirm'],$_GET['orderinguser']) && $_GET['confirm'] == "confirm" && !empty($_GET['orderinguser'])){
		$confirmSQL	=	"update tbl_orderingusers set ou_status = 1 where ou_id	= :id";
		$confirmQuery	=	$conn->prepare($confirmSQL);
		$confirmQuery->bindParam("id",$_GET['orderinguser'],PDO::PARAM_INT);
		$confirmQuery->execute();
		
		header("locatoin: usermanager.php");
	}
	if(isset($_GET['cancel'],$_GET['orderinguser']) && $_GET['cancel'] == "cancel" && !empty($_GET['orderinguser'])){
		$confirmSQL	=	"delete from tbl_orderingusers  where ou_id	= :id";
		$confirmQuery	=	$conn->prepare($confirmSQL);
		$confirmQuery->bindParam("id",$_GET['orderinguser'],PDO::PARAM_INT);
		$confirmQuery->execute();
		
		header("location: index.php");
	}
	
	if(isset($_GET['confirm'],$_GET['orderid']) && $_GET['confirm'] == "confirm" && !empty($_GET['orderid'])){
		$order_id	=	explode(",",$_GET['orderid']);
		if(sizeof($order_id) == 1){
			$confirmSQL		=	"update tbl_orders set order_status = 1 where order_id = ?";
			$ids			   =	array($order_id[0]);
		}else{
			$confirmSQL		=	"update tbl_orders set order_status = 1 where order_id in ( ";
			$where			 =	"";
			$ids			   =	array();
			for($c = 0; $c <= sizeof($order_id) -1 ;$c++){
				if($c == sizeof($order_id) - 1){ $where	.=	"?)"; }else{ $where	.=	"?,";}
				$ids[]	=	$order_id[$c];
			}
		}
		$confirmSQL		   =	$confirmSQL.$where;
		$confirmQuery		 =	$conn->prepare($confirmSQL);
		$confirmQuery->execute($ids);
		header("location: index.php");
	}
	
	if(isset($_GET['cancel'],$_GET['orderid']) && $_GET['cancel'] == "cancel" && !empty($_GET['orderid'])){
		$order_id	=	explode(",",$_GET['orderid']);
		if(sizeof($order_id) == 1){
			$confirmSQL	=	"delete from  tbl_orders where order_id = ?";
			$ids		=	array($order_id[0]);
		}else{
			$confirmSQL	=	"delete from tbl_orders where order_id in (";
			$where		=	"";
			$ids		=	array();
			for($c = 0; $c <= sizeof($order_id) -1 ;$c++){
				if($c == sizeof($order_id) - 1){ $where	.=	"?)"; }else{$where	.=	"?,";}
				$ids[]	=	$order_id[$c];
			}
			
		}
		$confirmSQL	  =	$confirmSQL.$where;
		$confirmQuery	=	$conn->prepare($confirmSQL);
		$confirmQuery->execute($ids);
		header("location: index.php");
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
                        <li> <a href="lnudeptofficeunitmanager.php"><i class="icon icon-list"></i>  LNU Department Manager </a> </li>
                        <li> <a href="reports.php"><i class="icon icon-book"></i>  Reports </a> </li>
                        <li> <a href="logout.php"><i class="icon icon-flag"></i> Logout </a> </li>
                    </ul>
            </div>
            <div class="Homeright pull-right">
            	<table class="table table-condensed">
                	<thead>
                    	<tr>
                        	<th> <p> <i class="icon icon-ok-circle"></i> &nbsp; Notifications </p> </th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php 
							$checkingOrderSQL	=	"select * from tbl_orders where order_status = ? ";
							$checkingUsersSQL 	=   "select * from tbl_orderingusers where ou_status = ?";
							
							$checkingOrderQuery	=	$conn->prepare($checkingOrderSQL);
							$checkingOrderQuery->execute(array(0));
							$checkingUsersQuery =	$conn->prepare($checkingUsersSQL);
							$checkingUsersQuery->execute(array(0));
							
							$checkOrders		=	$checkingOrderQuery->fetchAll(PDO::FETCH_ASSOC);
							$checkUsers			=	$checkingUsersQuery->fetchAll(PDO::FETCH_ASSOC);
							
						?>
                        <?php if( empty($checkOrders) && empty($checkUsers) ){ ?>
                            <tr>
                                <td>
                                	<b style="color:red;"> No Notification Found. </b>
                                </td>
                            </tr>
                        <?php }else{ ?>
                        	<tr>
                        	<Td>
                            	<?php
										$getUserSQL		=	"select ou_id,ou_username,ou_department, ou_name,ou_dateRegistered,ou_IPAddress, ou_contact from tbl_orderingusers where ou_status = ?";
										$getUserQuery	=	$conn->prepare($getUserSQL);
										$getUserQuery->execute(array(0));
										$GetUser		=	$getUserQuery->fetchAll(PDO::FETCH_ASSOC);
										
										$getOrderSQL	=	"select  order_id, GROUP_CONCAT(order_meal_name) AS order_meal_name,GROUP_CONCAT(order_price) AS order_price,order_date,GROUP_CONCAT(order_quantity) AS order_quantity,location,ou_username from tbl_orders inner join tbl_orderingusers on tbl_orders.meal_user_id = tbl_orderingusers.ou_id where order_status = ? group by order_date,ou_username";
										
										$getOrderQuery	=	$conn->prepare($getOrderSQL);
										$getOrderQuery->execute(array(0));
										
										$getOrder	=	$getOrderQuery->fetchAll(PDO::FETCH_ASSOC);
										
								?>
                               <?php if(!empty($getOrder)){ ?>
                               		<div class="accordion" id="accordion2">
                                    <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                                          New Order taken
                                        </a>
                                    </div>
                                    <div id="collapseOne" class="accordion-body collapse in">
                                    <div class="accordion-inner">
                                        <table class="table table-condensed">	
                                            <thead>
                                                <tr>
                                                    <th> Item - Quantity</th>
                                                    <th> Delivery Location </th>
                                                    <th> User </th>
                                                    <th> Date </th>
                                                    <th> Status </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($getOrder as $key => $values){ ?>
                                                        <tr>
                                                            <?php 
                                                                if(is_array($values)){
                                                                    $meals			= explode(",",$values['order_meal_name']);
                                                                    $mealPrice		= explode(",",$values['order_price']);
                                                                    $order_quantity	= explode(",",$values['order_quantity']);
                                                            ?>
                                                            <td>
                                                                
                                                            <ul>
                                                                <?php
                                                                        if(sizeof($meals) != 1){
                                                                            for($a = 0; $a <= sizeof($meals) -1 ; $a++){
                                                                ?>
                                                                                <li><?php echo $meals[$a] ." - ". $order_quantity[$a]; ?></li>
                                                                <?php      
                                                                            }
                                                                        }else{
                                                                ?>
                                                                    <li><?php echo $meals[0] ." - ". $order_quantity[0]; ?></li>
                                                                <?php
                                                                        }
                                                                    }
                                                                ?>
                                                            </ul>
                                                            </td>
                                                            
                                                            <td>
                                                                <?php echo $values['location']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $values['ou_username'];?>
                                                            </td>
                                                            <td>
                                                                <?php echo $values['order_date'];?>
                                                            </td>
                                                            <td>
                                                                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?confirm=confirm&orderid=<?php echo $values['order_id']; ?>&sec=<?php echo rand();?>" class="btn btn-success btn-mini"> <i class="icon-white icon-ok"></i> Confirm </a>
                                                                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?cancel=cancel&orderid=<?php echo $values['order_id']; ?>&sec=<?php echo rand();?>" class="btn btn-danger btn-mini"> <i class="icon-white icon-remove"></i> Cancel </a>
                                                             </td>
                                                        </tr>
                                                <?php };?>
                                            </tbody>
                                        </table>
                                    </div>
                                    </div>
                                    </div>
                                    
							   <?php } ?>
                               <?php if(!empty($GetUser)): ?>
                               		<div class="accordion-group">
                                        <div class="accordion-heading">
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                                             New User Registered
                                            </a>
                                        </div>
                                        <div id="collapseTwo" class="accordion-body collapse">
                                            <div class="accordion-inner">
                                                
                                                <table class="table table-condensed">	
                                                    <thead>
                                                        <tr>
                                                            <th colspan="2"> User Details </th>
                                                            <th colspan="2"> Date Registered </th>
                                                            <th> Status </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($GetUser as $key => $values ): ?>
                                                            <tr>
                                                                <td  colspan="2"> 
                                                                    <ul>
                                                                        <li>  Username - <b> <?php echo $values['ou_username'];?> </b></li>
                                                                        <li> Name  - <b> <?php echo $values['ou_name'];?> </b> </li>
                                                                        <li> Department - <b> <?php echo $values['ou_department'];?> </b></li>
                                                                        <li> Contact - <b> <?php echo $values['ou_contact'];?> </b></li>
                                                                        <li> IP Address - <b> <?php echo $values['ou_IPAddress'];?> </b> </li>
                                                                    </ul>
                                                                </td>
                                                                <td  colspan="2"> <?php echo $values['ou_dateRegistered']; ?> </td>
                                                                <td>
                                                                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?confirm=confirm&orderinguser=<?php echo $values['ou_id'];?>&sec=<?php echo rand();?>" class="btn btn-success btn-mini"> <i class="icon-white icon-ok"></i> Confirm </a>
                                                                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?cancel=cancel&orderinguser=<?php echo $values['ou_id'];?>&sec=<?php echo rand();?>" class="btn btn-danger btn-mini"> <i class="icon-white icon-remove"></i> Cancel </a>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                </div>
                               <?php endif; ?>
                                
                                </div>
                            </Td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <footer class="clearfix">
        	<p>Copyright @Leyte Normal University</p>
        </footer>
</body>
</html>
