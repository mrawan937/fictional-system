
<?php
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message']));

    if (!empty($name) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($message)) {
        $to = 'mtwrwyb12@gmail.com';
        $subject = "رسالة جديدة من $name";
        $body = "الاسم: $name\nالبريد: $email\n\nالرسالة:\n$message";
        $headers = "From: $email\r\nReply-To: $email\r\nContent-Type: text/plain; charset=UTF-8";

        $mail_sent = mail($to, $subject, $body, $headers);

        try {
            $stmt = $pdo->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $message]);
        } catch (PDOException $e) {
            die("حدث خطأ أثناء حفظ الرسالة: " . $e->getMessage());
        }

        echo $mail_sent ? "تم إرسال رسالتك وتخزينها بنجاح!" : "تم تخزين الرسالة، لكن فشل إرسال البريد.";
    } else {
        echo "يرجى تعبئة جميع الحقول بشكل صحيح.";
    }
} else {
    echo "طريقة الوصول غير صحيحة.";
}
?>
