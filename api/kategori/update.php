<?php
include "../koneksi.php";

$input = file_get_contents("php://input");
$decode = json_decode($input, true);

$id = $decode['id'];
$nama = $decode["kategori"];
$image = $decode["image"];

$sql = "UPDATE kategori SET nama = '{$nama}', image = '{$image}' WHERE id = '{$id}'";
$run_sql = mysqli_query($conn, $sql);

if($run_sql){
    echo json_encode(["success"=>true, "message"=>"Kategori Berhasil Diubah"]);
}else{
    echo json_encode(["success"=>false, "message"=>"Server Problem"]);
}

?>