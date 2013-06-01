<?php require 'conn.php'; ?>
<?php session_start(); if(!isset($_SESSION['userId'])){ header('location: index.php'); } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<link rel="icon" href="images/title.png" type="image/x-icon" />
<link rel="shortcut icon" href="images/title.png"  type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="assets/css/normalizer.css"/>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css"/>
<link type="text/css" href="assets/css/bootstrap-responsive.css" rel="stylesheet">
<link type="text/css" href="assets/js/google-code-prettify/prettify.css" rel="stylesheet">
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
<title>Leyte Normal University House Delivery</title>

</head>
<body  data-spy="scroll" data-target=".bs-docs-sidebar">
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
							$query					=	$conn->query("select mc_id,mc_name from tbl_mealCategory");
							$querylog				=	$query->fetchAll(PDO::FETCH_ASSOC);
				?>
                  
                  <?php if(!empty($querylog)){ ?>
                  			<div class="accordion" id="accordion2">
								  <?php foreach($querylog as $value): ?>
                                    <div class="accordion-group">
                                        <div class="accordion-heading">
                                          <b><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?php echo $value['mc_id']; ?>">
                                            <?php echo $value['mc_name']; ?>
                                          </a></b>
                                        </div>
                                        <div id="collapse<?php echo $value['mc_id']; ?>" class="accordion-body collapse in">
                                          <div class="accordion-inner">
                                            <?php 
                                                $queryLogs		 	=	$conn->prepare("select meal_name,meal_price from tbl_meals where meal_category = ? and meal_status = ?");
                                                
                                                $queryLogs->execute(array( $value['mc_id'],1));
                                                
                                                $queriedDatas		=	$queryLogs->fetchAll(PDO::FETCH_ASSOC);
                                                
                                                if( empty($queriedDatas)){
                                            ?>
                                            <p style="color:#F00"> No Item found.</p>
                                            <?php
                                                }else{
                                            ?>
                                            <ol>
                                                <?php foreach($queriedDatas as $keys => $valueses):?>
                                                    <li><?php echo $valueses['meal_name']; ?></li>
                                                <?php endforeach; ?>
                                            </ol>
                                            <?php
                                                }
                                            ?>
                                          </div>
                                        </div>
                                     </div>
                                  <?php endforeach; ?>
                               </div>
				  <?php }else{ ?>
                  			<p style="color:red;"> No Meal Available. </p>
				  <?php } ?>
            </div>
        </div>
        <footer class="clearfix">
        	<p>Copyright @Leyte Normal University</p>
        </footer>
</body>
</html>
