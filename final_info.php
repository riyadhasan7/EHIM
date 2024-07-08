<?php
session_start();
if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
    exit();
}

include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission
    $totalStudents = $_POST['total_students'];
    
    $attendedStudents = $_POST['attended_students'];
    $emergency = $_POST['emergency'] ?? '';
    $misconductPersons = $_POST['misconduct_person'] ?? [];
    $misconductTypes = $_POST['misconduct_type'] ?? [];

    // Insert a new record into exam_info and get its ID
    // $initialExamQuery = "INSERT INTO exam_info (total_students, attended_students)
    //                      VALUES ('$totalStudents', '$attendedStudents')";
    // if (mysqli_query($con, $initialExamQuery)) {
    //     $examId = mysqli_insert_id($con); 

    $examQuery = "SELECT * FROM exam_info ORDER BY id DESC LIMIT 1";
    $examResult = mysqli_query($con, $examQuery);

    if ($examResult && mysqli_num_rows($examResult) > 0) {
        $latestExam = mysqli_fetch_assoc($examResult);
        $lastExamId = $latestExam['id'];
        

        // Update the new record with emergency information
        $updateExamQuery = "UPDATE exam_info SET emergency='$emergency', 
            total_students='$totalStudents',attended_students='$attendedStudents' WHERE id='$lastExamId'";
        if (!mysqli_query($con, $updateExamQuery)) {
            echo "Error updating exam_info: " . mysqli_error($con);
        }

        // Insert misconduct information into the academic_misconduct table
        if (!empty($misconductPersons) && !empty($misconductTypes)) {
            for ($i = 0; $i < count($misconductPersons); $i++) {
                $personRoll = $misconductPersons[$i];
                $misconductType = $misconductTypes[$i];
                $misconductQuery = "INSERT INTO academic_misconduct (exam_id, std_roll, misconduct_type) VALUES ('$lastExamId', '$personRoll', '$misconductType')";
                
                if (!mysqli_query($con, $misconductQuery)) {
                    echo "Error inserting misconduct: " . mysqli_error($con);
                }
            }
        }
        echo "Information sucessfully added to the database";
        
        header("Location: info_show.php");
        
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <title>Final Info</title>
    <style>
        .input-row { margin-bottom: 10px; }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            border-radius: 10px;
            width: 60%;
        }
        .close {
            color: #aaa;
            float: right;
            padding: 2px;
            font-size: 35px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let addEmergencyBtn = document.getElementById("addEmergencyBtn");
            let emergencyContainer = document.getElementById("emergencyContainer");
            let addMisconductBtn = document.getElementById("addMisconductBtn");
            let misconductsContainer = document.getElementById("misconducts");

            addEmergencyBtn.addEventListener("click", function () {
                let newEmergencyRow = document.createElement("div");
                newEmergencyRow.classList.add("input-row");
                newEmergencyRow.innerHTML = `
                    <div class="input">
                        <label for="emergency">Emergency (if any)</label>
                        <textarea name="emergency" id="emergency" required></textarea>
                    </div>
                `;
                emergencyContainer.appendChild(newEmergencyRow);
                addEmergencyBtn.style.display = "none"; // Hide the button after adding the input
            });

            addMisconductBtn.addEventListener("click", function () {
                let newMisconductRow = document.createElement("div");
                newMisconductRow.classList.add("input-row");
                newMisconductRow.innerHTML = `
                    <div class="input">
                        <label for="misconduct_person[]">Person Roll</label>
                        <input type="text" name="misconduct_person[]" required>
                    </div>
                    <div class="input">
                        <label for="misconduct_type[]">Misconduct Type</label>
                        <input type="text" name="misconduct_type[]" required>
                    </div>
                `;
                misconductsContainer.appendChild(newMisconductRow);
            });
        });
    </script>
</head>
<body>
<div class="container">
    <div class="box form-box">
        <header class="header">Final Information</header>
        <form action="final_info.php" method="POST">
            <div class="field input">
                <label for="total_students">Total Students</label>
                <input type="number" name="total_students" id="total_students" required>
            </div>
            <div class="field input">
                <label for="attended_students">Attended Students</label>
                <input type="number" name="attended_students" id="attended_students" required>
            </div>

            <div class="field">
                <input class="btn" type="button" id="addEmergencyBtn" value="Add Emergency Info">
                <div id="emergencyContainer"></div>
            </div>

            <div class="field">
                <input class="btn" type="button" id="addMisconductBtn" value="Add Academic Misconduct">
                <div id="misconducts"></div>
            </div>

            <div class="field">
                <input class="btn" type="submit" name="submit" value="Submit">
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>
