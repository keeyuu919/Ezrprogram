<?php
session_start();
include('database.php');

function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['login'])) {
    $email = validate($_POST['email']);
    $password = validate($_POST['password']); 
    if (empty($email)) {
        header("Location: login.php?error=Email is required");
        exit();
    } elseif (empty($password)) {
        header("Location: login.php?error=Password is required");
        exit();
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];
        if (password_verify($password, $hashed_password)) {
            echo "Successfully Logged In";
            $_SESSION['email'] = $email;
            $_SESSION['id'] = $row['id'];
            header("Location: home.php");
            exit;
        } else {
            header("Location: index.php?error=Incorrect email or password");
            exit;
        }
    } else {
        header("Location: index.php?error=Incorrect email or password");
        exit();
    }
}
?>