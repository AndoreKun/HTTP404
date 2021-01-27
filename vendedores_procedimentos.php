<?php
/** 
 * Página que realiza os selects, inserts e updates(definidos em vendedores.php) na base de dados
 * Dados Enviados através de formulários na página vendedores.php utilizando o método POST
 * @author Grupo HTTP 404
 * @version 1.1
 * @since 24 jan 2021
 */
// Desabilita a demonstração de erros, para que não haja a possibilidade de aparecer erros para o usuário final
ini_set('display_errors', 0);
// Inicia a sessão
session_start();
ob_start();
include("envia_email.php");
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

// Define variáveis de session como "N", apenas se tornaram "S" caso aquela opção for submetida em vendedores.php
$_SESSION['registar_vendas'] = "N";
$_SESSION['clientes'] = "N";
$_SESSION['veiculos'] = "N";
$_SESSION['artigos'] = "N";


/** Caso o formulário estiver sido submetido, faz o insert desejado */
if(isset($_POST['submit'])){
    /** $insertpronto: Verdadeiro quando estiver definido qual é o insert a ser feito */
    $insertpronto = false;
    /** $clienteselecionado: Cliente Selecionado no formulário, obtido través do método POST */
    $clienteselecionado = $_POST['cliente'];
    // Remove os 9 primeiros carateres do cliente, logo que na seleção em HTML o nome do cliente buscado da base de dados é selecionado em conjunto de seu NIF(ID)
    // Para uma fácil localização do cliente
    $clienteselecionado = substr($clienteselecionado, 0, 9);
    $insertpronto = true;
    /** Caso não tenha sido selecionado um cliente, define $insertpronto como falso */
    if ($clienteselecionado == ""){
        $insertpronto = false;
    }
    /** $veiculoselecionado: Veiculo Selecionado no formulário, obtido através do método POST */
    $veiculoselecionado = $_POST['veiculo'];
    // retira o id do veiculo e guarda na mesma variável
    $veiculoselecionado = substr($veiculoselecionado, 0, 1);
    /** $artigoselecionado: Artigo Selecionado no formulário, obtido através do método POST */
    $artigoselecionado = $_POST['artigo'];
    $artigoselecionado = substr($artigoselecionado, 0, 1);
    /** Caso não tenha sido selecionado um veiculo e um artigo, define $insertpronto como falso */
    if($veiculoselecionado == "" and $artigoselecionado == ""){
        $insertpronto = false;
    }
    /** Caso o insert estiver pronto(Se um cliente e um veiculo e/ou um artigo estiverem selecionados), Cria o insert para a base de dados. 
     * caso não esteja pronto, imprime que faltam valores para inserir a venda
    */
    if ($insertpronto == true){
        if ($veiculoselecionado == "" and $artigoselecionado != ""){
            /** $consulta: Consulta para a base de dados, para calcular o valor da vendas a ser enviado a selects_basedados.php para realizar a consulta*/
            $consulta = "SELECT preco from artigos WHERE IDArtigo = '$artigoselecionado'";
            // inclui o script de conexão e consulta
            include('database/selects_basedados.php');
            // Define a variável com o resultado da consulta
            foreach($dados as $linha){
                $valordavenda = $linha['preco'];
            }
            /** $insert: Query do Insert a ser enviado para inserts_basedados.php para realizar o insert na base de dados */
            $insert = "INSERT INTO vendas(IDNIF_Cliente, IDArtigo, ValorVenda, IDFuncionario) VALUES ('$clienteselecionado', '$artigoselecionado', '$valordavenda', '$id_users')";
            // inclui o script de conexão e insert
            include('database/inserts_basedados.php');
            $_SESSION['registar_vendas'] = "S";
        }
        // Mesmo processo para artigos
        if ($artigoselecionado == "" and $veiculoselecionado != ""){
            $consulta = "SELECT preco from veiculos WHERE IDVeiculo = '$veiculoselecionado'";
            include('database/selects_basedados.php');
            foreach($dados as $linha){
                $valordavenda = $linha['preco'];
            }
            $insert = "INSERT INTO vendas(IDNIF_Cliente, IDVeiculo, ValorVenda, IDFuncionario) VALUES ('$clienteselecionado', '$veiculoselecionado', '$valordavenda', '$id_users')";
            include('database/inserts_basedados.php');
            $_SESSION['RegistarVendas'] = "S";
        // E para artigos e veículos
        }else{
            $consulta = "SELECT SUM(artigos.preco + veiculos.preco) AS preco from artigos, veiculos WHERE IDArtigo = '$artigoselecionado' AND IDVeiculo = '$veiculoselecionado'";
            include('database/selects_basedados.php');
            foreach($dados as $linha){
                $valordavenda = $linha['preco'];
            }
            $insert = "INSERT INTO vendas(IDNIF_Cliente, IDVeiculo, IDArtigo, ValorVenda, IDFuncionario) VALUES ('$clienteselecionado', '$veiculoselecionado', '$artigoselecionado', '$valordavenda', '$id_users')";
            include('database/inserts_basedados.php');
            $_SESSION['registar_vendas'] = "S";
        }
    }else{
        ?><h5 style="color:red">Valores em falta!</h5><?php
    }   
}

