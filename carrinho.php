<?php
/** Página que controla informação sobre os veiculos nos carrinhos para ser redirecionada para o checkout
* @author Grupo HTTP404
* @version 2.6
* @since 4 jan 2021
**/
// Desabilita a demonstração de erros, para que não haja a possibilidade de aparecer erros para o usuário final
ini_set('display_errors', 0);
session_start();

/** Informações enviadas ao adicionar/remover um veiculos em product-details.php ou limpar a list em checkout */
if(isset($_GET['mudar_carrinho'])){
    /** Ação a ser realizada */
    $action = $_GET['acao']; 
    /** Página para redirecionar */ 
    $voltar_para = $_GET['voltar_para'];
    // Guarda no array associativo a pargina para a ser redirecionada do produto atual
    $_SESSION['voltar_para'] = $voltar_para;
    $id_veiculo = "";
    /** $id_artigo = $_GET['id_artigo']: define o id do artigo enviado por product_details.php */
    if(isset($_GET['id_veiculo'])){
        $id_veiculo = $_GET['id_veiculo']; 
        /** $_SESSION['id_artigo']['id_artigo'] = $id_artigo: Guarda no array para a função feedback em product_details.php receber */  
        $_SESSION['id_veiculo']['id_veiculo'] = $id_veiculo;
        
    }

    /** switch($action): Decide o que será feito apartir da ação enviada */
    switch($action) {
        /** case "adicionar": Adicionar um produto ao carrinho e habilita o botão "Remover Produto" em product_details */  
        case "adicionar":
            /** $_SESSION['carrinho_veiculos'][$id_artigo]++: Adiciona um para o veiculo com o id definido */
            $_SESSION['carrinho_veiculos'][$id_veiculo]++;
            /** $_SESSION['produtos_veiculos'] = "adicionar": Define um valor para produtos veiculos para confirmar que um produto foi adicionado */
            $_SESSION['produtos_veiculos'] = "adicionar";
            /** $_SESSION['feedback']['feedback']: Define o feedback a ser dado após o veiculo ser adicionado ao carrinho(Função em Feedback em produt-details.php) */
            $_SESSION['feedback']['feedback'] = "<div style='text-align: center'>
                            <h4>Produto Adicionado ao Carrinho!</h4><br/>
                            <a href='checkout.php#carrinho'>
                            <input class='btn-style cr-btn' value='Ver Carrinho' type='button' style='cursor: pointer;'></input>
                            </a>
                        </div>";
            /** $_SESSION['abilitar_remover_artigos'][$id_veiculo]: Abilita o botão de remover um veículo do carrinho, logo que um foi adicionado */
            $_SESSION['abilitar_remover_veiculos'][$id_veiculo] = "<form method='get' action='carrinho.php'>
                                                        <input type='hidden' id='id_veiculo' name='id_veiculo' value='$id_veiculo'>
                                                        <input type='hidden' id='acao' name='acao' value='remover'>
                                                        <input type='hidden' id='voltar_para' name='voltar_para' value='$voltar_para'>
                                                        <input class='btn-style cr-btn' name='mudar_carrinho' value='Remover do Carrinho' type='submit' style='cursor: pointer'></input>
                                                    </form>";
            /** echo "<script type='text/javascript'>location.href='atualiza_carrinho.php'</script>": Redireciona para a página de atualização do carrinho para que o usuário não precise de recarregar checkout manualmente toda vez que adicionar um produto */
            echo "<script type='text/javascript'>
            location.href='atualiza_carrinho.php'
            </script>";
            
            break;
        /** case "remover": Remove um artigo do carrinho */ 
        case "remover":
            /** $_SESSION['carrinho_artigos'][$id_artigo]--: Remove um para o veiculo com o id definido acima */
            $_SESSION['carrinho_veiculos'][$id_veiculo]--; 
            /** $_SESSION['produtos_artigos'] = "remover": Define um valor para produtos veiculos para confirmar em checkout.php que um produto foi removido */
            $_SESSION['produtos_veiculos'] = "remover";
            $_SESSION['feedback']['feedback'] = "<div style='text-align: center'>
                            <h4>Produto Removido do Carrinho!</h4><br/>
                            <a href='checkout.php#carrinho'>
                            <input class='btn-style cr-btn' value='Ver Carrinho' type='button' style='cursor: pointer;'></input>
                            </a>
                        </div>";
            // Caso o número for zero(0 veículos com aquele id no carrinho), remove a variável, logo que se continuasse iria mostrar valores como -1,-2 nmo carrinho,
            // e desabilita o botão de remover, logo que o número de veiculos no carrinho é zero
            /** if($_SESSION['carrinho_veiculos'][$id_veiculo] == 0: Desabilita botão de remover e o retira o produto do carrinho caso o mesmo for zero */
            if($_SESSION['carrinho_veiculos'][$id_veiculo] == 0) {
                unset($_SESSION['carrinho_veiculos'][$id_veiculo]);
                unset($_SESSION['abilitar_remover_veiculos'][$id_veiculo]);
            }
            echo "<script type='text/javascript'>
            location.href='atualiza_carrinho.php'
            </script>";
            break;
        /** case "limpar": Limpa o carrinho e destroí a sessão */   
        case "limpar":
            // Limpa todas as variáveis de forma que o carrinho fique sem nenhum artigo/veiculo
            unset($_SESSION['produtos']['produtos']);
            unset($_SESSION['carrinho_veiculos']);
            unset($_SESSION['carrrinho_artigos']);
            unset($_SESSION['prod_veiculos_antigos']);
            // Destrói a sessão, e com isso os arrays associativos session
            session_destroy(); 
            break;
    }       
}

/** Redirecionamento para checkout quando o carrinho for limpo */
echo "<script type='text/javascript'>
				location.href='$voltar_para'
             </script>";	


?>