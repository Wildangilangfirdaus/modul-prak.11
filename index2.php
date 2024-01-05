<?php
$host = "localhost";
$nama_pengguna = "root";
$kata_sandi = "";
$nama_database = "formulir_servicesmotor"; // Ganti dengan nama database Anda

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
    $jenis_motor = $_POST['jenis_motor'];
    $tanggal_servis = $_POST['tanggal_servis'];

    $sql = "INSERT INTO layanan_motor (nama, alamat, email, telepon, jenis_motor, tanggal_servis) VALUES ('$nama', '$alamat', '$email', '$telepon', '$jenis_motor', '$tanggal_servis')";

    if ($koneksi->query($sql) === TRUE) {
        echo "Data berhasil disimpan";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

// Ambil data dari database
$sql_select = "SELECT * FROM layanan_motor";
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
    <title>Formulir Layanan Motor</title>
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

        input, select {
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
            <h1>Formulir Layanan Motor</h1>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" required>

                <label for="alamat">Alamat:</label>
                <textarea id="alamat" name="alamat" required></textarea>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="telepon">Nomor Telepon:</label>
                <input type="tel" id="telepon" name="telepon" required>

                <label for="jenis_motor">Jenis Motor:</label>
                <select id="jenis_motor" name="jenis_motor" required>
                    <option value="Sport">Sport</option>
                    <option value="Matic">Matic</option>
                    <option value="Cub">Cub</option>
                </select>

                <label for="tanggal_servis">Tanggal Servis:</label>
                <input type="date" id="tanggal_servis" name="tanggal_servis" required>

                <input type="submit" value="Submit">
            </form>
        </div>

        <div class="table-container">
            <?php
           // Tampilkan tabel data
if ($result->num_rows > 0) {
    echo "<h2>Data Layanan Motor</h2>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Nama</th><th>Alamat</th><th>Email</th><th>Telepon</th><th>Jenis Motor</th><th>Tanggal Servis</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['nama'] . "</td>";
        echo "<td>" . $row['alamat'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['telepon'] . "</td>";
        echo "<td>" . $row['jenis_motor'] . "</td>";
        echo "<td>" . $row['tanggal_servis'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Tidak ada data layanan motor.";
}
            ?>
        </div>
    </div>

</body>
</html>
