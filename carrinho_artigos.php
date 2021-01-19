<?php 
ini_set('display_errors', 0);
session_start();
$total = 0;
$total_artigo = 0;
$produtos_artigos = array();

if(isset($_GET['mudar_carrinho'])){

    $action = $_GET['acao']; //the action from the URL
    $voltar_para = $_GET['voltar_para'];
    $id_artigo = "";
    if(isset($_GET['id_artigo'])){
        $id_artigo = $_GET['id_artigo']; //the product id from the URL
        $_SESSION['id_artigo']['id_artigo'] = $id_artigo;
    }

    switch($action) { //decide what to do

        case "adicionar":
            $_SESSION['carrrinho_artigos'][$id_artigo]++; //add one to the quantity of the product with id $product_id

            $_SESSION['feedback']['feedback'] = "<div style='text-align: center'>
                            <h4>Produto Adicionado ao Carrinho!</h4><br/>
                            <a href='checkout.php#carrinho'>
                            <input class='btn-style cr-btn' value='Ver Carrinho' type='button' style='cursor: pointer;'></input>
                            </a>
                        </div>";
        break;

        case "remover":
            $_SESSION['carrrinho_artigos'][$id_artigo]--; //remove one from the quantity of the product with id $product_id
            $_SESSION['feedback']['feedback'] = "<div style='text-align: center'>
                            <h4>Produto Removido do Carrinho!</h4><br/>
                            <a href='checkout.php#carrinho'>
                            <input class='btn-style cr-btn' value='Ver Carrinho' type='button' style='cursor: pointer;'></input>
                            </a>
                        </div>";
            if($_SESSION['carrrinho_artigos'][$id_artigo] == 0) unset($_SESSION['carrrinho_artigos'][$id_artigo]); //if the quantity is zero, remove it completely (using the 'unset' function) - otherwise is will show zero, then -1, -2 etc when the user keeps removing items.
        break;

        case "limpar":
            unset($_SESSION['produtos']['produtos']);
            unset($_SESSION['carrinho_veiculos']);
            unset($_SESSION['carrrinho_artigos']);
            session_destroy(); //unset the whole cart, i.e. empty the cart.
        break;
    }       
}


if(isset($_SESSION['carrrinho_artigos'])){ //if the cart isn't empty
    //iterate through the cart, the $product_id is the key and $quantity is the value
    $consulta = "";
    $id_produto_artigo = (substr($id_artigo, 1));
    foreach($_SESSION['carrrinho_artigos'] as $id_artigo => $quantity) {
        $quantidade = $quantity;
    }
        if (isset($_SESSION['id_artigo']['id_artigo'])){
            $consulta = "SELECT nome, preco FROM artigos WHERE IDArtigo = '$id_produto_artigo'";

        }
        //get the name, description and price from the database - this will depend on your database implementation.
        //use sprintf to make sure that $product_id is inserted into the query as a number - to prevent SQL injection
        $pass_users = 'http404#2021%';
        $cargo = "admin";
        include('database/selects_basedados.php');
        //Only display the row if there is a product (though there should always be as we have already checked)
        if($dados) {
            foreach($dados as $linha){

                $nome = $linha['nome'];
                $preco_artigo = $linha['preco'];
            }                                             
        $line_cost = $preco_artigo * $quantidade; //work out the line cost
        $total_artigo = $total_artigo + $line_cost; //add to the total cost
        array_push($produtos_artigos, $nome, $quantidade, $total_artigo);
        }

    $_SESSION['produtos_artigos'] = $produtos_artigos;
    
}   
echo "<script type='text/javascript'>
				location.href='$voltar_para'
               </script>";	


?>