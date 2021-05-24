<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
include 'connection.php'; 
if(isset($_REQUEST["term"])){
    // Prepare a select statement
    $sql = "SELECT * FROM registration WHERE fullname LIKE ?";
    
    if($stmt = mysqli_prepare($con, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_term);
        
        // Set parameters
        $param_term = $_REQUEST["term"] . '%';
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            
            // Check number of rows in the result set
            if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    $un= $row['username'];
                    $q2= "select * from user_profile where username='$un'";
                    $mq2=mysqli_query($con,$q2);
                    $ro= mysqli_fetch_assoc($mq2);
                  $profile =$ro['profile_pic'];
                    ?>
                    <!--hell yeah   -->
                    <a href="profile.php">    
                        <div class="card container-fluid w-100 p-1 shadow-sm">
                                <div class="avatar">
                                <img src="<?php echo $profile ?>" alt="profile" class="float-left avatar rounded-circle img-fluid py-1" height="40px" width="40px" >
                                <!-- Button trigger modal -->
                                <span class="text-body px-4 my-0" >
                                    <b> <?php echo $row["username"]; ?></b>
                                    <br>
                                </span>
                                <span class="text-black-50 px-3">
                                    <?php echo $row["fullname"];?>
                                </span>
                            </div>
                        </div>
                        </a>
                            
                    <?php
                }
            } else{
                echo "<p>No matches found</p>";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
}
 
// close connection
mysqli_close($con);
?>