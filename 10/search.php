
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
        // gets the pet names from the json
        var petNames = <?= $pet_names_json ?>;
        function predictive() {
            var current = document.getElementById("search").value;
            console.log(current);
            var predictiveDiv = document.getElementById("predictive");
            // Clear the previous suggestions
            predictiveDiv.innerHTML = "";
            if (current !== "") {
                var matches = petNames.filter(function(petName) {
                    return petName.startsWith(current);
                });
                matches.forEach(function(match) {
                    var p = document.createElement("p");
                    p.innerText = match;
                    p.onclick = function() {
                        document.getElementById("search").value = match;
                        // Clear the suggestions after a click
                        predictiveDiv.innerHTML = ""; 
                        // Submit the form
                        document.querySelector('form').submit(); 
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
    <table>
        <tr>
            <th onclick="sortTable(0)">ID</th>
            <th onclick="sortTable(1)">Name</th>
            <th onclick="sortTable(2)">Age</th>
            <th onclick="sortTable(3)">Type</th>
            <th onclick="sortTable(4)">Owner name</th>
            <th onclick="sortTable(5)">Owner surname</th>
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
            <td><?= $row["owner_first"] ?></td>
            <td><?= $row["owner_last"] ?></td>
            <td><a href="..\8\edit.php?id=<?= $row["id"] ?>&msg=pets" class="button edit">Edit pet</a></td>
            <td><a href="..\8\delete-action.php?id=<?= $row["id"] ?>" class="button delete">Delete pet</a></td>
        </tr>
        <?php
        endwhile;
        ?>
    </table>
    <?php endif ?>

    <script src="..\partials\mergesort.js"></script>

    </body>
</html>
