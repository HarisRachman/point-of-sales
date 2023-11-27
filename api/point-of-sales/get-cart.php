<?php
include "../koneksi.php";

$sql = "SELECT produk.id as id, cart.id as id_cart, produk.nama as nama, produk.harga as harga, 
        cart.qty as qty, cart.subTotal as subTotal 
        FROM cart 
        LEFT JOIN produk ON cart.id_produk = produk.id
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