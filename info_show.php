<?php
session_start();
if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
    exit();
}

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
    <title>Exam Information</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid width_ch">
        <nav class="navbar" data-bs-theme="dark">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="img/modernIcon.png" alt="Lsbu" width="300" height="43">
                </a>
                <form class="d-flex" role="search">
                    <a href="final_info.php" class="btn btn-dark btn-lg btn_ch" type="submit">Add Info</a>
                    <a href="logout.php" class="btn btn-dark btn-lg btn_ch" type="submit">Logout</a>
                </form>
            </div>
        </nav>
    </div>

    <p id="demo" class="timer timer_ch"></p>

    <div class="container text-center module_pro">
        <div class="row "> 
            <div class="col-3 module_ch column-spacing">
                <!-- Showing the latest selected procedures -->
                <?php if ($latestExam): ?>
                    <div class="exam-info">
                        <h1>Module: <?php echo $latestExam['module']; ?></h1>
                        <p>Exam Date: <?php echo $latestExam['exam_date']; ?></p>
                        <p>Start Time: <?php echo $startTime; ?></p>
                        <p>End Time: <?php echo $endTime; ?></p>
                    </div>
                    <!-- Pass PHP variables to JavaScript -->
                    <script>
                        var examStartTime = "<?php echo $latestExam['exam_date'] . ' ' . date('H:i:s', strtotime($latestExam['start_time'])); ?>";
                        var examEndTime = "<?php echo $latestExam['exam_date'] . ' ' . date('H:i:s', strtotime($latestExam['end_time'])); ?>";
                        var notAllowedIntervals = <?php echo json_encode($notAllowedIntervals); ?>;
                    </script>
                <?php else: ?>
                    <p>No exam found.</p>
                <?php endif; ?>
                <div class="col-12">
                    <div class="icon_img">
                        <img src="img/icon.jpg" alt="icon">
                        <marquee class="alert mar_ch" direction="left">
                            <span id="marqueeMessage"></span>
                        </marquee>
                    </div>
                </div>
            </div>
            <div class="col-8 pro_ch">
                <h1 class="procedure">Procedures:</h1>
                <?php
                $selectedProc = $latestExam['selected_proc'];
                $cnt = 0;
                for ($i = 0; $i < strlen($selectedProc); $i++) {
                    if ($selectedProc[$i] == '1') {
                        $cnt += 1;
                        echo '<p class="pro_list">' . ($cnt) . '. ' . $procedures[$i]['proc'] . '</p>';
                    }
                }
                ?>
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
