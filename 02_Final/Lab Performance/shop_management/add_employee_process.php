<?php
    include 'db.php';

    $data     = $_POST['employee'];
    $employee = json_decode($data);

    $name       = mysqli_real_escape_string($conn, $employee->name);
    $username   = mysqli_real_escape_string($conn, $employee->username);
    $contact_no = mysqli_real_escape_string($conn, $employee->contact_no);
    $email      = mysqli_real_escape_string($conn, $employee->email);
    $password   = md5($employee->password);

    $check = mysqli_query($conn, "SELECT * FROM employees WHERE username='$username'");
    if(mysqli_num_rows($check) > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Username already exists!']);
        exit;
    }

    $sql = "INSERT INTO employees (name, username, contact_no, email, password)
            VALUES ('$name', '$username', '$contact_no', '$email', '$password')";

    if(mysqli_query($conn, $sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Employee registered successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to register employee!']);
    }
?>
