<?php

try{
    $conexao = new PDO("mysql:host=localhost;dbname=adc_http404", $cargo, $pass_users);
    }catch (PDOException $e) {
        echo "Failed to connect to MySQL: " . $e->getMessage();
        exit();
    }
    // Coloca o modo de erro de PDO para excecao
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // usar exec() logo que nao sao devolvidos resultados
    try{
    $conexao->exec($insert);
    $sucesso = TRUE;
    if($adicionar_foto == TRUE){
        include('upload.php');
    }
    } catch(PDOException $e) {
        echo  "<br>" . $e->getMessage();
        $sucesso = FALSE;
    }
    if($sucesso == TRUE){
        if($acao == 'insert'){
            ?><h5 style="color:green">Dados adicionados com sucesso!</h5><?php
        }
        if($acao == 'delete'){
            ?><h5 style="color:green">Dados deletados com sucesso!</h5><?php
        }
        if($acao == 'update'){
            ?><h5 style="color:green">Dados atualizados com sucesso!</h5><?php
        }
    }
    $conexao = null;
?>