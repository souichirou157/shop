
    <?php
    // session_start();
    // session_regenerate_id(true);//セッションidを発行する

     require_once('../common/common.php');

    //postで受け取った数量
    $post = sanitize($_POST);


    //削除前
    $cart = $_SESSION['cart'];
    
    for($i =$max; 0  <=$i ;$i--){

        if(isset($_POST[$i])==true) {
         
            array_splice($cart,$i,1);
            array_splice($NumberofProductsSelected,1);
        
        }
    }


    $_SESSION['cart'] = $cart; //削除後
    $_SESSION['NumberofProductsSelected'] = $NumberofProductsSelected;//増量分を更新
    header('Location:cart_look.php');
//    exit();

    
    ?>
