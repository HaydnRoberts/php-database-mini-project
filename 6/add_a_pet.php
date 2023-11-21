<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mid-Cornwall Vet Center</title>
</head>
<body>
    <?php
    // Include connection code 
    include "..\8\db.php";
    // Initialize connection
    $conn = connect();
    
    // sql query
    $query = "INSERT INTO pets(name, age, type, owner_first, owner_last) VALUES(?,?,?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssss", $_POST["name"], $_POST["age"], $_POST["type"], $_POST["owner_first"], $_POST["owner_last"]);
    $stmt->execute();

    // Output 
    echo "You have successfully added " . $_POST["name"] . " to the database";
    header("Location: http://localhost/php-database-mini-project/8/edit-pets.php?msg=add-success");
    
    ?>
</body>
</html>