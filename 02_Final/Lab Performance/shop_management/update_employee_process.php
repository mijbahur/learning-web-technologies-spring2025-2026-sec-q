<?php
    include 'db.php';

    $data     = $_POST['employee'];
    $employee = json_decode($data);

    $id         = mysqli_real_escape_string($conn, $employee->id);
    $name       = mysqli_real_escape_string($conn, $employee->name);
    $username   = mysqli_real_escape_string($conn, $employee->username);
    $contact_no = mysqli_real_escape_string($conn, $employee->contact_no);
    $email      = mysqli_real_escape_string($conn, $employee->email);

    $sql = "UPDATE employees SET name='$name', username='$username', contact_no='$contact_no', email='$email' WHERE id='$id'";

    if(mysqli_query($conn, $sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Employee updated successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Update failed!']);
    }
?>
