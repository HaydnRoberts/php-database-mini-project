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
include "db.php";
// Initialize connection
$conn = connect();
$query = "UPDATE pets SET name=?, age=?, type=? WHERE id=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssss", $_POST['name'], $_POST['age'], $_POST['type'], $_POST['id']);
$stmt->execute();

header("Location: http://localhost/php-database-mini-project/8/edit-pets.php?id={$_POST["id"]}&msg=success");
?>
</body>
</html>