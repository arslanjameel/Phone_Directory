<?php
    include 'sessioncheck.php';
    // add database connection
    include("include/connect.php");
    //check data found against the id
    if(isset($_GET['id'])){
        $id = $_GET[ 'id' ];
        $sql = "SELECT * FROM phone where id='$id' && user_id=$id1 ";
        $result=mysqli_query($conn,$sql);
		$row=mysqli_fetch_assoc($result);
        if(mysqli_num_rows( $result ) != 1){
            echo "<script>alert('No data found')</script>";
            //redirect to back
            echo "<script type='text/javascript'>window.location.href = 'dashbord.php';</script>";
            exit();
        }
    }
    //if click back button
    if(isset( $_POST['back'])){
        echo "<script type='text/javascript'>window.location.href = 'dashbord.php';</script>";
        exit();
    }
    // if add button is clicked
    if(isset( $_POST['share'])){
        $share_user_id = $_POST['username'];  // Storing Selected Value In Variable
        $phone=$_POST['phone'];
        $query="insert into sharecontact (cell,share_user_id,user_id) values('$phone',$share_user_id,'$id1')";
            if(mysqli_query($conn,$query)){
                echo "<script>alert('Share successful')</script>";
                //redirect to login page
                echo "<script type='text/javascript'>window.location.href = 'dashbord.php';</script>";
                exit();
            }else{
                echo "<center class='error'><h3> try again</h3></center>";
            }      
    }
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>share</title>
        <link rel="stylesheet" href="style.css"/>
    </head>

    <body>
        <div class="wrapper">
            <!-- This is Header-->
            <?php include("include/header.php"); ?>
            <!-- This is Body contant-->
            <div class="wrapper">
                <table border="1">
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>" >
                        <thead>
                            <tr>
                                <th>Phone no.</th>
                                <th>Share with</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <?php echo $row['cell']; ?>
                                    <input type="hidden" name="phone" value="<?php echo $row['cell']; ?>">
                                </td>
                                <td>
                                    <?php 
                                        
                                        $sql1 = "select * from user where id!=$id1";
                                        $result1 = mysqli_query($conn,$sql1);
                                        if(mysqli_num_rows( $result1 ) > 0 ){
                                            echo "<select name='username'>";
                                            while ( $row1 = mysqli_fetch_assoc( $result1) ) {
                                                    echo "<option value='$row1[id]'>$row1[name]</option>";
                                                }
                                            echo "</select>";
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" value="Back" name="back">
                                </td>
                                <td>
                                    <input type="submit" value="Share" name="share"> 
                                </td>
                            </tr>
                        </tbody>
                    </form>
                </table>
            </div>
        </div>
        <?php include("include/footer.php") ?>
    </body>
</html>