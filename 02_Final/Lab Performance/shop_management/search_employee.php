<?php
    include 'db.php';

    $data    = $_POST['data'];
    $search  = json_decode($data);
    $keyword = mysqli_real_escape_string($conn, $search->keyword);

    $sql = "SELECT * FROM employees WHERE name LIKE '%$keyword%' OR username LIKE '%$keyword%' OR email LIKE '%$keyword%' OR contact_no LIKE '%$keyword%'";
    $result = mysqli_query($conn, $sql);

    $employees = [];
    while($row = mysqli_fetch_assoc($result)) {
        $employees[] = $row;
    }

    echo json_encode($employees);
?>
