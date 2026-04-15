<?php
session_start();

if($_POST['username'] == $_SESSION['user']['username'] && $_POST['password'] == $_SESSION['user']['password']){
    setcookie('status', 'true', time()+3600, '/');
    header('location: dashboard.php');
}else{
    echo "Invalid Credentials";
}
?>
