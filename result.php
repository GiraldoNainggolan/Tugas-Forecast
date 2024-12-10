<?php
// Koneksi ke database
$mysqli = new mysqli("localhost", "root", "", "holt_winters");

// Periksa koneksi
if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

// Ambil data hasil perhitungan
$query = "SELECT di.tahun, di.quartal, di.period, di.aktual, 
                 hp.ylt_minus_yt, hp.at, hp.tt, hp.st, hp.forecast
          FROM data_input di
          LEFT JOIN hasil_perhitungan hp ON di.id = hp.data_id";
$result = $mysqli->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Perhitungan - Holt Winters</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Hasil Perhitungan Holt-Winters</h1>
        <table>
            <thead>
                <tr>
                    <th>Tahun</th>
                    <th>Quartal</th>
                    <th>Period</th>
                    <th>Aktual</th>
                    <th>YLt - Yt</th>
                    <th>AT</th>
                    <th>Tt</th>
                    <th>St</th>
                    <th>Forecast</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['tahun'] ?></td>
                        <td><?= $row['quartal'] ?></td>
                        <td><?= $row['period'] ?></td>
                        <td><?= $row['aktual'] ?></td>
                        <td><?= $row['ylt_minus_yt'] ?: '-' ?></td>
                        <td><?= $row['at'] ?: '-' ?></td>
                        <td><?= $row['tt'] ?: '-' ?></td>
                        <td><?= $row['st'] ?: '-' ?></td>
                        <td><?= $row['forecast'] ?: '-' ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