// Opcoes de clientes - adicionar/remover/atualizar

/** Atualiza um Cliente na base de dados */
if(isset($_POST['atualizarcliente'])){
    $nif_nome_cliente = $_POST['updt_cliente_nif'];
    // Remove o nome do cliente e guarda o nif
    $updt_nif_cliente = substr($nif_nome_cliente, 0, 9);
    // remove o nif e guarda o nome do cliente
    $updt_nome = substr($nif_nome_cliente, 12);
    $updt_email = $_POST['updt_email_cliente'];
    $updt_telemovel = $_POST['updt_telemovel_cliente'];
    $updt_pais = $_POST['updt_pais_cliente'];
    $updt_morada = $_POST['updt_morada_cliente'];
    $updt_codpostal = $_POST['updt_codpostal_cliente'];
    $updt_localidade = $_POST['updt_localidade_cliente'];
    // Sequência para testar quais campos estão nulos para criar o update na base de dados
    if($updt_email == ""){
        $email_insert = "";
    } else {
        $email_insert = ",Email='$updt_email'";
    }
    if($updt_email == ""){
        $email_insert = "";
    } else {
        $email_insert = ",Email='$updt_email'";
    }
    if($updt_telemovel == ""){
        $telemovel_insert = "";
    } else {
        $telemovel_insert = ",Telemovel='$updt_telemovel'";
    }
    if($updt_pais == ""){
        $pais_insert = "";
    } else { 
        $pais_insert = ",Pais='$updt_pais'";
    }
    if($updt_morada == ""){
        $morada_insert = "";
    } else { 
        $morada_insert = ",Morada='$updt_morada'";
    }
    if($updt_codpostal == ""){
        $codpostal_insert = "";
    } else {
        $codpostal_insert = ",Cod_Postal='$updt_codpostal'";
    }
    if($updt_localidade == ""){
        $localidade_insert = "";
    } else {
        $localidade_insert = ",Localidade='$updt_localidade'";
    }
    // Mesmo método de conexão e insert usado acima 
    $insert = "UPDATE clientes SET Nome='$updt_nome'$email_insert$telemovel_insert$email_insert$pais_insert$morada_insert$codpostal_insert$localidade_insert 
    WHERE IDNIF_Cliente=$updt_nif_cliente";
    /** $acao: Acão a ser realizada em inserts_basedeados.php("Insert", "Update" ou "Delete") */
    $acao = 'update';
    /** $imagem: A imagem que o utilizador fez o upload, que caso exista, serám convertida para binário e inserida na base de dados  */
    $imagem = $_FILES['image']['tmp_name'];
    if($imagem){
        // Tranforma a imagem em string binário para inserir na base de dados
        $foto_do_cliente = file_get_contents($imagem);
        $update_foto = "UPDATE clientes SET Foto=? WHERE IDNIF_Cliente=$updt_nif_cliente";
        $adicionar_foto = TRUE;
    } else {
        $adicionar_foto = FALSE;
    }
    // Inclui script de insert na base de dados
    include('database/inserts_basedados.php');
    $_SESSION['clientes'] = "S";
}

