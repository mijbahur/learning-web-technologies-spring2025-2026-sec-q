<?php
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username == "admin" && $password == "123"){
        
        $_SESSION['role'] = "admin";
        header('location: ../view/home.php');
    }
    else if(isset($_SESSION['registeredUser'])){

        $user = $_SESSION['registeredUser'];

        if($username == $user['username'] && $password == $user['password']){

            $_SESSION['role'] = "user";
            header('location: ../view/home.php');
        }
        else{
            echo "Invalid User!";
        }

    }
    else{
        echo "Invalid User!";
    }
?>