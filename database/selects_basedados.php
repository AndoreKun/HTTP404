<?php
/** 
 * Página responsável por fazer um select na base de dados
 * A variáveis não definidas nesta página mas utilizadas na mesma são definidas na página em que selects_basedados for incluida com: include("selects_basedados.php")
 * @author Grupo HTTP 404
 * @version 1.2
 * @since 1 jan 2021
 * @return $dados Resultado Final da consulta
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

    $items = array();
    /** $stmt: resultado da consulta */
    $stmt = $conexao->query($consulta);
    $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // desconecta da base de dados
    $conexao = null;
    return $dados;
?>