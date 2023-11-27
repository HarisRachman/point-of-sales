<?php
include '../koneksi.php';

// if(isset($_POST["nama"]) || isset($_POST["image"])){
    $input = file_get_contents("php://input");
    $decode = json_decode($input, true);

    $nama = $decode["nama"];
    $harga = $decode["harga"];
    $bayar = $decode["bayar"];
    $kembalian = $decode["kembalian"];

    $sql = "INSERT INTO transaksi (nama, id_user, total_harga, total_bayar, kembalian) 
            VALUES ('{$nama}', 1, '{$harga}', '{$bayar}', '{$kembalian}')";
    $run_sql = mysqli_query($conn, $sql);

    if($run_sql){
        $result = mysqli_query($conn, "SELECT id FROM transaksi ORDER BY id DESC LIMIT 1");
        while($res = mysqli_fetch_array($result))
        {
            $id = $res['id'];
        }

        $sql2 = "INSERT INTO detail_transaksi (id_produk, qty, subTotal) 
            SELECT id_produk, qty, subTotal FROM cart";
        $run_sql2 = mysqli_query($conn, $sql2);

        $sql3 = "UPDATE detail_transaksi SET id_transaksi = '{$id}' WHERE id_transaksi = 0";
        $run_sql3 = mysqli_query($conn, $sql3);

        $sql4 = "DELETE FROM cart";
        $run_sql4 = mysqli_query($conn, $sql4);

        echo json_encode(["success"=>true, "message"=>"Cart Berhasil Dimasukkan"]);

    }else{
        echo json_encode(["success"=>false, "message"=>"Server Problem"]);
    }
// }

?>