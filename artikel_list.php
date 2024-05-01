<?php
// Include koneksi ke database
include 'connect.php';

// Inisialisasi array untuk response
$response = array();

// Mendapatkan data dari Postman dengan metode GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Periksa apakah id_artikel tersedia
    if (isset($_GET['id_artikel'])) {
        $id_artikel = $_GET['id_artikel'];

        // Query untuk mengambil data artikel berdasarkan id_artikel
        $query = "SELECT id_artikel, judul, img_artikel FROM artikel ";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $rowData = array();

            // Ambil semua data pada $result lalu simpan pada $rowData
            while ($row = mysqli_fetch_assoc($result)) {
                $rowData[] = $row;
            }

            $response['status'] = 'success';
            $response['data'] = $rowData; // Convert $rowData menjadi array
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Artikel tidak ditemukan';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'ID Artikel tidak diterima';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Metode request tidak diizinkan';
}

// Mengembalikan response ke Postman
echo json_encode($response);
?>