/** Remove um Cliente da base de dados */
if(isset($_POST['removercliente'])){
    /** $rm_nif_cliente: NIF do cliente a ser removido */
    $rm_nif_cliente = $_POST['rm_cliente_nif'];
    // remove o nome do cliente e guarda seu nif
    $rm_nif_cliente = substr($rm_nif_cliente, 0, 9);
    $acao = 'delete';
    $insert = "DELETE FROM clientes WHERE IDNIF_Cliente='$rm_nif_cliente'";
    $adicionar_foto = FALSE;
    include('database/inserts_basedados.php');
    $_SESSION['clientes'] = "S";
} 

/** Adicionar um novo Cliente na base de dados*/
if(isset($_POST['criarcliente'])){
    $nif_cliente = $_POST['nif_cliente'];
    $nome = $_POST['nome_cliente'];
    $email = $_POST['email_cliente'];
    $telemovel = $_POST['telemovel_cliente'];
    $pais = $_POST['pais_cliente'];
    $morada = $_POST['morada_cliente'];
    $codpostal = $_POST['codpostal_cliente'];
    $localidade = $_POST['localidade_cliente'];
    $consulta = 'SELECT IDNIF_Cliente FROM clientes';
    // Inclui script de select
    include("database/selects_basedados.php");
    /** $clientenovo: Verdadeiro se o cliente não existe na base de dado, e falso se existe */
    $clientenovo = FALSE;
    /** foreach($dados as $linha): Ciclo testa se o cliente já existe na base de dados ou não */
    foreach($dados as $linha){
        if($nif_cliente == $linha['IDNIF_Cliente']){
            ?><h5 style="color: red">Este cliente já existe na base de dados!</h5> <?php
            $clientenovo = FALSE;
        }else{
            $clientenovo = TRUE;
        }    
    }
    /** if($clientenovo == TRUE): Se o Cliente for Novo, prepara o query do insert na base de dados */
    if($clientenovo == TRUE){
        $insert = "INSERT INTO clientes(IDNIF_Cliente, Nome, Email, Telemovel, Pais, Morada, Cod_Postal, Localidade) 
        VALUES ('$nif_cliente', '$nome', '$email', '$telemovel', '$pais', '$morada', '$codpostal', '$localidade')";
        $acao = 'insert';
        $imagem = $_FILES['image']['tmp_name'];
        if($imagem){
            $foto_do_cliente = file_get_contents($imagem);
            $update_foto = "UPDATE clientes SET Foto=? WHERE IDNIF_Cliente=$nif_cliente";
            $adicionar_foto = TRUE;
        } else {
            $adicionar_foto = FALSE;
        }
        // inclui script de insert na base de dados
        include('database/inserts_basedados.php');
        }
        $_SESSION['clientes'] = "S"; 
    }

// Opcoes de veiculos adicionar/remover/atualizar

