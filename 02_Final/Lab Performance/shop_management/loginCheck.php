<?php
    session_start();
    include 'db.php';

    $data = $_POST['user'];
    $user = json_decode($data);

    $username = mysqli_real_escape_string($conn, $user->username);
    $password = md5($user->password);

    $sql = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['admin_id'] = $row['id'];
        $_SESSION['admin_username'] = $row['username'];
        echo json_encode(['status' => 'success', 'message' => 'Login successful']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid username or password!']);
    }
?>
