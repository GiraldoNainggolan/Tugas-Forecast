document.addEventListener("DOMContentLoaded", function () {
  const data = JSON.parse(localStorage.getItem("holtWintersData") || "[]");
  const resultBody = document.getElementById("resultBody");

  data.forEach((row) => {
    // Contoh perhitungan sederhana (sesuaikan dengan formula Holt-Winters)
    const yltMinusYt = row.aktual - row.alpha * row.aktual;
    const at = row.aktual * row.beta;
    const tt = row.period * row.gamma;
    const st = at + tt;
    const forecast = st + yltMinusYt;

    const resultRow = document.createElement("tr");
    resultRow.innerHTML = `
            <td>${row.tahun}</td>
            <td>${row.quartal}</td>
            <td>${yltMinusYt.toFixed(2)}</td>
            <td>${at.toFixed(2)}<x/td>
            <td>${tt.toFixed(2)}</td>
            <td>${st.toFixed(2)}</td>
            <td>${forecast.toFixed(2)}</td>
        `;
    resultBody.appendChild(resultRow);
  });
});

/* ini adalah untuk mencarai nilai YLt - Yt*/

document.addEventListener('DOMContentLoaded', function () {
    // Ambil data dari localStorage
    const data = JSON.parse(localStorage.getItem('holtWintersData') || '[]');
    const resultBody = document.getElementById('resultBody');

    // Periksa apakah data yang diinput mencukupi
    if (data.length < 12) {
        alert("Data yang dimasukkan kurang dari 12 quartal. Mohon tambahkan lebih banyak data.");
        return;
    }

    // Loop untuk menghasilkan hasil perhitungan
    data.forEach((row, index) => {
        if (index < 12) {
            // Ambil nilai aktual dari quartal saat ini dan quartal yang sama dua tahun sebelumnya
            const currentActual = parseFloat(row.aktual || 0);
            const previousIndex = index - 12;

            // Jika quartal dua tahun sebelumnya tidak ada, gunakan 0 sebagai default
            const previousActual = previousIndex >= 0 ? parseFloat(data[previousIndex].aktual || 0) : 0;

            // Hitung YLt - Yt
            const yltMinusYt = currentActual - previousActual;

            // Placeholder untuk kolom lain (dapat diganti dengan formula Holt-Winters yang relevan)
            const at = 0; // Placeholder
            const tt = 0; // Placeholder
            const st = 0; // Placeholder
            const forecast = 0; // Placeholder

            // Tambahkan baris hasil ke tabel
            const resultRow = document.createElement('tr');
            resultRow.innerHTML = `
                <td>${row.tahun}</td>
                <td>${row.quartal}</td>
                <td>${yltMinusYt.toFixed(2)}</td>
                <td>${at.toFixed(2)}</td>
                <td>${tt.toFixed(2)}</td>
                <td>${st.toFixed(2)}</td>
                <td>${forecast.toFixed(2)}</td>
            `;
            resultBody.appendChild(resultRow);
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
  // Ambil data dari localStorage
  const data = JSON.parse(localStorage.getItem("holtWintersData") || "[]");
  const resultBody = document.getElementById("resultBody");

  if (data.length < 12) {
    alert(
      "Data yang dimasukkan kurang dari 12 periode. Mohon tambahkan lebih banyak data."
    );
    return;
  }

  // Inisialisasi hasil perhitungan
  const results = [];

  // Perhitungan YLt - Yt
  data.forEach((row, index) => {
    let yltMinusYt = null; // Default kosong untuk baris sebelum periode 13

    if (index >= 12) {
      const currentActual = parseFloat(row.aktual || 0);
      const previousActual = parseFloat(data[index - 12]?.aktual || 0);
      yltMinusYt = currentActual - previousActual; // Hitung selisih
    }

    // Simpan hasil
    results.push({
      tahun: row.tahun,
      quartal: row.quartal,
      period: row.period,
      aktual: row.aktual,
      yltMinusYt: yltMinusYt !== null ? yltMinusYt.toFixed(2) : "-", // Kosongkan jika tidak valid
    });
  });

  // Tampilkan hasil di tabel
  results.forEach((result) => {
    const resultRow = document.createElement("tr");
    resultRow.innerHTML = `
            <td>${result.tahun}</td>
            <td>${result.quartal}</td>
            <td>${result.period}</td>
            <td>${result.aktual}</td>
            <td>${result.yltMinusYt}</td>
        `;
    resultBody.appendChild(resultRow);
  });
});
