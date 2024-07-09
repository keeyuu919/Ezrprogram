<?php
    session_start();
    require 'database.php';
    if(isset($_POST["register"])){
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $number = $_POST["number"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmpassword = $_POST["confirmpassword"];
        $duplicate = mysqli_query($conn, "SELECT * FROM ezrdb WHERE email='$email'");

        if(mysqli_num_rows($duplicate) > 0) {
            echo
            "<script> alert('Email has already been registered'); </script>";
        }
        else{
            if($password == $confirmpassword) {
                $query = "INSERT INTO ezrdb VALUES('', '$fname', '$lname', '$number', '$email', '$password')";
                mysqli_query($conn,$query);
                echo
                "<script> alert('Successfully Registered'); </script>";
            }
            else {
                echo
                "<script> alert('Please confirm your password again'); </script>";
            }
            
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
            <h1> LOGIN </h1>
            <?php if(isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            <label for="fname">First Name</label>
            <input type="text" name="fname" id = "fname" placeholder="Enter Your First Name"><br>
            <label for="lname">Last Name</label>
            <input type="text" name="lname" id = "fname" placeholder="Enter Your Last Name"><br>
            <label for="number" >Phone Number</label>
            <input type="text" name="number" id = "fname" maxlength="11" placeholder="Enter Your Phone Number"><br>
            <label for="email">Email</label>
            <input type="text" name="email" id = "fname" placeholder="Enter Your Email"><br>
            <label for="password" >Password</label>
            <input type="password" name="password" id = "fname" maxlength="16" placeholder="Enter Your Password"><br>
            <label for="confirmpassword">Confirm Password</label>
            <input type="confirm password" name="confirmpassword" id = "confirmpassword" maxlength="16" placeholder="Please Confirm Your Password"><br>
            <button type="register">Register</button>
            <a href="index.php">Already have a registered account?</a>
            

        </form>
</html>
                 


