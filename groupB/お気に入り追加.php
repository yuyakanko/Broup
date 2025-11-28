<?php session_start(); ?>
<?php
    header('Content-Type: application/json');
    require 'データベース.php';
    $response = [];

    if (isset($_SESSION['customer']['id']) && isset($_POST['item_id'])) {    
        $user_id = $_SESSION['customer']['id'];
        $item_id = $_POST['item_id'];
        $pdo=new PDO($connect , USER , PASS);
        $sql=$pdo->prepare("SELECT  * FROM favorite WHERE item_id = ? AND user_id = ?");
        $sql->execute([$item_id,$user_id]);
        if($sql->rowCount() > 0){
            $mysql=$pdo->prepare("DELETE FROM favorite WHERE item_id = ? AND user_id = ?");
            $mysql->execute([$item_id,$user_id]);
            $response['status'] = 'removed';
        }
        else{
            $mysql=$pdo->prepare("INSERT INTO favorite (item_id,user_id) VALUES(?,?)");
            $mysql->execute([$item_id,$user_id]);
            $response['status'] = 'added';
        }
    }
    echo json_encode($response);
?>