<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - Shop Management</title>
</head>

<body>

    <div class="navbar">
        <h2>Shop Management System</h2>
        <a href="logout.php">Logout</a>
    </div>

    <div class="container">
        <div class="top-bar">
            <a href="add_employee.php" class="btn-add">+ Add Employee</a>
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Search by name or username..."
                    oninput="ajaxSearch()" />
                <button onclick="ajaxSearch()">Search</button>
            </div>
        </div>

        <div id="search-result"></div>

        <table id="empTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Contact No</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <?php
                session_start();
                if (!isset($_SESSION['admin_id'])) {
                    header('location: login.php');
                    exit;
                }
                include 'db.php';
                $result = mysqli_query($conn, "SELECT * FROM employees ORDER BY id DESC");
                $i = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>" . $i . "</td>
                        <td>" . $row['name'] . "</td>
                        <td>" . $row['username'] . "</td>
                        <td>" . $row['contact_no'] . "</td>
                        <td>" . $row['email'] . "</td>
                        <td>
                            <button class='btn-edit' onclick=\"window.location.href='update_employee.php?id=" . $row['id'] . "'\">Edit</button>
                            <button class='btn-delete' onclick=\"ajaxDelete(" . $row['id'] . ", this)\">Delete</button>
                        </td>
                    </tr>";
                    $i++;
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function ajaxSearch() {
            let keyword = document.getElementById('searchInput').value;

            let data = { 'keyword': keyword };
            let searchData = JSON.stringify(data);

            let xhttp = new XMLHttpRequest();
            xhttp.open('post', 'search_employee.php', true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send('data=' + searchData);
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    let res = JSON.parse(this.responseText);
                    let rows = '';
                    if (res.length == 0) {
                        rows = '<tr><td colspan="6" style="text-align:center;color:#999;">No employees found.</td></tr>';
                        document.getElementById('search-result').innerHTML = 'No results found.';
                    } else {
                        document.getElementById('search-result').innerHTML = 'Found: ' + res.length + ' result(s)';
                        res.forEach(function (emp, index) {
                            rows += `<tr>
                            <td>${index + 1}</td>
                            <td>${emp.name}</td>
                            <td>${emp.username}</td>
                            <td>${emp.contact_no}</td>
                            <td>${emp.email}</td>
                            <td>
                                <button class='btn-edit' onclick="window.location.href='update_employee.php?id=${emp.id}'">Edit</button>
                                <button class='btn-delete' onclick="ajaxDelete(${emp.id}, this)">Delete</button>
                            </td>
                        </tr>`;
                        });
                    }
                    document.getElementById('tableBody').innerHTML = rows;
                }
            }
        }

        function ajaxDelete(id, btn) {
            if (!confirm('Are you sure you want to delete this employee?')) return;

            let data = { 'id': id };
            let deleteData = JSON.stringify(data);

            let xhttp = new XMLHttpRequest();
            xhttp.open('post', 'delete_employee.php', true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send('data=' + deleteData);
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    let res = JSON.parse(this.responseText);
                    if (res.status == 'success') {
                        btn.closest('tr').remove();
                    } else {
                        alert('Delete failed!');
                    }
                }
            }
        }
    </script>
</body>

</html>