/** Atualiza um Veiculo, utiliza o mesmo método de atualizar clientes */
if(isset($_POST['atualizarveiculo'])){
    $marca_modelo_veiculo = $_POST['id_veiculo'];
    $id_veiculo = substr($marca_modelo_veiculo, 0, 1);
    $updt_preco = $_POST['preco_veiculo'];
    $updt_estado = $_POST['estado_veiculo'];
    $updt_stock = $_POST['stock_veiculo'];
    $updt_quantidade_stock = $_POST['quantidade_veiculo'];
    $updt_pronto_stock = $_POST['pronto_stock_veiculo'];
    if($updt_preco == ""){
        $preco_insert = "";
    } else {
        $preco_insert = ",preco='$updt_preco'";
    }
    if($updt_estado == ""){
        $estado_insert = "";
    } else {
        $estado_insert = ",estadoveiculo='$updt_estado'";
    }
    if($updt_stock == ""){
        $stock_insert = "";
    } else {
        $stock_insert = ",em_stock='$updt_stock'";
    }
    if($updt_quantidade_stock == ""){
        $quantidade_insert = "";
    } else { 
        $quantidade_insert = ",quantidade_stock='$updt_quantidade_stock'";
    }
    if($updt_pronto_stock == ""){
        $pronto_insert = "";
    } else { 
        $pronto = ",pronto_adicionar_stand='$updt_pronto_stock'";
    $insert = "UPDATE veiculos SET $updt_preco$updt_estado$updt_stock$updt_quantidade_stock$updt_pronto_stock
    WHERE IDVeiculo=$id_veiculo";
    $acao = 'update';
    $adicionar_foto == FALSE;
    include('database/inserts_basedados.php');
    }
    $_SESSION['veiculos'] = "S"; 
}
/** Remove um Veiculo, utiliza o mesmo método de remover clientes */
if(isset($_POST['removerveiculo'])){
    $rm_veiculo = $_POST['rm_veiculo'];
    $rm_id_veiculo = substr($rm_veiculo, 0, 1);
    $acao = 'delete';
    $insert = "DELETE FROM veiculos WHERE IDVeiculo='$rm_id_veiculo'";
    $adicionar_foto = FALSE;
    include('database/inserts_basedados.php');
    $_SESSION['veiculos'] = "S"; 
} 

/** Adicionar um novo Veiculo, utiliza o mesmo método de adicionar clientes */
if(isset($_POST['criarveiculo'])){
    $modelo_veiculo = $_POST['modelo_veiculo'];
    $marca_veiculo = $_POST['marca_veiculo'];
    $tipo_veiculo = $_POST['tipo_veiculo'];
    $velocidade_veiculo = $_POST['velocidade_veiculo'];
    $peso_veiculo = $_POST['peso_veiculo'];
    $consumo_veiculo = $_POST['consumo_veiculo'];
    $cambio_veiculo = $_POST['cambio_veiculo'];
    $combustivel_veiculo = $_POST['combustivel_veiculo'];
    $preco_veiculo = $_POST['preco_veiculo'];
    $estado_veiculo = $_POST['estado_veiculo'];
    $stock_veiculo = $_POST['stock_veiculo'];
    $quantidade_stock = $_POST['quantidade_stock'];
    $pronto_stock_veiculo = $_POST['pronto_stock_veiculo'];
    $insert = "INSERT INTO veiculos(modelo, marca, preco, tipoveiculo, estadoveiculo, velocidademaxima, peso, consumomedio, cambio, combustivel, em_stock, quantidade_stock, pronto_adicionar_stand) 
    VALUES ('$modelo_veiculo', '$marca_veiculo', '$preco_veiculo', '$tipo_veiculo', '$estado_veiculo', '$velocidade_veiculo', '$peso_veiculo', '$consumo_veiculo', '$cambio_veiculo','$combustivel_veiculo','$stock_veiculo','$quantidade_stock','$pronto_stock_veiculo')";
    $acao = 'insert';
    $adicionar_foto = FALSE;
    include('database/inserts_basedados.php');
    $_SESSION['veiculos'] = "S";
    /** $caro: Redefine o cargo para admin */
    $cargo = "admin";
    /** $pass_users: Redefine a password para a do cargo admin */
    $pass_users = "http404#2021%";
    /** $consulta: Query da consulta, seleciona todos os emails de todos os interessados da loja */
    $consulta = "SELECT Email FROM interessados";
    /** include('database/selects_basedados.php'): Faz a consulta à base de dados */
    include('database/selects_basedados.php');
    /** if($dados): Caso a consulta retorne dados, envia um email para todos os emails para indicar que existe um novo produto na loja */
    if($dados){
        foreach($dados as $linha){
            EnviarMail($linha['Email'], "Novo Produto Disponivel!", "email_produto", 0, 0, 0);
        }
    }
}

// Opcoes de artigos: adicionar/remover/atualizar 

