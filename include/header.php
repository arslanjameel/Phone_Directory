<div id="header">
    <div id="menu-bar">
        <ul>
            <li><a href="http://localhost:81/phonedirectory/">HOME</a></li>
            <?php 
                if(isset($_SESSION['log']) && $_SESSION['log']==="true"){
                    echo "<li><a href='http://localhost:81/phonedirectory/sharecontact.php'>Share Contact</a></li>";
                    echo "<li><a href='http://localhost:81/phonedirectory/logout.php'>Log Out</a></li>";
            }?>
        </ul>
    </div>
</div>