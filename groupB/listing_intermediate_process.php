<?php
session_start();
?>
<?php require "データベース.php"?>
<?php 
    $pdo=new PDO($connect, USER , PASS);
    if(isset($_FILES['image']) && isset($_POST['name']) && isset($_POST['number']) && isset($_POST['gener'])){
        $name = $_POST['name'];
        $number = $_POST['number'];
        $gener = $_POST['gener'];
        $num = 1;
        $description = "";
        $status = "";
        $item_id = "";
        $user_id = $_SESSION['customer']['id'];
        $images = $_FILES['image'];
        //echo '<pre>';
            //print_r($_SESSION['confirmation']['img']);
        //echo '</pre>';
        if(isset($_POST['description'])){
            $description = $_POST['description'];
        }
        if(isset($_POST['status'])){
            $status = $_POST['status'];
        }
        if(isset($description) && isset($status)){
            $sql=$pdo->prepare(
                "INSERT INTO item_information 
                (product_price,product_name,product_description,product_state,genre_id,user_id) 
                VALUES(?,?,?,?,?,?)"
            );
            $sql->execute([$number,$name,$description,$status,$gener,$user_id]);

            $item_id = $pdo->lastInsertId();
        }
        else if(isset($description)){
            $sql=$pdo->prepare(
                "INSERT INTO item_information 
                (product_price,product_name,product_description,genre_id,user_id) 
                VALUES(?,?,?,?,?)"
            );
            $sql->execute([$number,$name,$description,$gener,$user_id]);

            $item_id = $pdo->lastInsertId();
        }
        else if(isset($status)){
            $sql=$pdo->prepare(
                "INSERT INTO item_information 
                (product_price,product_name,product_state,genre_id,user_id) 
                VALUES(?,?,?,?,?)"
            );
            $sql->execute([$number,$name,$status,$gener,$user_id]);

            $item_id = $pdo->lastInsertId();
        }
        else{
            $sql=$pdo->prepare(
                "INSERT INTO item_information 
                (product_price,product_name,genre_id,user_id) 
                VALUES(?,?,?,?)"
            );
            $sql->execute([$number,$name,$gener,$user_id]);

            $item_id = $pdo->lastInsertId();
        }
        $save_paths = []; 
        for ($i = 0; $i < count($images['name']); $i++) {
            $upload_dir = 'image/';
            if ($images['error'][$i] === UPLOAD_ERR_OK) {
                $tmp_name = $images['tmp_name'][$i];
                $original_name = basename($images['name'][$i]);

                // ファイル名をユニークに（衝突防止）
                $unique_name = uniqid('img_', true) . '_' . $original_name;

                // 保存先フルパス
                $save_path = $upload_dir . $unique_name;

                // move_uploaded_fileで保存
                if (move_uploaded_file($tmp_name, $save_path)) {
                    error_log("保存成功: $save_path");
                    $save_paths [] = $save_path;
                    if (!isset($_SESSION['confirmation']['img'])) {
                        $_SESSION['confirmation']['img'] = [];
                    }
                    $_SESSION['confirmation']['img'][] = $save_path; 
                } 
                else {
                    error_log("保存失敗: $save_path");
                    error_log("tmp_name: $tmp_name");
                    error_log("エラーコード: " . $images['error'][$i]);
                    header("Location: product_listing.php");
                    exit;
                }
            }
        }
        foreach($save_paths as $key){
            $sql=$pdo->prepare('INSERT INTO product_image
            (product_path,sort_order,item_id)
            VALUES(?,?,?)');
            $sql->execute([$key,$num,$item_id]);
            $num += 1;
        }
        header("Location: product_listing_confirmation.php");
        exit;
    }
?>