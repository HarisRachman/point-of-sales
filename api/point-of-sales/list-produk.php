<?php
include "../koneksi.php";

$sql = "SELECT produk.id as id, produk.nama as nama, kategori.nama as kategori, 
        produk.image as image, produk.stok as stok, produk.harga as harga 
        FROM produk 
        LEFT JOIN kategori ON produk.id_kategori = kategori.id
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