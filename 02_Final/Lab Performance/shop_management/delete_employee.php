<?php
    include 'db.php';

    $data   = $_POST['data'];
    $emp    = json_decode($data);
    $id     = mysqli_real_escape_string($conn, $emp->id);

    $sql = "DELETE FROM employees WHERE id='$id'";
    if(mysqli_query($conn, $sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Employee deleted!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Delete failed!']);
    }
?>
