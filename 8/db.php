<?php

    function connect() {
        // Required variables set-up
        $servername = "localhost";
        $username = "root";
        $password = "";

        // Initialize connection
        $conn = new mysqli($servername, $username, $password, "pets");

        // Check if the connection was successful
        if ($conn->connect_error) {
            // Redirect to the error page
            header("Location: http://localhost/php-database-mini-project/5/db-fail.html");
            exit; // Make sure to exit to prevent further code execution
        }

        return $conn;
    }

    function delete_pet($id, $conn) {
    $query = "DELETE FROM pets WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    }

    function find_pet($search, $conn) {
        // Select pets with the name ?
        $query = "SELECT * FROM pets Where name LIKE ?";
        // prepare the sql to be executed
        $stmt = $conn->prepare($query);
        // sets the ? to the inputed search string
        $search = "{$_POST['search']}%";
        $stmt->bind_param("s", $search);
        // executes and returns
        $stmt->execute();
        return $stmt->get_result();
    }


    function get_all_pets($conn) {
        $sql = "SELECT name FROM pets";
        $result = $conn->query($sql);
        return $result;
    }
    
?>