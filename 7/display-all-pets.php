<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Pets</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            max-width: 800px;
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 20px;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #333;
            color: #ffffff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <h1>Registered pets</h1>
    <table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Age</th>
        <th>Type</th>
    </tr>
    <?php
    // Include connection code 
    include "..\8\db.php";
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
        </tr>
    <?php
    }
    $result->free_result();
    $conn->close();
    ?>
    </table>
</body>
</html>