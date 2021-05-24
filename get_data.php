<?php
    if(isset($_GET['offset']) && isset($_GET['limit'])){
    $limit = $_GET['limit'];
    $offset = $_GET['offset'];
    include 'connection.php';

    $q1= "select * from posts order by post_id desc";
    $mq1=mysqli_query($con,$q1);
    $nums =mysqli_num_rows($mq1);
    while($row = mysqli_fetch_array($mq1)){
      $un=$row['username'];
      $post=$row['post'];
      $post_title=$row['post_title'];
      $post_time=$row['post_time'];
      ?>
      <div class="avatar">
      <img src="<?php echo $profile ?>" alt="profile" class="avatar rounded-circle img-fluid bg-dark" height="40px" width="40px" >
        <a href="" class=" text-dark   p-1">
          <!--Dynamic name-->
          <?php echo $un; ?>
        </a><a href="#" class="text-primary pt-2 pr-2 float-right">Follow</a>
      </div>
      <?php
    }
    }
?>