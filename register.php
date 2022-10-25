<!DOCTYPE html>

<?php
include_once "init.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (
        empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["email"]) ||
        empty($_POST["firstName"] || empty($_POST["lastName"]))
    ) {
        displayError("Please fill in all fields");
    } else {

        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        $register_query = "INSERT INTO users (firstName, lastName, email, username, password) VALUES ('$_POST[firstName]', '$_POST[lastName]', '$_POST[email]', '$_POST[username]', '$password')";
        $register_result = mysqli_query($conn, $register_query);

        if ($register_result) {
            $last_id = $conn->insert_id;
            $_SESSION["user_id"] = $last_id;

            header("Location: " . rootUrl("/index.php"));
        } else {
            echo "Error: " . $register_query . "<br>" . mysqli_error($conn);
        }
    }
}

include_once "end.php";
?>
<html>

<?php include "head.php"; ?>

<div class="login-container">
    <form class="login-form" method="post">
        <input type="text" name="firstName" placeholder="First Name">
        <input type="text" name="lastName" placeholder="Last Name">
        <input type="text" name="username" placeholder="Username">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <input class="btn" type="submit" name="submit">
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
</div>

</html>