<?php
session_start();
include('database.php');

if(isset($_POST['email']) && isset($_POST['password'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

$email = validate($_POST['email']);
$password = validate($_POST['password']);

if(empty($email)) {
    header("Location: index.php?error=Email is required");
    exit();
}
else if(empty($password)) {
    header("Location: index.php?error=Password is required");
    exit();
}

$sql = "SELECT * FROM ezrdb WHERE email='$email' AND password=$password";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) === 1) {
    if($row['email'] === $email && $row['password'] === $password) {
        echo "Succesfully Logged In";
        $_SESSION['email'] = $row['email'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['id'] = $row['id'];
        header("Location: home.php");
        exit();
        }
    else{
        header("Location: index.php?error=Incorrect Email or Password");
        exit();
    }
}
else {
    header("Location: index.php");
    exit();
}
?>

