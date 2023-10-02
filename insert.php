<?php require_once('koneksi.php'); ?>

<?php
// Memeriksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $id_produk = $_POST["id_produk"];
    $jumlah = $_POST["jumlah"];
    $tgl = $_POST["tgl"];

    // Memanggil stored procedure
    $sql = "CALL InsertTransaksi(?, ?, ?, @new_id)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $id_produk, $jumlah, $tgl);

    if ($stmt->execute()) {
        // Mengambil hasil dari stored procedure (new_id)
        $select_result = $conn->query("SELECT @new_id AS new_id");
        $result_row = $select_result->fetch_assoc();
        $new_transaction_id = $result_row["new_id"];

        // Menampilkan data yang baru saja diinputkan
        if ($new_transaction_id != -1) {
            $new_transaction_sql = "SELECT * FROM transaksi WHERE id_transaksi = $new_transaction_id";
            $result = $conn->query($new_transaction_sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "Data transaksi berhasil ditambahkan:<br>";
                    echo "ID Transaksi: " . $row["id_transaksi"] . "<br>";
                    echo "ID Produk: " . $row["id_produk"] . "<br>";
                    echo "Jumlah: " . $row["jumlah"] . "<br>";
                    echo "Total: " . $row["total"] . "<br>";
                    echo "Tanggal: " . $row["tgl"] . "<br>";
                }
            } else {
                echo "Data transaksi tidak ditemukan.";
            }
        } else {
            echo "Produk tidak ditemukan.";
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    // Menutup statement
    $stmt->close();
}

// Menutup koneksi
$conn->close();
?>
