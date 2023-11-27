<?php
include "../koneksi.php";

if(isset($_GET["id"])){
    $id = $_GET["id"];
    $sql = "SELECT produk.nama as produk, produk.harga as harga, detail_transaksi.qty as qty, 
            detail_transaksi.subtotal as subtotal
            FROM detail_transaksi 
            LEFT JOIN produk ON detail_transaksi.id_produk = produk.id
            WHERE detail_transaksi.id_transaksi = '{$id}'";
    $run_sql = mysqli_query($conn, $sql);
    $output2 = [];
    if(mysqli_num_rows($run_sql) > 0){
        while($row = mysqli_fetch_assoc($run_sql)){
            $output2[] = $row;
        }
    }else{
        $output2["empty"] = "empty";
    }
    echo json_encode($output2);
}
?>