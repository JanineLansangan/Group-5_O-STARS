<?php
include 'db_connect.php';
function sanitize($input) {
    return htmlspecialchars(strip_tags($input));
}

if (isset($_GET['search'])) {
    $search_term = sanitize($_GET['search']);

    $sql = "SELECT * FROM tbviolation WHERE 
            srCode LIKE '%$search_term%'";

    $result = $conn->query($sql);
} else {
    // If no search query, retrieve all records
    $sql = "SELECT * FROM tbviolation";
    $result = $conn->query($sql);
}
// Check if the form is submitted for deletion
if (isset($_GET['delete_id'])) {
    $delete_id = sanitize($_GET['delete_id']);

    // SQL query to delete the record
    $delete_sql = "DELETE FROM tbviolation WHERE violationID = '$delete_id'";
    
    if ($conn->query($delete_sql) === TRUE) {
        echo '<script>alert("Record deleted successfully");</script>';
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Check if the form is submitted for update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $violationID = sanitize($_POST["violationID"]);
    $srCode = sanitize($_POST["srCode"]);
    $date = sanitize($_POST["date"]);
    $violationtype = sanitize($_POST["violationtype"]);
    $remarks = sanitize($_POST["remarks"]);
    $sanction = sanitize($_POST["sanction"]);

    // SQL query to update the record
    $update_sql = $conn->prepare("UPDATE tbviolation SET
                    srCode = ?,
                    date = ?,
                    violationtype = ?,
                    remarks = ?,
                    sanction = ?
                    WHERE violationID = ?");


    $update_sql->bind_param("sssssi", $srCode, $date, $violationtype, $remarks, $sanction, $violationID);

  
    if ($update_sql->execute()) {
        echo '<script>alert("Record updated successfully");</script>';
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close the statement
    $update_sql->close();
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Violation Records</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            font-size: small;
            display: grid;
            grid-template-rows: auto auto 1fr; 
            gap: 10px; 
            background-image: url('bsu.jpg'); 
            background-size: cover; 
            background-repeat: no-repeat; 
            background-attachment: fixed;
            background-color: rgba(255, 255, 255, 0.7);
        }
        .header {
            background-color: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            border-bottom: 1px solid #ddd;
            z-index: 1000;
        }
        .logo img {
            height: 60px; 
            width: 60px;
        }
        .title {
            flex-grow: 1;
            text-align: center;
            color: black;
            font-size: small;
        }
        .back button {
            padding: 10px;
            background-color: #d21b1b; 
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .back button:hover {
            background-color: #d72020; 
        }
        .title {
            flex-grow: 1;
            text-align: center;
            color: black;
            font-size: small;
        }
        table a {
        display: inline-block;
        padding: 6px 12px;
        text-decoration: none;
        background-color: #007bff;
        color: #fff;
        border-radius: 5px;
        margin-right: 5px;
        }

        table a:hover {
            background-color: #0056b3;
        }

        table a.delete {
            background-color: #dc3545;
        }

        table a.delete:hover {
            background-color: #bd2130;
        }
        table {
            border-collapse: collapse;
            width: 95%;
            background-color: #f2f2f2;
            margin: 0 auto;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        h1{
            text-align: center;

        }
        .search-form {
            text-align: right;
            margin-right: 20px;
            margin-bottom: 20px;
        }

        .search-input {
            padding: 8px;
            font-size: 16px;
        }

        .search-button {
            padding: 8px 16px;
            font-size: 16px;
            background-color: limegreen;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .search-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div class="header">
                <div class="logo">
                    <img src="logo1.png" alt="Logo">
                </div>
                <div class="title">
                    <h1>Online Students Transgressions Accuracy Recording System - Students Violation Records</h1>
                </div>
                <div class="back">
                <form action="home.php" method="post">
                <button type="submit">Back</button>
                </form>
                </div>
            </div>

        <div class="search-form">
            <form action="" method="get">
                <input type="text" name="search" class="search-input" placeholder="Search...">
                <button type="submit" class="search-button">Search</button>
            </form>
        </div>
<?php
if ($result->num_rows > 0) {
    // Output data in a table
    echo "<table>";
    echo "<tr><th>Violation ID</th><th>SR Code</th><th>Date</th><th>Violation Type</th><th>Remarks</th><th>Sanction</th><th>Action</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["violationID"] . "</td>";
        echo "<td>" . $row["srCode"] . "</td>";
        echo "<td>" . $row["date"] . "</td>";
        echo "<td>" . $row["violationtype"] . "</td>";
        echo "<td>" . $row["remarks"] . "</td>";
        echo "<td>" . $row["sanction"] . "</td>";
        echo "<td><a href='edit.php?id=" . $row["violationID"] . "'>Edit</a> | <a href='?delete_id=" . $row["violationID"] . "' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No records found.";
}

$conn->close();
?>

</body>
</html>