/** Atualiza um Artigo, utiliza o mesmo método de atualizar veiculos */
if(isset($_POST['atualizarartigo'])){
    $id_artigo = $_POST['id_artigo'];
    $id_artigo = substr($id_artigo, 0, 1);
    $updt_nome_artigo = $_POST['updt_nome_artigo'];
    $updt_desc_artigo = $_POST['updt_descricao_veiculo'];
    $updt_preco_artigo = $_POST['updt_preco_artigo'];
    $updt_stock_artigo = $_POST['updt_stock_artigo'];
    $updt_quantidade_stock_artigo = $_POST['updt_quantidade_veiculo'];

    if($updt_nome_artigo == ""){
        $nome_insert_artigo = "";
    } else {
        $nome_insert_artigo = "nome='$updt_nome_artigo'";
    }
    if($updt_preco_artigo == ""){
        $preco_insert_artigo = "";
    } else {
        $preco_insert_artigo = ",preco='$updt_preco_artigo'";
    }
    if($updt_desc_artigo == ""){
        $desc_insert_artigo = "";
    } else {
        $desc_insert_artigo = ",descricao='$updt_desc_artigo'";
    }
    if($updt_stock == ""){
        $stock_insert = "";
    } else {
        $stock_insert = ",em_stock='$updt_stock'";
    }
    if($updt_quantidade_stock_artigo == ""){
        $quantidade_insert_artigo = "";
    } else { 
        $quantidade_insert_artigo = ",quantidade_stock='$updt_quantidade_stock_artigo'";
    }
    $insert = "UPDATE artigos SET $updt_nome_artigo$updt_preco_artigo$updt_desc_artigo$updt_stock_artigo$updt_quantidade_stock_artigo
    WHERE IDArtigo=$id_artigo";
    $acao = 'update';
    $adicionar_foto == FALSE;
    include('database/inserts_basedados.php');
    $_SESSION['artigos'] = "S"; 
}
/** Remove um Artigo, utiliza o mesmo método de remover veiculos */
if(isset($_POST['removerartigo'])){
    $rm_artigo = $_POST['rm_artigo'];
    $rm_id_artigo = substr($rm_artigo, 0, 1);
    $acao = 'delete';
    $insert = "DELETE FROM veiculos WHERE IDVeiculo='$rm_id_veiculo'";
    $adicionar_foto = FALSE;
    include('database/inserts_basedados.php');
    $_SESSION['artigos'] = "S"; 
} 

/** Adicionar um novo Artigo, utiliza o mesmo método de adicionar veiculos */
if(isset($_POST['criarartigo'])){
    $nome_artigo = $_POST['nome_artigo'];
    $desc_artigo = $_POST['desc_artigo'];
    $preco_artigo = $_POST['preco_artigo'];
    $stock_artigo = $_POST['stock_artigo'];
    $tipo_artigo = $_POST['tipo_artigo'];
    $quantidade_stock_artigo = $_POST['quantidade_stock_artigo'];
    $insert = "INSERT INTO artigos(nome, descricao, tipo_artigo, preco, em_stock, quantidade_stock) 
    VALUES ('$nome_artigo', '$desc_artigo', '$tipo_artigo', '$preco_artigo', '$stock_artigo', '$quantidade_stock_artigo')";
    $acao = 'insert';
    $adicionar_foto = FALSE;
    include('database/inserts_basedados.php');
    $_SESSION['artigos'] = "S";
    /** $caro: Redefine o cargo para admin */
    $cargo = "admin";
    /** $pass_users: Redefine a password para a do cargo admin */
    $pass_users = "http404#2021%";
    /** $consulta: Query da consulta, seleciona todos os emails de todos os interessados da loja */
    $consulta = "SELECT Email FROM interessados";
    /** include('database/selects_basedados.php'): Faz a consulta à base de dados */
    include('database/selects_basedados.php');
    /** if($dados): Caso a consulta retorne dados, envia um email para todos os emails para indicar que existe um novo produto na loja */
    if($dados){
        foreach($dados as $linha){
            EnviarMail($linha['Email'], "Novo Produto Disponivel!", "email_produto", 0, 0, 0);
        }
    }  
}
echo "<script type='text/javascript'>
            location.href='vendedores.php'
            </script>";
?>