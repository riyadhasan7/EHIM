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

  <?php
  if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']); // Escape special characters
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $age = (int) $_POST['age']; // Cast to integer (optional)
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Hash the password before storing it
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Verify if email is unique
    $verify_email = mysqli_query($con, "SELECT email FROM users where email = '$email'");
    if (mysqli_num_rows($verify_email) != 0) {
      echo "<div class='message'> This email is already used!</div>";
      echo "<a href='javascript: self.history.back()'><button class ='btn' >Go Back</button>";
    } else {
      $sql = "INSERT INTO users(name, email, age, password) VALUES (?, ?, ?, ?)";

      // Prepare statement for security
      $stmt = mysqli_prepare($con, $sql);

      // Bind parameters
      mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $age, $hashed_password);

      // Execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
        echo "<div class='message'> Registration completed!</div>";
        echo "<a href='index.php'><button class ='btn' >Login Now...</button>";
      } else {
        echo "Error: " . mysqli_error($con);
      }

      // Close prepared statement
      mysqli_stmt_close($stmt);
    }
  }
  ?>

  <div class="container">
    <div class="box form-box">
      <header class="header">Sign Up</header>
      <form action="registration.php" method="POST">
        <div class="field input">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" required> </div>
        <div class="field input">
          <label for="username">Email</label>
          <input type="email" name="email" id="email" required> </div>
        <div class="field input">
          <label for="age">Age</label>
          <input type="number" name="age" id="age"> </div>

        <div class="field input">
          <label for="password">
            <div class="mb-3">
              <label for="" class="form-label">Password</label>
              <input type="password" class="form-control" name="password" id="password" required> </div>
          </label>
        </div>

        <div class="field ">
          <input class="btn" type="submit" name="submit" id="submit" value="Submit">
        </div>
        <div class="links">
          Have an account? <a href="index.php">Sign In</a>
        </div>
      </form>
    </div>
  </div>

</body>
</html>
