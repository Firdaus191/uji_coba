<?php
session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username == "usm" && $password == "123") {

        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
    }
}
?>
<html>
    <head>
        <title>Login Page</title>
        <style type="text/css">
            body {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                background: #f9c5d1; /* pink muda */
                background-image: url("bg_pinki.jpg"); /* gunakan file baru */
                background-size: cover;
                background-attachment: fixed;
            }

            table {
                background-color: rgba(255, 240, 245, 0.9); /* pink sangat muda transparan */
                border: 4px solid #f4b6c2; /* pink medium */
                padding: 20px;
                border-radius: 20px;
                font-family: 'Poppins', sans-serif;
                box-shadow: 0px 10px 20px rgba(216, 112, 147, 0.5); /* bayangan pink */
            }

            button {
                background-color: #e75480; /* pink tua */
                color: white;
                padding: 10px;
                border: 0;
                border-radius: 5px;
                width: 100%;
                font-weight: bold;
                font-size: 16px;
                transition: background-color 0.3s ease;
            }

            button:hover {
                background-color: #d6336c;
            }
        </style>
    </head>
    <body>
        <form action="login.php" method="post">
         <table>
            <tr>
                <td colspan="2" style="text-align: center; font-weight: bold; font-size: 30px;" >LOGIN</td>
            </tr>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username" /></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" /></td>
            </tr>
            <tr>
                <td colspan="2"><input type="checkbox" /> Ingatkan saya</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;"><button type="submit" >SUBMIT</button></td>
            </tr>
        </table>
        </form>
    </body>
</html>