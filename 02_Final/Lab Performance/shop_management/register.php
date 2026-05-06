<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Register</title>
</head>

<body>
    <div class="card">
        <h2>Admin Register</h2>
        <input type="text" id="username" placeholder="Username" />
        <input type="email" id="email" placeholder="Email" />
        <input type="password" id="password" placeholder="Password" />
        <button onclick="ajaxRegister()">Register</button>
        <div id="msg"></div>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>

    <script>
        function ajaxRegister() {
            let username = document.getElementById('username').value;
            let email = document.getElementById('email').value;
            let password = document.getElementById('password').value;

            if (username == '' || email == '' || password == '') {
                document.getElementById('msg').innerHTML = '<span class="error">All fields are required!</span>';
                return;
            }

            let data = {
                'username': username,
                'email': email,
                'password': password
            };
            let user = JSON.stringify(data);

            let xhttp = new XMLHttpRequest();
            xhttp.open('post', 'regCheck.php', true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send('user=' + user);
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    let res = JSON.parse(this.responseText);
                    if (res.status == 'success') {
                        document.getElementById('msg').innerHTML = '<span class="success">' + res.message + '</span>';
                        setTimeout(() => { window.location.href = 'login.php'; }, 1200);
                    } else {
                        document.getElementById('msg').innerHTML = '<span class="error">' + res.message + '</span>';
                    }
                }
            }
        }
    </script>
</body>

</html>