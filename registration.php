<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Registration</title>
  <?php include("config.php"); ?>
  <script>
    function validateForm() {
      const password = document.getElementById('password').value;
      if (password.length < 6) {
        alert("Password must be at least 6 characters long.");
        return false;
      }
      return true;
    }
  </script>
</head>
<body>

  <?php
  if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Hash the password before storing it
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Verify if email is unique
    $verify_email = mysqli_query($con, "SELECT email FROM users WHERE email = '$email'");
    if (mysqli_num_rows($verify_email) != 0) {
      echo "<div class='message'>This email is already used!</div>";
      echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
    } else {
      // Check password length
      if (strlen($password) < 6) {
        echo "<div class='message'>Password must be at least 6 characters long.</div>";
        echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
      } else {
        $sql = "INSERT INTO users(name, email, password) VALUES (?, ?, ?)";

        // Prepare statement for security
        $stmt = mysqli_prepare($con, $sql);

        // Bind parameters
        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashed_password);

        if (mysqli_stmt_execute($stmt)) {
          echo "<div class='message'>Registration completed!</div>";
          header("Location: index.php");
        } else {
          echo "Error: " . mysqli_error($con);
        }

        // Close prepared statement
        mysqli_stmt_close($stmt);
      }
    }
  }
  ?>

  <div class="container">
    <div class="box form-box">
      <header class="header">Sign Up</header>
      <form action="registration.php" method="POST" onsubmit="return validateForm()">
        <div class="field input">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" required>
        </div>
        <div class="field input">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" required>
        </div>
        <div class="field input">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" required>
        </div>
        <div class="field">
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
