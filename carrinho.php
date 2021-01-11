<?php 
ini_set('display_errors', 0);
session_start();

if(isset($_GET['mudar_carrinho'])){

    $action = $_GET['acao']; //the action from the URL
    $voltar_para = $_GET['voltar_para'];
    $product_id = "";
    if(isset($_GET['id_artigo'])){
        $id_artigo = $_GET['id_artigo']; //the product id from the URL
        $product_id = (substr($id_artigo, 1));
        $_SESSION['id_artigo']['id_artigo'] = $id_artigo;
    }

    if(isset($_GET['id_veiculo'])){
        $id_veiculo = $_GET['id_veiculo']; //the product id from the URL
        $product_id = $id_veiculo;
        $_SESSION['id_veiculo']['id_veiculo'] = $id_veiculo;
    }


    switch($action) { //decide what to do

        case "adicionar":
            $_SESSION['cart'][$product_id]++; //add one to the quantity of the product with id $product_id
            $_SESSION['feedback']['feedback'] = "<div style='text-align: center'>
                            <h4>Produto Adicionado ao Carrinho!</h4><br/>
                            <a href='checkout.php#carrinho'>
                            <input class='btn-style cr-btn' value='Ver Carrinho' type='button' style='cursor: pointer;'></input>
                            </a>
                        </div>";
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
            unset($_SESSION['cart']);
            session_destroy(); //unset the whole cart, i.e. empty the cart.
        break;
    }       
}


if(isset($_SESSION['cart'])){ //if the cart isn't empty
    //iterate through the cart, the $product_id is the key and $quantity is the value
    $total = 0;
    $veiculo = FALSE;
    $artigo = FALSE;
    $produtos = array();
    foreach($_SESSION['cart'] as $product_id => $quantity) {
        $consulta = "";
        if (isset($_SESSION['id_veiculo']['id_veiculo'])){
            $consulta = "SELECT modelo, marca, preco FROM veiculos WHERE IDVeiculo = '$product_id'";
            $veiculo = TRUE;

        }
        if (isset($_SESSION['id_artigo']['id_artigo'])){
            $consulta = "SELECT nome, preco FROM artigos WHERE IDArtigo = '$product_id'";
            $artigo = TRUE;
        }
        //get the name, description and price from the database - this will depend on your database implementation.
        //use sprintf to make sure that $product_id is inserted into the query as a number - to prevent SQL injection
        $pass_users = 'http404#2021%';
        $cargo = "admin";
        include('database/selects_basedados.php');
        
        //Only display the row if there is a product (though there should always be as we have already checked)
        if($dados) {
            foreach($dados as $linha){
                if($veiculo == TRUE){
                    $modelo = $linha['modelo'];
                    $marca = $linha['marca'];
                    $preco = $linha['preco'];
                }
                if($artigo == TRUE){
                    $nome = $linha['nome'];
                    $preco = $linha['preco'];
                }
            }
            if($veiculo == TRUE){
                $veiculo_nome = $marca.''.$modelo;
                $line_cost = $preco * $quantity; //work out the line cost
                $total_veiculo = $total_veiculo + $line_cost; //add to the total cost
                array_push($produtos, $veiculo_nome, $quantity, $total_veiculo);
            }
            if($artigo == TRUE){
                $line_cost = $preco * $quantity; //work out the line cost
                $total_artigo = $total_artigo + $line_cost; //add to the total cost
                array_push($produtos, $nome, $quantity, $total_artigo);
            }
        }
    }
    $_SESSION['num_produtos']['num_produtos']++;

    $_SESSION['produtos']['produtos'] = $produtos;
}
echo "<script type='text/javascript'>
					location.href='$voltar_para'
                </script>";	


?>