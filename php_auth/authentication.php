<?php
session_start();

require "db.php";

if ($_SERVER["REQEST_METHOD"] !== "POST") {
    die("invalid reqest method");
}


$username = trim($_POST["username"] ?? '' );
$password = trim($_POST["password"] ?? '');

if (empty($username) || empty($password)) {
    die("username and password are rquired");

}

if (!preg_match("/^[a-zA-Z0-9_]{3,20}$/", $username)) {
    die("Invalid username format.");
}

$stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
$stmt-> bind_param("s", $username);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = result->fetch_assoc();


    if (password_verify($password, $user["password"])) {
        sesstion_regenerate_id(true);

        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];

        header("location: dashboard.php");
        exit;
    }
} else {
    echo "Invalid username or password";
}


?>