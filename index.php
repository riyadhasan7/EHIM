<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <?php session_start(); ?>
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <?php 
                include("config.php");
                if(isset($_POST['submit'])){
                    $email = mysqli_real_escape_string($con, $_POST['email']);
                    $password = mysqli_real_escape_string($con, $_POST['password']);
                    
                    $result = mysqli_query($con, "SELECT * FROM users WHERE email = '$email'") or die("SELECT Error");
                    $row = mysqli_fetch_assoc($result);

                    if(is_array($row) && !empty($row) && password_verify($password, $row['password'])){
                        $_SESSION['valid'] = $row['id'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['username'] = $row['name'];
                        $_SESSION['age'] = $row['age'];
                        $_SESSION['id'] = $row['id'];
                        header("Location: setup.php");
                    } else {
                        echo "<div class='message'><p>wrong username or password</p></div><br>";
                        echo "<a href='index.php'><button class='btn'>Go back</button></a>";       
                    }
                }
            ?>
            <header class="header">login</header>
            <form action="" method="POST">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email">
                </div>
                <div class="field input">
                    <label for="password"><div class="mb-3">
                        <label for="" class="form-label">Password</label>
                        <input
                            type="password"
                            class="form-control"
                            name="password"
                            id="password"
                        />
                    </div></label>
                </div>
                <div class="field">
                    <input class="btn" type="submit" name="submit" id="submit" value="login">
                </div>
                <div class="links">
                    don't have account? <a href="registration.php">Sign Up</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
