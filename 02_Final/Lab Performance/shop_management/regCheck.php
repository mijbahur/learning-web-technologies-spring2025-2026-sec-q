<?php
    include 'db.php';

    $data = $_POST['user'];
    $user = json_decode($data);

    $username = mysqli_real_escape_string($conn, $user->username);
    $email    = mysqli_real_escape_string($conn, $user->email);
    $password = md5($user->password);

    $check = mysqli_query($conn, "SELECT * FROM admins WHERE username='$username'");
    if(mysqli_num_rows($check) > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Username already exists!']);
        exit;
    }

    $sql = "INSERT INTO admins (username, email, password) VALUES ('$username', '$email', '$password')";
    if(mysqli_query($conn, $sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Registration successful! Redirecting...']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Registration failed. Try again!']);
    }
?>
