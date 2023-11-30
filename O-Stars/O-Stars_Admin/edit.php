<?php

include 'db_connect.php';


function sanitize($input) {
    return htmlspecialchars(strip_tags($input));
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $violationID = sanitize($_POST["violationID"]);
    $srCode = sanitize($_POST["srCode"]);
    $date = sanitize($_POST["date"]);
    $violationtype = sanitize($_POST["violationtype"]);
    $remarks = sanitize($_POST["remarks"]);
    $sanction = sanitize($_POST["sanction"]);

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

    $update_sql->close();
}

if (isset($_GET['id'])) {
    $edit_id = sanitize($_GET['id']);

    $edit_sql = $conn->prepare("SELECT * FROM tbviolation WHERE violationID = ?");
    $edit_sql->bind_param("i", $edit_id);
    $edit_sql->execute();

    $result = $edit_sql->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $violationID = $row["violationID"];
        $srCode = $row["srCode"];
        $date = $row["date"];
        $violationtype = $row["violationtype"];
        $remarks = $row["remarks"];
        $sanction = $row["sanction"];

        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Violation Record</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: grid;
            grid-template-rows: auto auto 1fr; 
            gap: 10px; 
            background-image: url('bsu.jpg'); 
            background-size: cover; 
            background-repeat: no-repeat; 
            background-attachment: fixed;
        }
        .header {
            background-color: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 40px;
            border-bottom: 1px solid #ddd;
            z-index: 1000;
        }
        .logo img {
            height: 60px; 
            width: 60px;
            padding: 10px;
        }
        .title {
            flex-grow: 1;
            text-align: center;
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
        .edit-form {
            max-width: 1000px;
            margin: 0 auto; 
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 8px 0px rgba(0,0,0,0.1);
        }
        .edit-form {
            width: 100%;
        }
        .horizontal-fields {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
        }

        .field {
            flex: 1;
            min-width: calc(33.33% - 10px);
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], select, textarea {
            width: 80%;
            padding: 10px;
            font-family: Arial, sans-serif;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 3px;
            outline: none;
        }

        textarea {
            resize: none;
        }
        .update button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .update button:hover {
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
                    <h1>Online Students Transgressions Accuracy Recording System - Update Student Records</h1>
                </div>
                <div class="back">
                <form action="update.php" method="post">
                <button type="submit">Back</button>
                </form>
                </div>
            </div>

<div class="edit-form">
        <form action="update.php" method="post">
            <input type="hidden" name="violationID" value="<?php echo $violationID; ?>">
            
            <label for="srCode">SR Code:</label>
            <input type="text" id="srCode" name="srCode" value="<?php echo $srCode; ?>" required><br>
            
            <label for="date">Date:</label>
            <input type="datetime-local" id="date" name="date" value="<?php echo $date; ?>" required><br>

            <label for="violationtype">Violation Type:</label>
            <select id="violationtype" name="violationtype" required>
                <option value="Haircut/Color" <?php echo ($violationtype === 'Haircut/Color') ? 'selected' : ''; ?>>Haircut/Color</option>
                <option value="Uniform" <?php echo ($violationtype === 'Uniform') ? 'selected' : ''; ?>>Uniform</option>
                <option value="Misconduct" <?php echo ($violationtype === 'Misconduct') ? 'selected' : ''; ?>>Misconduct</option>
                <option value="Dress Code" <?php echo ($violationtype === 'Dress Code') ? 'selected' : ''; ?>>Dress Code</option>
                <option value="Others" <?php echo ($violationtype === 'Others') ? 'selected' : ''; ?>>Others</option>
            </select><br>

            <label for="remarks">Remarks:</label>
            <textarea id="remarks" name="remarks" rows="4" cols="50" required><?php echo $remarks; ?></textarea><br>

            <label for="sanction">Sanction:</label>
            <select id="sanction" name="sanction" required>
                <option value="Community Service" <?php echo ($sanction === 'Community Service') ? 'selected' : ''; ?>>Community Service</option>
                <option value="Detention" <?php echo ($sanction === 'Detention') ? 'selected' : ''; ?>>Detention</option>
                <option value="Written Warning" <?php echo ($sanction === 'Written Warning') ? 'selected' : ''; ?>>Written Warning</option>
                <option value="Written Reprimand" <?php echo ($sanction === 'Written Reprimand') ? 'selected' : ''; ?>>Written Reprimand</option>
                <option value="To be Discussed" <?php echo ($sanction === 'To be Discussed') ? 'selected' : ''; ?>>To be Discussed</option>
                <option value="One-day Suspension" <?php echo ($sanction === 'One-day Suspension') ? 'selected' : ''; ?>>One-day Suspension</option>
                <option value="Two-day Suspension" <?php echo ($sanction === 'Two-day Suspension') ? 'selected' : ''; ?>>Two-day Suspension</option>
                <option value="Three-day Suspension" <?php echo ($sanction === 'Three-day Suspension') ? 'selected' : ''; ?>>Three-day Suspension</option>
                <option value="Expulsion" <?php echo ($sanction === 'Expulsion') ? 'selected' : ''; ?>>Expulsion</option>
            </select><br>
            <div class = "update">
            <button type="submit">Update Record</button>
            </div>
        </form>
    </div>

</body>
</html>

<?php
    } else {
        echo "Record not found.";
    }

    $edit_sql->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
