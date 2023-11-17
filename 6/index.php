<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\8\style.css">
    <title>Mid-Cornwall Vet Center</title>
    <style>
        .submit {
            margin-top: 8px;
            color: #ffffff;
            background-color: rgb(11, 110, 255);
            border-color: #d6e9c6;
            padding: 15px;
            margin-bottom: 8px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .form {
            border-collapse: collapse;
            width: 80%;
            max-width: 800px;
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 20px;
            margin-bottom: 20px;
            padding: 15px;
        }
        .formtitle {
            border-collapse: collapse;
            background-color: #333;
            color: #ffffff;
            margin-top: 20px;
            margin-bottom: 20px;
            padding: 15px;
        }
    </style>
</head>
<body>
    <?php
    include "..\partials\menu.php"; 
    ?>
    
    <form class="form" action="add_a_pet.php" method="post">
        <h2 class="formtitle">Add a pet to the system</h2>
        <p>Enter pet name: <input type="test" name="name"></p>
        <p>Enter pet age: <input type="test" name="age"></p>
        <p>Enter pet type: <input type="test" name="type"></p>
        <hr>
        <p>Enter owner's first name: <input type="test" name="owner_first"></p>
        <p>Enter owner's last name: <input type="test" name="owner_last"></p>
        <hr>
        <input class="submit" type="submit" value="Add pet details">
    </form>
</body>
</html>