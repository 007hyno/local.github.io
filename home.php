<?php
  session_start();
if(!isset($_SESSION['username'])){
  header('location:login.php');
}else{
    $uid=$_SESSION['id'];
    include 'connection.php';
    $q= "select * from registration where id='$uid' ";
    $mq=mysqli_query($con,$q);
    if($mq){
      $row = mysqli_fetch_assoc($mq);
      $username=$row['username'];
      //for profile pic
      $q1= "select * from user_profile where username='$username'";
      $mq1=mysqli_query($con,$q1);
      $row = mysqli_fetch_assoc($mq1);
      $profile=$row['profile_pic'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/83258b24d5.js" crossorigin="anonymous"></script>
    <title>home</title>
</head>
<body class="night bg-dark" >

<script>
              $(document).ready(function(){
                $("#di1").load("post.php",function(){
                  });
    });
    
</script>

<div id="di1">
</div>


</body>
</html>
<?php


?>