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
?>