<?php 
session_start();

if(isset($_GET['mudar_carrinho'])){

    $product_id = $_GET['id_artigo']; //the product id from the URL
    $action = $_GET['acao']; //the action from the URL
    $voltar_para = $_GET['voltar_para'];

    switch($action) { //decide what to do

        case "adicionar":
            $_SESSION['cart'][$product_id]++; //add one to the quantity of the product with id $product_id
            $_SESSION['feedback']['feedback'] = "<div style='text-align: center'>
                            <h4>Produto Adicionado ao Carrinho!</h4><br/>
                            <a href='checkout.php#carrinho'>
                            <input class='btn-style cr-btn' value='Ver Carrinho' type='button' style='cursor: pointer;'></input>
                            </a>
                        </div>";
            $_SESSION['id_artigo']['id_artigo'] = $product_id;
        break;

        case "remover":
            $_SESSION['cart'][$product_id]--; //remove one from the quantity of the product with id $product_id
            $_SESSION['feedback']['feedback'] = "<div style='text-align: center'>
                            <h4>Produto Removido do Carrinho!</h4><br/>
                            <a href='checkout.php#carrinho'>
                            <input class='btn-style cr-btn' value='Ver Carrinho' type='button' style='cursor: pointer;'></input>
                            </a>
                        </div>";
            if($_SESSION['cart'][$product_id] == 0) unset($_SESSION['cart'][$product_id]); //if the quantity is zero, remove it completely (using the 'unset' function) - otherwise is will show zero, then -1, -2 etc when the user keeps removing items.
        break;

        case "limpar":
            unset($_SESSION['cart']); //unset the whole cart, i.e. empty the cart.
        break;
    }       
}
echo "<script type='text/javascript'>
					location.href='$voltar_para'
                </script>";	
?>


