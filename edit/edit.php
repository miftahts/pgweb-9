<?php
$conn = new mysqli("127.0.0.1", "root", "", "pgweb_9");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$no        = (int) ($_POST['no'] ?? 0);
$longitude = $_POST['longitude'] ?? '';
$latitude  = $_POST['latitude'] ?? '';
$nama      = $_POST['nama_usaha'] ?? '';
$subsektor = $_POST['subsektor'] ?? '';

$stmt = $conn->prepare(
    "UPDATE palembang
     SET Longitude = ?, Latitude = ?, `Nama Usaha` = ?, `Subsektor Usaha` = ?
     WHERE No = ?"
);
$stmt->bind_param("ssssi", $longitude, $latitude, $nama, $subsektor, $no);

if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    header("Location: ../index.php");   // kembali ke daftar
    exit;
} else {
    echo "Error: " . $stmt->error;
}
?>