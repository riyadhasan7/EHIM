<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="Style.css" rel="stylesheet">
    <?php 
    include("config.php"); 
    
    // Fetch the latest exam info
    $examQuery = "SELECT * FROM exam_info ORDER BY id DESC LIMIT 1";
    $examResult = mysqli_query($con, $examQuery);
    $latestExam = mysqli_fetch_assoc($examResult);

    // Fetch all procedures
    $procQuery = "SELECT * FROM loc_pro";
    $procResult = mysqli_query($con, $procQuery);
    $procedures = [];
    while ($procRow = mysqli_fetch_assoc($procResult)) {
        $procedures[] = $procRow;
    }
  ?>
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
        <strong>Success!</strong> You should <a href="#" class="alert-link">read this message</a>.
    </marquee>
    <p id="demo" class="timer"></p>

    <div class="container text-center">
        <div class="row">
            <div class="col">
                Column
            </div>
            <div class="col-6">
                <!-- Showing the latest selected procedures -->
                <?php
                if ($latestExam) {
                    echo '<div class="exam-info">';
                    echo '<h5>Module: ' . $latestExam['module'] . '</h5>';
                    echo '<p>Exam Date: ' . $latestExam['exam_date'] . '</p>';
                    echo '<p>Start Time: ' . $latestExam['start_time'] . '</p>';
                    echo '<p>End Time: ' . $latestExam['end_time'] . '</p>';
                    echo '<p>Selected Procedures:</p>';
                    echo '<ul>';

                    // Decode selected_proc and display the corresponding procedures
                    $selectedProc = $latestExam['selected_proc'];
                    for ($i = 0; $i < strlen($selectedProc); $i++) {
                        if ($selectedProc[$i] == '1') {
                            echo '<li>' . $procedures[$i]['proc'] . '</li>';
                        }
                    }

                    echo '</ul>';
                    echo '</div><hr>';

                    // Pass PHP variables to JavaScript
                    echo '<script>';
                    echo 'var examStartTime = "' . $latestExam['exam_date'] . ' ' . $latestExam['start_time'] . '";';
                    echo 'var examEndTime = "' . $latestExam['exam_date'] . ' ' . $latestExam['end_time'] . '";';
                    echo '</script>';
                } else {
                    echo 'No exam found.';
                }
                ?>
            </div>
            <div class="col">
                Column
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script>
        function updateTimer() {
            var now = new Date().getTime();
            var startTime = new Date(examStartTime).getTime();
            var endTime = new Date(examEndTime).getTime();
            var message;

            if (now < startTime) {
                message = "Exam has not started yet.";
            } else if (now > endTime) {
                message = "Exam time is up.";
            } else {
                var timeLeft = endTime - now;
                var hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
                message = "Exam is ongoing. Time left: " + hours + "h " + minutes + "m " + seconds + "s ";
            }

            document.getElementById("demo").innerHTML = message;

            if (now <= endTime) {
                setTimeout(updateTimer, 1000);
            }
        }

        updateTimer();
    </script>
</body>

</html>
