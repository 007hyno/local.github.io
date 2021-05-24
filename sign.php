<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign_up</title>
    <link rel="stylesheet" href="form.css">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet"> 
</head>
<body >
<header>
        <main>
            <div class="container1">
                <img src="images/phn.png" alt="">
            </div>
        </main>

        <section>
            <div class="container2">
                <form action="" method="POST">
                    <br>
                        <h1>M.in</h1><br>
                        <label for = "email" class = "label">Email Address</label><br>
                    <input type="text" class = "input1" placeholder="Email" id="email" name="email" autocomplete="off" required ><br><br>
                        <label for = "fullname" class = "label">Full Name</label><br>
                    <input type="text" class = "input1" placeholder="Fullname" id="fullname" name="fullname" autocomplete="off" required ><br><br>
                        <label for = "username" class = "label">User Name</label><br>
                    <input type="text" class = "input1" placeholder="Username" id="username" name="username" autocomplete="off" required ><br><br>
                        <label for = "password" class = "label">Password</label><br>
                    <input type="password" class = "input1" placeholder="Password" id="email" name="email" autocomplete="off" required ><br><br>
                    <button type="submit" name="signup" class="inputbut" >Create Account </button>  <br><br><hr>
                    <br>
                    <h4>already have a account.<a href="login.php">log_in</a></h4><br>
                </form>
            </div>
        </section>
    </header>

</body>
</html>
<?php

include 'connection.php';

if(isset($_POST['signup'])){

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $fullname = mysqli_real_escape_string($con,$_POST['fullname']);
    $username = mysqli_real_escape_string($con,$_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $post = mysqli_real_escape_string($con,'0');
    $following = mysqli_real_escape_string($con,'0');
    $follower = mysqli_real_escape_string($con,'0');

    $pass = password_hash($password,PASSWORD_BCRYPT);

    $q= "insert into registration (email,fullname,username,password) values('$email','$fullname','$username','$pass') ";
    $q1= "insert into user_info (username,post,following,follower) values('$username','$post','$following','$follower') ";
    $q2= "insert into user_profile (username,profile_pic) values('$username','$dest') ";
    
    $mq  = mysqli_query($con,$q);
    $mq1  = mysqli_query($con,$q1);
    $mq2  = mysqli_query($con,$q2);
    if($mq&&$mq1&&$mq2){
?>
        <script>
        alert("DATA INSERTED  ");
        </script>
<?php
header('location:index.php');
    }else{
?>
        <script>
        alert("ERROR-404");
        </script>
<?php
    }



}

?>