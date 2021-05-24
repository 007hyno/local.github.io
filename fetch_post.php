<?php
if(isset($_POST["limit"], $_POST["start"]))
{
include 'connection.php';
 $query = "SELECT * FROM posts ORDER BY post_id DESC LIMIT ".$_POST["start"].", ".$_POST["limit"]."";
 $result = mysqli_query($con, $query);
 while($row = mysqli_fetch_array($result))
 {
    $un=$row['username'];
    $post=$row['post'];
    $post_title=$row['post_title'];
    $post_time=$row['post_time'];
    $post_id=$row['post_id'];
    $q2= "select * from user_profile where username='$un'";
    $mq2=mysqli_query($con,$q2);
    $ro= mysqli_fetch_assoc($mq2);
  $profile =$ro['profile_pic'];
  
  ?>
  <div class="post-card card mt-5 mb-5 col-lg-8 col-md-10 col-sm-12 mx-auto container p-2 shadow" style="width:650px">
      <div class="info bg-light pd-2 pb-3">
        <div class="avatar">
        <img src="<?php echo $profile ?>" alt="profile" class="avatar rounded-circle img-fluid bg-dark" height="40px" width="40px" >
          <a href="" class=" text-dark   p-1">
            <!--Dynamic name-->
            <?php echo $un; ?>
          </a><a href="#" class="text-primary pt-2 pr-2 float-right">Follow</a>
        </div>
          <small class="card-text bg-light pl-1 font-2px">
            <!--Dynamic text-->
            <?php 
            $timestamp = strtotime($post_time);
            echo date("d-m-Y", $timestamp);
            ?>
          </small>
          <h5 class="p-0 text-dark"> <?php echo $post_title; ?> </h5>
            <div class="card-body p-0">
          <img class="post-img card-img-top img-fluid rounded img-responsive" src="<?php echo $post; ?>"alt="Card image"height="600px" width="650px">
        <div class=" w-100 mx-auto text-center btn btn-toggle" data-toggle="buttons">

        <!--new-->
        </div>
      </div>


<!--reaction-->
        <div class="card-body  p-0">        
    
      <div class="post-info">
	    <!-- if user likes post, style button differently -->
      <i <?php 
      include 'server.php';
       if (userLiked($post_id)): ?>
      	 class="fa fa-thumbs-up like-btn"
      	  <?php else: ?>
      		  class="fa fa-thumbs-o-up like-btn"
      	  <?php endif ?>
      	  data-id="<?php echo $post_id ?>"></i>
      	<span class="likes"><?php echo getLikes($post_id); ?></span>
      	
      	&nbsp;&nbsp;&nbsp;&nbsp;

		<!-- if user dislikes post, style button differently -->
      	<i <?php if (userDisliked($post_id)): ?>
      		  class="fa fa-thumbs-down dislike-btn"
      	  <?php else: ?>
      		  class="fa fa-thumbs-o-down dislike-btn"
      	  <?php endif ?>
      	  data-id="<?php echo $post_id ?>"></i>
		  <span class="dislikes"><?php echo getDislikes($post_id); ?></span>
		</div>
	</div>

      <!--comment-->
      <div class="form-group">          
        <input type="comment" class="form-control" placeholder="comment..." id="comment" autocomplete="off">
      </div>
    </div>
  </div>
<?php
 }
}

?>