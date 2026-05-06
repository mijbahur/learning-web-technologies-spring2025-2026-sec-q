<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Employee</title>
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['admin_id'])) {
        header('location: login.php');
        exit;
    }
    ?>
    <div class="navbar">
        <h2>Shop Management System</h2>
        <a href="logout.php">Logout</a>
    </div>

    <div class="container">
        <div class="card">
            <h3>Register New Employee</h3>
            <label>Full Name</label>
            <input type="text" id="name" placeholder="Employee full name" />
            <label>Username</label>
            <input type="text" id="username" placeholder="Username" />
            <label>Contact No</label>
            <input type="text" id="contact_no" placeholder="Contact number" />
            <label>Email</label>
            <input type="email" id="email" placeholder="Email address" />
            <label>Password</label>
            <input type="password" id="password" placeholder="Password" />
            <div class="btn-row">
                <button class="btn-save" onclick="ajaxAddEmployee()">Save</button>
                <button class="btn-back" onclick="window.location.href='dashboard.php'">Back</button>
            </div>
            <div id="msg"></div>
        </div>
    </div>

    <script>
        function ajaxAddEmployee() {
            let name = document.getElementById('name').value;
            let username = document.getElementById('username').value;
            let contact_no = document.getElementById('contact_no').value;
            let email = document.getElementById('email').value;
            let password = document.getElementById('password').value;

            if (name == '' || username == '' || contact_no == '' || email == '' || password == '') {
                document.getElementById('msg').innerHTML = '<span class="error">All fields are required!</span>';
                return;
            }

            let data = {
                'name': name,
                'username': username,
                'contact_no': contact_no,
                'email': email,
                'password': password
            };
            let employee = JSON.stringify(data);

            let xhttp = new XMLHttpRequest();
            xhttp.open('post', 'add_employee_process.php', true);
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