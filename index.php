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
    $email=$row['email'];
    //for profile pic
    $q1= "select * from user_profile where username='$username'";
    $mq1=mysqli_query($con,$q1);
    $row = mysqli_fetch_assoc($mq1);
    $profile=$row['profile_pic'];
    $_SESSION['user_profile'] = $row['profile_pic'];
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
  <script src="https://kit.fontawesome.com/83258b24d5.js" crossorigin="anonymous"></script>
  <title>index</title>
  <style>
        *{
            margin: 0; padding: 0; font-family: 'Josefin Sans', sans-serif;
        }
        </style>
</head>
<!--                          Navbar                                     -->
<body class="night bg-light" >
  <header class="mb-5">
    <nav class="navbar fixed-top navbar-expand-lg navbar-light  bg-light pl-2 pr-5 shadow-sm">
      <a class="navbar-brand" id="log">PA</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
        
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto ">
        <li class="pt-1 fa">
          <?php include 'search.php'; ?>
        </li>
              <li class="nav-item pl-2 pr-1">
                <div class="avatar text-center m-1" id="profile" >
                  <a  ><img src="<?php echo $profile ?>" id="profile2" alt="profile" class="avatar rounded-circle img-fluid shadow" height="30px" width="30px" 
                  ></a>
                  <?php echo $username; ?>
                </div>
                </li>
              <li class="nav-item pl-2 pr-2">
                <a class="nav-link" id="explore"  role="button">Explore</a>
              </li>
              <li class="nav-item pl-2 pr-2">
                <a class="nav-link" id="trending" role="button">Trending</a>
              </li>
              <!--notification drop down-->
              <li class="nav-item pl-2 pr-2">
              <div class="dropdown">
  <a class="nav-link dropdown-toggle btn" type="" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Notification
      </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item text-danger" href="#">Comming soon</a>
  </div>
</div>
              </li>
              <li class="nav-item pl-2 pr-2">
                <a class="nav-link" id="about" role="button">About Us</a>
              </li>
              <li>
                <a class="btn btn-outline-success " href="logout.php">LogOut</a>
              </li>
            </ul>
        </div>
        <hr>
      </nav>
    </header>
    <div class="result container"></div>
                                                        <!--       n nn n ne w ne w ne n   w en     wne nw new nen               -->
<div id="here" class="">

</div>

<script>
$(document).ready(function(){
            $("#here").load("post.php",function(){
            });
        $("#explore").click(function(){
            $("#here").load("ex_post.php",function(){
            });
        });
        $("#trending").click(function(){
            $("#here").load("trending.php",function(){
            });
        });
        $("#about").click(function(){
            $("#here").load("about.php",function(){
            });
        });
        $("#profile").click(function(){
            $("#here").load("profile.php",function(){
            });
        });
        $("#profile2").click(function(){
            $("#here").load("profile.php",function(){
            });
        });
        $("#log").click(function(){
            $("#here").load("post.php",function(){
            });
        });
    });
</script>

</body>
</html>
<?php
?>