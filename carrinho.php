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
            $_SESSION['carrrinho_veiculos'][$id_veiculo]++; //add one to the quantity of the product with id $product_id
            
            $_SESSION['feedback']['feedback'] = "<div style='text-align: center'>
                            <h4>Produto Adicionado ao Carrinho!</h4><br/>
                            <a href='checkout.php#carrinho'>
                            <input class='btn-style cr-btn' value='Ver Carrinho' type='button' style='cursor: pointer;'></input>
                            </a>
                        </div>";
        break;

        case "remover":
            $_SESSION['carrrinho_veiculos'][$id_veiculo]--; //remove one from the quantity of the product with id $product_id
            $_SESSION['feedback']['feedback'] = "<div style='text-align: center'>
                            <h4>Produto Removido do Carrinho!</h4><br/>
                            <a href='checkout.php#carrinho'>
                            <input class='btn-style cr-btn' value='Ver Carrinho' type='button' style='cursor: pointer;'></input>
                            </a>
                        </div>";
            if($_SESSION['carrrinho_veiculos'][$id_veiculo] == 0) unset($_SESSION['carrrinho_veiculos'][$id_veiculo]); //if the quantity is zero, remove it completely (using the 'unset' function) - otherwise is will show zero, then -1, -2 etc when the user keeps removing items.
        break;

        case "limpar":
            unset($_SESSION['produtos']['produtos']);
            unset($_SESSION['carrinho_veiculos']);
            unset($_SESSION['carrrinho_artigos']);
            session_destroy(); //unset the whole cart, i.e. empty the cart.
            echo "<script type='text/javascript'>
				location.href='$voltar_para'
             </script>";
        break;
    }       
}


if(isset($_SESSION['carrrinho_veiculos'])){ //if the cart isn't empty
    //iterate through the cart, the $product_id is the key and $quantity is the value
    $consulta = "";


    $veiculo_atual = $id_veiculo;
    foreach($_SESSION['carrrinho_veiculos'] as $id_veiculo => $quantity) {
        $quantidade = $quantity;
    }


    $id_veiculo = $veiculo_atual;

        if (isset($_SESSION['id_veiculo']['id_veiculo'])){
            $consulta = "SELECT modelo, marca, preco FROM veiculos WHERE IDVeiculo = '$id_veiculo'";
        }
        $pass_users = 'http404#2021%';
        $cargo = "admin";
        include('database/selects_basedados.php');
        // Only display the row if there is a product (though there should always be as we have already checked)
        if($dados) {
            foreach($dados as $linha){

                $modelo = $linha['modelo'];
                $marca = $linha['marca'];
                $preco_veiculo = $linha['preco'];                                           

            }
        
        $veiculo_nome = $marca.' '.$modelo;
        $line_cost = $preco_veiculo * $quantidade; //work out the line cost
        $total_veiculo = $total_veiculo + $line_cost; //add to the total cost
        array_push($produtos_veiculos, $veiculo_nome, $quantidade, $total_veiculo);
        }

        $_SESSION['produtos_veiculos'] = $produtos_veiculos;
    }   
    
echo "<script type='text/javascript'>
				location.href='$voltar_para'
             </script>";	


?>