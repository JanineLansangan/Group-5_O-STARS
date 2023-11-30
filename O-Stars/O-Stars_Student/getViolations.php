<?php
include 'db_connect.php';

$username = $_POST['username'];

$sql = "SELECT * FROM tbviolation WHERE srCode = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table border="1">';
    echo '<tr><th>Violation ID</th><th>SR-Code</th><th>Date</th><th>Violation Type</th><th>Remarks</th><th>Sanction</th></tr>';

    while ($row = $result->fetch_assoc()) {
        // Output data for each row
        echo '<tr>';
        echo '<td>' . $row['violationID'] . '</td>';
        echo '<td>' . $row['srCode'] . '</td>';
        echo '<td>' . $row['date'] . '</td>';
        echo '<td>' . $row['violationtype'] . '</td>';
        echo '<td>' . $row['remarks'] . '</td>';
        echo '<td>' . $row['sanction'] . '</td>';
        echo '</tr>';
    }

    // Close the HTML table
    echo '</table>';
} else {
    echo "No violation found";
}

$conn->close();
?>
