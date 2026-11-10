<?php
$conn = new mysqli("127.0.0.1", "root", "", "pgweb_9");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = (int) ($_GET['id'] ?? 0);

$stmt = $conn->prepare("DELETE FROM palembang WHERE No = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    header("Location: index.php");
    exit;
} else {
    echo "Error: " . $stmt->error;
}
?>