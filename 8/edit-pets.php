<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mid-Cornwall Vet Center</title>
    <link rel="stylesheet" href="style.css">
        
</head>
<body> 
    <?php
    include "..\partials\menu.php"; 
    ?>
    <h2>Registered pets</h2>
    <table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Age</th>
        <th>Type</th>
        <th></th>
        <th></th>
    </tr>
    <?php
    // Include connection code 
    include "db.php";
    // Initialize connection
    $conn = connect();
    $sql = "SELECT * FROM pets";
    $result = $conn->query($sql);
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) { 
    ?>
        <tr>
        <td> <?= $row["id"] ?> </td>
        <td> <?= $row["name"] ?> </td>
        <td> <?= $row["age"] ?> </td>
        <td> <?= $row["type"] ?> </td>
        <td> <a href="edit.php?id=<?= $row["id"] ?>" class="button edit">Edit</a> </td>
        <td> <a href="delete-action.php?id=<?= $row["id"] ?> " class="button delete">Delete</a> </td>
        </tr>
    <?php
    }
    $result->free_result();
    $conn->close();
    ?>
    </table>
    <?php if(isset($_GET["msg"]) && $_GET["msg"]=="success"): ?>
        <div class="success">
            Updated Successfully.
        </div>
    <?php endif ?>
    <?php if(isset($_GET["msg"]) && $_GET["msg"]=="delete-success"): ?>
        <div class="success">
            Deleted Successfully.
        </div>
    <?php endif ?>

</body>
</html>