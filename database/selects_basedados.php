<?php

try{
    $conexao = new PDO("mysql:host=localhost;dbname=adc_http404", $cargo, $pass_users);
    }catch (PDOException $e) {
        echo "Failed to connect to MySQL: " . $e->getMessage();
        exit();
    }

    //Store table records into an array
    $items = array();
    $stmt = $conexao->query($consulta);
    $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $conexao = null;
    return $dados;
?>