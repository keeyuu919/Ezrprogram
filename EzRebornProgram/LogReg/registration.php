<?php
session_start();
include('database.php');

function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['register'])) {
    $fname = validate($_POST['fname']);
    $lname = validate($_POST['lname']);
    $number = validate($_POST['number']);
    $email = validate($_POST['email']);
    $password = $_POST['password']; 
    $confirmpassword = $_POST['confirmpassword'];

    if (empty($fname)) {
        header("Location: registration.php?error=First name is required");
        exit();
    } elseif (empty($lname)) {
        header("Location: registration.php?error=Last name is required");
        exit();
    } elseif (empty($number)) {
        header("Location: registration.php?error=Phone number is required");
        exit();
    } elseif (empty($email)) {
        header("Location: registration.php?error=Email is required");
        exit();
    } elseif (empty($password)) {
        header("Location: registration.php?error=Password is required");
        exit();
    } elseif ($password != $confirmpassword) {
        header("Location: registration.php?error=Passwords do not match");
        exit();
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (fname, lname, number, email, password) VALUES (?,?,?,?,?)");
        $stmt->bind_param("sssss", $fname, $lname, $number, $email, $hashed_password);
        $stmt->execute();

        $_SESSION['email'] = $email;
        $_SESSION['id'] = $conn->insert_id;

        header("Location: registration.php?success=Registered successfully!");
        exit();
    } else {
        header("Location: registration.php?error=Email already exists");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title> Register  </title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <form action="registration.php" method="post" autocomplete="off">
        <h1> REGISTER </h1>
        <?php if(isset($_GET['error'])) {?>
            <p class="error"><?php echo $_GET['error'];?></p>
        <?php } elseif(isset($_GET['success'])) {?>
            <p class="success"><?php echo $_GET['success'];?></p>
            <button><a href="index.php">Continue to Login</a></button>
        <?php }?>
        <label for="fname">First Name</label>
        <input type="text" name="fname" id="fname" placeholder="Enter Your First Name"><br>
        <label for="lname">Last Name</label>
        <input type="text" name="lname" id="lname" placeholder="Enter Your Last Name"><br>
        <label for="number" >Phone Number</label>
        <input type="text" name="number" id="number" maxlength="11" placeholder="Enter Your Phone Number"><br>
        <label for="email">Email</label>
        <input type="text" name="email" id="email" placeholder="Enter Your Email"><br>
        <label for="password" >Password</label>
        <input type="password" name="password" id="password" maxlength="16" placeholder="Enter Your Password"><br>
        <label for="confirmpassword">Confirm Password</label>
        <input type="password" name="confirmpassword" id="confirmpassword" maxlength="16" placeholder="Please Confirm Your Password"><br>
        <button type="submit" name="register">Register</button>
        <a href="index.php">Already have a registered account?</a>
    </form>
</body>
</html>