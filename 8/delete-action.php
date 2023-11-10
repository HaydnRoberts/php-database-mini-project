<?php
// Include connection code 
include "db.php";
// Initialize connection
$conn = connect();
delete_pet($_GET["id"], $conn);

header("Location: http://localhost/php-database-mini-project/8/edit-pets.php?msg=delete-success");
?>
</body>
</html>