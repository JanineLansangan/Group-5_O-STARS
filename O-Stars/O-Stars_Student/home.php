<?php
session_start();

// Check if the session variable is set
if (!isset($_SESSION['username'])) {
    // Redirect to login page if the username is not set
    header("Location: index.html");
    exit();
}

// Get the username from the session
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Student Portal</title>
    <link rel="stylesheet" type="text/css" href="studentStyles.css">
</head>

<body>
    <div class="header">
        <div class="logo">
            <img src="logo1.png" alt="Logo">
        </div>
        <div class="title">
            <h1>Batangas State University - The National Engineering University</h1>
        </div>
        <div class="logout">
        <form action="logout.php" method="post">
        <button type="submit">Logout</button>
        </form>
        </div>
    </div>
    <style>
        .icon img {
            height: 40px;
            flex: 1;
            display: flex;
            align-items: center;
        }

        .field p {
            color: #000000;
        }

        .field p:hover {
            color: #4caf50;
        }

        .field a {
            text-decoration: none;
            color: inherit;
        }

        .horizontal-fields {
            display: flex;
            flex-wrap: wrap;
            margin-left: 70px;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            max-width: 100%;
            height: 100%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bolder;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        table {
            border-collapse: collapse;
            width: 90%;
            background-color: #f2f2f2;
            margin: 0 auto;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            font-size: medium;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>

    <div class="container">
        <h2>Student Portal</h2>
            <div class="horizontal-fields">
                <div class="icon">
                    <img src="1.png" alt="1">
                </div>
                <div class="field">
                    <p>Certificate of Registration</p>
                </div>
                <div class="icon">
                    <img src="2.png" alt="2">
                </div>
                <div class="field">
                    <p>View Student ID</p>
                </div>
                <div class="icon">
                    <img src="3.png" alt="3">
                </div>
                <div class="field">
                    <p>Subjects</p>
                </div>
            </div>
            <div class="horizontal-fields">
                <div class="icon">
                    <img src="4.png" alt="4">
                </div>
                <div class="field">
                    <p>Grades</p>
                </div>
                <div class="icon">
                    <img src="5.png" alt="5">
                </div>
                <div class="field">
                    <p>All Grades</p>
                </div>
                <div class="icon">
                    <img src="6.png" alt="6">
                </div>
                <div class="field">
                    <p>Curriculum</p>
                </div>
            </div>
            <div class="horizontal-fields">
                <div class="icon">
                    <img src="7.png" alt="7">
                </div>
                <div class="field">
                    <p>Scholarships</p>
                </div>
                <div class="icon">
                    <img src="8.png" alt="8">
                </div>
                <div class="field">
                    <p>Assessment of Fees</p>
                </div>
                <div class="icon">
                    <img src="9.png" alt="9">
                </div>
                <div class="field">
                    <p>Payments</p>
                </div>
            </div>
            <div class="horizontal-fields">
                <div class="icon">
                    <img src="10.png" alt="10">
                </div>
                <div class="field">
                    <p>SSC Payments</p>
                </div>
                <div class="icon">
                    <img src="11.png" alt="11">
                </div>
                <div class="field">
                    <p>Liabilities</p>
                </div>
                <div class="icon">
                    <img src="12.png" alt="12">
                </div>
                <div class="field">
                    <p>Subjects to Complete</p>
                </div>
            </div>
            <div class="horizontal-fields">
                <div class="icon">
                    <img src="13.png" alt="13">
                </div>
                <div class="field">
                    <p>Print Copy of Grades</p>
                </div>
                <div class="icon">
                    <img src="14.png" alt="14">
                </div>
                <div class="field">
                    <p>Print Copy of All Grades</p>
                </div>
                <div class="icon">
                    <img src="star.png" alt="star">
                </div>
                <div class="field">
                <a href="#" id="oStarsLink">
                    <p>O-STARS</p>
                </a>
                <div id="myModal" class="modal">
                    <div class="modal-content">
                        <span class="close" id="closeBtn">&times;</span>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.getElementById("oStarsLink").addEventListener("click", function (event) {
            event.preventDefault();

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "getViolations.php", true);

            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            var username = "<?php echo $username; ?>";

            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = xhr.responseText;

                        if (response !== "No violation found") {
                            showModal(response);
                        } else {
                            showModal("No Violations Found.");
                        }
                    } else {
                        console.error('Error:', xhr.status);
                    }
                }
            };

            // Send the username as data
            xhr.send("username=" + encodeURIComponent(username));
        });

        // Function to show the modal
        function showModal(content) {
            var modal = document.getElementById("myModal");
            var modalContent = document.querySelector(".modal-content");

            modalContent.innerHTML = "";

            var header = document.createElement("div");
            header.className = "modal-header";

            var image = document.createElement("img");
            image.src = "star.png"; 
            image.alt = "Logo";
            image.style.width = "50px";
            image.style.marginRight = "20px";

            var title = document.createElement("h2");
            title.textContent = "O-STARS: Online Students Transgression Accuracy Recording System";

            var headerContainer = document.createElement("div");
            headerContainer.style.display = "flex";
            headerContainer.style.alignItems = "center"; 
            headerContainer.style.justifyContent = "center";
            headerContainer.appendChild(image);
            headerContainer.appendChild(title);

            header.appendChild(headerContainer);

            modalContent.appendChild(header);

            var closeBtn = document.createElement("span");
            closeBtn.className = "close";
            closeBtn.innerHTML = "&times;";

            header.appendChild(closeBtn);  

            // Check if there are no violations found
            if (content === "No Violations Found.") {
                var noViolationsContainer = document.createElement("div");
                noViolationsContainer.style.display = "flex";
                noViolationsContainer.style.flexDirection = "column"; 
                noViolationsContainer.style.alignItems = "center"; 
                noViolationsContainer.style.justifyContent = "center";

                var noViolationsImage = document.createElement("img");
                noViolationsImage.src = "check.png"; 
                noViolationsImage.alt = "No Violations Found";
                noViolationsImage.style.width = "15%";
                noViolationsImage.style.marginTop = "10px"; 

                var noViolationsMessage = document.createElement("p");
                noViolationsMessage.textContent = content;

                noViolationsMessage.style.fontSize = "20px"; 
                noViolationsMessage.style.fontWeight = "bold";

                noViolationsContainer.appendChild(noViolationsImage);
                noViolationsContainer.appendChild(noViolationsMessage);

                modalContent.appendChild(noViolationsContainer);

                var okButton = document.createElement("button");
                okButton.textContent = "OK";
                okButton.style.marginTop = "15px"; 
                okButton.style.marginRight = "20px";
                okButton.style.padding = "10px 20px"; 
                okButton.style.fontSize = "16px"; 
                okButton.style.fontWeight = "bold"; 
                okButton.style.backgroundColor = "#4caf50"; 
                okButton.style.color = "#ffffff"; 
                okButton.style.border = "none"; 
                okButton.style.borderRadius = "5px";
                okButton.style.cursor = "pointer"; 

                okButton.addEventListener("click", function () {
                    closeModal();
                });

                var buttonContainer = document.createElement("div");
                buttonContainer.style.display = "flex";
                buttonContainer.style.alignItems = "center";
                buttonContainer.style.justifyContent = "center";
                buttonContainer.appendChild(okButton);

                modalContent.appendChild(buttonContainer);
            } else {
                var contentParagraph = document.createElement("p");
                contentParagraph.innerHTML = content;

                modalContent.appendChild(contentParagraph);
            }


            modal.style.display = "block";

            closeBtn.addEventListener("click", function () {
                closeModal();
            });

            window.onclick = function (event) {
                if (event.target == modal) {
                    closeModal();
                }
            };


            tableContainer.innerHTML = content;
            modalContent.appendChild(tableContainer);
        }

        function closeModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
        }

        </script>
        </form>
    </div>
</body>

</html>
