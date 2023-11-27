<?php
include "../koneksi.php";

$sql = "SELECT SUM(subTotal) AS totalHarga FROM cart;";
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