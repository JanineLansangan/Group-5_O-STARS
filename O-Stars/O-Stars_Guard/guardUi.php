<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'];
    $srcode = $_POST['srCode'];
    $violationtype = $_POST['violationtype'];
    $violationremarks = $_POST['remarks'];
    $violationsanction = $_POST['sanction'];

    $sql = "INSERT INTO tbviolation (date, srCode, violationtype, remarks, sanction) VALUES ('$date', '$srcode', '$violationtype', '$violationremarks', '$violationsanction')";
    $add_record = mysqli_query($conn, $sql); 

    if(!$add_record){
        echo "Something went wrong!". mysqli_error($conn);
    }
    else  {
        echo "<script type='text/javascript'>
                alert('Data added successfully!');
                window.location.href = 'home.php'; // Redirect to home.php
              </script>";
    }
}
$conn->close();
?>
