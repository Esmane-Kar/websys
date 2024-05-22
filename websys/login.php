<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "fruit_sales"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashed_password = hash('sha256', $password);

    $sql = "SELECT * FROM admins WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (hash_equals($row['password'], $hashed_password)) {
            header("Location: sampleDashboard.php");
            exit();
        } else {
            $error_message = "Incorrect password. Please try again.";
        }
    } else {
        $error_message = "Username not found.";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fruit Stock Management</title>
    <link rel="stylesheet" href="login.css">
</head>
<body class="container">
    <div>
        <div class="login-header">
            <h1>Fruit Stock Management</h1>
            <div>
                <img src="image/icon.jpg" alt="fasdgd">
            </div>
        </div>
        <div class="login-body">
            <form action="" method="post">
                <div class="username">
                    <input type="text" name="username" placeholder="Username" required><br><br>
                </div>
                <div class="pass">
                    <input type="password" id="password" name="password" placeholder="Password" required><br><br>
                </div>
                <div>
                    <input type="checkbox" id="showPassword"> Show Password
                </div>
                <div class="forgotP">
                    <p style="text-decoration: color(white);">Forgot password? <a href="forgotPass.php">Click here!</a></p>
                </div>
                <div class="loginBtn">
                    <button type="submit" id="signIn" onclick="">Sign in</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            const showPwCheckBox = document.getElementById('showPassword');
            const passwordText = document.getElementById('password');

            showPwCheckBox.addEventListener('change', function(){
                if(this.checked){
                    passwordText.type = 'text';
                }
                else{
                    passwordText.type = 'password';
                }
            });

            <?php if(!empty($error_message)): ?>
                alert("<?php echo $error_message; ?>");
                //comment ni Esmane
            <?php endif; ?>
        });
    </script>
</body>
</html>
