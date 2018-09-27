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
    $nameErr = $emailErr = $passwordErr = "";
    $name = $email = $password= "";
    // if register button is clicked
    if(isset( $_POST['submit'])){
        // initialize flag 
        $problem=true;
        //check form is null
        if (empty($_POST["name"])) {
            $problem=false;
            $nameErr = "Name is required";
        } else {
            $name = $_POST["name"];
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                $problem=false;
                $nameErr = "Only letters and white space allowed";
            }
        }
        //check email
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
        //check password
        if (empty($_POST["password"])) {
            $problem=false;
            $passwordErr = "Password is required";
        } else {
            $password = $_POST["password"];
        }
        // check email alrady exist 
        $sql="select * from user where email='$email' ";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows( $result ) == 1 ){
            $problem=false;
            $emailErr ="Email already exist";
        }
        // if no error then add data in database
        if($problem){
            $query="insert into user (name,email,password) values('$name','$email','$password')";
            if(mysqli_query($conn,$query)){
                echo "<script>alert('Registration successful')</script>";
                //redirect to login page
                echo "<script type='text/javascript'>window.location.href = 'index.php';</script>";
                exit();
            }else{
                echo "<center class='error'><h3> username and email already exist</h3></center>";
            }      
        }
    }
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Register</title>
        <link rel="stylesheet" href="style.css"/>
    </head>

    <body>
        <div class="wrapper">
             <!-- This is Header-->
            <?php include("include/header.php"); ?>

            <div id="loginpage">
                <div id="loginform">
                    <p><span class="error">* required field</span></p>
                    <form action="Register.php" target="_self" method="post" >
                        <input type="text" name="name" placeholder="Name" value="<?php echo $name;?>" id="luname" required />
                        <span class="error" >* <?php echo $nameErr;?></span><br>
                        <input type="email" name="email" placeholder="Email" id="lpass" value="<?php echo $email;?>" required/>
                        <span class="error" >* <?php echo $emailErr;?></span><br>
                        <input type="password" name="password" placeholder="Password"  id="lpass" required/>
                        <span class="error" >* <?php echo $passwordErr;?></span><br>
                        <input type="submit" value="Register" name="submit" id="lbtn" />
                    </form>
                    <br>
                    <a href="index.php"><button id="lbtn">Log in</button></a>
                </div>
            </div>

        </div>
        <?php include("include/footer.php") ?>
    </body>
</html>