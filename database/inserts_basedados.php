<?php

try{
    $conexao = new PDO("mysql:host=localhost;dbname=adc_http404", $cargo, $pass_users);
    }catch (PDOException $e) {
        echo "Failed to connect to MySQL: " . $e->getMessage();
        exit();
    }
    // set the PDO error mode to exception
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // use exec() because no results are returned
    try{
    $conexao->exec($insert);
    $sucesso = TRUE;
    } catch(PDOException $e) {
        echo  "<br>" . $e->getMessage();
        $sucesso = FALSE;
    }
    if($sucesso == TRUE){?>
        <h5 style="color:green">Dados adicionados com sucesso!</h5>
    <?php
    }
    $conexao = null;
?>