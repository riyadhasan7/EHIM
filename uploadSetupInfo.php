<?php
// Include database configuration file
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $module_name = $_POST['module_name'];
    $exam_date = $_POST['exam_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $selected_proc = $_POST['selected_proc'];

    // Prepare an SQL statement to insert data into exam_info table
    $stmt = $con->prepare("INSERT INTO exam_info (module, exam_date, start_time, end_time, selected_proc) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $module_name, $exam_date, $start_time, $end_time, $selected_proc);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Data inserted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $con->close();
}
?>
