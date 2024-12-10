document.addEventListener("DOMContentLoaded", () => {
    const tableBody = document.getElementById("tableBody");
    const addRowButton = document.getElementById("addRow");
    const submitDataButton = document.getElementById("submitData"); // Pastikan elemen ini ada

    if (!submitDataButton) {
        console.error("submitDataButton tidak ditemukan di DOM.");
        return;
    }

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

    // Event listener untuk submit data
    submitDataButton.addEventListener("click", () => {
        const rows = document.querySelectorAll("#tableBody tr");
        const data = Array.from(rows).map((row) => ({
            tahun: row.querySelector('input[name="tahun[]"]').value,
            quartal: row.querySelector('select[name="quartal[]"]').value,
            aktual: row.querySelector('input[name="aktual[]"]').value,
            period: row.querySelector('input[name="period[]"]').value,
            alpha: row.querySelector('input[name="alpha[]"]').value,
            beta: row.querySelector('input[name="beta[]"]').value,
            beta: row.querySelector('input[name="gamma[]"]').value,
        }));

        // Validasi jika ada baris yang kosong
        if (data.some((row) => !row.tahun || !row.quartal || !row.aktual || !row.period)) {
            alert("Mohon isi semua kolom sebelum mengirim data!");
            return;
        }

        // Simpan data ke localStorage (opsional)
        localStorage.setItem("holtWintersData", JSON.stringify(data));

        // Arahkan ke halaman hasil
        window.location.href = "results.html";
    });
});
