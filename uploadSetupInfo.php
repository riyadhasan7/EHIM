<?php
// Include database configuration file
include("config.php");

// Function to get the last inserted ID from exam_info table
function getLastInsertedExamID($con) {
    $query = "SELECT id FROM exam_info ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($con, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['id'];
    } else {
        return null;
    }
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $module_name = mysqli_real_escape_string($con, $_POST['module_name']);
    $exam_date = mysqli_real_escape_string($con, $_POST['exam_date']);
    $start_time = mysqli_real_escape_string($con, $_POST['start_time']);
    $end_time = mysqli_real_escape_string($con, $_POST['end_time']);
    $selected_proc = mysqli_real_escape_string($con, $_POST['selected_proc']);
    
    // Insert into exam_info table
    $insert_query = "INSERT INTO exam_info (module, exam_date, start_time, end_time, selected_proc) 
                     VALUES ('$module_name', '$exam_date', '$start_time', '$end_time', '$selected_proc')";
    
    if (mysqli_query($con, $insert_query)) {
        // Get the last inserted exam_id
        $exam_id = getLastInsertedExamID($con);
        header("Location: info_show.php");

        // Insert into not_allowed table
        if ($exam_id) {
            // Assuming you have multiple intervals, process each one
            if (isset($_POST['no_leave_start']) && isset($_POST['no_leave_end'])) {
                $no_leave_starts = $_POST['no_leave_start'];
                $no_leave_ends = $_POST['no_leave_end'];
                
                foreach ($no_leave_starts as $key => $no_leave_start) {
                    $no_leave_start = mysqli_real_escape_string($con, $no_leave_start);
                    $no_leave_end = mysqli_real_escape_string($con, $no_leave_ends[$key]);

                    // Insert into not_allowed table
                    $insert_not_allowed_query = "INSERT INTO not_allowed (exam_id, start_time, end_time) 
                                                VALUES ('$exam_id', '$no_leave_start', '$no_leave_end')";
                    mysqli_query($con, $insert_not_allowed_query);
                }
            }

            echo "Data inserted successfully.";
        } else {
            echo "Failed to retrieve exam ID.";
        }
    } else {
        echo "Error inserting data into exam_info table: " . mysqli_error($con);
    }
} else {
    echo "Invalid request method.";
}


?>
