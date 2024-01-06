<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jumlah Kas Warga</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        /* Tambahkan gaya CSS khusus jika diperlukan */
        body {
            background-color: #f8f9fa;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }
    </style>
</head>

<body>
<div class="container mt-5 table-responsive">
    <h2 class="mb-4">Jumlah Kas Warga yang Sudah Membayar</h2>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nama Warga</th>
            <th>NIK</th>
            <th>Tanggal</th>
            <th>Jumlah Kas</th>
        </tr>
        </thead>
        <tbody>
        <?php

        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "db_kas_rt";

        $conn = new mysqli($host, $username, $password, $database);

        // Periksa koneksi
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }


        $query = "SELECT warga.id AS warga_id, warga.nama, warga.nik, iuran.tanggal, iuran.nominal 
                          FROM warga 
                          INNER JOIN iuran ON warga.id = iuran.warga_id 
                          WHERE iuran.jenis_iuran = 'Kas' AND iuran.keterangan = 'Dibayar'";
        $result = $conn->query($query);

        // Tampilkan data dalam tabel
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["warga_id"] . "</td>";
                echo "<td>" . $row["nama"] . "</td>";
                echo "<td>" . $row["nik"] . "</td>";
                echo "<td>" . $row["tanggal"] . "</td>";
                echo "<td>" . $row["nominal"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
        }

        // Tutup koneksi
        $conn->close();
        ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
