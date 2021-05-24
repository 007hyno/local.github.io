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
    $fullname=$row['fullname'];
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
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="pro.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <title>Profile</title>
    <style>
        *{
            margin: 0; padding: 0; font-family: 'Josefin Sans', sans-serif;
        }
        </style>
</head>
<?php
include 'connection.php';
$user=$username;
  $q= "select * from user_info where username='$username'"; 
  $mq = mysqli_query($con,$q);
  $key = mysqli_num_rows($mq);
  if($key){
    $row = mysqli_fetch_assoc($mq);
    $post=$row['post'];
    $following=$row['following'];
    $follower=$row['follower'];
}else{
        echo' - error in fetch - ';
}
?>
<body>
<script>
  $(document).$ready(function(){
        $("#home").click(function(){
            $("#here").load("home.php",function(){
            });
        });
  });
</script>
    <!--top space -->
<section class="mb-0">
</section>
    <!--top-->
    <!--profile top-->
    <section class="bg-light profile-top container-fluid w-100 mx-auto">
    <!--new one -->
    <div class="wall-art container-fluid align-center mx-auto p-3" >
        <div class="main-art text-center p-0 fixed" >
            <img class="img-art img-responsive" src="images/art3.jpg" alt="Avatar">
            <img class="img-pro img-responsive img-fluid" src="<?php echo $profile ?>" alt="Avatar">
        </div>
      </div>
        <div class="container  w-50 text-center" >
          <h4><b><?php echo $username; ?>.Dank</b></h4>
        </div>
        <!--follow and following-->
        <div class="bg-light pro-list container-fluid w-50 ">
          <ul class="uu">
            <li class="ll"><?php echo $post; ?> Post</li>
            <li class="ll"><?php echo $follower; ?> Followers</li>
            <li class="ll"><?php echo $following; ?> Following</li>
          </ul>
          <a id="edit_profile" class=" btn btn-outline-primary" href="edit.php">Edit Profile</a>
          <a href="#demo" class="btn btn-primary" data-toggle="collapse">Info </a>
  <div id="demo" class="collapse">
    Paras Rawat
    22 nov  
    code
  </div>
        </div>
    </section>
  <hr class="bg mx-auto container-fluid w-50">
<section>
    <!-- Nav tabs -->
    <div class= "container-fluid w-50 sm-nav">
      <ul class="nav sm-nav-tabs ">
        <li class="nav-item">
          <a class="nav-link text-dark active" data-toggle="tab" href="#Memes">Memes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" data-toggle="tab" href="#Tagged">Tagged</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-dark" data-toggle="tab" href="#Saved">Saved</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle text-dark" data-toggle="dropdown" href="#">More</a>
      <div class="dropdown-menu">
          <a class="dropdown-item" href="#">Memer</a>
          <a class="dropdown-item" href="#">Normi</a>
          <a class="dropdown-item" href="#">Dank</a>
        </div>
      </li>
    </ul>
  </div>
    <!-- Tab panes -->
    <div class="tab-content">
    <div class="tab-pane container active" id="Memes">
      <!--Gallary-->
<section>
  <div class="container text-center">
      <h3 class="text-center text-capitalize pt-2">Memes</h3  >
      <hr class="w-25 mx-auto pb-1">
      <!--fetching from database-->
      <div class="row">
      <!--here is one-->
        <div class="">
      <?php
    include 'connection.php';
    $q1= "select * from posts where username='$username' order by post_id desc limit 9";
    $mq1=mysqli_query($con,$q1);
    $nums =mysqli_num_rows($mq1);
    while($row = mysqli_fetch_array($mq1)){
      $post=$row['post'];
      ?>
<img src="<?php echo $post; ?>" alt="ass" class="img-fluid rounded col-lg-3 col-md-4 col-sm-12 my-1 "  height="400px" width="400px">
<?php
}
?>
</div>
  </div>
  </div>  
</section>
    </div>
    <div class="tab-pane container fade" id="Tagged">
      <!--Gallary-->
<section>
  <div class="container">
    <h3 class="text-center text-capitalize pt-2">Tagged</h3>
    <hr class="w-25 mx-auto pb-1">
<div class="row">
</div>
  </div>
</section>
    </div>
    <div class="tab-pane container fade" id="Saved">
      <!--Gallary-->
<section>
  <div class="container">
    <h3 class="text-center text-capitalize pt-2">Saved</h3>
    <hr class="w-25 mx-auto pb-1">
<div class="row" >
  <div class="col-lg-4 col-md-6 col-sm-12 mb-5">
<img src="images/art1.jpg" alt="ass" class="img-fluid rounded">
  </div>
  <div class="col-lg-4 col-md-6 col-sm-12 mb-5">
<img src="images/art2.jpg" alt="ass" class="img-fluid">
  </div>
  <div class="col-lg-4 col-md-6 col-sm-12 mb-5">
<img src="images/art1.jpg" alt="ass" class="img-fluid">
  </div>
  <div class="col-lg-4 col-md-6 col-sm-12 mb-5">
<img src="images/art3.jpg" alt="ass" class="img-fluid">
  </div>
  <div class="col-lg-4 col-md-6 col-sm-12 mb-5">
<img src="images/art1.jpg" alt="ass" class="img-fluid">
  </div>
  <div class="col-lg-4 col-md-6 col-sm-12 mb-5">
<img src="images/art1.jpg" alt="ass" class="img-fluid">
  </div>
  <div class="col-lg-4 col-md-6 col-sm-12 mb-5">
<img src="images/art2.jpg" alt="ass" class="img-fluid">
  </div>
  <div class="col-lg-4 col-md-6 col-sm-12 mb-5">
<img src="images/art2.jpg" alt="ass" class="img-fluid">
  </div>
  <div class="col-lg-4 col-md-6 col-sm-12 mb-5">
<img src="images/art2.jpg" alt="ass" class="img-fluid">
  </div>
  <div class="col-lg-4 col-md-6 col-sm-12 mb-5">
<img src="images/art1.jpg" alt="ass" class="img-fluid">
  </div>
  <div class="col-lg-4 col-md-6 col-sm-12 mb-5">
<img src="images/art1.jpg" alt="ass" class="img-fluid">
  </div>
  <div class="col-lg-4 col-md-6 col-sm-12 mb-5">
<img src="images/art1.jpg" alt="ass" class="img-fluid">
  </div>
</div>
</section>
    </div>
  </div>
</section>
</body>
</html>