<?php
// Koneksi ke database
$mysqli = new mysqli("localhost", "root", "", "holt_winters");

// Periksa koneksi
if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

// Cek apakah data yang diterima adalah array
if (isset($_POST['tahun']) && is_array($_POST['tahun']) && 
    isset($_POST['quartal']) && is_array($_POST['quartal']) && 
    isset($_POST['aktual']) && is_array($_POST['aktual']) && 
    isset($_POST['period']) && is_array($_POST['period'])) {

    // Ambil data input
    $tahun = $_POST['tahun'];
    $quartal = $_POST['quartal'];
    $aktual = $_POST['aktual'];
    $period = $_POST['period'];

    // Simpan data input ke database
    $data_ids = [];
    for ($i = 0; $i < count($tahun); $i++) {
        $stmt = $mysqli->prepare("INSERT INTO data_input (tahun, quartal, aktual, period) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isdi", $tahun[$i], $quartal[$i], $aktual[$i], $period[$i]);
        if ($stmt->execute()) {
            $data_ids[] = $stmt->insert_id;  // Menyimpan ID yang baru dimasukkan
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    // Perhitungan YLt - Yt (12 bulan sebelumnya)
    for ($i = 12; $i < count($data_ids); $i++) {
        $current_actual = $aktual[$i];
        $previous_actual = $aktual[$i - 12];
        $ylt_minus_yt = $current_actual - $previous_actual;

        // Simpan hasil perhitungan ke database
        $stmt = $mysqli->prepare("INSERT INTO hasil_perhitungan (data_id, ylt_minus_yt) VALUES (?, ?)");
        $stmt->bind_param("id", $data_ids[$i], $ylt_minus_yt);
        $stmt->execute();
    }

    // Redirect ke halaman hasil setelah data diproses
    header("Location: result.php");
    exit;
} else {
    // Jika data tidak valid, tampilkan pesan kesalahan
    echo "Data input tidak valid. Semua input harus berupa array.";
}

// Tutup koneksi database
$mysqli->close();
?>
