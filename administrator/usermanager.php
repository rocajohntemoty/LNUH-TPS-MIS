<?php require '../conn.php'; ?>
<?php session_start(); if(!isset($_SESSION['admin_id'])){ header("location: login.php");} ?>
<?php 
	if(isset($_POST['ou_username'], $_POST['ou_name'], $_POST['ou_department'], $_POST['ou_password'], $_POST['ou_cpassword'], $_POST['ou_contact'])){
		
		$registerUserSQL		=	"insert into tbl_orderingusers(ou_username, ou_password, ou_name, ou_department, ou_contact, ou_status, ou_dateRegistered,  ou_IPAddress) values(:username, :password, :name, :department, :contact, 1 , now(), 'administrator')";
		
		$registerUserQuery		=	$conn->prepare($registerUserSQL);
		$registerUserQuery->bindParam(":username",	$_POST['ou_username'],		PDO::PARAM_STR,255);
		$registerUserQuery->bindParam(":password",	sha1($_POST['ou_password']),PDO::PARAM_STR,255);
		$registerUserQuery->bindParam(":name",		$_POST['ou_name'],			PDO::PARAM_STR,255);
		$registerUserQuery->bindParam(":department",$_POST['ou_department'],	PDO::PARAM_STR,255);
		$registerUserQuery->bindParam(":contact",	$_POST['ou_contact'],		PDO::PARAM_STR,255);
		$registerUserQuery->execute();
		
		header("location: ".$_SERVER['PHP_SELF']);
	}
	if(isset($_POST['bu_username'], $_POST['bu_name'],  $_POST['bu_password'], $_POST['bu_cpassword'], $_POST['bu_contact'])){
		
		$registerUserSQL		=	"insert into tbl_backendusers(bu_username, bu_password, bu_name, bu_contact) values(:username, :password, :name, :contact)";
		
		$registerUserQuery		=	$conn->prepare($registerUserSQL);
		$registerUserQuery->bindParam(":username",	$_POST['bu_username'],		PDO::PARAM_STR,255);
		$registerUserQuery->bindParam(":password",	sha1($_POST['bu_password']),PDO::PARAM_STR,255);
		$registerUserQuery->bindParam(":name",		$_POST['bu_name'],			PDO::PARAM_STR,255);
		$registerUserQuery->bindParam(":contact",	$_POST['bu_contact'],		PDO::PARAM_STR,255);
		$registerUserQuery->execute();
		
		header("location: ".$_SERVER['PHP_SELF']);
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
	var options	=	{};
	$('#myModal').modal(options);
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
            	<?php 
					$getUserSQL	=	"select * from tbl_orderingusers where ou_status = 1";
					$getUserQuery	=	$conn->query($getUserSQL);
					$queryUsers		=	$getUserQuery->fetchAll(PDO::FETCH_ASSOC);
				?>
                <div class="accordion" id="accordion2">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                           	 Ordering Users
                            </a>
                        </div>
                        <div id="collapseOne" class="accordion-body collapse in">
                            <div class="accordion-inner">
                           	 	<table class="table table-condensed table-hover">
                                    <thead>
                                    	<tr>
                                        	<th colspan="8">
                                            	<a href="#addNewOrderingUser" role="button" class="btn btn-success btn-mini" data-toggle="modal"> <i class="icon-user icon-white"></i> Add New Ordering User</a>
                                            </th>
                                        </tr>
                                        <tr>
                                        	<th> User ID </th>
                                            <th> Username </th>
                                            <th> Name </th>
                                            <th> Department </th>
                                            <th> Contact </th>
                                            <th> Date Registered </th>
                                            <th> IP Address </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php if(isset($queryUsers) && !empty($queryUsers)){ ?>
                                        		<?php foreach( $queryUsers as $key => $values ): ?>
                                                    <tr>
                                                        <td> <?php echo $values['ou_id']; ?> </td>
                                                        <td> <?php echo $values['ou_username']; ?> </td>
                                                        <td> <?php echo $values['ou_name']; ?> </td>
                                                        <td> <?php echo $values['ou_department']; ?> </td>
                                                        <td> <?php echo $values['ou_contact']; ?> </td>
                                                        <td> <?php echo $values['ou_dateRegistered']; ?> </td>
                                                        <td> <?php echo $values['ou_IPAddress']; ?></td>
                                                        <td>
                                                            <a href="edituser.php?ou=ou&id=<?php echo $values['ou_id']; ?>" class="btn btn-mini btn-primary"> <i class="icon-edit icon-white"> </i> Edit  </a>
                                                            <a href="deleteuser.php?ou=ou&id=<?php echo $values['ou_id']; ?>" class="btn btn-mini btn-danger"> <i class="icon-remove icon-white"> </i> Delete  </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
										<?php }else{ ?>
                                        		<tr >
                                                	<td colspan="7"><b style="color:red;"> No User Found. </b></td>
                                                </tr>
										<?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                            	Backend Users
                            </a>
                        </div>
                        <div id="collapseTwo" class="accordion-body collapse">
                        	<?php 
								$getBUserSQL	=	"select * from tbl_backendusers";
								$getBUserQuery	=	$conn->query($getBUserSQL);
								$queryBUsers		=	$getBUserQuery->fetchAll(PDO::FETCH_ASSOC);
							?>
                            <div class="accordion-inner">
                            	<table class="table table-condensed table-hover">
                                    <thead>
                                    	<tr>
                                        	<th colspan="6">
                                            	<a href="#addNewBackendUser" role="button" class="btn btn-success btn-mini" data-toggle="modal"> <i class="icon-user icon-white"></i> Add New Backend User</a>
                                            </th>
                                        </tr>
                                        <tr>
                                        	<th> User ID</th>
                                            <th> Username </th>
                                            <th> Name </th>
                                            <th> Contact </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php if(isset($queryBUsers) && !empty($queryBUsers)){ ?>
                                        	<?php foreach($queryBUsers as $keys => $valueses): ?>
                                                <tr>
                                                    <td> <?php echo $valueses['bu_id']; ?> </td>
                                                    <td> <?php echo $valueses['bu_username']; ?> </td>
                                                    <td> <?php echo $valueses['bu_name']; ?> </td>
                                                    <td> <?php echo $valueses['bu_contact']; ?> </td>
                                                    <td>
                                                        <a href="editbuser.php?bu=bu&id=<?php echo $valueses['bu_id']; ?>" class="btn btn-mini btn-primary"> <i class="icon-edit icon-white"> </i> Edit  </a>
                                                        <a href="deleteuser.php?bu=bu&id=<?php echo $valueses['bu_id']; ?>" class="btn btn-mini btn-danger"> <i class="icon-remove icon-white"> </i> Delete  </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php }else{ ?>
                                        		<tr>
                                                	<td  colspan="5"><b style="color:red;"> No User Found. </b></td>
                                                </tr>
                                        <?php } ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="clearfix">
        	<p>Copyright @Leyte Normal University</p>
        </footer>
        
         
        <!-- Front End Users  -->
        <form class=" form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div id="addNewBackendUser" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h3 id="myModalLabel"> Backend User </h3>
            </div>
        <div class="modal-body">
      	  			<div class=" alert alert-info"> Note All Fields Are Required  <b style="color:red;">( * )</b>
                    <a class='close' data-dismiss='alert' href='#'>&times;</a>
                    </div>
                	<fieldset>
                    	<legend> User Information </legend>
                        <div class="control-group">
                    		<label class="control-label"> Name <b style="color:red;">( * )</b></label>
                            <div class="controls">
                                <input type="text" class="span4" name="bu_name" placeholder="Username" value="<?php if(isset($_POST['name'])){echo $_POST['name']; } ?>" />
                            </div>
                        </div>
                        <div class="control-group">
                    		<label class="control-label"> Cellphone #</label>
                            <div class="controls">
                                <input type="text" class="span4" name="bu_contact" placeholder="Cellphone Number" value="<?php if(isset($_POST['contact'])){echo $_POST['contact'];} ?>" />
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                    	<legend> Login Information </legend>
                        <div class="control-group">
                    		<label class="control-label"> Username <b style="color:red;">( * )</b></label>
                            <div class="controls">
                                <input type="text" class="span4" name="bu_username" placeholder="Username" value="<?php if(isset($_POST['username'])){echo $_POST['username'];} ?>" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"> Password <b style="color:red;">( * )</b></label>
                            <div class="controls">
                                <input type="password" class="span4" name="bu_password" placeholder="Password" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"> Confirm Password <b style="color:red;">( * )</b></label>
                            <div class="controls">
                                <input type="password" class="span4" name="bu_cpassword" placeholder="Confirm Password" />
                            </div>
                        </div>
                    </fieldset>
                
        </div>
            <div class="modal-footer">
            <button class="btn btn-primary" type="submit"><i class="icon-white icon-ok"></i> Save</button>
            <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true"> <i class="icon-white icon-remove"></i>  Close</button>
            
            </div>
        </div>
        </form>
        <!-- End of Front End Users -->
        
        
        <!-- Backend Users -->
        <form class=" form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div id="addNewOrderingUser" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h3 id="myModalLabel"> Ordering User </h3>
            </div>
        <div class="modal-body">
      	  			<div class=" alert alert-info"> Note All Fields Are Required  <b style="color:red;">( * )</b>
                    <a class='close' data-dismiss='alert' href='#'>&times;</a>
                    </div>
                	<fieldset>
                    	<legend> User Information </legend>
                        <div class="control-group">
                    		<label class="control-label"> Name <b style="color:red;">( * )</b></label>
                            <div class="controls">
                                <input type="text" class="span4" name="ou_name" placeholder="Name" value="<?php if(isset($_POST['name'])){echo $_POST['name']; } ?>" />
                            </div>
                        </div>
                        <div class="control-group">
                    		<label class="control-label"> Department <b style="color:red;">( * )</b></label>
                            <div class="controls">
                                <input type="text" class="span4" name="ou_department" placeholder="Department" value="<?php if(isset($_POST['department'])){echo $_POST['department'];} ?>" />
                            </div>
                        </div>
                        <div class="control-group">
                    		<label class="control-label"> Cellphone #</label>
                            <div class="controls">
                                <input type="text" class="span4" name="ou_contact" placeholder="Cellphone Number" value="<?php if(isset($_POST['contact'])){echo $_POST['contact'];} ?>" />
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                    	<legend> Login Information </legend>
                        <div class="control-group">
                    		<label class="control-label"> Username <b style="color:red;">( * )</b></label>
                            <div class="controls">
                                <input type="text" class="span4" name="ou_username" placeholder="Username" value="<?php if(isset($_POST['username'])){echo $_POST['username'];} ?>" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"> Password <b style="color:red;">( * )</b></label>
                            <div class="controls">
                                <input type="password" class="span4" name="ou_password" placeholder="Password" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"> Confirm Password <b style="color:red;">( * )</b></label>
                            <div class="controls">
                                <input type="password" class="span4" name="ou_cpassword" placeholder="Confirm Password" />
                            </div>
                        </div>
                    </fieldset>
                
        </div>
            <div class="modal-footer">
            <button class="btn btn-primary" type="submit"><i class="icon-white icon-ok"></i> Save</button>
            <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true"> <i class="icon-white icon-remove"></i> Close</button>
            </div>
        </div>
        </form>
        <!-- End of Backend End Users -->
</body>
</html>
