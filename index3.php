<?php
$host = "localhost";
$nama_pengguna = "root";
$kata_sandi = "";
$nama_database = "formulir_kliniksehat"; // Ganti dengan nama database Anda

$koneksi = new mysqli($host, $nama_pengguna, $kata_sandi, $nama_database);

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Proses formulir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $keluhan = $_POST['keluhan'];
    $tanggal_periksa = $_POST['tanggal_periksa'];

    $sql = "INSERT INTO formulir_kliniksehat (nama, alamat, email, telepon, keluhan, tanggal_periksa) VALUES ('$nama', '$alamat', '$email', '$telepon', '$keluhan', '$tanggal_periksa')";

    if ($koneksi->query($sql) === TRUE) {
        echo "Data berhasil disimpan";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

// Ambil data dari database
$sql_select = "SELECT * FROM formulir_kliniksehat";
$result = $koneksi->query($sql_select);

if (!$result) {
    die("Error saat menjalankan query: " . $sql_select . "<br>" . $koneksi->error);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Klinik Sehat</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-container,
        .table-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: grid;
            gap: 15px;
            width: 100%;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #4caf50;
            color: white;
        }

        label {
            font-weight: bold;
            font-size: 16px;
        }

        input, select, textarea {
            width: 100%;
            padding: 12px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
            padding: 12px;
            border: none;
            border-radius: 4px;
            font-size: 18px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="form-container">
            <h1>Formulir Klinik Sehat</h1>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" required>

                <label for="alamat">Alamat:</label>
                <textarea id="alamat" name="alamat" required></textarea>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="telepon">Nomor Telepon:</label>
                <input type="tel" id="telepon" name="telepon" required>

                <label for="keluhan">Keluhan:</label>
                <textarea id="keluhan" name="keluhan" required></textarea>

                <label for="tanggal_periksa">Tanggal Periksa:</label>
                <input type="date" id="tanggal_periksa" name="tanggal_periksa" required>

                <input type="submit" value="Submit">
            </form>
        </div>

        <div class="table-container">
            <?php
           // Tampilkan tabel data
if ($result->num_rows > 0) {
    echo "<h2>Data Formulir Klinik Sehat</h2>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Nama</th><th>Alamat</th><th>Email</th><th>Telepon</th><th>Keluhan</th><th>Tanggal Periksa</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['nama'] . "</td>";
        echo "<td>" . $row['alamat'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['telepon'] . "</td>";
        echo "<td>" . $row['keluhan'] . "</td>";
        echo "<td>" . $row['tanggal_periksa'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Tidak ada data formulir klinik sehat.";
}
            ?>
        </div>
    </div>

</body>
</html>
