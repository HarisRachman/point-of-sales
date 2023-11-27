<?php
include '../koneksi.php';

    $input = file_get_contents("php://input");
    $decode = json_decode($input, true);

    $nama = $decode["kategori"];
    $image = $decode["image"];

    $sql = "INSERT INTO kategori (nama, image) VALUES ('{$nama}', '{$image}')";
    $run_sql = mysqli_query($conn, $sql);

    if($run_sql){
        echo json_encode(["success"=>true, "message"=>"Kategori Berhasil Dimasukkan"]);
    }else{
        echo json_encode(["success"=>false, "message"=>"Server Problem"]);
    }
    
?>