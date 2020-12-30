   
<?php
// apenas para testes:
$cargo = 'admin';
$pass_users = 'http404#2021%';
$consulta =  'SELECT * FROM vendas';

// function downloadfile($cargo, $pass_users, $consulta){
    try{
    $conexao = new PDO("mysql:host=localhost;dbname=adc_http404", $cargo, $pass_users);
    }catch (PDOException $e) {
        echo "Failed to connect to MySQL: " . $e->getMessage();
        exit();
    }
    //Query our MySQL table
    $stmt = $conexao->query($consulta);

    //Retrieve the data from our table.
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    //The name of the Excel file that we want to force the
    //browser to download.
    // Filename with current date
    $current_date = date("y/m/d");
    $filename = "teste" . $current_date . ".xls";
    
    //Send the correct headers to the browser so that it knows
    //it is downloading an Excel file.
    header("Content-Type: application/xls");    
    header("Content-Disposition: attachment; filename=$filename");  
    header("Pragma: no-cache"); 
    header("Expires: 0");
    
    //Define the separator line
    $separator = "\t";

    $fp = fopen('php://output', 'w');
    
    //If our query returned rows
    if(!empty($rows)){
        
        //Dynamically print out the column names as the first row in the document.
        //This means that each Excel column will have a header.
        echo implode($separator, array_keys($rows[0])) . "\n";
        
        //Loop through the rows
        foreach($rows as $row){     
            //Implode and print the columns out using the 
            //$separator as the glue parameter
            fputcsv($fp, array_values($row));
            echo implode($separator, $row) . "\n";
        }
    }
    $conexao = null;
?>
