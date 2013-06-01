<?php require '../conn.php'; ?>
<?php session_start(); if(!isset($_SESSION['admin_id'])){ header("location: login.php");} ?>
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
	th{
		border-bottom:1px solid black;
	}
	tfoot > tr > td{
		  border-top:1px solid black;
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
                <?php
					$getItem		=	"select * from tbl_orders where order_status = 1";
					$getItemQuery	=	$conn->query($getItem);
					$orders_total	=	0;
					$orders			=	$getItemQuery->fetchAll(PDO::FETCH_ASSOC);
				?>
                <table class="table-condensed table-hover table-bordered" style="width:100%;">
                    <thead>
                        <Tr>
                            <th> Item Name </th>
                            <th> Item Price / Serve </th>
                            <th> No. Order Taken  </th>
                            <th> Date </th>
                            <th> Total Price of Order Taken </th>
                        </Tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($orders)){ ?>
                        	<?php foreach($orders as $key => $values ): ?>
								<?php $orders_total	+= $values['order_price']*$values['order_quantity'];	?>
                                <tr>
                                    <td><?php echo $values['order_meal_name']; ?></td>
                                    <td>Php <?php echo $values['order_price']; ?></td>
                                    <td><?php echo $values['order_quantity']; ?></td>
                                    <td><?php echo $values['order_date']; ?></td>
                                    <td>Php <?php echo $values['order_price']*$values['order_quantity']; ?> </td>
                                </tr>
                            <?php endforeach; ?>
						<?php }else{ ?>
                        		<tr>
                                	<Td colspan="5">
                                    	<p style="color:red;"> No Orders Made. </p>
                                    </Td>
                                </tr>
						<?php }?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td  colspan="3" align="right">
                               Total
                            </td>
                            <td> - </td>
                            <td> Php <?php echo $orders_total; ?> </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <footer class="clearfix">
        	<p>Copyright @Leyte Normal University</p>
        </footer>
</body>
</html>
