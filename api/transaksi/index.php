<?php
include "../koneksi.php";

$sql = "SELECT transaksi.id as id, transaksi.nama as pelanggan, users.nama as kasir, 
        transaksi.total_harga as harga, transaksi.total_bayar as bayar, transaksi.kembalian as kembalian,
        transaksi.tanggal as tanggal
        FROM transaksi 
        LEFT JOIN users ON transaksi.id_user = users.id
        ORDER BY id DESC";
$run_sql = mysqli_query($conn, $sql);
$output = [];
if(mysqli_num_rows($run_sql) > 0){
    while($row = mysqli_fetch_assoc($run_sql)){
        $output[] = $row;
    }
}else{
    $output["empty"] = "empty";
}
echo json_encode($output);
?>