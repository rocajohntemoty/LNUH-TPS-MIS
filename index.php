<?php require 'conn.php'; ?>
<?php 
	session_start();
	if(isset($_SESSION['userId'])){
		header('location: home.php');
	}
?>
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
<title>Leyte Normal University House Delivery</title>

</head>
<body>
    	<header class="clearfix">
        	<h1 class="pull-left"> LNU HOUSE Delivery </h1>
            <h2 class="pull-right"> Login here</h2>
        </header>
        <div class="container clearfix" id="container">
        	<div class="left pull-left">
            	<?php 
							$query					=	$conn->query("select mc_id,mc_name from tbl_mealCategory");
							$querylog				=	$query->fetchAll(PDO::FETCH_ASSOC);
				?>
                  
                  <div class="accordion" id="accordion2">
                      <?php if(isset($querylog) and !empty( $querylog )){ ?>
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
					  <?php }else{ ?>
                      			<p style="color:#F00;"> No Category Found. </p>
					  <?php }?>
                   </div>
            </div>
            <div class="right pull-right">
            	<form action="login.php" method="POST" class="form">
                    <label><i class="icon icon-user"></i>&nbsp; Username</label> <input class="input-large" type='text' name='ouusername' placeholder="Username..." />	<br/>
                    <label><i class="icon-lock"></i> &nbsp; Password</label> <input class="input-large" type='password' name='password' placeholder="Password..." /> <br/>
                    <input type='submit' class="btn btn-primary" value="Login" name='login'/>
                </form>
                <p> Do not have an account?  <a href="register.php">Register here!</a> </p>
            </div>
        </div>
        <footer class="clearfix">
        	<p>Copyright @Leyte Normal University</p>
        </footer>
</body>
</html>
