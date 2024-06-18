
    <?php
    session_start();
    session_regenerate_id(true);//セッションidを発行する

    require_once('../common/common.php');

    //postで受け取った数量
    $post = sanitize($_POST);
    

    $max = $post['max'];
    

    for($i =0; $i < $max;$i++){
        $NumberofProductsSelected[] = $post['NumberofProductsSelected'.$i];

    }


    //削除前
    $cart = $_SESSION['cart'];
    
    for($i =$max; 0  <=$i ;$i--){

        if(isset($_POST[$i])==true) {
         
            array_splice($cart,$i,1);
            array_splice($NumberofProductsSelected,1);
        
        }
    }

    for($i =0; $i < $max;$i++){

        if(preg_match('/\A[0-9]+\z/', $post['NumberofProductsSelected'.$i])==0)
        {
            print'数量が不正です';
            print'数量は半角で入力してください';
            print '<a href="cart_look.php">カートに戻る</a>';
            exit();
        }
        $NumberofProductsSelected[] = $post['NumberofProductsSelected'.$i];

    }



    $_SESSION['cart'] = $cart; //削除後
    $_SESSION['NumberofProductsSelected'] = $NumberofProductsSelected;//増量分を更新
    header('Location:cart_look.php');
    exit();

    
    ?>
