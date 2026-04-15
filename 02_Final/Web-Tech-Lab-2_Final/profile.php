<?php
session_start();

if(!isset($_COOKIE['status'])){
    header('location: login.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
</head>

<body>

<table border="1" width="100%" cellspacing="0" cellpadding="10">
<tr>
    <td style="display:flex; justify-content:space-between; align-items:center;">
        <h2 style="color:green; margin:0;">XCompany</h2>

        <div>
            Logged in as 
            <a href="profile.php"><?php echo $_SESSION['user']['username']; ?></a> |
            <a href="logout.php">Logout</a>
        </div>
    </td>
</tr>
</table>

<table border="1" width="100%" cellspacing="0" cellpadding="10">

<tr>
    <td width="25%" valign="top">
        <h3>Account</h3>
        <hr>

        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="profile.php">View Profile</a></li>
            <li><a href="edit.php">Edit Profile</a></li>
            <li><a href="upload.php">Change Profile Picture</a></li>
            <li><a href="change_password.php">Change Password</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </td>

    <td valign="top">

        <fieldset>
            <legend><b>PROFILE</b></legend>

            <table width="100%">

                <tr>
                    <td width="60%">
                        Name : <?php echo $_SESSION['user']['name']; ?> <hr>
                        Email : <?php echo $_SESSION['user']['email']; ?> <hr>
                        Gender : <?php echo $_SESSION['user']['gender']; ?> <hr>
                        Date of Birth : <?php echo $_SESSION['user']['dob']; ?>
                    </td>

                    <td align="center">
                        <img src="learning-web-technologies-spring2025-2026-sec-q\02_Final\Web-Tech-Lab-2_Final\Upload/<?php echo $_SESSION['user']['image'] ? $_SESSION['user']['image'] : 'default.png'; ?>" width="120"><br>
                        <a href="upload.php">Change</a>
                    </td>
                </tr>

            </table>

            <hr>
            <a href="edit.php">Edit Profile</a>

        </fieldset>

    </td>
</tr>

</table>

<table border="1" width="100%" cellspacing="0" cellpadding="10">
<tr>
    <td align="center">
        Copyright &copy; 2017
    </td>
</tr>
</table>

</body>
</html>