/** Pagína do carrinho de artigos
* @author Grupo HTTP404
* @version 1.0
* @since 21 jan 2021
**/
<?php
ini_set('display_errors', 0);
session_start();
$total = 0;
/**Quantidade total.**/
$total_artigo = 0;
/**Total custo da compra.**/
$produtos_artigos = array();
/**Produtos comprados.**/

if(isset($_GET['mudar_carrinho'])){

    $action = $_GET['acao']; /** Ação a partir da URL. **/
    $voltar_para = $_GET['voltar_para'];
    $id_artigo = "";
    if(isset($_GET['id_artigo'])){
        $id_artigo = $_GET['id_artigo']; /** isset$_GET: Produto a partir da URL. **/
        $_SESSION['id_artigo']['id_artigo'] = $id_artigo;
    }

    switch($action) { /**switch($action): Decide o que fazer. **/

        case "adicionar":
            $_SESSION['carrrinho_artigos'][$id_artigo]++; /**case "adicionar": Adiciona um na quantidade de produto com id $product_id . **/

            $_SESSION['feedback']['feedback'] = "<div style='text-align: center'>
                            <h4>Produto Adicionado ao Carrinho!</h4><br/>
                            <a href='checkout.php#carrinho'>
                            <input class='btn-style cr-btn' value='Ver Carrinho' type='button' style='cursor: pointer;'></input>
                            </a>
                        </div>";
        break;

        case "remover":
            $_SESSION['carrrinho_artigos'][$id_artigo]--; /**case "remover": Remove um a partir da quantidade de produto com id $product_id .**/
            $_SESSION['feedback']['feedback'] = "<div style='text-align: center'>
                            <h4>Produto Removido do Carrinho!</h4><br/>
                            <a href='checkout.php#carrinho'>
                            <input class='btn-style cr-btn' value='Ver Carrinho' type='button' style='cursor: pointer;'></input>
                            </a>
                        </div>";
            if($_SESSION['carrrinho_artigos'][$id_artigo] == 0) unset($_SESSION['carrrinho_artigos'][$id_artigo]); /** unset($_SESSION: Se a quantidade é zero, remove completamente (usando a função 'unset'), caso contrário mostra 0, -1, -2, etc. Enquanto o usuário continua a remover os itens.**/
        break;

        case "limpar":
            unset($_SESSION["produtos"]["produtos"]);
            unset($_SESSION['carrinho_veiculos']);
            unset($_SESSION['carrrinho_artigos']);
            session_destroy(); /**case "limpar": Limpa o carrinho inteiro, exemplo: esvazia o carrinho.**/
        break;
    }       
}


if(isset($_SESSION['carrrinho_artigos'])){ /**carrrinho_artigos: Se o carriho não está vazio. **/
    /** Repete através do carrinho. O $product_id é a chave, e $quantity é o valor.**/
    $consulta = "";
    $id_produto_artigo = (substr($id_artigo, 1));
    foreach($_SESSION['carrrinho_artigos'] as $id_artigo => $quantity) {
        $quantidade = $quantity;
    }
        if (isset($_SESSION['id_artigo']['id_artigo'])){
            $consulta = "SELECT nome, preco FROM artigos WHERE IDArtigo = '$id_produto_artigo'";

        }
        /** Pega o nome, a descrição e o preço no banco de dados. **/
        /** Usa sprintf para se certificar de que $ product_id é inserido na consulta como um número - para evitar uso de SQL. **/
        $pass_users = 'http404#2021%';
        $cargo = "admin";
        include('database/selects_basedados.php');
        /** Exibe a linha apenas se houver um produto (embora deva sempre haver).**/
        if($dados) {
            foreach($dados as $linha){

                $nome = $linha['nome'];
                $preco_artigo = $linha['preco'];
            }                                             
        $line_cost = $preco_artigo * $quantidade; /**$line_cost: Calcular o custo da compra.**/
        $total_artigo = $total_artigo + $line_cost; /**$total_artigo: Adiciona ao custo total.**/
        array_push($produtos_artigos, $nome, $quantidade, $total_artigo);
        }

    $_SESSION['produtos_artigos'] = $produtos_artigos;
    
}   
echo "<script type='text/javascript'>
				location.href='$voltar_para'
               </script>";	


?>