<?php require 'conn.php'; ?>
<?php 
	session_start();
	if(!isset($_SESSION['userId'])){
		header('location: index.php');
	}
?>
<!DOCTYPE html>
<head>
<link rel="icon" href="images/title.png" type="image/x-icon" />
<link rel="shortcut icon" href="images/title.png"  type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="assets/css/normalizer.css"/>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="css/templateCss.css"/>
<link rel="stylesheet" type="text/css" href="css/home.css"/>
<script type="text/javascript" src="assets/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.js"></script>
<script type="text/javascript">
	var regExp		=	new RegExp(/^[0-9]*$/);
	$(document).ready(function(){
		
		$(".read")
		.change(function(){
			var amount 		=	$($(this).parents("tr")).children("td").last();
			var perSnack 	=	$($(this).parents("tr")).children("td").next().html();
			
			amount.html(parseFloat(perSnack) * parseFloat($(this).val()) );
			if( amount.html() == "NaN"){
				amount.html("<p style='color:red;'>Enter Valid Quantity.</p>");
			}
		})
		.keyup(function(){
			
			
			var amount 		=	$($(this).parents("tr")).children("td").last();
			var perSnack 	=	$($(this).parents("tr")).children("td").next().html();
			amount.html(parseFloat(perSnack) * parseFloat($(this).val()) );
			var value	=	$(this).val();
			if(regExp.test(value) != true){
				amount.html("<p style='color:red;'>Enter 0-9 Number Only.</p>");
			}
			if(amount.html() == "NaN"){
				amount.html("<p style='color:red;'>Enter Valid Quantity.</p>");
			}
		});
		
		$("#takeOrder").submit(function(){
			var error	=	0;
			for(var a = 0; a <= $('input[type=number]').length -1 ; a++ ){
				if( regExp.test( $('input[type=number]').eq(a).val() ) == false){
					error++;
				}
			}
			if(error == 0){
				return true;
			}else{
				alert("Only Positive Numbers are allowed. \n Please Check your inputs.");
				return false;
			}
			
		});
		
		$("#takeOrder").submit(function(){
			var location	= 	"";
			var quantity	=	"";
			location	=	$("#locates").val();
			quantity	=	$(".quant");
			var err		 =	0;
			for(var a = 0; a <= quantity.length - 1 ; a++){
				if(quantity.eq(a).val() == "" || quantity.eq(a).val() == null ){
					err++;
				}
			}
			
			if( location != 0  && err != quantity.length ){
				$('#orderErrors').html("");
				return true;
			}else{
				$('#orderErrors').html("");
				if( err === quantity.length ){
					$('#orderErrors').append("<div class='alert alert-danger'> <p> <strong> Warning: </strong>Please <span class='label label-info'> select order.</span></p> </div>");
				}
				if(location == 0){
					$('#orderErrors').append("<div class='alert alert-danger'> <p> <strong> Warning: </strong>You did not <span class='label label-info'> specify </span> delivery location.</p> </div>");
				}
				return false;
			}
			
			
		});
	});
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
                            $query					=	$conn->query("select meal_id,meal_name,meal_price,meal_status,mc_name from tbl_meals left join tbl_mealCategory on tbl_meals.meal_category = tbl_mealCategory.mc_id");
                            $querylog				=	$query->fetchAll(PDO::FETCH_ASSOC);
							$getdepartmentSQL		=	"Select * from tbl_department";
							$getDepartmentQuery		=	$conn->query($getdepartmentSQL);
							$departmentlog			=		$getDepartmentQuery->fetchAll(PDO::FETCH_ASSOC);
   				?>
                
                <form action="takeOrder.php" name="order" method="POST" id="takeOrder">
                <?php if(!empty($querylog)){ ?>
                			<div class="alert alert-info"> Note All Fields Are Required  <b style="color:red;">( * )</b>
                            <a class='close' data-dismiss='alert' href='#'>&times;</a>
                            </div>
                            <div id="orderErrors"></div>
                <?php } ?>
                <table class="table table-condensed table-hover">
                        <thead>
                        	<?php if(!empty($querylog)){ ?>
                            	<tr>
                                    <th colspan="6">
                                        <b> Delivery Location <b style="color:red;">( * )</b></b> &nbsp;
                                        <select id="locates" name="location">
                                        	<option value="0">-- Select Location -- </option>
                                        	<?php if(!empty($departmentlog)){
													foreach( $departmentlog as $v ){
											?>
                                            	<option value="<?php echo $v['dep_id']; ?>"> <?php echo $v['dep_name']; ?></option>
                                            <?php } ?>
											<?php		
												}
											?>
                                        </select>
                                    </th>
                                </tr>
							<?php }?>
                            <tr>
                                <th> Item Name </th>
                                <th> Price </th>
                                <th> Category </th>
                                <th> Quantity </th>
                                <th> Status </th>
                                <th> Total Amount ( Php ) </th>
                            </tr>
                        </thead>
                        <tbody>
						
                        <?php if(!empty($querylog)){ ?>
                        		<?php foreach($querylog as $value): ?>
                                    <tr>
                                        <input type="hidden" name="mealId[]" value="<?php echo $value['meal_name']; ?>"/>
                                        <input type="hidden" name="mealPrice[]" value="<?php echo $value['meal_price']; ?>"/>
                                        <td> <?php echo $value['meal_name']; ?></td>
                                        <td> <?php echo $value['meal_price']; ?></td>
                                        <td> <?php echo $value['mc_name']; ?></td>
                                        <td> 
                                            <?php if($value['meal_status'] == 1 ){ ?>
                                                    <input class="span1 read quant" type='text' name="quantity[]"/>
                                             <?php }else{ ?>
                                                    <input disabled class="span1 read" type='text'  name="quantity[]"/>
                                             <?php }?>
                                        </td>
                                        <td> <?php if($value['meal_status'] == 1 ){ echo "<p style='color:green;'> Now Serving... </p>"; }else{ echo "<p style='color:red'>Not Available!</p>"; }?></td>
                                        <td> Amount </td>
                                    </tr>
                            <?php endforeach; ?>
                            	<tr>
                                    <td colspan="7" align="right"> <input class="btn btn-primary" type='submit' value="Take Order" /></td>
                                </tr>
						<?php }else{ ?>
                        		<tr>
                                	<Td colspan="6"> <b style="color:Red;"> No Records Found. </b> </Td>
                                </tr>
						<?php }?>
                            
                        </tbody>
                    </table>
                    </form>
            </div>
        </div>
        <footer class="clearfix">
        	<p>Copyright @Leyte Normal University</p>
        </footer>
</body>
</html>
