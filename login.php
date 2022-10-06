<?php
include_once "init.php";

if (isset($_POST["submit"])) {
    $login_query = "SELECT * FROM users WHERE username = '$_POST[username]' AND password = '$_POST[password]'";
    $login_result = mysqli_query($conn, $login_query);

    if (mysqli_num_rows($login_result) > 0) {
        $login_row = mysqli_fetch_assoc($login_result);
        $_SESSION["user_id"] = $login_row["id"];
        header("Location: index.php");
    } else {
        echo "Invalid username or password";
    }
}
?>

<html>

<?php include "head.php"; ?>

<div>
    <form method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" name="submit">
    </form>
    <a class="btn" href="register.php">Register</a>
</div>

</html>