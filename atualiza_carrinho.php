<?php
/** Página de Atualização dos Carrinho - Permite atualizar automaticamente o carrinho ao adicionar um produto e redirecionar de volta para product_details.php
* @author Grupo HTTP404
* @version 1.0
* @since 25 jan 2021
**/  
// Desabilita a demonstração de erros, para que não haja a possibilidade de aparecer erros para o usuário final
ini_set('display_errors', 1);
session_start();
// Definição de variáveis
/** Valor Total de Produtos */
$total_valor_produtos = 0;
/** Número Total de Produtos */
$num_produtos_total = 0;
/** Designação do Veículo */
$veiculo_nome = "";
/** Custo total de um produto */
$line_cost = 0;
/** Custo Total dos Veículos */
$total_veiculo = 0; 
/** Custo Total dos Artigos */
$total_artigo = 0;
/** Tipo de produto(Veiculo/Artigo) */
$tipo_produto = "";
/** Torna-se Verdadeiro caso não existam artigos no array dos artigos do carrinho */
$artigo_nulo = FALSE;
/** Torna-se Verdadeiro caso não existam veiculos no array dos veiculos do carrinho */
$veiculo_nulo = FALSE;
/** Recebe voltar_para, logo que será necessário  redirecionar de volta à product_details*/
$voltar_para = $_SESSION['voltar_para'];

