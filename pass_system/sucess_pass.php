<?php

include "../admin.php";
 include "../header.php";
//  include "../admin.php";
if(!isset($_SESSION)) {
    session_start();
}
?>

 
    <?php
    $id = $_POST['collegeid'];
    echo "$id";
    if(isset($_SESSION['id'])){
        $username = $_SESSION['id'];
        echo $username;
        $dsa = connect();
        $query = "SELECT * FROM `passgeneration` WHERE status='inactive'";
        
    }

    ?>

    





<?php
    include "../footer.php";
?>