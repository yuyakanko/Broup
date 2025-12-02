<?php session_start();?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Cart Preview</title>
  <link rel="stylesheet" href="css/header1.css?ver=0">
  <style>
    * { 
        box-sizing: border-box; 
        margin: 0; 
        padding: 0; 
        font-family: "YuGothic", sans-serif; 
    }

    body { 
        background: #ffffff; 
    }

    .app {
        width: 100vw; 
        height: 100vh; 
        border: none; 
        margin: 0;
        overflow: auto; 
    }

    header { 
        height: 40px; 
        background: #fff99a; 
        display: flex; 
        align-items: center; 
        padding: 0 10px; 
    }

    .logo { 
        font-size: 12px; 
        margin-right: 10px; 
    }

    .search-area { 
        flex: 1; 
        display: flex; 
        align-items: center; 
    }

    .search-input { 
        width: 100%; 
        height: 22px; 
        border: 1px solid #888; 
        padding: 0 6px; 
        font-size: 12px; 
    }

    .search-button { 
        width: 24px; 
        height: 24px; 
        border: 1px solid #888; 
        border-left: none; 
        font-size: 14px; 
        cursor: pointer; 
        background: #ffffff; 
    }

    .header-right { 
        display: flex; 
        align-items: center; 
        margin-left: 10px; 
        gap: 5px; 
    }

    .user-icon { 
        width: 22px; 
        height: 22px; 
        border-radius: 50%; 
        background: #dcdcdc; 
    }

    .logout-btn { 
        background: #ff0000; 
        color: #fff; 
        border: none; 
        font-size: 11px; 
        padding: 5px 10px; 
        cursor: pointer; 
    }

    main { 
        padding: 10px; 
        font-size: 12px; 
    }

    .back-link { 
        margin-bottom: 8px; 
    }
    .content { 
        display: flex; 
        align-items: flex-start; 
        justify-content: center; 
        gap: 40px; 
        padding-top: 20px; 
    }

    .items { 
        width: 50%; 
        max-width: 600px; 
    }

    .cart-item { 
        display: flex; 
        margin-bottom: 15px; 
    }

    .item-image { 
        width: 170px; 
        height: 170px; 
        background: #dcdcdc; 
        display: flex; 
        justify-content: center; 
        align-items: center; 
        margin-right: 10px; 
        font-size: 40px; 
    }

    .item-image img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .item-right { 
        flex: 1; 
        display: flex; 
        flex-direction: column; 
    }

    .delete-btn { 
        background: #ff0000; 
        color: #fff; border: none; 
        padding: 8px 18px; 
        font-size: 14px; 
        cursor: pointer; 
        border-radius: 4px; 
        align-self: flex-start; 
        margin-bottom: 18px; 
    }

    .item-name { 
        font-size: 16px; 
        margin-bottom: 4px; 
    }

    .item-price { 
        font-size: 13px; 
    }

    .underline { 
        text-decoration: underline; 
    }

    .checkout-area { 
        width: 30%; 
        min-width: 250px; 
        display: flex; 
        justify-content: center; 
        align-items: flex-start; 
        padding-top: 40px; 
    }

    .checkout-btn { 
        width: 170px; 
        height: 120px; 
        border-radius: 10px; 
        border: none; 
        background: #33cfff; 
        cursor: pointer; 
        font-size: 18px; 
    }

    .hoa {
      text-decoration: none;
      color: #000000;
    }

  </style>
</head>
<body>
    <?php require "データベース.php"?>
    <?php
        if(isset($_POST['cart_item'])){
            $cart_item = $_POST['cart_item'];
            $pdo=new PDO($connect, USER , PASS);
            $sql=$pdo->prepare("SELECT * FROM item_information WHERE item_id = ?");
            $sql->execute([$cart_item]);
            $item = $sql->fetch(PDO::FETCH_ASSOC);

            $mysql=$pdo->prepare("SELECT * FROM product_image WHERE item_id = ?  AND sort_order = 1");
            $mysql->execute([$cart_item]);
            $img = $mysql->fetch(PDO::FETCH_ASSOC);

            if(!isset($_SESSION['cart'])){
                $_SESSION['cart'] =[];
            }

            $_SESSION['cart'][] = [
                'id' => $item['item_id'],
                'name' => $item['product_name'], 
                'price' => $item['product_price'], 
                "img" => $img['product_path'],
            ];
        }
        if(isset($_POST['delete_item']) && isset($_SESSION['cart'])){
            $delete_item = $_POST['delete_item'];
            foreach($_SESSION['cart'] as $row => $value){
                if($value['id'] == $delete_item){
                    unset($_SESSION['cart'][$row]);
                    $_SESSION['cart'] = array_values($_SESSION['cart']);
                }
            }
        }
    ?>
    <div class="app">
        <main>
            <?php require 'header1.php'?>
            <div class="back-link">
                <a href="homePage.php" class="hoa">&lt; ホームへ</a>
            </div>
            <div class="content">
                <div class="items">
                    <?php
                        if(isset($_SESSION['cart'])){
                            foreach($_SESSION['cart'] as $key){
                                echo '<div class="cart-item">';
                                    echo '<div class="item-image">';
                                        echo '<img src="'.htmlspecialchars($key['img']).'">';
                                    echo '</div>';
                                    echo '<div class="item-right">';
                                        echo '<form action="カート.php" method="POST">';
                                            echo '<input type="hidden" name="delete_item" value="'.htmlspecialchars($key['id']).'">';
                                            echo '<button class="delete-btn">削除</button>';
                                        echo '</form>';
                                        echo '<h4 class="item-name">'.htmlspecialchars($key['name']).'</h4>';
                                        echo '<p class="item-price">値段（￥'.htmlspecialchars($key['price']).'）</p>';
                                    echo '</div>';
                                echo '</div>';
                            }
                        }
                    ?>
                </div>
                <form class="checkout-area" action="購入予定.php" method="POST">
                    <button class="checkout-btn">購入手続きへ</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
