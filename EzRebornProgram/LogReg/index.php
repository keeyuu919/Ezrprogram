<!DOCTYPE html>
<html lang="en">
    <head>
    <title> LOGIN  </title>
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <form action="login.php" method="post">
            <h1> LOGIN </h1>
            <?php if(isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            <label>Email</label>
            <input type="text" name="email" placeholder="Enter Your Email"><br>
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter Your Password"><br>
            <button type="submit">Login</button>
            <a href="registration.php">Don't have an account?</a>

        
</html>

