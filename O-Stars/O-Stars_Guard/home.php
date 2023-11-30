<!DOCTYPE html>
<html>
<head>
    <title>Security Guard Interface</title>
    <link rel="stylesheet" type="text/css" href="guardStyles.css">
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
        .logout button {
            padding: 10px;
            background-color: #d21b1b; 
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-left: 20px;
        }
        .logout button:hover {
            background-color: #d72020; 
        }
        
        .mission-vision-container {
            display: flex;
            justify-content: space-between;
            margin: 20px; 
        }

        .mission,
        .vision {
            background-color: rgba(249, 249, 249, 0.9);
            padding: 20px;
            border-radius: 5px;
            max-width: 48%; 
            box-sizing: border-box; 
        }

        .mission h2,
        .vision h2 {
            text-align: center;
        }

        .mission p,
        .vision p {
            text-align: center;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto; 
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 8px 0px rgba(0,0,0,0.1);
        }
        .container form {
            width: 100%;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="logo1.png" alt="Logo">
        </div>
        <div class="title">
            <h1>Batangas State University - <br>Online Students Transgression Accuracy Recording System</h1>
        </div>
        <div class="logout">
        <form action="logout.php" method="post">
        <button type="submit">Logout</button>
        </form>
        </div>
    </div>

    <div class="mission-vision-container">
        <div class="mission">
            <h2>Mission</h2>
            <p>A university committed to producing leaders by providing a 21st-century learning environment through innovations in education, multidisciplinary research, and community and industry partnerships in order to nurture the spirit of nationhood, propel the national economy, and engage the world for sustainable development.</p>
        </div>

        <div class="vision">
            <h2>Vision</h2>
            <p>A premier national university that develops leaders in the global knowledge economy.</p>
             <h2>Core Values</h2>
            <p> • Patriotism • Service • Integrity • Resilience • Excellence • Faith </p>
        </div>
    </div>

     <div class="container">
        <h2>O-STARS Record Form</h2>
        <form action="guardUi.php" method="post">
            <div class="horizontal-fields">
            <div class="field">
            <label>Date:</label>
            <input type="datetime-local" name="date" value="<?php echo time(); ?>"/>
            </div>
                <div class="field">
                    <label>SR Code:</label>
                    <input type="text" name="srCode" required>
                </div>
            <div class="field" style="margin-top: 10px;">
            <div class="field">
                <label>Violation Type:</label>
                <select name="violationtype" required>
                    <option value="">--Please choose an option--</option>
                    <option value="Haircut/Color">Haircut/Color</option>
                    <option value="Dress Code">Dress Code</option>
                    <option value="Misconduct">Misconduct</option>
                    <option value="Uniform">Uniform</option>
                    <option value="Attendance">Attendance</option>
                    <option value="Others">Others</option>
                </select>
            </div>
            <div class="field">
                <label>Violation Remarks:</label>
                <input type="text" name="remarks" required>
            </div>

            <div class="field">
                <label>Violation Sanction:</label>
                <select name="sanction" required>
                    <option value="">--Please choose an option--</option>
                    <option value="Written Warning">Written Warning</option>
                    <option value="Written Reprimand">Written Reprimand</option>
                    <option value="Community Service">Community Service</option>
                    <option value="Detention">Detention</option>
                    <option value="Written Warning">Suspension</option>
                    <option value="To be Discussed">To be Discussed</option>
                </select>
            </div>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>