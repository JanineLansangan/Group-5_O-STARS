<?php

include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM tbemplogin WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        header("Location: home.php");
        exit();
    } else {
        echo "<script type='text/javascript'>
        alert('Incorrect Email or Password');
        window.location.href = 'index.html'; // Redirect to home.php
      </script>";
    }
}

$conn->close();

?>
