<!DOCTYPE html>

<?php
include_once "init.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (
        empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["email"]) ||
        empty($_POST["firstName"] || empty($_POST["lastName"]))
    ) {
        displayError("Please fill in all fields");
    } else if (userExists($_POST["username"])) {
        displayError("Username is already taken");
    } else if (emailExists($_POST["email"])) {
        displayError("Email is already taken");
    } else if ($_POST["captcha"] != $_SESSION["captcha"]) {
        displayError("Captcha is incorrect");
    } else {

        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            displayError("Invalid email");
        } else {

            $register_query = "INSERT INTO users (firstName, lastName, email, username, password) VALUES (?, ?, ?, ?, ?)";
            $result = runQuery($register_query, "sssss", $_POST["firstName"], $_POST["lastName"], $_POST["email"], $_POST["username"], $password);
            $register_result = $result->fetch_assoc();

            if ($register_result) {
                $last_id = $conn->insert_id;
                $_SESSION["user_id"] = $last_id;

                header("Location: " . rootUrl("/index.php"));
            } else {
                echo "Error: " . $register_query . "<br>" . mysqli_error($conn);
            }
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
        <img src="captcha.php" height="50%" width="50%" alt="captcha">
        <input type="text" name="captcha" placeholder="Enter Captcha">
        <input class="btn" type="submit" name="submit">
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
</div>

</html>