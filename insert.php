<?php require_once('koneksi.php'); ?>

<?php
// Memeriksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $id_produk = $_POST["id_produk"];
    $jumlah = $_POST["jumlah"];
    $tgl = $_POST["tgl"];

    // Memanggil stored procedure
    $sql = "CALL InsertTransaksi(?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $id_produk, $jumlah, $tgl);

    if ($stmt->execute()) {
        echo "Data transaksi berhasil ditambahkan.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Menutup statement
    $stmt->close();
}

// Menutup koneksi
$conn->close();
?>
