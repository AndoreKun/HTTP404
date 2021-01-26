<?php
/** 
 * Página responsável por fazer o insert de uma imagem na base de dados, usando o método mysqli
 * A variáveis não definidas nesta página mas utilizadas na mesma são definidas na página em que upload for incluida com: include("upload.php")
 * @author Grupo HTTP 404
 * @version 1.2
 * @since 3 jan 2021
 */
/** Caso uma imagem tiver sido adicionado, insere-a diretamente na base de dados usando o formato binário */
if($_SERVER['REQUEST_METHOD']=='POST'){
    /** $con: Conexão à base de dados com método mysqli */
    $con = mysqli_connect('localhost', $cargo, $pass_users,'adc_http404') or die('Falha ao conectar à base de dados');
    /** $stmt: Dados preparados para serem adicionados(transforma a imagem em binário) */
    $stmt = mysqli_prepare($con,$update_foto);
    /** $foto_do_cliente: Imagem adicionada pelo utilizador convertida em binário com o método file_get_contents() */
    mysqli_stmt_bind_param($stmt, "s",$foto_do_cliente);
    // Executa o insert
    mysqli_stmt_execute($stmt);
    // Fecha a conexão 
    mysqli_close($con);
}
?>
