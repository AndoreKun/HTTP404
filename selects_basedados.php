<?php
$cargo = $_SESSION['cargo'];
$pass_users = $_SESSION['pass'];
$consulta = $_SESSION['consulta'];

try{
    $conexao = new PDO("mysql:host=localhost;dbname=adc_http404", $cargo, $pass_users);
    }catch (PDOException $e) {
        echo "Failed to connect to MySQL: " . $e->getMessage();
        exit();
    }

    //Store table records into an array
    $items = array();
    $stmt = $conexao->query($consulta);
    $resultado_consulta = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['resultado_consulta'] = $resultado_consulta;

    $conexao = null;


if (isset($_POST['baixarexcel'])) {
$fileName = "dados".date('d-m-Y').".xls";

        //Set header information to export data in excel format
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename='.$fileName);

        //Set variable to false for heading
        $heading = false;

        //Add the MySQL table data to excel file
        if(!empty($resultado_consulta)) {
            foreach($resultado_consulta as $item) {
                if(!$heading) {
                    echo implode("\t", array_keys($item)) . "\n";
                    $heading = true;
                }
                echo implode("\t", array_values($item)) . "\n";
            }
        }
        exit();
    }
?>