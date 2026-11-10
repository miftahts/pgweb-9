<?php
$longitude = $_POST['longitude'] ?? '';
$latitude  = $_POST['latitude'] ?? '';
$nama      = $_POST['nama_usaha'] ?? '';
$subsektor = $_POST['subsektor'] ?? '';

$conn = new mysqli("127.0.0.1", "root", "", "pgweb_9");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare(
    "INSERT INTO palembang (Longitude, Latitude, `Nama Usaha`, `Subsektor Usaha`)
     VALUES (?, ?, ?, ?)"
);
$stmt->bind_param("ssss", $longitude, $latitude, $nama, $subsektor);

if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    header("Location: http://localhost/latihan8c/index.php");
    exit;
} else {
    echo "Error: " . $stmt->error;
}
?>