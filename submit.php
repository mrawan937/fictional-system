
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "marwan_contact";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("فشل الاتصال: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$service = $_POST['service'];
$message = $_POST['message'];

$sql = "INSERT INTO messages (name, email, service, message)
VALUES ('$name', '$email', '$service', '$message')";

if ($conn->query($sql) === TRUE) {
  echo "تم استلام رسالتك بنجاح!";
} else {
  echo "خطأ: " . $conn->error;
}

$conn->close();
?>
