<?php
include "../koneksi.php";

$input = file_get_contents("php://input");
$decode = json_decode($input, true);

$id = $decode['id'];
$kategori = $decode["kategori"];
$nama = $decode["nama"];
$stok = $decode["stok"];
$price = $decode["price"];
$image = $decode["image"];

$sql = "UPDATE produk SET nama = '{$nama}', id_kategori = '{$kategori}', image = '{$image}', 
        stok = '{$stok}', harga = '{$price}' WHERE id = '{$id}'";
$run_sql = mysqli_query($conn, $sql);

if($run_sql){
    echo json_encode(["success"=>true, "message"=>"Produk Berhasil Diubah"]);
}else{
    echo json_encode(["success"=>false, "message"=>"Server Problem"]);
}

?>