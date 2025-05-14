
<?php
session_start();

$valid_username = 'admin';
$valid_password = '123456'; // غيّرها كما تشاء

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['logged_in'] = true;
        header('Location: admin_messages.php');
        exit;
    } else {
        $error = "بيانات الدخول غير صحيحة";
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول</title>
    <style>
        body {
            background-color: #111;
            color: #fff;
            font-family: 'Cairo', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-box {
            background-color: #222;
            padding: 30px;
            border-radius: 10px;
            width: 300px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
        }
        input[type="submit"] {
            width: 100%;
            background: #f9c349;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            color: #000;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>تسجيل الدخول</h2>
        <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="اسم المستخدم" required>
            <input type="password" name="password" placeholder="كلمة المرور" required>
            <input type="submit" value="دخول">
        </form>
    </div>
</body>
</html>
