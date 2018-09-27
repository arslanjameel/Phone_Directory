<?php
if(isset($_REQUEST['submit'])){
		session_start();
		session_unset();
	session_destroy();
	
	}
$c=0;
	if(isset($_REQUEST['login'])){
		
		$class='none';
$username=$_REQUEST['username'];
$password=$_REQUEST['password'];
include("include/connect.php");
$sql="select * from registration where username='$username' and password='$password' ";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($result)){
	
	
	
	session_start();
	$class=$row['class'];
	$_SESSION["username"]=$row['username'];
	$_SESSION["id"]=$row['id'];
	$_SESSION["class"]=$class;
		
	
	
	
	
	
}
if($class=='admin'){
	
	header("Location: http://localhost/Project/admin.php");
	
}
		else if($class=='user'){
			header("Location: http://localhost/Project/user.php");
		}
		else{
			echo"<script>alert('username or password wrong')</script>";
		}
		 
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login Page</title>


<link rel="stylesheet" href="style.css"/>

</head>

<body>
<div class="wrapper">
<!-- This is Header-->
	<?php include("include/header.php") ?>
	
	<div id="loginpage">
		<form action="Login.php" target="_self" method="post" id="loginform">
			<input type="text" name="username" placeholder="Username" id="luname" /><br>
			<input type="password" name="password" placeholder="password" id="lpass" /><br>
			<input type="submit" value="Login" name="login" id="lbtn"/>
			<br>
			<a href="Register.php">Register now</a>
			
		</form>
		
	</div>
	

	
</div>

	
				
	
	<?php include("include/footer.php") ?>
	

</body>
</html>
