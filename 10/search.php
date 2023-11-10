
<?php
include "..\8\db.php";
$conn = connect();
// only show results if the user has submitted a search
$show_results = false;
$user_search_string = "";
if (isset($_POST["search"])) {
    $show_results = true;
    $result = find_pet($_POST['search'], $conn);
    $user_search_string= $_POST['search'];
}

// Fetch all pet names
$all_pets_result = get_all_pets($conn);
$pet_names = array();
while ($row = $all_pets_result->fetch_array(MYSQLI_ASSOC)) {
    $pet_names[] = $row["name"];
}
$pet_names_json = json_encode($pet_names);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="..\8\style.css">
    <title>Mid-Cornwall vet Center</title>
</head>
<body>
    <?php
    // nav bar
    include "..\partials\menu.php";
    ?>

<h1>Search</h1>
    <form action="search.php" method="POST">
    <p>
        Enter part of pets name:
    </p>
    <input type="text" name="search" value="<?= $user_search_string ?>" onkeyup="predictive()" id="search">
    <input type="submit" value="Find">
    <div id="predictive"></div>
    
    <script>
        var petNames = <?= $pet_names_json ?>;
        function predictive() {
            var current = document.getElementById("search").value;
            console.log(current);
            var predictiveDiv = document.getElementById("predictive");
            predictiveDiv.innerHTML = ""; // Clear the previous suggestions
            if (current !== "") {
                var matches = petNames.filter(function(petName) {
                    return petName.startsWith(current);
                });
                matches.forEach(function(match) {
                    var p = document.createElement("p");
                    p.innerText = match;
                    p.onclick = function() {
                        document.getElementById("search").value = match;
                        predictiveDiv.innerHTML = ""; // Clear the suggestions after a click
                        document.querySelector('form').submit(); // Submit the form
                    };
                    predictiveDiv.appendChild(p);
                });
            }
        }


    </script>
    
    <style>
        .search-container {
    position: relative;
    display: inline-block;
}

#search {
    width: 20%;
    box-sizing: border-box;
}

#predictive {
    position: absolute;
    width: 20%;
    left: 0;
    /* other styles... */
}

        </style>


    
</form>

    <?php
    // if the user has subbmited a search then the table will appear
    if ($show_results):
    ?>
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
        while ($row = $result->fetch_array(MYSQLI_ASSOC)):
        ?>
        <tr>
            <td><?= $row["id"] ?></td>
            <td><?= $row["name"] ?></td>
            <td><?= $row["age"] ?></td>
            <td><?= $row["type"] ?></td>
            <td><a href="..\8\edit.php?id=<?= $row["id"] ?>" class="button edit">Edit</a></td>
            <td><a href="..\8\delete-action.php?id=<?= $row["id"] ?>" class="button delete">Delete</a></td>
        </tr>
        <?php
        endwhile;
        ?>
    </table>
    <?php endif ?>
    </body>
</html>
