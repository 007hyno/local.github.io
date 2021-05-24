<?php

$server = "localhost";
$user = "root";
$password = "";
$db = "main";

$con = mysqli_connect($server,$user,$password,$db);
if($con){
}else{
    echo' -Not connected error - ';
}

?>