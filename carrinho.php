/** Pagína do carrinho
*  @author André Pereira
*  @version 2.5
*  @since 21 jan 2021
**/
<?php
ini_set('display_errors', 0);
session_start();
$total = 0;
$produtos_veiculos = array();
$total_veiculo = 0;

if(isset($_GET['mudar_carrinho'])){

    $action = $_GET['acao']; /** Ação a partir da URL. **/
    $voltar_para = $_GET['voltar_para'];
    $id_veiculo = "";
    

    if(isset($_GET['id_veiculo'])){
        $id_veiculo = $_GET['id_veiculo']; /** isset$_GET: Produto a partir da URL. **/
        $_SESSION['id_veiculo']['id_veiculo'] = $id_veiculo;
    }


    switch($action) { /** switch($action): Decide o que fazer. **/

        case "adicionar":
            $_SESSION['carrrinho_veiculos'][$id_veiculo]++; /** case "adicionar": Adiciona um na quantidade de produto com id $product_id . **/

            $_SESSION['feedback']['feedback'] = "<div style='text-align: center'>
                            <h4>Produto Adicionado ao Carrinho!</h4><br/>
                            <a href='checkout.php#carrinho'>
                            <input class='btn-style cr-btn' value='Ver Carrinho' type='button' style='cursor: pointer;'></input>
                            </a>
                        </div>";
        break;

        case "remover":
            $_SESSION['carrrinho_veiculos'][$id_veiculo]--; /** Remove um a partir da quantidade de produto com id $product_id .**/
            $_SESSION['feedback']['feedback'] = "<div style='text-align: center'>
                            <h4>Produto Removido do Carrinho!</h4><br/>
                            <a href='checkout.php#carrinho'>
                            <input class='btn-style cr-btn' value='Ver Carrinho' type='button' style='cursor: pointer;'></input>
                            </a>
                        </div>";
            if($_SESSION['carrrinho_veiculos'][$id_veiculo] == 0) unset($_SESSION['carrrinho_veiculos'][$id_veiculo]); /** Se a quantidade é zero, remove completamente (usando a função 'unset'), caso contrário mostra 0, -1, -2, etc. Enquanto o usuário continua a remover os itens.**/
        break;

        case "limpar":
            unset($_SESSION["produtos"]["produtos"]);
            unset($_SESSION['carrinho_veiculos']);
            unset($_SESSION['carrrinho_artigos']);
            session_destroy(); /** Limpa o carrinho inteiro, exemplo: esvazia o carrinho.**/
            echo "<script type='text/javascript'>
				location.href='$voltar_para'
             </script>";
        break;
    }       
}


if(isset($_SESSION['carrrinho_veiculos'])){ /** Se o carriho não está vazio. **/
    /** Repete através do carrinho. O $product_id é a chave, e $quantity é o valor.**/
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
        /** Mostra a linha, se conter um produto (embora deva haver sempre, como já verificamos).*//
        if($dados) {
            foreach($dados as $linha){

                $modelo = $linha['modelo'];
                $marca = $linha['marca'];
                $preco_veiculo = $linha['preco'];                                           

            }
        
        $veiculo_nome = $marca.' '.$modelo;
        $line_cost = $preco_veiculo * $quantidade; /**Calcular o custo da linha.**/
        $total_veiculo = $total_veiculo + $line_cost; /**Adiciona ao custo total.**/
        array_push($produtos_veiculos, $veiculo_nome, $quantidade, $total_veiculo);
        }

        $_SESSION['produtos_veiculos'] = $produtos_veiculos;
    }   
    
echo "<script type='text/javascript'>
				location.href='$voltar_para'
             </script>";	


?>