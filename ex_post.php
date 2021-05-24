<?php
  session_start();
if(!isset($_SESSION['username'])){
  header('location:login.php');
}else{
    $uid=$_SESSION['id'];
    include 'connection.php';
    $q= "select * from registration where id='$uid' ";
    $q1= "select * from t_post";
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
    <title>post</title>
    <style>
</style>
</head>
<body>
  <div class="card">

  </div>
  <div class="align-center pt-1">
            <h1 class="pad-text text-center text-light text-capitalize p-2 w-100 bg-warning ">Explore</h1>
          </div>
              <?php
    include 'connection.php';
   $q1= "select * from posts order by post_id desc";
  $mq1=mysqli_query($con,$q1);
  $nums =mysqli_num_rows($mq1);
  while($row = mysqli_fetch_array($mq1)){
    $un=$row['username'];
    $post=$row['post'];
    $post_title=$row['post_title'];
    $post_time=$row['post_time'];


    $q2= "select * from user_profile where username='$un'";
      $mq2=mysqli_query($con,$q2);
      $ro= mysqli_fetch_assoc($mq2);
    $profile =$ro['profile_pic'];
  ?>
    <div class="post-card card mt-5 mb-5 col-lg-8 col-md-10 col-sm-12 mx-auto container p-2 shadow" style="width:650px">
      <div class="info bg-light pd-2 pb-3">
        <div class="avatar">
          <img src="<?php echo $profile ?>" alt="profile" class="avatar rounded-circle img-fluid bg-" height="40px" width="40px" >
            <a href="" class=" text-dark   p-1">
              <!--Dynamic name-->
              <?php echo $un; ?>
            </a><a href="#" class="text-primary pt-2 pr-2 float-right">Follow</a>
          </div>
          <small class="card-text bg-light pl-1 font-2px">
            <!--Dynamic text-->
            <?php $timestamp = strtotime($post_time);
              echo date("d-m-Y", $timestamp);
              ?>
            </small>
            <h5 class="p-0"> <?php echo $post_title; ?> </h5>
            <img class="post-img card-img-top img-fluid img-responsive" src="<?php echo $post; ?>"alt="Card image"height="600px" width="650px">
            <hr class="bg-">
          </div>
          <div class=" w-100 mx-auto text-center btn btn-toggle" data-toggle="buttons">
            <a href="javascript:void();" id="funny1" class="funny1 btn btn-outline-warning mr-5 " >Funny</a>
            <a href="javascript:void();" class="funny2 btn btn-outline-primary mr-5 ml-5">Compliment</a>
            <a href="javascript:void();" class="funny3 btn btn-outline-success ml-5">Share</a>              
          </div>
                
    </div>
  <?php
      }
      ?>
</body>
</html>