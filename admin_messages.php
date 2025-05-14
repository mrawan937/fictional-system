
<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

$host = 'localhost';
$dbname = 'contact_form';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("فشل الاتصال بقاعدة البيانات: " . $e->getMessage());
}

$stmt = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC");
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم - الرسائل</title>
    <style>
        body {
            background: #111;
            color: #eee;
            font-family: 'Cairo', sans-serif;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #f9c349;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #333;
            text-align: right;
        }
        th {
            background: #222;
        }
        tr:nth-child(even) {
            background: #1a1a1a;
        }
    </style>
</head>
<body>
    <h1>الرسائل المستلمة</h1>
    <table>
        <thead>
            <tr>
                <th>الرقم</th>
                <th>الاسم</th>
                <th>البريد الإلكتروني</th>
                <th>الرسالة</th>
                <th>التاريخ</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($messages) > 0): ?>
                <?php foreach ($messages as $msg): ?>
                    <tr>
                        <td><?= $msg['id'] ?></td>
                        <td><?= htmlspecialchars($msg['name']) ?></td>
                        <td><?= htmlspecialchars($msg['email']) ?></td>
                        <td><?= nl2br(htmlspecialchars($msg['message'])) ?></td>
                        <td><?= $msg['created_at'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5">لا توجد رسائل حالياً.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
