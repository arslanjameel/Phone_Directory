<?php
    include 'sessioncheck.php';
    // add database connection
    include("include/connect.php");
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
                <a href="dashbord.php"><button >Back</button></a>
                <br/>
                <h4>My Contacts share with</h4><br/>
                <table border="1">
                        <thead>
                            <tr>
                                <th>Phone no.</th>
                                <th>Share with</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php 

                                    $sql1 = "select * from sharecontact where user_id=$id1";
                                    $result1 = mysqli_query($conn,$sql1);
                                    if(mysqli_num_rows( $result1 ) > 0 ){
                                        while ( $row1 = mysqli_fetch_assoc( $result1) ) {
                                            $sid=$row1['share_user_id'];
                                            $sql2 = "select * from user where id=$sid";
                                            $result2 = mysqli_query($conn,$sql2);
                                            $row2 = mysqli_fetch_assoc( $result2);
                                            if(mysqli_num_rows( $result2 ) > 0 ){
                                                echo "<td>$row1[cell]</td>";
                                                echo "<td>$row2[name]</td>";
                                            }
                                        }
                                    }
                                    else{
                                        echo "<td colspan='2'> you not Share with anyone </td>";
                                    }
                                ?>
                            </tr>
                        </tbody>
                </table>
                <br/>
                
                <h4>Others share Contact with me</h4><br/>
                <table border="1">
                        <thead>
                            <tr>
                                <th>Phone no.</th>
                                <th>Share User Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php 

                                    $sql1 = "select * from sharecontact where share_user_id=$id1";
                                    $result1 = mysqli_query($conn,$sql1);
                                    if(mysqli_num_rows( $result1 ) > 0 ){
                                        while ( $row1 = mysqli_fetch_assoc( $result1) ) {
                                            $sid=$row1['share_user_id'];
                                            $sql2 = "select * from user where id=$sid";
                                            $result2 = mysqli_query($conn,$sql2);
                                            $row2 = mysqli_fetch_assoc( $result2);
                                            if(mysqli_num_rows( $result2 ) > 0 ){
                                                echo "<td>$row1[cell]</td>";
                                                echo "<td>$row2[name]</td>";
                                            }
                                        }
                                    }
                                    else{
                                        echo "<td colspan='2'> Not Share with you </td>";
                                    }
                                ?>
                            </tr>
                        </tbody>
                </table>
            </div>
        </div>
        <?php include("include/footer.php") ?>
    </body>
</html>