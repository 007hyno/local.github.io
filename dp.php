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
    }
  
}
?><!DOCTYPE html>
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
    <title>Document</title>
</head>
<body>
    <h1><?php echo $username; ?></h1>
<form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="img" id="">
        <input class="btn btn-info" type="submit" name="submit" id="">
        <a class="btn btn-primary" href="edit.php">Back</a>
    </form>
</body>
</html>
<?php
include 'connection.php';
if(isset($_POST['submit'])) {
$image = $_FILES['img'];
//print_r($image);
$filename = $image['name'];
$filepath = $image['tmp_name'];
$fileerror = $image['error'];
if($fileerror==0){
        $destfile = 'upload/'.$filename;
        move_uploaded_file($filepath,$destfile);
        $q= "update user_profile set  profile_pic='$destfile' where username='$username'";
        $mq=mysqli_query($con,$q);
        if($mq){
          header("location:edit.php");
            echo 'success';
        }else{
            echo 'not done';
        }
}
}
?>