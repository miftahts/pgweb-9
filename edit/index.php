<!DOCTYPE html>
<html>
<body>
<h2>Form Edit</h2>
<?php
$conn = new mysqli("127.0.0.1", "root", "", "pgweb_9");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = (int) ($_GET['id'] ?? 0);
$stmt = $conn->prepare("SELECT * FROM palembang WHERE No = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $h = fn($v) => htmlspecialchars((string) $v, ENT_QUOTES);
    echo "<form action='edit.php' onsubmit='return validateForm()' method='post'>
        <input type='hidden' name='no' value='{$h($row['No'])}'>

        <label for='long'>Longitude:</label><br>
        <input type='text' id='long' name='longitude' value='{$h($row['Longitude'])}'><br>

        <label for='lat'>Latitude:</label><br>
        <input type='text' id='lat' name='latitude' value='{$h($row['Latitude'])}'><br>

        <label for='nama'>Nama Usaha:</label><br>
        <input type='text' id='nama' name='nama_usaha' value='{$h($row['Nama Usaha'])}'><br>

        <label for='sub'>Subsektor Usaha:</label><br>
        <input type='text' id='sub' name='subsektor' value='{$h($row['Subsektor Usaha'])}'><br><br>

        <input type='submit' value='Submit'>
    </form>";
} else {
    echo "Data tidak ditemukan.";
}
$conn->close();
?>
<p id="informasi"></p>
<script>
function validateForm() {
    let lng = document.getElementById("long").value;
    let lat = document.getElementById("lat").value;
    let nama = document.getElementById("nama").value;
    let text = "";

    if (nama.trim() === "") {
        text = "Nama usaha tidak boleh kosong";
    } else if (lng.trim() === "" || isNaN(lng) || lat.trim() === "" || isNaN(lat)) {
        text = "Longitude dan latitude harus berupa angka";
    }

    document.getElementById("informasi").innerHTML = text;
    return text === "";   // false = batalkan submit
}
</script>
</body>
</html>