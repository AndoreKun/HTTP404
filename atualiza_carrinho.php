<?php 
// Desabilita a demonstração de erros, para que não haja a possibilidade de aparecer erros para o usuário final
ini_set('display_errors', 1);
session_start();
// Definição de variáveis
$total_valor_produtos = 0;
$num_produtos_total = 0;
$veiculo_nome = "";
$line_cost = 0;
$total_veiculo = 0; 
$total_artigo = 0;
$tipo_produto = "";
$artigo_nulo = FALSE;
$veiculo_nulo = FALSE;
$voltar_para = $_SESSION['voltar_para'];

// Apenas inicia o processo de um veiculo/artigo tiver sido adicionado ao carrinho através da loja
if(isset($_SESSION['produtos_veiculos']) || isset($_SESSION['produtos_artigos'])){
    
    // Se um artigo foi adicionado ao carrinho, define as variáveis do mesmo
    if(isset($_SESSION['produtos_artigos'])){
        $id_artigo = $_SESSION['id_artigo']['id_artigo'];
        $id_artigo = $id_artigo[0];
        $acao_artigo = $_SESSION['produtos_artigos'];
        $tipo_produto = "artigo";
    } 
    // Se um veiculo foi adicionado ao carrinho, define as variáveis do mesmo
    if(isset($_SESSION['produtos_veiculos'])){
        $id_veiculo =  $_SESSION['id_veiculo']['id_veiculo'];
        $id_veiculo = $id_veiculo[0];
        $acao_veiculo = $_SESSION['produtos_veiculos'];
        $tipo_produto = "veiculo";
    }
    
    $produtos = array();
    $prod_veiculos_antigos = array();

    if($tipo_produto == "veiculo"){

        // Condição que não permite que sejam definidos produtos que não tenham sido adicionados em carrinho.php(ou que foram removidos)
        if(isset($_SESSION['carrinho_veiculos'][$id_veiculo])){ 

            // Quantidade é definida em carrinho.php
            $quantidade_veiculo = $_SESSION['carrinho_veiculos'][$id_veiculo];       
            // Define o query da consulta e chama o ficheiro para conectar à base de dados
            $consulta = "SELECT modelo, marca, preco FROM veiculos WHERE IDVeiculo = '$id_veiculo'";
            $pass_users = 'http404#2021%';
            $cargo = "admin";
            include('database/selects_basedados.php');
            // Ciclo que extrai para variáveis o resultado da consulta

            if($dados) {
                foreach($dados as $linha){
                    $modelo = $linha['modelo'];
                    $marca = $linha['marca'];
                    $preco_veiculo = $linha['preco'];                                           
                }
            }

            // Define as variáveis finais
            $veiculo_nome = $marca.' '.$modelo;
            // Define o preço por veiculo
            $line_cost = $preco_veiculo * $quantidade_veiculo; 
            // Adiciona ao valor total
            $total_veiculo = $total_veiculo + $line_cost; 
            $sem_produtos = TRUE;
            // Caso já existam produtos no carrinho, se o novo produto for igual a um dos que já existem, redefine as posições do produto para o novo

            if(isset($_SESSION['produtos']['produtos'])){
                $produtos = $_SESSION['produtos']['produtos'];
                
                $num_produtos = count($produtos);
                for($produtos_repetidos = 0; $num_produtos > $produtos_repetidos; $produtos_repetidos++){
                    
                    if($veiculo_nome == $produtos[$produtos_repetidos]){
                        
                        $produtos[$produtos_repetidos] = $veiculo_nome;
                        $produtos[$produtos_repetidos + 1] = $quantidade_veiculo;
                        $produtos[$produtos_repetidos + 2] = $total_veiculo;
                        $sem_produtos = FALSE;
                        break;        
                    }
                }
            }
            // Caso não haja produtos, empurra os valores para o array dos produtos
            if($sem_produtos == TRUE){
                array_push($produtos, $veiculo_nome, $quantidade_veiculo, $total_veiculo);   
            }
        } else {
            $veiculo_nulo = TRUE;
           
        }
    }

    // Caso um artigo tiver sido adicionado, repete o mesmo processo que o dos veículos
    if($tipo_produto == "artigo"){
        
        // Condição que não permite que sejam definidos produtos que não tenham sido adicionados em carrinho.php(ou que foram removidos)
        if(isset($_SESSION['carrinho_artigos'][$id_artigo])){
            
            // Quantidade é definida em carrinho_artigos.php
            $quantidade_artigo = $_SESSION['carrinho_artigos'][$id_artigo];
            // $id_artigo = (substr($id_artigo, 1));
            // Conexão à base de dados
            $consulta = "SELECT nome, preco FROM artigos WHERE IDArtigo = '$id_artigo'";
            $pass_users = 'http404#2021%';
            $cargo = "admin";
            include('database/selects_basedados.php');

            // Ciclo para extrair resultado
            if($dados) {
                foreach($dados as $linha){

                    $nome = $linha['nome'];
                    $preco_artigo = $linha['preco'];                                           

                }
            }
            // Define o preço por artigo
            $line_cost = $preco_artigo * $quantidade_artigo; 
            // Adiciona ao valor total
            $total_artigo = $total_artigo + $line_cost; 
            $sem_produtos = TRUE;
            // Caso já existam produtos no carrinho, se o novo produto for igual a um dos que já existem, redefine as posições do produto para o novo
            if(isset($_SESSION['produtos']['produtos'])){
                $produtos = $_SESSION['produtos']['produtos'];
                $num_produtos = count($produtos);
                
                for($produtos_repetidos = 0; $num_produtos > $produtos_repetidos; $produtos_repetidos++){
                    
                    if($nome == $produtos[$produtos_repetidos]){
                        
                        $produtos[$produtos_repetidos] = $nome;
                        $produtos[$produtos_repetidos + 1] = $quantidade_artigo;
                        $produtos[$produtos_repetidos + 2] = $total_artigo;
                        $sem_produtos = FALSE;
                        break;
                    }
                }
            }
            // Caso não haja produtos, empurra os valores para o array dos produtos
            if($sem_produtos == TRUE){
                array_push($produtos, $nome, $quantidade_artigo, $total_artigo);   
            }
        } else {
            $artigo_nulo = TRUE;

        }
    }
    if($veiculo_nulo == TRUE){
        $produtos = $_SESSION['produtos']['produtos'];
        $consulta = "SELECT modelo, marca FROM veiculos WHERE IDVeiculo = '$id_veiculo'";
        $pass_users = 'http404#2021%';
        $cargo = "admin";
        include('database/selects_basedados.php');
        // Ciclo que extrai para variáveis o resultado da consulta

        if($dados) {
            foreach($dados as $linha){
                $modelo = $linha['modelo'];
                $marca = $linha['marca'];                                        
            }
        }
        $veiculo_nome = $marca.' '.$modelo;
        $num_produtos = count($produtos);
            for($remover_produto_nulo = 0; $num_produtos > $remover_produto_nulo; $remover_produto_nulo++){
                
                if($veiculo_nome == $produtos[$remover_produto_nulo]){
                    
                    unset($produtos[$remover_produto_nulo]);
                    unset($produtos[$remover_produto_nulo + 1]);
                    unset($produtos[$remover_produto_nulo + 2]);
                    $produtos = array_values($produtos);
                    break;        
                }
            }
    }
    if($artigo_nulo == TRUE){
        
        $produtos = $_SESSION['produtos']['produtos'];
        $consulta = "SELECT nome FROM artigos WHERE IDArtigo = '$id_artigo'";
        $pass_users = 'http404#2021%';
        $cargo = "admin";
        include('database/selects_basedados.php');
        // Ciclo que extrai para variáveis o resultado da consulta

        if($dados) {
            foreach($dados as $linha){
                $nome = $linha['nome'];                                      
            }
        }
        $num_produtos = count($produtos);
            for($remover_produto_nulo = 0; $num_produtos > $remover_produto_nulo; $remover_produto_nulo++){
                
                if($nome == $produtos[$remover_produto_nulo]){
                    unset($produtos[$remover_produto_nulo]);
                    unset($produtos[$remover_produto_nulo + 1]);
                    unset($produtos[$remover_produto_nulo + 2]);
                    $produtos = array_values($produtos);
                    break;        
                }
            }
    }
    // Transforma o array associativo session de todos os produtos para não permitir que o processo acima seja repetida apenas ao recarregar da página
    unset($_SESSION['produtos_veiculos']);
    unset($_SESSION['produtos_artigos']);
    // Guarda os produtos todos no array associativo
    if(isset($produtos)){
        $_SESSION['produtos']['produtos'] = $produtos;
    }
    // Caso o count de produtos seja igual a zero, significa que não há produtos, logo remove o array associativo dos produtos
    if(count($produtos) == 0){
        unset($_SESSION['produtos']['produtos']);
    } 
}

echo "<script type='text/javascript'>
            location.href='$voltar_para'
            </script>";
?>