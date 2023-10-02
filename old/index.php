<?php require_once('koneksi.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Form Insert Transaksi</title>
</head>

<body>
    <h1>Form Insert Transaksi</h1>

    <form action="insert.php" method="post">
        <label for="id_produk">Pilih Produk:</label>
        <select name="id_produk" id="id_produk" required>
            <?php

            // Query untuk mengambil data produk
            $sql = "SELECT id_produk, nama_produk FROM produk";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["id_produk"] . "'>" . $row["nama_produk"] . "</option>";
                }
            } else {
                echo "<option value='' disabled>Tidak ada produk</option>";
            }

            // Menutup koneksi
            $conn->close();
            ?>
        </select><br><br>

        <label for="jumlah">Jumlah:</label>
        <input type="text" name="jumlah" id="jumlah" required><br><br>

        <label for="tgl">Tanggal:</label>
        <input type="date" name="tgl" id="tgl" required><br><br>

        <input type="submit" value="Tambahkan Transaksi">
    </form>

    <br>
    <a href="view.php">Lihat Data Transaksi</a>
</body>

</html>