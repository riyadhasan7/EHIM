$(document).ready(function() {
    function updateTimer() {
        var now = new Date().getTime();
        var startTime = new Date(examStartTime).getTime();
        var endTime = new Date(examEndTime).getTime();
        var message;
        var notAllowedMessage = "You are allowed to go outside.";

        for (var i = 0; i < notAllowedIntervals.length; i++) {
            var notAllowedStart = new Date(examStartTime.split(' ')[0] + ' ' + notAllowedIntervals[i].start).getTime();
            var notAllowedEnd = new Date(examStartTime.split(' ')[0] + ' ' + notAllowedIntervals[i].end).getTime();

            if (now >= notAllowedStart && now <= notAllowedEnd) {
                notAllowedMessage = "You are not allowed to go outside.";
                break;
            }
        }

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
        document.getElementById("marqueeMessage").innerHTML = notAllowedMessage;

        if (now <= endTime) {
            setTimeout(updateTimer, 1000);
        }
    }

    function fetchNotAllowedIntervals() {
        $.ajax({
            url: 'fetch_not_allowed_intervals.php',
            method: 'GET',
            success: function (data) {
                notAllowedIntervals = JSON.parse(data);
                updateTimer();
            }
        });
    }

    setInterval(fetchNotAllowedIntervals, 5000); // Fetch intervals every 5 seconds
    updateTimer(); // Initial call
});
