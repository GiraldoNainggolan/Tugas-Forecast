<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data - Holt Winters</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Input Data Holt-Winters</h1>
        <form id="dataForm" action="process.php" method="POST">
            <table id="inputTable">
                <thead>
                    <tr>
                        <th>Tahun</th>
                        <th>Quartal</th>
                        <th>Aktual</th>
                        <th>Period</th>
                        <th>Alpha</th>
                        <th>Beta</th>
                        <th>Gamma</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <tr>
                        <td><input type="number" name="tahun[]" required></td>
                        <td>
                            <select name="quartal[]" required>
                                <option value="Q1">Q1</option>
                                <option value="Q2">Q2</option>
                                <option value="Q3">Q3</option>
                                <option value="Q4">Q4</option>
                                <option value="Q5">Q5</option>
                                <option value="Q6">Q6</option>
                                <option value="Q7">Q7</option>
                                <option value="Q8">Q8</option>
                                <option value="Q9">Q9</option>
                                <option value="Q10">Q10</option>
                                <option value="Q11">Q11</option>
                                <option value="Q12">Q12</option>
                            </select>
                        </td>
                        <td><input type="number" step="0.01" name="aktual[]" required></td>
                        <td><input type="number" name="period[]" required></td>
                        <td><input type="number" step="0.01" name="alpha[]" min="0" max="1" required></td>
                        <td><input type="number" step="0.01" name="beta[]" min="0" max="1" required></td>
                        <td><input type="number" step="0.01" name="gamma[]" min="0" max="1" required></td>
                        <td><button type="button" class="deleteRow">Hapus</button></td>
                    </tr>
                </tbody>
            </table>
            <button type="button" id="addRow">Tambah Baris</button>
            <button type="submit">Kirim Data</button>
        </form>
        <!-- Tombol Lihat Data -->
        <div class="view-data">
            <a href="view_data.php" class="view-button">Lihat Data</a>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const tableBody = document.getElementById("tableBody");
            const addRowButton = document.getElementById("addRow");

            // Fungsi untuk menambah baris baru
            addRowButton.addEventListener("click", () => {
                const newRow = document.createElement("tr");
                newRow.innerHTML = `
                    <td><input type="number" name="tahun[]" required></td>
                    <td>
                        <select name="quartal[]" required>
                            <option value="Q1">Q1</option>
                            <option value="Q2">Q2</option>
                            <option value="Q3">Q3</option>
                            <option value="Q4">Q4</option>
                            <option value="Q5">Q5</option>
                            <option value="Q6">Q6</option>
                            <option value="Q7">Q7</option>
                            <option value="Q8">Q8</option>
                            <option value="Q9">Q9</option>
                            <option value="Q10">Q10</option>
                            <option value="Q11">Q11</option>
                            <option value="Q12">Q12</option>
                        </select>
                    </td>
                    <td><input type="number" step="0.01" name="aktual[]" required></td>
                    <td><input type="number" name="period[]" required></td>
                    <td><input type="number" step="0.01" name="alpha[]" min="0" max="1" required></td>
                    <td><input type="number" step="0.01" name="beta[]" min="0" max="1" required></td>
                    <td><input type="number" step="0.01" name="gamma[]" min="0" max="1" required></td>
                    <td><button type="button" class="deleteRow">Hapus</button></td>
                `;
                tableBody.appendChild(newRow);
            });

            // Delegasi event untuk tombol hapus
            tableBody.addEventListener("click", (e) => {
                if (e.target && e.target.classList.contains("deleteRow")) {
                    const row = e.target.closest("tr");
                    if (row) {
                        row.remove();
                    }
                }
            });
        });
    </script>
</body>
</html>
