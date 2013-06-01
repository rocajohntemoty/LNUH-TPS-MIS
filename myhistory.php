<?php require 'conn.php'; ?>
<?php session_start();if(!isset($_SESSION['userId'])){header('location: index.php');}?>
<!DOCTYPE html >
<head>
<title>Leyte Normal University House Delivery</title>
<link rel="icon" href="images/title.png" type="image/x-icon" />
<link rel="shortcut icon" href="images/title.png"  type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="assets/css/normalizer.css"/>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="css/templateCss.css"/>
<link rel="stylesheet" type="text/css" href="css/home.css"/>
<script type="text/javascript" src="assets/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.js"></script>
<script type="text/javascript">
	$(".collapse").collapse();
</script>
<style type="text/css">
.welcome{
		background:url(images/welcome.png);
		position:relative; 
		height:90px; 
		width:290px;
		right:10px; 
		top:30px;
		background-repeat:no-repeat;
	}
</style>
</head>
<body>
    	<header class="clearfix">
        	<h1 class="pull-left"> LNU HOUSE Delivery </h1>
            <?php 
				$sql	=	"select ou_name from tbl_orderingusers where ou_id 	= ?";
				
				$query		=	$conn->prepare($sql);
				
				$query->execute(ARRAY($_SESSION['userId']));
				
				foreach($query->fetchAll(PDO::FETCH_ASSOC) as $key => $values){
					$name	=	$values['ou_name'];
				}
			?>
            <div class="welcome pull-right">
            	<p style="margin-left:70px; margin-top:50px;">
                	<?php echo $name; ?>
                </p>
            </div>
        </header>
        <div class="container clearfix" id="container">
        	<div class="Homeleft pull-left">
                    <ul class="nav nav-tabs nav-stacked" style="width:300px;">
	                    <li> <a href="order.php"> <i class="icon icon-list"></i> Take an Order </a> </li>
                    	<li> <a href="home.php"><i class="icon icon-tags"></i> Now Serving... </a> </li>
                        <li> <a href="myhistory.php"><i class="icon icon-star-empty"></i>  My History </a> </li>
                        <li> <a href="logout.php"><i class="icon icon-flag"></i> Logout </a> </li>
                    </ul>
            </div>
            <div class="Homeright pull-right">
                <?php 
							$query					=	$conn->prepare("select * from tbl_orders where meal_user_id =	?  order by order_date desc ");
							$query->execute(array($_SESSION['userId']));
							$querylog				=	$query->fetchAll(PDO::FETCH_ASSOC);
							
							$sqlSum					=	"select sum(order_price * order_quantity) as total from tbl_orders where order_status = 0 and meal_user_id = ?";
							
							$queryTotal				=	$conn->prepare($sqlSum);
							
							$queryTotal->execute(array($_SESSION['userId']));
							
							$querySumLog			=	$queryTotal->fetchAll(PDO::FETCH_ASSOC);
							
							$total					=	"";
							foreach($querySumLog	as $key => $values ){
								$total = $values['total'];
							}
				?>
                
                <table class="table table-hover">
                	<thead>
                    	<tr>
                        	<td colspan="3"> <b> My Order History </b> </td>
                            <td colspan="3"> <p style="color:red;">Total Payment: &nbsp; <b><a href="#">Php <?php if(empty($total)){echo "0.00";}else{ echo $total;} ?></a> </b></p> </td>
                        </tr>
                        <tr>
                        	<th> Item Name </th>
                            <th> Item Price </th>
                            <th> Quantity </th>
                            <th> Date </th>
                            <th> Total Price </th>
                            <th> Order Status </th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php if(!empty($querylog)){ ?>
                        	<?php foreach($querylog as $key => $values ){ ?>
                                <tr>
                                    <td><?php echo $values['order_meal_name']; ?></td>
                                    <td><?php echo $values['order_price']; ?></td>
                                    <td><?php echo $values['order_quantity']; ?></td>
                                    <td><?php echo $values['order_date']; ?></td>
                                    <td>
                                        <?php if($values['order_status'] == 0 ){ echo " <p style='color:red;'>".(int)$values['order_quantity'] * (float)$values['order_price']."</p>";}else{ echo "<p style='color:green;'>".(int)$values['order_quantity'] * (float)$values['order_price']."</p>";} ?>
                                    </td>
                                    <td><?php if($values['order_status'] == 0 ){ echo " <p style='color:blue;'>processing... </p>";}else if( $values['order_status'] == 1){ echo "<p style='color:green;'> Received... </p>";}else{ echo "<p style='color:red'> Canceled... </p>";} ?></td>
                                </tr>
                            <?php } ?>
                        <?php }else{ ?>
                        	<tr>
                            	<td colspan="6"> <p style="color:red;"> No Order history Found. </p> </td>
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
