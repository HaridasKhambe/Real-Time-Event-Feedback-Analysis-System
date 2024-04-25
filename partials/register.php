
<?php session_start();
	   
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<style type="text/css">
:root{

		--bgcolor-1:#34495e ;
	   --bgcolor-2:#2f3640;
	   --ahover:#3498db;
}

*{
		padding:0;
		margin:0;
}
body{
	font-family:montserrat;
	

}


	.reg-form
	{
		background: var(--bgcolor-1);
		color: white;
	}


nav
{
/*	position:fixed;*/
	height: 80px;
	width:100%;
	background:var(--bgcolor-1);
	z-index:9999;

}

.alert
{
/*	margin-top:10px;*/
	width:70%;
	margin-left:50%;
	transform:translate(-50%, 10%);
}

.alert #l-btn
{
	width:100px;
	float:right;
}

nav .title
{
	color:white;
	font-size:35px;
	font-weight:bold;
	padding:0 100px;
	line-height:80px;
}

@media (max-width:909px)
{
	.can-btn, .suc-btn
	{
		margin-top:20px;
	}

	.alert
{
/*	margin-top:10px;*/
	width:85%;
	font-size:16px;
	
}

	.alert #l-btn
{
	width:100px;
	float:right;
	font-size:16px ;
}


}
</style>
</head>
<body>

	<nav>
		<label class="title">Real Time Feedback Analysis System</label>
	</nav>


<!-- Display error messages -->
<?php if (isset($_SESSION['error'])){ ?>
    <div class="alert alert-danger mt-10" role="alert">
        <?php echo $_SESSION['error']; }?>
    </div>
 <?php if (isset($_SESSION['success'])){ ?>
    <div class="alert alert-success mt-10" role="alert">
        <?php echo $_SESSION['success']; 

        echo '<button type="button" id="l-btn" class="btn btn-outline-success form-control " onclick="window.location.href=\'../index.php\'" >Login</button>';


    }?> 
    </div>
    <?php   unset($_SESSION['error']); ?> <!-- Clear the error message -->
    <?php   unset($_SESSION['success']); ?>
<?php ?>


<div class="container">
	<div class="row justify-content-center mt-5">
		<div class="col-xs-12 col-sm-8 col-md-6 col-lg-7">
			<div class="card reg-form">
				<div class="card-header">
					<h3 class="card-title">Registration Form</h3>
				</div>
					<div class="card-body">
						<form method="POST" action="add-registration.php">
							<div class="form-group">
 							    <label>Username</label>
 							    <input type="email" name="username" class="form-control" placeholder="enter unique email address" required>
 						    </div>

 						    <div class="form-group">
 							    <label>Password</label>
 							    <input type="password" name="password" class="form-control" placeholder="enter your Password" required>
 						    </div>

 						    
 							<div class="form-group">
    							<label>User Type</label>
    							<select name="userType" class="form-control" required>
        							<option value="" disabled selected>Select User Type</option>
        							<option value="user">User</option>
        							<option value="admin">Admin</option>
    							</select>
							</div>

							<div class="row ">
           					 <div class="col-sm-6">
               					 <button type="button" class="btn btn-outline-danger form-control can-btn" onclick="window.location.href='../index.php'">Cancel</button>
           					 </div>
            					<div class="col-sm-6">
                					<button type="submit" class="btn btn-outline-success form-control suc-btn">Register</button>
            					</div>
        					</div>
 						  

						</form>
				</div>
			</div>
		</div>
	</div>
</div>

	
</body>
</html>