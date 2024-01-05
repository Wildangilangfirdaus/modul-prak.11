<!DOCTYPE html>
<html>
<head>
    <title>Membuat Database dan Menampilkan data dari database dengan PHP</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="judul">
        <h1>Membuat Koneksi Dengan PHP Dan Mysql</h1>
        <h2>Menampilkan data dari database</h2>
        <h3>www.unipma.ac.id</h3>
    </div>
    <br/>

    <br/>

    <h3>Data Mahasiswa</h3>
    <table border="1" class="table">
        <tr>
            <th>NPM</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Kelas</th>
        </tr>
        <?php
include "koneksi.php";

$query = $conn->query("SELECT * FROM Mahasiswa") or die($conn->error);

while ($data = $query->fetch_assoc()) {
    ?>
    <tr>
        <td><?php echo $data['npm']; ?></td>
        <td><?php echo $data['nama']; ?></td>
        <td><?php echo $data['alamat']; ?></td>
        <td><?php echo $data['kelas']; ?></td>
    </tr>
    <?php
}

// Close the connection
$conn->close();
?>

    </table>
</body>
</html>