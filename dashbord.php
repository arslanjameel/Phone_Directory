<?php
    include 'sessioncheck.php';
    // add database connection
    include("include/connect.php");
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>dashbord</title>
        <link rel="stylesheet" href="style.css"/>
    </head>

    <body>
        <div class="wrapper">
            <!-- This is Header-->
            <?php include("include/header.php"); ?>
            <!-- This is Body contant-->
            <div class="wrapper">
                <a href="addphone.php"><button>Add Phone</button></a> <br/><br/>
                <table border="1">
                    <thead>
                        <tr>
                            <th>Sr. No</th>
                            <th>Phone Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sql="select * from phone where user_id='$id1' ORDER BY id DESC";
                            $result=mysqli_query($conn,$sql);
                            if(mysqli_num_rows( $result ) > 0 ){
                                $sr=1;
                                while ( $row = mysqli_fetch_assoc( $result) ) {
                                    echo "<tr>";
                                    echo "<td>$sr</td>";
                                    echo "<td>$row[cell]</td>";
                                    echo "<td>
                                            <a href='edit.php?id=$row[id]'><button>Edit</button></a>
                                            <a href='share.php?id=$row[id]'><button>Share</button></a>
                                            </td>";
                                    echo "</tr>";
                                    $sr++;
                                }
                            }
                            else{
                                echo "<td colspan='3'>No Data</td>";
                            }
                        ?>
                    </tbody>
                </table> 
            </div>
        </div>
        <br/>
        <?php include("include/footer.php") ?>
    </body>
</html>