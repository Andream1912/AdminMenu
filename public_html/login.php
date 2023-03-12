<?php
include './connection.php';
$error = "";
if (isset($_POST['username']) || isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $success = check_db($username, $password, $dbh);
    if ($success) {
        header("Location:./admin-page.php");
    } else {
        $error = "Username/Password Errata!";
    }
}


function check_db($user, $pass, $db)
{

    $stmt = $db->prepare("SELECT * FROM USER where username=?");
    $stmt->execute([$user]);
    $user = $stmt->fetch();
    if ($user) {
        if ($pass == $user['password']) {
            session_start();
            $_SESSION['username'] = $user['username'];
            $_SESSION['level'] = $user['type'];
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/css/login.css">
    </link>
    <title>Login Admin</title>
</head>

<body>
    <div class="background-index">
        <div class="container">
            <form action="login.php" method="post" class="form-login">
                <?php
                if ($error != "") {
                    echo "<p style='color:red;font-size:14px;'>$error</p>";
                }
                ?>
                <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                <button type="submit" class="btn">Login</button>
            </form>
        </div>
    </div>
</body>

</html>