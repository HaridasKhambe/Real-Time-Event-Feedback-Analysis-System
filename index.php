<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<style type="text/css">
	:root
{
	  --bgcolor-1:#34495e ;
	   --bgcolor-2:#2f3640;
	   --ahover:#3498db;
}

body{
	font-family:montserrat;
	

}

*{
	padding: 0;
	margin: 0;
}
nav
{
/*	position:fixed;*/
	height: 80px;
	width:100%;
	background:var(--bgcolor-1);
	z-index:9999;

}
nav .title
{
	color:white;
	font-size:35px;
	font-weight:bold;
	padding:0 100px;
	line-height:80px;
}

.center
{
	position: absolute;
	top:50%;
	left:50%;
	transform:translate(-50%, -50%);

	width:400px;
	background:white;
	border-radius:10px;
	border:2px solid gray;
	background-color:var(--bgcolor-1);
	line-height:40px;


}
.center h1
{
	text-align: center;
	padding: 0 0 20px 0;
	border-bottom:1px solid silver;
	color:white;

}

.center form
{
	padding:10px 40px;
	box-sizing:border-box;

}

form .txt_field{
	position:relative;
	margin:30px 0;
	background-color: var(--bgcolor-2);
	border-bottom: 2px solid var(--ahover);
	border-radius:25px;
}

.txt_field input
{
	width:100%;
	padding: 0 15px;
	height: 40px;
	font-size:16px;
	border: none;
	background: none;
	outline: none;
	color:white;


	
}

.txt_field .selectTag
{
	
	width:100%;
	padding: 0 15px;
	height: 40px;
	font-size:16px;
	border: none;
	background: none;
	outline: none;
	color:gray;


}
.txt_field .selectTag option
{
	font-size:16px;
	color:white;
	background: var(--bgcolor-1);
	height: 80px;
	padding:80px
	border-bottom:2px solid var(--bgcolor-2);

	
}

.forgot-pwd a ,.reg-now a
{
	width:100%;
	padding: 0 15px;
	height: 40px;
	font-size:18px;
	border: none;
	background: none;
	outline: none;
	color:white;
}
.reg-now label 
{
	width:100%;
	padding: 0 15px;
	height: 40px;
	font-size:16px;
	border: none;
	background: none;
	outline: none;
	color: white;

}

.txt_field input:hover {
/*	padding-left:10px ;*/
	
	padding-left:20px;
	transition: .5s;
	color:white;


}

input[type="submit"]{
	width:100%;
	height:50px;
	border:1px solid gray;
	background: var(--bgcolor-2);
	border-radius:25px;
	font-size:18px;
	color:#e9f4fb;
	font-weight:700;
	cursor:pointer;
	outline: none;
	margin-bottom:20px;

}

input[type="submit"]:hover{
	border-color:white;
	transition: .5s;
}

@media (max-width:909px)
{

nav .title
{
	
	font-size:20px;
	padding:0 26px;
	
}


}
</style>
<body>
	
	<nav>
		<label class="title">Real Time Feedback Analysis System</label>
	</nav>
			
	<div class="center">
		<h1>Login</h1>
		<form method="POST" name="login-form" action="partials/auth.php" id="#login-form">

			<div class="txt_field">
				<input type="email" name="username" placeholder="Username" required>
				
			</div>

			
			<div class="txt_field">
				<input type="password" name="password" placeholder="Password" required>
				
			</div>

			<div class="txt_field">
            <select name="usertype" class="selectTag" required>
            
            		<option  value="" disabled selected>Select User Type</option>
                	<option  value="user">User</option>
                	<option  value="admin">Admin</option>
         
            </select>
        	</div>

			<div class="login-btn">
				<input type="submit" name="l-btn" value="Login">
			</div>

			<div class="forgot-pwd">
        		<a href="#">Forgot Password</a>
        	</div>

        	<div class="reg-now">
        		<label>Don't have an account?</label>
        		<a href="partials/register.php">Register now</a>
        	</div>

		</form>
		
	</div>

</body>
</html>