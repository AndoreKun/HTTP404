<?php 
ini_set('display_errors', 0);
session_start();
$total = 0;
$produtos_veiculos = array();
$total_veiculo = 0;

if(isset($_GET['mudar_carrinho'])){

    $action = $_GET['acao']; //the action from the URL
    $voltar_para = $_GET['voltar_para'];
    $id_veiculo = "";
    if(isset($_GET['id_veiculo'])){
        $id_veiculo = $_GET['id_veiculo']; //the product id from the URL
        $_SESSION['id_veiculo']['id_veiculo'] = $id_veiculo;
        
    }


    switch($action) { //decide what to do

        case "adicionar":
            $_SESSION['carrinho_veiculos'][$id_veiculo]++; //add one to the quantity of the product with id $product_id
            $_SESSION['produtos_veiculos'] = "adicionar";
            $_SESSION['feedback']['feedback'] = "<div style='text-align: center'>
                            <h4>Produto Adicionado ao Carrinho!</h4><br/>
                            <a href='checkout.php#carrinho'>
                            <input class='btn-style cr-btn' value='Ver Carrinho' type='button' style='cursor: pointer;'></input>
                            </a>
                        </div>";
        break;

        case "remover":
            $_SESSION['carrinho_veiculos'][$id_veiculo]--; //remove one from the quantity of the product with id $product_id
            $_SESSION['produtos_veiculos'] = "remover";
            $_SESSION['feedback']['feedback'] = "<div style='text-align: center'>
                            <h4>Produto Removido do Carrinho!</h4><br/>
                            <a href='checkout.php#carrinho'>
                            <input class='btn-style cr-btn' value='Ver Carrinho' type='button' style='cursor: pointer;'></input>
                            </a>
                        </div>";
            if($_SESSION['carrinho_veiculos'][$id_veiculo] == 0) unset($_SESSION['carrinho_veiculos'][$id_veiculo]); //if the quantity is zero, remove it completely (using the 'unset' function) - otherwise is will show zero, then -1, -2 etc when the user keeps removing items.
        break;

        case "limpar":
            unset($_SESSION['produtos']['produtos']);
            unset($_SESSION['carrinho_veiculos']);
            unset($_SESSION['carrrinho_artigos']);
            unset($_SESSION['prod_veiculos_antigos']);
            session_destroy(); //unset the whole cart, i.e. empty the cart.
            break;
    }       
}


echo "<script type='text/javascript'>
				location.href='$voltar_para'
             </script>";	


?>