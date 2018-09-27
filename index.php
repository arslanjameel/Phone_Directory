<?php
    session_start();
    //check if already login
    if(isset($_SESSION['log']) && $_SESSION['log']==="true")
    {
        echo "<script type='text/javascript'>window.location.href = 'dashbord.php';</script>";
        exit();
    }
    // add database connection
    include("include/connect.php");
    // declare variable
    $emailErr = $passwordErr = "";
    $email = $password= "";
	// if login button is clicked
    if ( isset( $_POST[ 'login' ] ) ){
        // initialize flag 
        $problem=true;
        // check form is null
        if (empty($_POST["email"])) {
            $problem=false;
            $emailErr = "Email is required";
        } else {
            $email = $_POST["email"];
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format"; 
                $problem=false;
            }
        }
        if (empty($_POST["password"])) {
            $problem=false;
            $passwordErr = "Password is required";
        } else {
            $password = $_POST["password"];
        }
        // check data from database
        if($problem){  
            $sql="select * from user where email='$email' and password='$password' ";
            $result=mysqli_query($conn,$sql);
            if(mysqli_num_rows( $result ) == 1 ){
                while ( $row = mysqli_fetch_assoc( $result) ) {
                        $Id = $row[ 'id' ];
                    }
                $_SESSION[ 'login_user' ] = $email;  // Initializing Session
                $_SESSION['id']= $Id;
				$_SESSION[ 'log' ] = "true";
                // redirect to page
                echo "<script type='text/javascript'>window.location.href = 'dashbord.php';</script>";
                exit();
            }
            else{
                echo"<script>alert('username or password wrong')</script>";
            } 
        }
	}
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>index</title>
        <link rel="stylesheet" href="style.css"/>
    </head>

    <body>
        <div class="wrapper">
            <!-- This is Header-->
            <?php include("include/header.php"); ?>
            <!-- This is Body contant-->
            <div id="loginpage">
                <div id="loginform">
                    <p><span class="error">* required field</span></p>
                    <!-- login form  -->
                    <form action="index.php" method="POST" >
                        <input type="email" name="email" placeholder="Email" value="<?php echo $email;?>" id="luname" />
                        <span class="error" >* <?php echo $emailErr;?></span><br>
                        <input type="password" name="password" placeholder="password" id="lpass" />
                        <span class="error" >* <?php echo $passwordErr;?></span><br>
                        <input type="submit" value="Login" name="login" id="lbtn"/>
                    </form>
                    <br>
                    <a href="Register.php"><button id="lbtn">Register now</button></a>
                </div>                
	       </div>
        </div>
        <?php include("include/footer.php") ?>
    </body>
</html>