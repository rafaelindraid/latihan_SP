<?php
$host = "localhost"; // Ganti sesuai dengan host Anda
$username = "root"; // Ganti sesuai dengan username database Anda
$password = ""; // Ganti sesuai dengan password database Anda
$database = "latihan_abs"; // Ganti sesuai dengan nama database Anda

// Membuat koneksi ke database
$conn = new mysqli($host, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
