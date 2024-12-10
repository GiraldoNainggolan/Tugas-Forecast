<?php
// Koneksi ke database
$conn = new mysqli("localhost", "username", "password", "holt_winters");

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Fungsi untuk menambah data
if (isset($_POST['tambah_data'])) {
    $tahun = $_POST['tahun'];
    $quartal = $_POST['quartal'];
    $aktual = $_POST['aktual'];
    $period = $_POST['period'];
    $alpha = $_POST['alpha'];
    $beta = $_POST['beta'];
    $gamma = $_POST['gamma'];

    $sql = "INSERT INTO data_input (tahun, quartal, aktual, period, alpha, beta, gamma)
            VALUES ('$tahun', '$quartal', '$aktual', '$period', '$alpha', '$beta', '$gamma')";

    if ($conn->query($sql) === TRUE) {
        echo "<p class='success'>Data berhasil ditambahkan.</p>";
    } else {
        echo "<p class='error'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}

// Fungsi untuk mengupdate data
if (isset($_POST['edit_data'])) {
    $id = $_POST['id'];
    $tahun = $_POST['tahun'];
    $quartal = $_POST['quartal'];
    $aktual = $_POST['aktual'];
    $period = $_POST['period'];
    $alpha = $_POST['alpha'];
    $beta = $_POST['beta'];
    $gamma = $_POST['gamma'];

    $sql = "UPDATE data_input SET tahun='$tahun', quartal='$quartal', aktual='$aktual', period='$period', alpha='$alpha', beta='$beta', gamma='$gamma' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<p class='success'>Data berhasil diperbarui.</p>";
    } else {
        echo "<p class='error'>Error: " . $conn->error . "</p>";
    }
}

// Fungsi untuk menghapus data
if (isset($_POST['hapus_data'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM data_input WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<p class='success'>Data berhasil dihapus.</p>";
    } else {
        echo "<p class='error'>Error: " . $conn->error . "</p>";
    }
}

// Query untuk mengambil data dari tabel data_input dan hasil_perhitungan
$sql = "SELECT di.id, di.tahun, di.quartal, di.aktual, di.period, di.alpha, di.beta, di.gamma, 
               hp.YLt_minus_Yt, hp.AT, hp.Tt, hp.St, hp.Forecast, hp.e, hp.MSE, hp.MAPE
        FROM data_input di
        LEFT JOIN hasil_perhitungan hp ON di.period = hp.period
        ORDER BY di.period ASC"; // Data terbaru berada di atas

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Holt-Winters</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }
        h2 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="text"], input[type="submit"], button {
            padding: 8px;
            margin: 5px 0;
            font-size: 14px;
        }
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
        .action-buttons {
            display: flex;
            justify-content: space-between;
        }
        .action-buttons form {
            margin: 0;
        }
    </style>
</head>
<body>

    <!-- Form untuk menambah data -->
    <div class="form-container">
        <h2>Tambah Data</h2>
        <form method="POST">
            <label>Tahun:</label> <input type="text" name="tahun" required><br>
            <label>Quartal:</label> <input type="text" name="quartal" required><br>
            <label>Aktual:</label> <input type="text" name="aktual" required><br>
            <label>Period:</label> <input type="text" name="period" required><br>
            <label>Alpha:</label> <input type="text" name="alpha" required><br>
            <label>Beta:</label> <input type="text" name="beta" required><br>
            <label>Gamma:</label> <input type="text" name="gamma" required><br>
            <input type="submit" name="tambah_data" value="Tambah Data">
        </form>
    </div>

    <hr>

    <!-- Tabel untuk menampilkan data -->
    <h2>Data Input</h2>
    <?php
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr>
                <th>ID</th>
                <th>Tahun</th>
                <th>Quartal</th>
                <th>Aktual</th>
                <th>Period</th>
                <th>Alpha</th>
                <th>Beta</th>
                <th>Gamma</th>
                <th>YLt - Yt</th>
                <th>AT</th>
                <th>Tt</th>
                <th>St</th>
                <th>Forecast</th>
                <th>e</th>
                <th>MSE</th>
                <th>MAPE</th>
                <th>Aksi</th>
              </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['tahun']}</td>
                    <td>{$row['quartal']}</td>
                    <td>{$row['aktual']}</td>
                    <td>{$row['period']}</td>
                    <td>{$row['alpha']}</td>
                    <td>{$row['beta']}</td>
                    <td>{$row['gamma']}</td>
                    <td>{$row['YLt_minus_Yt']}</td>
                    <td>{$row['AT']}</td>
                    <td>{$row['Tt']}</td>
                    <td>{$row['St']}</td>
                    <td>{$row['Forecast']}</td>
                    <td>{$row['e']}</td>
                    <td>{$row['MSE']}</td>
                    <td>{$row['MAPE']}</td>
                    <td class='action-buttons'>
                        <form action='' method='POST'>
                            <input type='hidden' name='id' value='{$row['id']}'>
                            <button type='submit' name='hapus_data'>Hapus</button>
                        </form>
                        <form action='' method='POST'>
                            <input type='hidden' name='id' value='{$row['id']}'>
                            <input type='text' name='tahun' value='{$row['tahun']}' required><br>
                            <input type='text' name='quartal' value='{$row['quartal']}' required><br>
                            <input type='text' name='aktual' value='{$row['aktual']}' required><br>
                            <input type='text' name='period' value='{$row['period']}' required><br>
                            <input type='text' name='alpha' value='{$row['alpha']}' required><br>
                            <input type='text' name='beta' value='{$row['beta']}' required><br>
                            <input type='text' name='gamma' value='{$row['gamma']}' required><br>
                            <button type='submit' name='edit_data'>Edit</button>
                        </form>
                    </td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p class='error'>Tidak ada data di database.</p>";
    }
    ?>

</body>
</html>

<?php
$conn->close();
?>
