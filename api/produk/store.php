<?php
include '../koneksi.php';

// if(isset($_POST["nama"]) || isset($_POST["image"])){
    $input = file_get_contents("php://input");
    $decode = json_decode($input, true);

    $nama = $decode["nama"];
    $kategori = $decode["kategori"];
    $stok = $decode["stok"];
    $price = $decode["price"];
    $image = $decode["image"];

    $sql = "INSERT INTO produk (nama, id_kategori, image, stok, harga) 
            VALUES ('{$nama}', '{$kategori}', '{$image}', '{$stok}', '{$price}')";
    $run_sql = mysqli_query($conn, $sql);

    if($run_sql){
        echo json_encode(["success"=>true, "message"=>"Produk Berhasil Dimasukkan"]);
    }else{
        echo json_encode(["success"=>false, "message"=>"Server Problem"]);
    }
// }

?>