/** Apenas inicia o processo se um veiculo/artigo tiver sido adicionado ao carrinho através da loja */
if(isset($_SESSION['produtos_veiculos']) || isset($_SESSION['produtos_artigos'])){
    
    /** if(isset($_SESSION['produtos_artigos'])): Se um artigo foi adicionado ao carrinho, resgata id_artigo definido na página carrinho_artigos */
    if(isset($_SESSION['produtos_artigos'])){
        $id_artigo = $_SESSION['id_artigo']['id_artigo'];
        // Id_artigo passa a ser si próprio na posição zero logo que $_SESSION['id_artigo']['id_artigo'] é um array
        $id_artigo = $id_artigo[0];
        $tipo_produto = "artigo";
    } 
    /** if(isset($_SESSION['produtos_veiculos'])): Se um veiculo foi adicionado ao carrinho, resgata id_veiculo definido na página carrinho_artigos */
    if(isset($_SESSION['produtos_veiculos'])){
        $id_veiculo =  $_SESSION['id_veiculo']['id_veiculo'];
        // Id_veiculo passa a ser si próprio na posição zero logo que $_SESSION['id_veiculo']['id_veiculo'] é um array
        $id_veiculo = $id_veiculo[0];
        $tipo_produto = "veiculo";
    }
    /** $produtos: Array dos Produtos do carrinho */
    $produtos = array();
    /** $prod_veiculos_antigos: Array dos produtos já adicionados ao carrinho previamente */
    $prod_veiculos_antigos = array();
    /** if($tipo_produto == "veiculo"): Caso o tipo do produto ser um veiculo, conecta à base de dados e empurra o resultado para o array dos produtos */
    if($tipo_produto == "veiculo"){

        /** if(isset($_SESSION['carrinho_veiculos'][$id_veiculo]: Condição que não permite que sejam definidos produtos que não tenham sido adicionados em carrinho.php(ou que foram removidos), 
         * Caso não houverem produtos, define veiculo_nulo como verdadeiro
         */
        if(isset($_SESSION['carrinho_veiculos'][$id_veiculo])){ 

            // Quantidade é definida em carrinho.php
            $quantidade_veiculo = $_SESSION['carrinho_veiculos'][$id_veiculo];       
            /** $consulta: Define o query da consulta */
            $consulta = "SELECT modelo, marca, preco FROM veiculos WHERE IDVeiculo = '$id_veiculo'";
            /** $pass_users, $cargo: Define os dados para logar na base de dados */
            $pass_users = 'http404#2021%';
            $cargo = "admin";
            /** chama o ficheiro para conectar à base de dados */
            include('database/selects_basedados.php');
            /** foreach($dados as $linha): Ciclo que extrai para variáveis o resultado da consulta */
            if($dados) {
                foreach($dados as $linha){
                    /** $modelo = $linha['modelo']: Define o Modelo */
                    $modelo = $linha['modelo'];
                    /** $marca = $linha['marca']: Define a Marca */
                    $marca = $linha['marca'];
                    /** $preco_veiculo = $linha['preco']: Define o preço */
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
            /** if(isset($_SESSION['produtos']['produtos']:  Caso já existam produtos no carrinho, se o novo produto for igual a um dos que já existem, redefine as posições do produto para o novo */
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
            /** if($sem_produtos == TRUE): Caso não haja produtos no carrinho, ou não houverem produtos repetidos, empurra os valores para o array dos produtos */
            if($sem_produtos == TRUE){
                array_push($produtos, $veiculo_nome, $quantidade_veiculo, $total_veiculo);   
            }
        } else {
            $veiculo_nulo = TRUE;
           
        }
    }
    /** if($tipo_produto == "veiculo"): Caso um artigo tiver sido adicionado, repete o mesmo processo que o dos veículos, senão define artigo_nulo como verdadeiro */
    if($tipo_produto == "artigo"){
        // Condição que não permite que sejam definidos produtos que não tenham sido adicionados em carrinho.php(ou que foram removidos)
        if(isset($_SESSION['carrinho_artigos'][$id_artigo])){
            
            // Quantidade é definida em carrinho_artigos.php
            $quantidade_artigo = $_SESSION['carrinho_artigos'][$id_artigo];
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
    /** if($veiculo_nulo == TRUE): Faz uma conexão à base de dados, similar à feita para definir veículos, para buscar o nome do veículo nulo apartir do seu id.
     * Com esse dado, procura no array de produtos o nome obtido e remove-o do array, em conjunto com sua quantidade e preço
    */
    if($veiculo_nulo == TRUE){
        // Armazena os produtos adicionados anteriormente no array produtos
        $produtos = $_SESSION['produtos']['produtos'];
        // Conexão à base de dados
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
        // Define variáveis Finais
        $veiculo_nome = $marca.' '.$modelo;
        $num_produtos = count($produtos);
        // Ciclo se repete consoante o número de produtos existentes no array dos produtos
        for($remover_produto_nulo = 0; $num_produtos > $remover_produto_nulo; $remover_produto_nulo++){

            if($veiculo_nome == $produtos[$remover_produto_nulo]){
                
                unset($produtos[$remover_produto_nulo]);
                unset($produtos[$remover_produto_nulo + 1]);
                unset($produtos[$remover_produto_nulo + 2]);
                // Remove as posição vazias de produtos ao redefinir o array com os valores de si próprio
                $produtos = array_values($produtos);
                break;        
            }
        }
    }
    /** if($artigo_nulo == TRUE): Repete o mesmo processo feito aos veículos, só que desta vez para os artigoss */
    if($artigo_nulo == TRUE){
        
        $produtos = $_SESSION['produtos']['produtos'];
        // Conexão base de dados
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
        // Ciclo que remove o produto nulo do array produtos
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
    // Remove o array associativo session de todos os produtos para não permitir que o processo acima seja repetida apenas ao recarregar da página
    unset($_SESSION['produtos_veiculos']);
    unset($_SESSION['produtos_artigos']);
    // Guarda os produtos todos no array associativo
    if(isset($produtos)){
        /** $_SESSION['produtos']['produtos']: Array associativo que guarda todos os produtos do carrinho */
        $_SESSION['produtos']['produtos'] = $produtos;
    }
    /** if(count($produtos) == 0): Caso o numero de produtos seja igual a zero, significa que não há produtos, logo remove o array associativo dos produtos */
    if(count($produtos) == 0){
        unset($_SESSION['produtos']['produtos']);
    } 
}
/** Redireciona Para product_details na posição da página do produto adicionado*/
echo "<script type='text/javascript'>
            location.href='$voltar_para'
            </script>";
?>