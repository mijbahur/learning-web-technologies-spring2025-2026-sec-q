<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Employee</title>
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['admin_id'])) {
        header('location: login.php');
        exit;
    }
    include 'db.php';

    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM employees WHERE id='$id'");
    $emp = mysqli_fetch_assoc($result);
    ?>
    <div class="navbar">
        <h2>Shop Management System</h2>
        <a href="logout.php">Logout</a>
    </div>

    <div class="container">
        <div class="card">
            <h3>Update Employee Info</h3>
            <input type="hidden" id="emp_id" value="<?= $emp['id'] ?>" />
            <label>Full Name</label>
            <input type="text" id="name" value="<?= $emp['name'] ?>" />
            <label>Username</label>
            <input type="text" id="username" value="<?= $emp['username'] ?>" />
            <label>Contact No</label>
            <input type="text" id="contact_no" value="<?= $emp['contact_no'] ?>" />
            <label>Email</label>
            <input type="email" id="email" value="<?= $emp['email'] ?>" />
            <div class="btn-row">
                <button class="btn-update" onclick="ajaxUpdate()">Update</button>
                <button class="btn-back" onclick="window.location.href='dashboard.php'">Back</button>
            </div>
            <div id="msg"></div>
        </div>
    </div>

    <script>
        function ajaxUpdate() {
            let id = document.getElementById('emp_id').value;
            let name = document.getElementById('name').value;
            let username = document.getElementById('username').value;
            let contact_no = document.getElementById('contact_no').value;
            let email = document.getElementById('email').value;

            if (name == '' || username == '' || contact_no == '' || email == '') {
                document.getElementById('msg').innerHTML = '<span class="error">All fields are required!</span>';
                return;
            }

            let data = {
                'id': id,
                'name': name,
                'username': username,
                'contact_no': contact_no,
                'email': email
            };
            let employee = JSON.stringify(data);

            let xhttp = new XMLHttpRequest();
            xhttp.open('post', 'update_employee_process.php', true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send('employee=' + employee);
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    let res = JSON.parse(this.responseText);
                    if (res.status == 'success') {
                        document.getElementById('msg').innerHTML = '<span class="success">' + res.message + '</span>';
                        setTimeout(() => { window.location.href = 'dashboard.php'; }, 1000);
                    } else {
                        document.getElementById('msg').innerHTML = '<span class="error">' + res.message + '</span>';
                    }
                }
            }
        }
    </script>
</body>

</html>