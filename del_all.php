<?php
include 'koneksi.php';

// Proses delete semua tugas
$q_del_all = "DELETE FROM tasks";
$run_q_del_all = mysqli_query($conn, $q_del_all);

if ($run_q_del_all) {
    header('Location: index.php'); // Redirect kembali ke halaman utama setelah penghapusan
    exit();
} else {
    echo "Gagal menghapus semua tugas.";
}
?>