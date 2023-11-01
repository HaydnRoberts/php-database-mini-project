<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    // Include connection code 
    include "..\8\db.php";
    // Initialize connection
    $conn = connect();
    
    // sql query
    $query = "INSERT INTO pets(name, age, type) VALUES(?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $_POST["name"], $_POST["age"], $_POST["type"]);
    $stmt->execute();

    // Output 
    echo "You have successfully added " . $_POST["name"] . " to the database";
    
    ?>
</body>
</html>