<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
</head>

<body>
    <div class="card">
        <h2>Admin Login</h2>
        <input type="text" id="username" placeholder="Username" />
        <input type="password" id="password" placeholder="Password" />
        <button onclick="ajaxLogin()">Login</button>
        <div id="msg"></div>
        <p>Don't have an account? <a href="register.php">Register</a></p>
    </div>

    <script>
        function ajaxLogin() {
            let username = document.getElementById('username').value;
            let password = document.getElementById('password').value;

            if (username == '' || password == '') {
                document.getElementById('msg').innerHTML = '<span class="error">All fields are required!</span>';
                return;
            }

            let data = {
                'username': username,
                'password': password
            };
            let user = JSON.stringify(data);

            let xhttp = new XMLHttpRequest();
            xhttp.open('post', 'loginCheck.php', true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send('user=' + user);
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    let res = JSON.parse(this.responseText);
                    if (res.status == 'success') {
                        document.getElementById('msg').innerHTML = '<span class="success">Login successful! Redirecting...</span>';
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