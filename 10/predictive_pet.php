<?php
    include '..\8\db.php';  // Include your database connection file

    if(isset($_POST['current'])) {
        $conn = connection();
        $current = $_POST['current'];
        echo predictive_pet($current, $conn);
        exit();
    }

?>
