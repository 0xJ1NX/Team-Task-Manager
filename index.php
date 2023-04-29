<!DOCTYPE html>
<html lang="en">

<?php

session_start();

$conn = "";
include 'includes/db.php';
include 'includes/functions.php';




//check if user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    checkLateTasks($conn);
    header("Location: mainPage.php");
    exit();
}



if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];


    $username = validate($username);
    $password = validate($password);

    if (empty($username)) {
        header("Location: index.php?error=Username is required");
        exit();
    } else if (empty($password)) {
        header("Location: index.php?error=Password is required");
        exit();
    } else {
        //the password is encrypted
        $query = "SELECT * FROM credentials WHERE username='$username'";
        $result = $conn->query($query);

        $row = $result->fetch();
        $hashed_password = $row['password'];

        if (password_verify($password, $hashed_password)) {
            session_start();

            $_SESSION['username'] = $username;
            $_SESSION['id'] = $row['user_id'];
            $id = $_SESSION['id'];
            $_SESSION['loggedin'] = true;

            header("Location: mainPage.php");

        } else {
            header("Location: index.php?error=Incorrect username or password");
        }
        exit();

    }

}






?>


<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="css/logReg_mainStyle.css">
    <link rel="stylesheet" href="css/login_styling.css">

</head>

<body>
<header>
    <h1><span class="logo">Team Task Manager</span></h1>
</header>
<main>
    <form method="post" action="index.php">
        <h2>Login</h2>

        <?php if (isset($_GET['error'])) { ?>
            <?php
            //check for xss
            $error = validate($_GET['error']);
            ?>
            <p class="error"><?php echo $error ?></p>
        <?php } ?>

        <label class="details">Username</label>
        <input type="text" name="username" placeholder="Username" required>

        <label class="details">Password</label>
        <input type="password" name="password" placeholder="Password" required>

        <input type="submit" value="Login" name="login">

        <p>Don't have an account? <a href="register.php">Register</a></p>

    </form>
</main>

<footer>
    <p>Team Task Manager &copy; 2023</p>
</footer>

</body>
</html>