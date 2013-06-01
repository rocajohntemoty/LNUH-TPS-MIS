<?php require '../conn.php'; ?>
<?php session_start(); if(!isset($_SESSION['admin_id'])){ header("location: login.php");} ?>
<?php 
	if(isset($_POST['mealCat'])){
		$addCategorySQL	=	"insert into tbl_mealcategory( mc_name ) values(:mn)";	
		$categoryQuery	=	$conn->prepare($addCategorySQL);
		$categoryQuery->bindParam(":mn",$_POST['mealCat'],PDO::PARAM_STR,255);
		$categoryLog	=	$categoryQuery->execute();
		
		
	}
	if(isset($_POST['DepartmentOfficeUnit'],$_POST['contact']) && !empty($_POST['DepartmentOfficeUnit']) && !empty($_POST['contact'])){
		$depname						=	$_POST['DepartmentOfficeUnit'];
		$depContactDetails	=	$_POST['contact'];
		$sql					=	"Insert into tbl_department(dep_name,dep_contactDetails) values(?,?)";
		
		$query				=	$conn->prepare($sql);
		
		$arr					=	array($depname,$depContactDetails);
		$queryLog			=	$query->execute($arr);
		
		header('location: '.$_SERVER['PHP_SELF']);
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
            	
               <table class="table-condensed table table-hover" >
				<thead>
                	<tr>
                            <th colspan="5">
                            	<a href="#addnewdeptunitoffice" role="button" class="btn btn-success btn-mini" data-toggle="modal"> <i class="icon-user icon-white"></i> Add New Category </a>
                            </th>
                        </tr>
					<tr>
						<th> Department / Unit / Office </th>
						<th> Contact Number </th>
                        <th> Action </th>
					</tr>
				</thead>
				<tbody>
						<?php 
							$query					=	$conn->query("select * from tbl_department");
							$querylog				=	$query->fetchAll(PDO::FETCH_ASSOC);
						?>
                        <?php if(isset($querylog) && !empty($querylog)){ ?>
                        		<?php foreach($querylog as $value): ?>
                                        <tr>
                                            <td> <?php echo $value['dep_name']; ?></td>
                                            <td> <?php echo $value['dep_contactDetails']; ?></td>
                                            <td>
                                                <a href="editdepunitoffice.php?id=<?php echo $value['dep_id']; ?>" class="btn btn-mini btn-primary"> <i class="icon-edit icon-white"> </i> Edit  </a>
                                                <a href="deletedepunitoffice.php?id=<?php echo $value['dep_id']; ?>" class="btn btn-mini btn-danger"> <i class="icon-remove icon-white"> </i> Delete  </a>
                                            </td>
                                        </tr>
                                <?php endforeach; ?>
                        <?php }else{ ?>
                        		<tr>
                                	<td colspan="2">
                                    	<b style="color:red;">No Department / Unit / Office Found. </b>
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
        <div id="addnewdeptunitoffice" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        	
            <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h3 id="myModalLabel"> Add New Department / Office / Unit </h3>
            </div>
        <div class="modal-body">
        			<div class=" alert alert-info"> Note All Fields Are Required  <b style="color:red;">( * )</b>
                    <a class='close' data-dismiss='alert' href='#'>&times;</a>
                    </div>
                    <label for="DepartmentOfficeUnit"> Department / Office / Unit Name <b style="color:red;">( * )</b></label><input type="text" name="DepartmentOfficeUnit" /> <br/>
                    <label for="contact"> Contact Details <b style="color:red;">( * )</b> </label> <input type="text" name="contact" />
        </div>
            <div class="modal-footer">
            	<button class="btn btn-primary" type="submit"> <i class="icon-white icon-ok"></i> Add Meal Category</button>
	            <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true"> <i class="icon-white icon-remove"></i>Close</button>
            </div>
        </div>
        </form>
</body>
</html>
