<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="form.css">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet"> 
</head> 
<body>
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
                    <h1 >M</h1><br>
                    <label for = "email" class = "label">Email Address</label><br>
                    <input type="text" class = "input1" placeholder="Enter email" id="email" name="email" autocomplete="off" required ><br><br>
                    <label for = "Password" class = "label">Password</label><br>
                    <input type="password" class = "input1"  placeholder="Enter password" id="pwd" name="password" required ><br><br>
                    <input type="checkbox" >&nbsp Remember Me<br><br>
                 
                    <button type="submit" name="login" class="inputbut" >Here We Go Again.. </button>  <br><br><hr>
                    <br>
                    <h4>don't have a account.<a href="sign.php">Sign_Up</a></h4><br>
                </form>
            </div>
        </section>
    </header>

</body>

</html>
<?php
include 'connection.php';
if(isset($_POST['login'])){
    $email =$_POST['email'];
    $password =mysqli_real_escape_string($con,$_POST['password']);
    $q= "select * from registration where email='$email' ";
    $mq=mysqli_query($con,$q);
    $key  = mysqli_num_rows($mq);
    if($key){
        $row = mysqli_fetch_assoc($mq);
        $pass=$row['password'];
        $p = password_verify($password,$pass);
        if($p){
            echo $row['email'];
            $_SESSION['id']=$row['id'];
            $_SESSION['email']=$row['email'];
            $_SESSION['fullname']=$row['fullname'];
            $_SESSION['username']=$row['username'];
            $_SESSION['time']=$row['time'];
            header("location:index.php");
        }else{
            echo' - pass not match - ';
        }
    }else{
        echo' - no such email found - ';
    }
}

?>