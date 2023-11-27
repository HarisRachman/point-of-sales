<?php

    $targetPath = "../../img/kategori/" . Basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath);

    if($_POST["image"] != $_POST["imageOld"]) {
        unlink("../../img/kategori/".$_POST["imageOld"]);   
    }

?>