<?php
include_once "init.php";

if (isset($_POST["submit"])) {

    $login_query = "SELECT * FROM users WHERE username = '$_POST[username]'";
    $login_result = mysqli_query($conn, $login_query);

    $passwordVerified = false;

    if (mysqli_num_rows($login_result) > 0) {
        $user = mysqli_fetch_assoc($login_result);
        $passwordVerified = password_verify($_POST["password"], $user["password"]);
    }
    if ($passwordVerified) {
        $_SESSION["user_id"] = $user["id"];
        header("Location: index.php");
    } else {
        displayError("Invalid username or password");
    }
}

?>

<html>

<?php include "head.php"; ?>

<div class="login-container">
    <form class="login-form" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <input class="btn" type="submit" name="submit">
    </form>
    <p>Don't have an account? <a href="register.php">Register</a></p>
</div>

</html>