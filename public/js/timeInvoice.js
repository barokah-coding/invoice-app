function updateTime() {
    var now = new Date();
    var day = String(now.getDate()).padStart(2, "0");
    var month = String(now.getMonth() + 1).padStart(2, "0"); // Bulan dimulai dari 0
    var year = now.getFullYear();

    // Format yang akan ditampilkan: DD-MM-YYYY HH:MM:SS
    var dateTime = day + "-" + month + "-" + year;

    // Menampilkan waktu pada input field
    document.getElementById("invoice_date").value = dateTime;
}

// Memperbarui waktu setiap detik
setInterval(updateTime, 1000);

// Jalankan fungsi saat halaman dimuat
updateTime();
