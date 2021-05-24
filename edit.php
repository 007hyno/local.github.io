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
      $t=$row['time'];
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="index.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <title>text</title>
    <style>
        *{
            margin: 0; padding: 0; font-family: 'Josefin Sans', sans-serif;
        }
        </style>
</head>
<body>
<header class="mb-5">
    <nav class="navbar fixed-top navbar-expand-lg navbar-light  bg-light pl-2 pr-5 shadow-sm">
      <a class="navbar-brand" href="index.php" id="#logo">Memez</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <div class="ml-auto w-50">
            <form class="form-inline my-2 my-lg-0 ml-5">
                <input class="form-control mr-sm-2 col-lg-10 col-md-12 col-12" type="search" placeholder="Search Memer here.." aria-label="Search" style="border: 0;">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit" style="background-color: rgb(254, 44, 84);">Search</button>
            </form>
          </div>
          <ul class="navbar-nav ml-auto ">
              <li class="nav-item pl-2 pr-1">
                <div class="avatar text-center m-1" id="profile" >
                  <a  ><img src="<?php echo $profile ?>" id="profile2" alt="profile" class="avatar rounded-circle img-fluid shadow" height="30px" width="30px" 
                  ></a>
                  <?php echo $username; ?>
                </div>
                </li>
              <li class="nav-item pl-2 pr-2">
                <a class="nav-link" id="home"  role="button" href="index.php">Home</a>
              </li>
              <li class="nav-item pl-2 pr-2">
                <a class="nav-link" id="trending" role="button">Trending</a>
              </li>
              <!--notification drop down-->
              <li class="nav-item pl-2 pr-2">
                <div class="dropdown">
                  <a class="nav-link col-md-6 col-lg-12 btn  "  href="#" role="button" dropdown-toggle type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-bell fa-lg"></i><span class="badge">1</span>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <!--notificaion content-->
                    <div class="info bg-light pd-2 pb-3">
                      <div class="avatar">
                        <img src="images/avatar.png" alt="profile" class="avatar rounded-circle img-fluid bg-dark" height="40px" width="40px" >
                        <a  class=" text-dark"><?php echo $username; ?></a>
                      </div>
                    </div>
                    
                    <div class="card bg-dark w-100">
                      <div class="avatar text-left " id="status">
                        <a href="" ><img src="images/avatar.png" alt="profile" class="avatar rounded-circle img-fluid shadow m-2s" height="25px" width="25px" ></a>
                    </div>
                  </div>
                  </div>
                </div>
              </li>
              <li class="nav-item pl-2 pr-2">
                <a class="nav-link" id="about">About Us</a>
              </li>
              <li>
                <a class="btn btn-outline-success" href="logout.php">LogOut</a>
              </li>
            </ul>
        </div>
        <hr>
      </nav>
    </header> 



<!-- Edit form-->
<section class="pt-1">
    <div class="bg- register-photo w-50 mx-auto my-5">
        <div id="up" class= "form-container container mx-auto card mt-5 mb-5 pt-5 pb-1 col-lg-8 col-12">
            <form action="edit.php" method="POST">
                    <h1 class="text-center text-muted">Edit_Profile
                    </h1>
                        <div class="info pd-2 pb-3">
                            <div class="avatar">
                              <img src="<?php echo $profile  ?>" alt="profile" class="avatar rounded-circle img-fluid" height="90px" width="90px" >
                              <a class="btn btn-primary text-light" id="butt" href="dp.php">Edit Profile Pic</a>
                              <?php echo Date($t);?>
                            </div>
                          </div>
                         

<!--here is the problem starts-->
                          <!--Edit fullname-->
                        <div class="form-group">
                            <label for="fullname"><b> Fullname:</b></label>
                            <input type="fullname" class="form-control" placeholder="Fullname" id="Full Name" autocomplete="off" name="fullname" value="<?php echo $fullname; ?>">
                        </div>
                        <p class="text-secondary">
                            Your first name is an individual name that is given to you by your parents, and for that reason is often referred to as a given name. 
                        </p>
                        <div class="form-group">
                            <label for="username"><b> Username:</b></label>
                    <input type="username" class="form-control" placeholder="Username" id="Username" autocomplete="off" name="username" value="<?php echo $username; ?>">
                  </div>
                  <p class="text-muted">
                      This is your unique name which will give you a unique identity in this platform
                  </p>
                  <div class="form-group">
                      <label for="username"><b> Bio:</b></label>
                      <textarea class=" col-lg-12 col-md-8 col-sm-6" name="bio" id="bio" cols="60" rows="4" maxlength="80"></textarea>
                    </div>
                    <hr class="bg-info mx-auto">
                  <div class="form-group">
                      <label for="pwd" class="text-danger">Old Password:</label>
                      <input type="password" class="form-control" placeholder="Enter old password" id="pwd">
                    </div>
                  <div class="form-group">
                      <label for="pwd" class="text-success"> New Password:</label>
                      <input type="password" class="form-control" placeholder="Enter new password" id="pwd">
                    </div>
                  <div class="form-group">
                      <label for="pwd" class="text-success"> Confirm Password:</label>
                      <input type="password" class="form-control" placeholder="Enter confirm password" id="pwd">
                    </div>
                    <div class="text-center pb-3">
                        <button type="submit" id="update" class="btn btn-primary" name="update">Save changes </button>
                        <button type="submit" class="btn btn-primary" href="edit.php">Cancel </button>
                    </div>
              </form>
        </div>
    </div>
</section>

</body>
</html>
<?php

//update into ...
include 'connection.php';
if(isset($_POST['update'])){
    $fullname = mysqli_real_escape_string($con, $_POST['fullname']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $bio = mysqli_real_escape_string($con, $_POST['bio']);
    $q= "update registration set  username='$username',fullname='$fullname' where id='$uid'";
    $mq=mysqli_query($con,$q);
    if($mq){
      echo' - updated - ';
    }else{
            echo' - error while update - ';
        }
  
}


?>
      <script>
</script>
