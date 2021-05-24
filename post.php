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
    $profile=$_SESSION['user_profile'];
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

<div class="p-3">
</div>
<!--top section-->
  <div class="card mx-auto container p-1 shadow bg" style="width:650px">  
    <div class="avatar text-center" id="status">
      <img src="<?php echo $profile ?>" alt="profile" class="float-left avatar rounded-circle img-fluid bg-dark" height="40px" width="40px" >
      <!-- Button trigger modal -->
      <div class="text-center container w-25">  
        <a class="mx-auto btn btn-success text-light" id="bt" href="create_post.php">
          .    +    .
        </a>
      </div>
    </div>
</div>
<!-- here is my code -->
<div class="container">
   <div id="load_data"></div>
   <div id="load_data_message"></div>
  </div>

<!-- Scripteeeeee -->
<script>
$(document).ready(function(){
 
 var limit = 7;
 var start = 0;
 var action = 'inactive';
 function load_country_data(limit, start)
 {
  $.ajax({
   url:"fetch_post.php",
   method:"POST",
   data:{limit:limit, start:start},
   cache:false,
   success:function(data)
   {
    $('#load_data').append(data);
    if(data == '')
    {
     $('#load_data_message').html("<button type='button' class='btn btn-info'>YOU REACH TO THE LIMIT</button>");
     action = 'active';
    }
    else
    {
     $('#load_data_message').html("<button type='button' class='btn btn-warning'>Please Wait....</button>");
     action = "inactive";
    }
   }
  });
 }

 if(action == 'inactive')
 {
  action = 'active';
  load_country_data(limit, start);
 }
 $(window).scroll(function(){
  if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
  {
   action = 'active';
   start = start + limit;
   setTimeout(function(){
    load_country_data(limit, start);
   }, 1000);
  }
 });
 
});
</script>


<!--scripteeeeee-->
<script>
  $(document).ready(function(){

// if the user clicks on the like button ...
$('.like-btn').on('click', function(){ 
  var post_id = $(this).data('id'); 
  $clicked_btn = $(this);
  
  if ($clicked_btn.hasClass('fa-thumbs-o-up')) {
      action = 'like';

  } else if($clicked_btn.hasClass('fa-thumbs-up')){
      action = 'unlike';
    
  }
  $.ajax({
      url: 'index.php',
      type: 'post',
      data: {
          'action': action,
          'post_id': post_id
      },
      success: function(data){
          res = JSON.parse(data);
          if (action == "like") {
              $clicked_btn.removeClass('fa-thumbs-o-up');
              $clicked_btn.addClass('fa-thumbs-up');
          } else if(action == "unlike") {
              $clicked_btn.removeClass('fa-thumbs-up');
              $clicked_btn.addClass('fa-thumbs-o-up');
          }
          // display the number of likes and dislikes
          $clicked_btn.siblings('span.likes').text(res.likes);
          $clicked_btn.siblings('span.dislikes').text(res.dislikes);

          // change button styling of the other button if user is reacting the second time to post
          $clicked_btn.siblings('i.fa-thumbs-down').removeClass('fa-thumbs-down').addClass('fa-thumbs-o-down');
      }
  });		

});

// if the user clicks on the dislike button ...
$('.dislike-btn').on('click', function(){
  var post_id = $(this).data('id');
  $clicked_btn = $(this);
  if ($clicked_btn.hasClass('fa-thumbs-o-down')) {
      action = 'dislike';
  } else if($clicked_btn.hasClass('fa-thumbs-down')){
      action = 'undislike';
  }
  $.ajax({
      url: 'index.php',
      type: 'post',
      data: {
          'action': action,
          'post_id': post_id
      },
      success: function(data){
          res = JSON.parse(data);
          if (action == "dislike") {
              $clicked_btn.removeClass('fa-thumbs-o-down');
              $clicked_btn.addClass('fa-thumbs-down');
          } else if(action == "undislike") {
              $clicked_btn.removeClass('fa-thumbs-down');
              $clicked_btn.addClass('fa-thumbs-o-down');
          }
          // display the number of likes and dislikes
          $clicked_btn.siblings('span.likes').text(res.likes);
          $clicked_btn.siblings('span.dislikes').text(res.dislikes);
          
          // change button styling of the other button if user is reacting the second time to post
          $clicked_btn.siblings('i.fa-thumbs-up').removeClass('fa-thumbs-up').addClass('fa-thumbs-o-up');
      }
  });	

});

});

</script>
</body>
</html>