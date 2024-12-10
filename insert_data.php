<?php
// Koneksi ke database
$mysqli = new mysqli("localhost", "root", "", "holt_winters");

// Cek koneksi
if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

// Data yang akan dimasukkan
$data = [
    ['year' => 2019, 'quartal' => 1, 'aktual' => 471, 'period' => 1],
    ['year' => 2019, 'quartal' => 2, 'aktual' => 331, 'period' => 2], 
    ['year' => 2019, 'quartal' => 3, 'aktual' => 331, 'period' => 3], 
    ['year' => 2019, 'quartal' => 4, 'aktual' => 331, 'period' => 4], 
    ['year' => 2019, 'quartal' => 5, 'aktual' => 331, 'period' => 5], 
    ['year' => 2019, 'quartal' => 6, 'aktual' => 331, 'period' => 6], 
    ['year' => 2019, 'quartal' => 7, 'aktual' => 331, 'period' => 7], 
    ['year' => 2019, 'quartal' => 8, 'aktual' => 331, 'period' => 8], 
    ['year' => 2019, 'quartal' => 9, 'aktual' => 331, 'period' => 9], 
    ['year' => 2019, 'quartal' => 10, 'aktual' => 331, 'period' => 10], 
    ['year' => 2019, 'quartal' => 11, 'aktual' => 331, 'period' => 11], 
    ['year' => 2020, 'quartal' => 12, 'aktual' => 331, 'period' => 12], 
    ['year' => 2020, 'quartal' => 1, 'aktual' => 331, 'period' => 13], 
    ['year' => 2020, 'quartal' => 2, 'aktual' => 331, 'period' => 14], 
    ['year' => 2020, 'quartal' => 3, 'aktual' => 331, 'period' => 15], 
    ['year' => 2020, 'quartal' => 4, 'aktual' => 331, 'period' => 16], 
    ['year' => 2020, 'quartal' => 5, 'aktual' => 331, 'period' => 17], 
    ['year' => 2020, 'quartal' => 6, 'aktual' => 331, 'period' => 18], 
    ['year' => 2020, 'quartal' => 7, 'aktual' => 331, 'period' => 19], 
    ['year' => 2020, 'quartal' => 8, 'aktual' => 331, 'period' => 20], 
    ['year' => 2020, 'quartal' => 9, 'aktual' => 331, 'period' => 21], 
    ['year' => 2020, 'quartal' => 10, 'aktual' => 331, 'period' => 22], 
    ['year' => 2020, 'quartal' => 11, 'aktual' => 331, 'period' => 23], 
    ['year' => 2020, 'quartal' => 12, 'aktual' => 331, 'period' => 24], 
    ['year' => 2021, 'quartal' => 1, 'aktual' => 331, 'period' => 25], 
    ['year' => 2021, 'quartal' => 2, 'aktual' => 331, 'period' => 26], 
    ['year' => 2021, 'quartal' => 3, 'aktual' => 331, 'period' => 27], 
    ['year' => 2021, 'quartal' => 4, 'aktual' => 331, 'period' => 28], 
    ['year' => 2021, 'quartal' => 5, 'aktual' => 331, 'period' => 29], 
    ['year' => 2021, 'quartal' => 6, 'aktual' => 331, 'period' => 30], 
    ['year' => 2021, 'quartal' => 7, 'aktual' => 331, 'period' => 31], 
    ['year' => 2021, 'quartal' => 8, 'aktual' => 331, 'period' => 32], 
    ['year' => 2021, 'quartal' => 9, 'aktual' => 331, 'period' => 33], 
    ['year' => 2021, 'quartal' => 10, 'aktual' => 331, 'period' => 34], 
    ['year' => 2021, 'quartal' => 11, 'aktual' => 331, 'period' => 35], 
    ['year' => 2021, 'quartal' => 12, 'aktual' => 331, 'period' => 36], 
    ['year' => 2021, 'quartal' => 1, 'aktual' => 331, 'period' => 37], 
    ['year' => 2021, 'quartal' => 2, 'aktual' => 331, 'period' => 38], 
    ['year' => 2021, 'quartal' => 3, 'aktual' => 331, 'period' => 39], 
    ['year' => 2021, 'quartal' => 4, 'aktual' => 331, 'period' => 40], 
    ['year' => 2021, 'quartal' => 5, 'aktual' => 331, 'period' => 41], 
    ['year' => 2021, 'quartal' => 6, 'aktual' => 331, 'period' => 42], 
    ['year' => 2021, 'quartal' => 7, 'aktual' => 331, 'period' => 43], 
    ['year' => 2021, 'quartal' => 8, 'aktual' => 331, 'period' => 44], 
    ['year' => 2021, 'quartal' => 9, 'aktual' => 331, 'period' => 45], 
    ['year' => 2021, 'quartal' => 10, 'aktual' => 331, 'period' => 46], 
    ['year' => 2021, 'quartal' => 11, 'aktual' => 331, 'period' => 47], 
    ['year' => 2021, 'quartal' => 12, 'aktual' => 331, 'period' => 48], 
    ['year' => 2022, 'quartal' => 1, 'aktual' => 331, 'period' => 49], 
    ['year' => 2022, 'quartal' => 2, 'aktual' => 331, 'period' => 50], 
    ['year' => 2022, 'quartal' => 3, 'aktual' => 331, 'period' => 51], 
    ['year' => 2022, 'quartal' => 4, 'aktual' => 331, 'period' => 52], 
    ['year' => 2022, 'quartal' => 5, 'aktual' => 331, 'period' => 53], 
    ['year' => 2022, 'quartal' => 6, 'aktual' => 331, 'period' => 54], 
    ['year' => 2022, 'quartal' => 7, 'aktual' => 331, 'period' => 55], 
    ['year' => 2022, 'quartal' => 8, 'aktual' => 331, 'period' => 56], 
    ['year' => 2022, 'quartal' => 9, 'aktual' => 331, 'period' => 57], 
    ['year' => 2022, 'quartal' => 10, 'aktual' => 331, 'period' => 58], 
    ['year' => 2022, 'quartal' => 11, 'aktual' => 331, 'period' =>59], 
    ['year' => 2022, 'quartal' => 12, 'aktual' => 331, 'period' => 60], 
    // Tambahkan data lainnya sesuai array di atas...
];

// Masukkan data ke tabel
foreach ($data as $row) {
    $stmt = $mysqli->prepare("INSERT INTO data_input (year, quartal, aktual, period) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iidi", $row['year'], $row['quartal'], $row['aktual'], $row['period']);
    $stmt->execute();
}

// Tutup koneksi
$mysqli->close();

echo "Data berhasil dimasukkan!";
?>
