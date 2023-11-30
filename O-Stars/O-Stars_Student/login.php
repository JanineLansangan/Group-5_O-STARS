<?php

include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM tbstudlogin WHERE srCode = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Start the session
        session_start();
    
        // Store the username in the session
        $_SESSION['username'] = $username;
    
        // Redirect to home.php
        header("Location: home.php");
        exit();
    } else {
        echo "<script type='text/javascript'>
        alert('Incorrect Email or Password');
        window.location.href = 'index.html'; // Redirect to home.php
        </script>";
    }
}

// Close the connection outside of the if-else blocks
$conn->close();

?>
