<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>HALAMAN SIGN UP</title>
</head>
<body>
    <br>
    <br>
    <header>
        <h1>HALAMAN SIGN UP</h1>
    </header>

    <br>
    <h5>BUATLAH USERNAME DAN PASSWORD ANDA</h5>
    <form action="signup.php" method="post" encypte="multipart/form-data">
        <td>User Name:</td>
        <br>
            <input type="text" name="username"/><br>
        </br>

        <td>Password:</td>
        <br>
            <input type="password" name="password"/><br>
        </br>

        <center><button type="submit" name="submit" a href="login.php">SIGN UP</button></center>
    </form>
</body>
</html>

<center><?php
    session_start();
    require_once("config.php");
    if(isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($username) || empty($password)) {
            echo 'Username Atau Password Kosong!';
        }
        else if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
            echo "Format Email Salah!";
        }
        else if (strlen($password) < 6) {
            echo "Password Anda Harus Terdiri Dari 6 Karakter!";
        }
        else if (!preg_match("#[0-9]+#", $password) && !preg_match("#[A-Z]+#", $password)) {
            echo "Password Anda Harus Memiliki 1 Angka Atau Huruf Kapital!";
        }
        else{
            $sql_insert = "INSERT INTO admin VALUES('$username', '$password')";
            mysqli_query($config, $sql_insert);
            $_SESSION['username'] = $username;
            header("Location:dashbord.php");
        }
    }
?></center>
