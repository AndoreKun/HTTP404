<?php
//Inserir diretamente uma imagem em uma tabela mysql usando o formato binário
if($_SERVER['REQUEST_METHOD']=='POST'){

    $con = mysqli_connect('localhost', $cargo, $pass_users,'adc_http404') or die('Falha ao conectar à base de dados');
    $stmt = mysqli_prepare($con,$update_foto);

    mysqli_stmt_bind_param($stmt, "s",$foto_do_cliente);
    mysqli_stmt_execute($stmt);

    mysqli_close($con);
}
?>
