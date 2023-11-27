<?php
include "../koneksi.php";

$id = $_GET["id"];
$id_produk = $_GET["id_produk"];
$qty = $_GET["qty"];

$sql = "DELETE FROM cart WHERE id = '{$id}'";
$run_sql=mysqli_query($conn,$sql);
if($run_sql){
    echo json_encode(["success"=>true, "message"=>"Item Berhasil Dihapus"]);
    $sql2 = "UPDATE produk SET stok = stok+'{$qty}' WHERE id = '{$id_produk}'";
    $run_sql2 = mysqli_query($conn, $sql2);
}else{
    echo json_encode(["success"=>false, "message"=>"Server Problem"]);
}

?>