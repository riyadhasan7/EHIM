<?php
include("config.php");

// Initialize variables
$latestExam = null;
$notAllowedIntervals = [];
$procedures = [];

// Fetch the latest exam info
$examQuery = "SELECT * FROM exam_info ORDER BY id DESC LIMIT 1";
$examResult = mysqli_query($con, $examQuery);

if ($examResult && mysqli_num_rows($examResult) > 0) {
    $latestExam = mysqli_fetch_assoc($examResult);
    $lastExamId = $latestExam['id'];

    // Fetch all procedures
    $procQuery = "SELECT * FROM loc_pro";
    $procResult = mysqli_query($con, $procQuery);
    
    if ($procResult) {
        while ($procRow = mysqli_fetch_assoc($procResult)) {
            $procedures[] = $procRow;
        }
    } else {
        echo "Error fetching procedures: " . mysqli_error($con);
    }

    // Fetch not allowed intervals for the latest exam
    $notAllowedQuery = "SELECT * FROM not_allowed WHERE exam_id = $lastExamId";
    $notAllowedResult = mysqli_query($con, $notAllowedQuery);

    if ($notAllowedResult) {
        while ($row = mysqli_fetch_assoc($notAllowedResult)) {
            $notAllowedIntervals[] = [
                'start' => $row['start_time'],
                'end' => $row['end_time']
            ];
        }
    } else {
        echo "Error fetching not allowed intervals: " . mysqli_error($con);
    }

    // Convert start_time and end_time to 12-hour format
    $startTime = date("g:i A", strtotime($latestExam['start_time']));
    $endTime = date("g:i A", strtotime($latestExam['end_time']));
} else {
    echo "No exam found.";
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="Style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid width_ch">
        <nav class="navbar bg-body-tertiary border-bottom border-body" data-bs-theme="dark">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="/img/lsbu.png" alt="Bootstrap" width="30" height="24">
                </a>
                <form class="d-flex" role="search">
                    <a href="#" class="btn btn-outline-success" type="submit">Logout</a>
                </form>
            </div>
        </nav>
    </div>

    <marquee class="alert alert-success" direction="left">
        <strong>Notice: </strong> <span id="marqueeMessage"></span>
    </marquee>
    <p id="demo" class="timer"></p>

    <div class="container text-center">
        <div class="row">
            <div class="col">
                Column
            </div>
            <div class="col-6">
                <!-- Showing the latest selected procedures -->
                <?php if ($latestExam): ?>
                    <div class="exam-info">
                        <h5>Module: <?php echo $latestExam['module']; ?></h5>
                        <p>Exam Date: <?php echo $latestExam['exam_date']; ?></p>
                        <p>Start Time: <?php echo $startTime; ?></p>
                        <p>End Time: <?php echo $endTime; ?></p>
                        <p>Selected Procedures:</p>
                        <ul>
                            <?php
                            $selectedProc = $latestExam['selected_proc'];
                            for ($i = 0; $i < strlen($selectedProc); $i++) {
                                if ($selectedProc[$i] == '1') {
                                    echo '<li>' . $procedures[$i]['proc'] . '</li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    <hr>
                    <!-- Pass PHP variables to JavaScript -->
                    <script>
                        var examStartTime = "<?php echo $latestExam['exam_date'] . ' ' . date('H:i:s', strtotime($latestExam['start_time'])); ?>";
                        var examEndTime = "<?php echo $latestExam['exam_date'] . ' ' . date('H:i:s', strtotime($latestExam['end_time'])); ?>";
                        var notAllowedIntervals = <?php echo json_encode($notAllowedIntervals); ?>;
                    </script>
                <?php else: ?>
                    <p>No exam found.</p>
                <?php endif; ?>
            </div>
            <div class="col">
                Column
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/dynamic_alert.js"></script>
</body>

</html>
