<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Registration</title>
  <?php include("config.php"); ?>
</head>
<body>

<div class="container">
  <!-- Image on the left side -->
  <div class="img left-sided">
    <img src="https://img.freepik.com/free-photo/international-day-education-dark-style_23-2151013409.jpg?t=st=1719506016~exp=1719509616~hmac=3100cffba209508058ed7e90513aacc79ccfb4780ab53bf120168c36c50ea1af&w=740" alt="Exam Image">
  </div>
  
  <div class="box form-box">
    <header class="header">Exam Registration</header>
    <form action="registration.php" method="POST">
      <div class="field input">
        <label for="module_name">Module Name</label>
        <input type="text" name="module_name" id="module_name" required>
      </div>
      <div class="field input">
        <label for="exam_date">Exam Date</label>
        <input type="date" name="exam_date" id="exam_date" required>
      </div>
      <div class="field input-row">
        <div class="input">
          <label for="start_time">Start Time</label>
          <input type="time" name="start_time" id="start_time" required>
        </div>
        <div class="input">
          <label for="end_time">End Time</label>
          <input type="time" name="end_time" id="end_time" required>
        </div>
      </div>
      

      <div class="field">
        <input class="btn" type="submit" name="submit" id="submit" value="Submit">
      </div>
      
    </form>
  </div>
</div>

</body>
</html>
