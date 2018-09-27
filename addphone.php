<?php
    include 'sessioncheck.php';
    // add database connection
    include("include/connect.php");
    // declare variable
    $phoneErr = $phone = "";
    //if click back button
    if(isset( $_POST['back'])){
        echo "<script type='text/javascript'>window.location.href = 'dashbord.php';</script>";
        exit();
    }
    // if add button is clicked
    if(isset( $_POST['add'])){
        // initialize flag 
        $problem=true;
        //assign value to variable
        $phone = $_POST["phone"];
        //check form is null
        if (empty($phone)) {
            $problem=false;
            $phoneErr = "Phone is required";
        } else {
            // check phone no formate
            if (!preg_match("/^[0]{1}[3]{1}[0-9]{9}$/",$phone)) {
                $problem=false;
                $phoneErr = "format is invalid";
            }
        }
        // check phone no alrady exist 
        $sql="select * from phone where cell='$phone' ";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows( $result ) == 1 ){
            $problem=false;
            $phoneErr ="Phone no. already exist";
        }
        // if no error then add data in database
        if($problem){
            $query="insert into phone (cell,user_id) values('$phone','$id1')";
            if(mysqli_query($conn,$query)){
                echo "<script>alert('Add successful')</script>";
                //redirect to back
                echo "<script type='text/javascript'>window.location.href = 'dashbord.php';</script>";
                exit();
            }else{
                $phoneErr = "Phone not add try again";
            }      
        }
    }
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Add Phone</title>
        <link rel="stylesheet" href="style.css"/>
    </head>

    <body>
        <div class="wrapper">
            <!-- This is Header-->
            <?php include("include/header.php"); ?>
            <!-- This is Body contant-->
            <div class="wrapper">
                <table>
                    <form action="addphone.php" method="post">
                        <tr>
                            <td>Phone no.</td>
                            <td>
                                <input type="tel" name="phone" placeholder="03001122333" pattern="[0]{1}[3]{1}[0-9]{9}" 
                                   title="phone format is 03001122333" value="<?php echo $phone;?>">
                            </td>
                            <td><span class="error" ><?php echo $phoneErr;?></span></td>
                        </tr>
                        <br/>
                        <tr>
                            <td></td>
                            <td><input type="submit" value="Back" name="back"> <input type="submit" value="Add" name="add"> </td>
                        </tr>
                    </form>
                </table>
            </div>
        </div>
        <?php include("include/footer.php") ?>
    </body>
</html>