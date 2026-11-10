<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Data Usaha Palembang</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f6f8;
        margin: 0;
        padding: 30px;
        color: #333;
    }
    h2 {
        margin-top: 0;
    }
    .btn-input {
        display: inline-block;
        background: #2563eb;
        color: #fff;
        padding: 8px 16px;
        border-radius: 6px;
        text-decoration: none;
        margin-bottom: 16px;
    }
    .btn-input:hover {
        background: #1d4ed8;
    }
    table {
        border-collapse: collapse;
        width: 100%;
        background: #fff;
        box-shadow: 0 1px 4px rgba(0,0,0,0.1);
    }
    th, td {
        padding: 10px 14px;
        border-bottom: 1px solid #e5e7eb;
        text-align: left;
    }
    th {
        background: #1e3a8a;
        color: #fff;
    }
    tr:nth-child(even) td {
        background: #f9fafb;
    }
    tr:hover td {
        background: #eef2ff;
    }
    a.hapus { color: #dc2626; text-decoration: none; }
    a.edit  { color: #2563eb; text-decoration: none; }
    a.hapus:hover, a.edit:hover { text-decoration: underline; }
</style>
</head>
<body>

<h2>Data Usaha Palembang</h2>

<?php
$conn = new mysqli("127.0.0.1", "root", "", "pgweb_9");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM palembang");

echo "<a class='btn-input' href='input/index.html'>+ Input</a>";

if ($result->num_rows > 0) {
    echo "<table>
        <tr>
            <th>No</th>
            <th>Longitude</th>
            <th>Latitude</th>
            <th>Nama Usaha</th>
            <th>Subsektor Usaha</th>
            <th colspan='2'>Aksi</th>
        </tr>";

    while ($row = $result->fetch_assoc()) {
        $nama      = htmlspecialchars($row['Nama Usaha']);
        $subsektor = htmlspecialchars($row['Subsektor Usaha']);
        echo "<tr>
                <td>{$row['No']}</td>
                <td>{$row['Longitude']}</td>
                <td>{$row['Latitude']}</td>
                <td>{$nama}</td>
                <td>{$subsektor}</td>
                <td><a class='hapus' href='delete.php?id={$row['No']}'>hapus</a></td>
                <td><a class='edit' href='edit/index.php?id={$row['No']}'>edit</a></td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>

</body>
</html>