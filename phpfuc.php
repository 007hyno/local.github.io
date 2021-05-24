<?php

switch($_GET['menu']){

    case 'home':
        menu1();
        break;
    case 'explore':
        menu2();
        break;
    case 'trending':
        menu3();
        break;
    default:
        echo "he";
    break;
}

function menu1(){
    include 'home.php'; //do something
}
function menu2(){
    include 'ex_post.php';
}
function menu3(){
    include 'trending.php';
}


?>