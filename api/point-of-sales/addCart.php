<?php
include '../koneksi.php';

// if(isset($_POST["nama"]) || isset($_POST["image"])){
    $input = file_get_contents("php://input");
    $decode = json_decode($input, true);

    $id = $decode["id_produk"];
    $qty = $decode["qty"];
    $subTotal = $decode["subTotal"];

    $sql = "INSERT INTO cart (id_produk, qty, subTotal) VALUES ('{$id}', '{$qty}', '{$subTotal}')";
    $run_sql = mysqli_query($conn, $sql);

    if($run_sql){
        echo json_encode(["success"=>true, "message"=>"Cart Berhasil Dimasukkan"]);
        $sql2 = "UPDATE produk SET stok = stok-'{$qty}' WHERE id = '{$id}'";
        $run_sql2 = mysqli_query($conn, $sql2);
    }else{
        echo json_encode(["success"=>false, "message"=>"Server Problem"]);
    }
// }

?>