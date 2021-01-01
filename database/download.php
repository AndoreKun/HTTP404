<?php
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

$consulta = $_GET['consulta'];


$dados = include 'selects_basedados.php';

$fileName = "dados".date('d-m-Y').".xls";

        //Set header information to export data in excel format
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename='.$fileName);

        //Set variable to false for heading
        $heading = false;

        //Add the MySQL table data to excel file
        if(!empty($dados)) {
            foreach($dados as $item) {
                if(!$heading) {
                    echo implode("\t", array_keys($item)) . "\n";
                    $heading = true;
                }
                echo implode("\t", array_values($item)) . "\n";
            }
        }
        exit();
?>

?>