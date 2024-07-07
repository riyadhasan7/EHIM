<?php
include("config.php");

$examQuery = "SELECT * FROM exam_info ORDER BY id DESC LIMIT 1";
$examResult = mysqli_query($con, $examQuery);
$latestExam = mysqli_fetch_assoc($examResult);

$notAllowedIntervals = [];

if ($latestExam) {
    $lastExamId = $latestExam['id'];

    // Fetch not allowed intervals for the latest exam
    $notAllowedQuery = "SELECT * FROM not_allowed WHERE exam_id = $lastExamId";
    $notAllowedResult = mysqli_query($con, $notAllowedQuery);
    while ($row = mysqli_fetch_assoc($notAllowedResult)) {
        $notAllowedIntervals[] = [
            'start' => $row['start_time'],
            'end' => $row['end_time']
        ];
    }
}

echo json_encode($notAllowedIntervals);
?>
