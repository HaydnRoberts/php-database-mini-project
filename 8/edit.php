

<?php
// Include connection code 
include "db.php";
// Initialize connection
$conn = connect();

// Retrieve pet's ID from the URL parameter
$petId = $_GET['id'];

// Query to get owner's first and last name
$sqlOwner = "SELECT owner_first, owner_last FROM pets WHERE id=?";
$stmtOwner = $conn->prepare($sqlOwner);
$stmtOwner->bind_param("i", $petId);
$stmtOwner->execute();
$resultOwner = $stmtOwner->get_result();
$ownerInfo = $resultOwner->fetch_assoc();

// Retrieve owner's first and last name
$ownerFirst = $ownerInfo['owner_first'];
$ownerLast = $ownerInfo['owner_last'];

// Query to get all pets belonging to the owner
$sqlPets = "SELECT * FROM pets WHERE owner_first=? AND owner_last=?";
$stmtPets = $conn->prepare($sqlPets);
$stmtPets->bind_param("ss", $ownerFirst, $ownerLast);
$stmtPets->execute();
$resultPets = $stmtPets->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\8\style.css">
    <title>Mid-Cornwall Vet Center</title>
</head>
<body>
    <?php
    include "..\partials\menu.php"; 
    ?>

    <h2 class="formtitle"><?= $ownerFirst ?> <?= $ownerLast ?>'s Pets</h2>

    <?php
    // Display each pet belonging to the owner
    while ($pet = $resultPets->fetch_assoc()) {
    ?>
        <form class="editform" action="edit-action.php" method="POST">
            <h2>Edit <?= $pet['name'] ?></h2>
            <p>
                Pet Name:
                <input type="text" name="name" value="<?= $pet["name"] ?>">
            </p>
            <p>
                Age:
                <input type="text" name="age" value="<?= $pet["age"] ?>">
            </p>
            <p>
                Type:
                <input type="text" name="type" value="<?= $pet["type"] ?>">
            </p>
            <input type="hidden" name="id" value="<?= $pet["id"] ?>">
            <hr>

            <p>
                <input type="submit" class="submit" value="Update">
            </p>
        </form>
    <?php
    }

    // Free the result sets
    $resultOwner->free_result();
    $resultPets->free_result();

    // Close the connections
    $conn->close();
    ?>
</body>
</html>
