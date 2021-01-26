<?php
/** 
 * Página responsável por fazer o download em formato excel desta página, que irá conter uma tabela da base de dados. Permite também adicionar um valor extra
 * @author Grupo HTTP 404
 * @version 1.3
 * @since 6 jan 2021
 */
//starta a sessão
session_start();
ob_start();
//resgata os valores das session em variaveis
$id_users = isset($_SESSION['id_users']) ? $_SESSION['id_users']: "";	
$nome_user = isset($_SESSION['nome']) ? $_SESSION['nome']: "";
$email_users = isset($_SESSION['email']) ? $_SESSION['email']: "";	
$pass_users = isset($_SESSION['pass']) ? $_SESSION['pass']: "";
$logado = isset($_SESSION['logado']) ? $_SESSION['logado']: "N";
$cargo = isset($_SESSION['cargo']) ? $_SESSION['cargo']: "";	
//verificamos se a var logado contem o valor (S) OU (N), se conter N quer dizer que a pessoa não fez o login corretamente
//que no caso satisfará nossa condição no if e a pessoa sera redirecionada para a tela de login novamente
if ($logado == "N" || $id_users == ""){	    
    echo  "<script type='text/javascript'>
                location.href='login.php'
            </script>";	
    exit();
}
/** Consulta Enviada através do método GET */
$consulta = $_GET['consulta'];

/** Adicionar um valor extra ao excel, recebido através do método GET, poder ser "S" ou "N" */
$adicionarvalor = $_GET['adicionarvalor'];

/** Caso $adicionarvalor seja igual a 'S', recebe do método get o valor extra e o seu nome. Senão define ambos como variáveis vazias("")*/
if ($adicionarvalor == 'S'){
    /** $valorextra: O valor a ser adicionado */
    $valorextra = $_GET['valorextra'];
    /** $nomevalorextra: O nome do valor a ser adicionado */
    $nomevalorextra = $_GET['nomevalorextra'];
}else{
    $valorextra = "";
    $nomevalorextra = "";
}


$dados = include 'selects_basedados.php';

/** Nome do Ficheiro */
$fileName = "dados".date('d-m-Y').".xls";

// Define a informação do cabeçalho para exportar como dados para o excel
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename='.$fileName);

//  Define para falso a variável do cabeçalho
$heading = false;

/** se tiver recebido algum dado da base de dados, imprime-os na página para adicioná-los ao ficheiro excel */
if(!empty($dados)) {
    foreach($dados as $item) {
        if(!$heading) {
            echo implode("\t", array_keys($item)) . "\n";
            $heading = true;
        }
        echo implode("\t", array_values($item)) . "\n";
        
    }
    
}

echo $nomevalorextra . "\n";
echo $valorextra;

exit();
?>
