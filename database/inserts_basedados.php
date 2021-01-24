<?php
/** 
 * Página responsável por fazer um insert na base de dados, também permite inserir imagens e imprime um feedback
 *  A variáveis não definidas nesta página mas utilizadas na mesma são definidas na página em que inserts_basedados for incluida com: include("inserts_basedados.php")
 * @author Grupo HTTP 404
 * @version 1.2
 * @since 2 jan 2021
 * @param $acao Ação que foi realizada ("Insert", "delete" ou "update"), definida na página em que inserts_basedados for incluida
 * @param $feedback Feedback a ser mostrado ao utilizador, varia de acordo com a ação enviada
 * @param $adicionar_foto Verdadeiro caso queira adicionar uma foto na base de dados, definida na página em que inserts_basedados for incluida
 */

/** Tenta criar uma conexão à based de dados com método orientado a objetos(PDO), caso falhe, retorna a excecao */
try{
    /** $conexão: conexão à base de dados*/
    $conexao = new PDO("mysql:host=localhost;dbname=adc_http404", $cargo, $pass_users);
    // Se ocorrer um erro, imprime-o
    }catch (PDOException $e) {
        echo "Failed to connect to MySQL: " . $e->getMessage();
        exit();
    }
    // Coloca o modo de erro de PDO para excecao 
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try{
        // usar exec() logo que nao sao devolvidos resultados
        $conexao->exec($insert);
        /** $sucesso: é verdadeiro caso consiga fazer upload de uma foto à base de dados em upload.php */
        $sucesso = TRUE;
        if($adicionar_foto == TRUE){
            include('upload.php');
        }
        // Se ocorrer um erro, imprime-o e define sucesso como falso
        } catch(PDOException $e) {
            echo  "<br>" . $e->getMessage();
            $sucesso = FALSE;
    }
    /** Se sucesso for verdadeiro, define o feedback consoante a ação realizada */
    if($sucesso == TRUE){
        if($acao == 'insert'){
            $feedback = '<h5 style="color:green">Dados adicionados com sucesso!</h5>';
        }
        if($acao == 'delete'){
            $feedback = '<h5 style="color:green">Dados deletados com sucesso!</h5>';
        }
        if($acao == 'update'){
            $feedback = '<h5 style="color:green">Dados atualizados com sucesso!</h5>';
        }
    }
    // desconecta da base de dados
    $conexao = null;
    session_start();
    $_SESSION['feedback_insert'] = $feedback;
?>