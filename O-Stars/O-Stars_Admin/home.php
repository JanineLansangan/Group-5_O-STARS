<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="homestyle.css">
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

        .logout button {
            padding: 10px;
            background-color: #d21b1b;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
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
            text-align: center;
        }

        .mission h2,
        .vision h2 {
            text-align: center;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: rgba(249, 249, 249, 0.9);
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 8px 0px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center; 
            justify-content: space-between;
        }

        .container button {
            padding: 10px;
            background-color:limegreen; 
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bolder;
            margin: 5px; 
        }

        .container button:hover {
            background-color: limegreen;
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
            <h1>Batangas State University - Online Students Trangression Accuracy Recording System</h1>
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
        <h2>O-STARS Admin Dashboard</h2>
        <div class="container button">
            <a href="CodeOfConduct.pdf" target="_blank" class="pdf-link">
                <button type="button">Student Code of Conduct</button>
            </a>
            <button type="button" onclick="redirectToView()">View All Students Violation Record</button>
            <button type="button" onclick="redirectToUpdate()">Update Students Violation Record</button>

            <script>
                function redirectToView() {
                    window.location.href = 'view.php';
                }

                function redirectToUpdate() {
                    window.location.href = 'update.php';
                }
            </script>
        </div>
    </div>
</body>

</html>
