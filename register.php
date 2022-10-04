<!DOCTYPE html>

<?php
include "init.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $register_query = "INSERT INTO users (firstName, lastName, email, username, password) VALUES ('$_POST[firstName]', '$_POST[lastName]', '$_POST[email]', '$_POST[username]', '$_POST[password]')";
    $register_result = mysqli_query($conn, $register_query);

    if ($register_result) {
        $last_id = $conn->insert_id;
        $_SESSION["user_id"] = $last_id;

        header("Location: index.php");
    } else {
        echo "Error: " . $register_query . "<br>" . mysqli_error($conn);
    }
}

include "end.php";
?>
<html>

<div>
    <form method="post">
        <input type="text" name="firstName" placeholder="First Name">
        <input type="text" name="lastName" placeholder="Last Name">
        <input type="text" name="username" placeholder="Username">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" name="submit">
    </form>
</div>

</html>