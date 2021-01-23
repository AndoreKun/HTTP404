<?php
/** Página dos funcionários reservada apenas para a vendedores, outros funcionários são imediatamente redirecionados.
 * @author Grupo HTTP 404
 * @version 1.3
 * @since 26 dez 2020
 **/
/** Inicia a sessão. **/
session_start();
ob_start();
/** Desabilita a demonstração de erros, para que não haja a possibilidade de aparecer erros para o usuário final. **/
ini_set('display_errors', 0);
/** Resgata os valores das session em variaveis. **/
$id_users = isset($_SESSION['id_users']) ? $_SESSION['id_users']: "";	
$nome_user = isset($_SESSION['nome']) ? $_SESSION['nome']: "";
$email_users = isset($_SESSION['email']) ? $_SESSION['email']: "";	
$pass_users = isset($_SESSION['pass']) ? $_SESSION['pass']: "";
$logado = isset($_SESSION['logado']) ? $_SESSION['logado']: "N";
$cargo = isset($_SESSION['cargo']) ? $_SESSION['cargo']: "";

/** $logado: Verificamos se a var logado contem o valor (S) OU (N), se conter N quer dizer que a pessoa não fez o login corretamente
*que no caso satisfará nossa condição no if e a pessoa sera redirecionada para a tela de login novamente. **/
if ($logado == "N" || $id_users == ""){	    
    echo  "<script type='text/javascript'>
                location.href='login.php'
            </script>";	
    exit();
}
/** setlocale: Define o Local e lingua, para as funções strftime e strtotime funcionarem bem na página. **/
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
?>
<!DOCTYPE HTML>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>HTTP 404</title>
    <meta name="description" content="HTTP 404 - O melhor site de vendas de veículos">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon - ícones de visualização.-->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
    <!-- Todos os css -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/chosen.min.css">
    <link rel="stylesheet" href="assets/css/meanmenu.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/icofont.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/bundle.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="assets/js/mostraselecao.js"></script>
</head>
<body>
    <div class="wrapper">
    <!-- Cabeçalho da Pagina -->
    <div class="col-lg-4 col-md-4 col-4">
        <div class="logo-small-device">
            <a href="index.html"><img alt="" src="assets/img/logo/logo.png"></a>
        </div>
        </div>
        <div class="breadcrumb-area pt-255 pb-170" style="background-image: url(assets/img/banner/banner-4.jpg)">
            <div class="container-fluid">
                <div class="breadcrumb-content text-center">
                    <h2>acesso de <?php echo $cargo;?></h2>
                    <ul>
                        <li>
                            <a href="index.html">home</a>
                        </li>
                        <li>acesso reservado</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </br>
    <div style="text-align:center;">
        <h1>Olá, <?php echo $nome_user;?>!</h1>
        <button style="cursor: pointer" id="sair" value="Sair" class="btn-style cr-btn" onclick="location.href ='logout.php';">Sair</button>
    </div>
    <!-- Área de vendas, permite inserir uma nova venda na base de dados!-->
    <form action="" method="post">
        <label for="actions"><h2>Registar venda de Veículos/Artigos</h2></label><br/> 
        <div id="registarvenda" name="registarvenda" style="width:300px; margin:4px;">
                <h5>Cliente: </h5>
                <!-- Conexão à base de dados para mostrar os clientes em uma lista !-->
                <select name="cliente">
                    <option selected name= "" value="">Selecione uma opção...</option>
                    <?php $consulta = "SELECT CONCAT(IDNIF_Cliente, ' - ', Nome) AS clientes FROM clientes";
                    include('database/selects_basedados.php');
                    foreach($dados as $linha){ ?>
                    <option value="<?php echo $linha['clientes'];?>"><?php echo $linha['clientes'];?></option>
                    <?php } ?>
                </select>
                <h5>Veículo:</h5>
                <!-- Conexão à base de dados para mostrar os veiculos em uma lista !-->
                <select name="veiculo" style="width:300px; margin:4px;">
                    <option selected name= "" value="">Selecione uma opção...</option>
                    <?php $consulta = "SELECT CONCAT(IDVeiculo, ' - ', marca, ' ', modelo) AS veiculos FROM veiculos WHERE Em_stock='Sim'";
                    include('database/selects_basedados.php');
                    foreach($dados as $linha){ ?>
                    <option value="<?php echo $linha['veiculos'];?>"><?php echo $linha['veiculos'];?></option>
                    <?php } ?>
                </select>
                <h5>Artigo:</h5>
                <!-- Conexão à base de dados para mostrar os artigos em uma lista!-->
                <select name="artigo" style="width:300px; margin:4px;">
                    <option selected name= "" value="">Selecione uma opção...</option>
                    <?php $consulta = "SELECT CONCAT(IDArtigo, ' - ', Nome) AS artigos FROM artigos WHERE Em_stock='Sim'";
                    include('database/selects_basedados.php');
                    foreach($dados as $linha){ ?>
                    <option value="<?php echo $linha['artigos'];?>"><?php echo $linha['artigos'];?></option>
                    <?php } ?>
                </select>
            <input style="cursor: pointer; width:300px; margin:4px;" name="submit" type="submit" value="submit" class="btn-style cr-btn"></input>
    </form>
    </div>
    <?php 
    /** isset($_POST['submit']: Caso o formulário estiver sido submetido, e faz o insert desejado. **/
    if(isset($_POST['submit'])){
        $insertpronto = false;
        $clienteselecionado = $_POST['cliente'];
        $clienteselecionado = substr($clienteselecionado, 0, 9);
        $insertpronto = true;
        if ($clienteselecionado == ""){
            $insertpronto = false;
        }
        $veiculoselecionado = $_POST['veiculo'];
        $veiculoselecionado = substr($veiculoselecionado, 0, 1);
        $artigoselecionado = $_POST['artigo'];
        $artigoselecionado = substr($artigoselecionado, 0, 1);

        if($veiculoselecionado == "" and $artigoselecionado == ""){
            $insertpronto = false;
        }
        /** $insertpronto == true: Caso o insert estiver pronto(Se um cliente e um veiculo e/ou um artigo estiverem selecionados). **/
        if ($insertpronto == true){
            if ($veiculoselecionado == "" and $artigoselecionado != ""){
                $consulta = "SELECT preco from artigos WHERE IDArtigo = '$artigoselecionado'";
                include('database/selects_basedados.php');
                foreach($dados as $linha){
                    $valordavenda = $linha['preco'];
                }
                $insert = "INSERT INTO vendas(IDNIF_Cliente, IDArtigo, ValorVenda, IDFuncionario) VALUES ('$clienteselecionado', '$artigoselecionado', '$valordavenda', '$id_users')";

                include('database/inserts_basedados.php');
            }
            if ($artigoselecionado == "" and $veiculoselecionado != ""){
                $consulta = "SELECT preco from veiculos WHERE IDVeiculo = '$veiculoselecionado'";
                include('database/selects_basedados.php');
                foreach($dados as $linha){
                    $valordavenda = $linha['preco'];
                }
                $insert = "INSERT INTO vendas(IDNIF_Cliente, IDVeiculo, ValorVenda, IDFuncionario) VALUES ('$clienteselecionado', '$veiculoselecionado', '$valordavenda', '$id_users')";
                include('database/inserts_basedados.php');
            }else{
                $consulta = "SELECT SUM(artigos.preco + veiculos.preco) AS preco from artigos, veiculos WHERE IDArtigo = '$artigoselecionado' AND IDVeiculo = '$veiculoselecionado'";
                include('database/selects_basedados.php');
                foreach($dados as $linha){
                    $valordavenda = $linha['preco'];
                }
                $insert = "INSERT INTO vendas(IDNIF_Cliente, IDVeiculo, IDArtigo, ValorVenda, IDFuncionario) VALUES ('$clienteselecionado', '$veiculoselecionado', '$artigoselecionado', '$valordavenda', '$id_users')";
                include('database/inserts_basedados.php');
            }
        }else{
            ?><h5 style="color:red">Valores em falta!</h5><?php
        }
    }
    
/** Opções de clientes - adicionar/remover/atualizar **/
?>
<label for="actions"><h2>Opções de Clientes</h2></label><br/>
<select name="clientes" id="clientes" style="width:300px; margin:4px;" onchange="admSelectCheck(this, true);">
    <option selected id="" name="" value="">Selecione uma opcao...</option>
    <option id="opcao" value="nvcliente">Adicionar novo cliente</option>
    <option id="opcao2" value="rmcliente">Remover cliente</option>
    <option id="opcao3" value="atcliente">Atualizar dados de um cliente</option>
</select>
<div id="elemento" name="elemento" style="display: none">
    <form id="nvcliente" name="nvcliente" action="" method="post" enctype="multipart/form-data"><form>
        <div style="width:300px; margin:4px; float:left;">
            <h5>NIF do Cliente: <span style="color: red" >*</span></h5>
            <input name="nif_cliente" value="" minlength="9" maxlength="9" required/>
        </div>
        <div style="width:300px; margin:4px; float:left;">
            <h5>Nome do Cliente: <span style="color: red" >*</span><h5>
            <input name="nome_cliente" value="" minlength="3" required/>
        </div>
        <div style="width:300px; margin:4px; float:left;">
            <h5>Email do Cliente: <span style="color: red" >*</span><h5>
            <input name="email_cliente" value="" minlength="7" required/>
        </div>
        <div style="width:300px; margin:4px; float:left;">
            <h5>Telemóvel do Cliente: <span style="color: red" >*</span><h5>
            <input name="telemovel_cliente" value="" minlength="9" maxlength="13" required/>
        </div>
        <div style="width:300px; margin:4px; float:left;">
            <h5>Morada do cliente: <span style="color: red">*</span><h5>
            <input name="morada_cliente" value="" minlength="5" required/>
        </div>
        <div style="width:300px; margin:4px; float:left;">
            <h5>País de Residência: <span style="color: red" >*</span><h5>
            <input name="pais_cliente" value="" minlength="3" required/>
        </div>
        <div style="width:300px; margin:4px; float:left;">
            <h5>Código Postal: <span style="color: red" >*</span><h5>
            <input name="codpostal_cliente" value="" minlength="5" maxlength="8" required/>
        </div> 
        <div style="width:300px; margin:4px; float:left;">
            <h5>Localidade/Cidade do cliente: <span style="color: red" >*</span><h5>
            <input name="localidade_cliente" value="" minlength="3" required/>
        </div>
        <div style="width:300px;">
            <h5>Foto do cliente:<h5>
                <input type="file" name="image" onclick="" style="background-color: white; border:hidden; margin:-3%;"/>
            <br/><br/>
        </div>   
        <input style="cursor: pointer; width:300px; margin:4px;" name="criarcliente" type="submit" value="submit" class="btn-style cr-btn"/>
    </form>
</div>
<div id="elemento2" name="elemento2" style="display: none">
    <form id="removercliente" name="removercliente" action="" method="post">
        <div style="width:300px; margin:4px;">
            <h5>NIF do Cliente: <span style="color: red" >*</span></h5>
            <select name="rm_cliente_nif" required>
                <option selected name= "" value="">Selecione uma opção...</option>
                <?php $consulta = "SELECT CONCAT(IDNIF_Cliente, ' - ', Nome) AS clientes FROM clientes";
                include('database/selects_basedados.php');
                foreach($dados as $linha){ ?>
                <option name="rm_cliente_nif" value="<?php echo $linha['clientes'];?>"><?php echo $linha['clientes'];?></option>
                <?php } ?>
            </select>
        </div>
        <input style="cursor: pointer; width:300px; margin:4px;" name="removercliente" type="submit" value="submit" class="btn-style cr-btn"/>
    </form>
</div>
<div id="elemento3" name="elemento3" style="display: none">
    <form id="update_cliente" name="update_cliente" action="" method="post" enctype="multipart/form-data"><form>
        <div style="width:300px; margin:4px; float:left;">
            <h5>NIF do Cliente: <span style="color: red" >*</span></h5>
            <select name="updt_cliente_nif" required>
                <option selected name= "" value="">Selecione uma opção...</option>
                <?php $consulta = "SELECT CONCAT(IDNIF_Cliente, ' - ', Nome) AS clientes FROM clientes";
                include('database/selects_basedados.php');
                foreach($dados as $linha){ ?>
                <option name="updt_cliente_nif" value="<?php echo $linha['clientes'];?>"><?php echo $linha['clientes'];?></option>
                <?php } ?>
            </select>
        </div>
        <div style="width:300px; margin:4px; float:left;">
            <h5>Email do Cliente: <h5>
            <input name="updt_email_cliente" value="" minlength="7"/>
        </div>
        <div style="width:300px; margin:4px; float:left;">
            <h5>Telemóvel do Cliente: <h5>
            <input name="updt_telemovel_cliente" value="" minlength="9" maxlength="13"/>
        </div>
        <div style="width:300px; margin:4px; float:left;">
            <h5>Morada do cliente: <span style="color: red">*</span><h5>
            <input name="updt_morada_cliente" value="" minlength="5"/>
        </div>
        <div style="width:300px; margin:4px; float:left;">
            <h5>País de Residência: <h5>
            <input name="updt_pais_cliente" value="" minlength="3"/>
        </div>
        <div style="width:300px; margin:4px; float:left;">
            <h5>Código Postal: <h5>
            <input name="updt_codpostal_cliente" value="" minlength="5" maxlength="8"/>
        </div> 
        <div style="width:300px; margin:4px; float:left;">
            <h5>Localidade/Cidade do cliente: <h5>
            <input name="updt_localidade_cliente" value="" minlength="3"/>
        </div>
        <div style="width:300px;">
            <h5>Foto do cliente:<h5>
                <input type="file" name="image" onclick="" style="background-color: white; border:hidden; margin:-3%;"/>
        </div>
        <input style="cursor: pointer; width:300px; margin:4px;" name="atualizarcliente" type="submit" value="submit" class="btn-style cr-btn"/>
    </form>
</div>
<?php 

/** isset($_POST['atualizarcliente']: Atualizar um Cliente **/

if(isset($_POST['atualizarcliente'])){
    $nif_nome_cliente = $_POST['updt_cliente_nif'];
    $updt_nif_cliente = substr($nif_nome_cliente, 0, 9);
    $updt_nome = substr($nif_nome_cliente, 12);
    $updt_email = $_POST['updt_email_cliente'];
    $updt_telemovel = $_POST['updt_telemovel_cliente'];
    $updt_pais = $_POST['updt_pais_cliente'];
    $updt_morada = $_POST['updt_morada_cliente'];
    $updt_codpostal = $_POST['updt_codpostal_cliente'];
    $updt_localidade = $_POST['updt_localidade_cliente'];
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
    $insert = "UPDATE clientes SET Nome='$updt_nome'$email_insert$telemovel_insert$email_insert$pais_insert$morada_insert$codpostal_insert$localidade_insert 
    WHERE IDNIF_Cliente=$updt_nif_cliente";
    $acao = 'update';
    $imagem = $_FILES['image']['tmp_name'];
    if($imagem){
        $foto_do_cliente = file_get_contents($imagem);
        $update_foto = "UPDATE clientes SET Foto=? WHERE IDNIF_Cliente=$updt_nif_cliente";
        $adicionar_foto = TRUE;
    } else {
        $adicionar_foto = FALSE;
    }
    include('database/inserts_basedados.php');
    }

/** isset($_POST['removercliente']: Remover um Cliente **/

if(isset($_POST['removercliente'])){
    $rm_nif_cliente = $_POST['rm_cliente_nif'];
    $rm_nif_cliente = substr($rm_nif_cliente, 0, 9);
    $acao = 'delete';
    $insert = "DELETE FROM clientes WHERE IDNIF_Cliente='$rm_nif_cliente'";
    $adicionar_foto = FALSE;
    include('database/inserts_basedados.php');
    } 

/** isset($_POST['criarcliente']: Adicionar um novo Cliente **/

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
    include("database/selects_basedados.php");
    $clientenovo = FALSE;
    foreach($dados as $linha){
        if($nif_cliente == $linha['IDNIF_Cliente']){
            ?><h5 style="color: red">Este cliente já existe na base de dados!</h5> <?php
            $clientenovo = FALSE;
        }else{
            $clientenovo = TRUE;
        }
    }
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
        include('database/inserts_basedados.php');
        }
    }
/** Opções de veículos e artigos: adicionar/remover/atualizar **/
?>
<br/><br/>
<label for="actions"><h2>Opções de Veículos</h2></label><br/>
<select name="veiculos" id="veiculos" style="width:300px; margin:4px;" onchange="admSelectCheck2(this, true);">
    <option selected id="" name="" value="">Selecione uma opcao...</option>
    <option id="opcao4" value="veiculos">Adicionar novo veículo</option>
    <option id="opcao5" value="rm_veiculo">Remover veículo</option>
    <option id="opcao6" value="at_veiculo">Atualizar dados de um veículo</option>
</select>
<div id="elemento4" name="elemento_veiculos" style="display: none">
    <form id="nvcliente" name="nvcliente" action="" method="post">
        <div style="width:300px; margin:4px; float:left;">
            <h5>Modelo do Veículo: <span style="color: red" >*</span></h5>
            <input name="modelo_veiculo" value="" minlength="1" required/>
        </div>
        <div style="width:300px; margin:4px; float:left;">
            <h5>Marca do Veículo: <span style="color: red" >*</span><h5>
            <input name="marca_veiculo" value="" minlength="1" required/>
        </div>
        <div style="width:300px; margin:4px; float:left;">
            <h5>Preço do Veículo: <span style="color: red" >*</span><h5>
            <input name="preco_veiculo" value="" minlength="1" required/>
        </div>
        <div style="width:300px; margin:4px; float:left;">
            <h5>Tipo do Veículo (Carro/Moto): <span style="color: red" >*</span><h5>
            <input name="tipo_veiculo" value="" minlength="1"  required/>
        </div>
        <div style="width:300px; margin:4px; float:left;">
            <h5>Estado do Veículo: <span style="color: red">*</span><h5>
            <input name="estado_veiculo" value="" minlength="1" required/>
        </div>
        <div style="width:300px; margin:4px; float:left;">
            <h5>Velocidade Máxima: <span style="color: red" >*</span><h5>
            <input name="velocidade_veiculo" value="" minlength="1" required/>
        </div>
        <div style="width:300px; margin:4px; float:left;">
            <h5>Peso do Veículo: <span style="color: red" >*</span><h5>
            <input name="peso_veiculo" value="" minlength="1" required/>
        </div> 
        <div style="width:300px; margin:4px; float:left;">
            <h5>Consumo médio do veículo: <span style="color: red" >*</span><h5>
            <input name="consumo_veiculo" value="" minlength="3" required/>
        </div>
        <div style="width:300px; margin:4px; float:left;">
            <h5>Tipo de Câmbio do Veículo: <span style="color: red" >*</span><h5>
            <input name="cambio_veiculo" value="" minlength="3" required/>
        </div>
        <div style="width:300px; margin:4px; float:left;">
            <h5>Tipo de Combustível do Veículo: <span style="color: red" >*</span><h5>
            <input name="combustivel_veiculo" value="" minlength="3" required/>
        </div>
        <div style="width:300px; margin:4px; float:left;">
            <h5>Em Stock: <span style="color: red" >*</span><h5>
            <select name="stock_veiculo" required>
                <option value="Sim" selected>Sim</option>
                <option value="Nao">Não</option>
            </select>
        </div>
        <div style="width:300px; margin:4px; float:left;">
            <h5>Quantidade em Stock: <span style="color: red" >*</span><h5>
            <input name="quantidade_stock" value="" minlength="1" required/>
        </div>
        <div style="width:300px; margin:4px; float:left;" >
            <h5>Pronto Para Adicionar ao Stock: <span style="color: red" >*</span><h5>
            <select name="pronto_stock_veiculo" required>
                <option value="Sim" selected>Sim</option>
                <option value="Nao">Não</option>
            </select>
        </div>
        <input style="cursor: pointer; width:300px; margin:4px;" name="criarveiculo" type="submit" value="submit" class="btn-style cr-btn"/>
    </form>
</div>
<div id="elemento5" name="remover_veiculo" style="display: none">
    <form id="removerveiculo" name="removercliente" action="" method="post">
        <div style="width:300px; margin:4px;">
            <h5>ID do Veículo: <span style="color: red" >*</span></h5>
            <select name="rm_veiculo" required>
                <option selected name= "" value="">Selecione uma opção...</option>
                <?php $consulta = "SELECT CONCAT(IDVeiculo, ' - ', marca, ' ', modelo) AS veiculo FROM veiculos";
                include('database/selects_basedados.php');
                foreach($dados as $linha){ ?>
                <option name="rm_veiculo" value="<?php echo $linha['veiculo'];?>"><?php echo $linha['veiculo'];?></option>
                <?php } ?>
            </select>
        </div>
        <input style="cursor: pointer; width:300px; margin:4px;" name="removerveiculo" type="submit" value="submit" class="btn-style cr-btn"/>
    </form>
</div>
<div id="elemento6" name="atualizar_veiculo" style="display: none">
    <form id="update_cliente" name="atualizar_veiculo" action="" method="post" >
        <div style="width:300px; margin:4px; float:left;">
            <h5>ID do Veículo: <span style="color: red" >*</span></h5>
            <select name="id_veiculo" required>
                <option selected name= "" value="">Selecione uma opção...</option>
                <?php $consulta = "SELECT CONCAT(IDVeiculo, ' - ', marca, ' ', modelo) AS veiculo FROM veiculos";
                include('database/selects_basedados.php');
                foreach($dados as $linha){ ?>
                <option name="updt_veiculo" value="<?php echo $linha['veiculo'];?>"><?php echo $linha['veiculo'];?></option>
                <?php } ?>
            </select>
        </div>
        <div style="width:300px; margin:4px; float:left;">
            <h5>Preço do Veículo:<h5>
            <input name="preco_veiculo" value="" minlength="1"/>
        </div>
        <div style="width:300px; margin:4px; float:left;">
            <h5>Estado do Veículo:<h5>
            <input name="estado_veiculo" value="" minlength="1"/>
        </div>
        <div style="width:300px; margin:4px; float:left;">
            <h5>Em Stock:<h5>
            <select name="stock_veiculo">
                <option value="Sim" selected>Sim</option>
                <option value="Nao">Não</option>
            </select>
        </div>
        <div style="width:300px; margin:4px; float:left;">
            <h5>Quantidade em Stock:<h5>
            <input name="quantidade_veiculo" value="" minlength="1"/>
        </div>
        <div style="width:300px; margin:4px; float:left;" >
            <h5>Pronto Para Adicionar ao Stock:<h5>
            <select name="pronto_stock_veiculo">
                <option value="Sim" selected>Sim</option>
                <option value="Nao">Não</option>
            </select>
        </div>
        <div style="width:300px; margin:4px;">
            <input style="cursor: pointer;" name="atualizarveiculo" type="submit" value="submit" class="btn-style cr-btn"/>
        </div>
    </form>
</div>
<?php 

/** isset($_POST['atualizarveiculo']: Atualizar um Veiculo **/

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
        $pronto = ",pronto_adicionar_stock='$updt_pronto_stock'";
    $insert = "UPDATE veiculos SET $updt_preco$updt_estado$updt_stock$updt_quantidade_stock$updt_pronto_stock
    WHERE IDNIF_Cliente=$id_veiculo";
    $acao = 'update';
    $adicionar_foto == TRUE;
    include('database/inserts_basedados.php');
    }
}
/** isset($_POST['removerveiculo']: Remover um Veiculo **/

if(isset($_POST['removerveiculo'])){
    $rm_veiculo = $_POST['rm_veiculo'];
    $rm_id_veiculo = substr($rm_veiculo, 0, 1);
    $acao = 'delete';
    $insert = "DELETE FROM veiculos WHERE IDVeiculo='$rm_id_veiculo'";
    $adicionar_foto = FALSE;
    include('database/inserts_basedados.php');
    } 

/** isset($_POST['criarveiculo']: Adicionar um novo Veiculo **/

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
    $consulta = 'SELECT IDVeiculo FROM veiculos';
    include("database/selects_basedados.php");
    $insert = "INSERT INTO veiculos(modelo, marca, preco, estadoveiculo, velocidademaxima, peso, consumomedio, cambio, combustivel, em_stock, quantidade_stock, pronto_adicionar_stock) 
    VALUES ('$modelo_veiculo', '$marca_veiculo', '$preco_veiculo', '$estado_veiculo', '$velocidade_veiculo', '$peso_veiculo', '$consumo_veiculo', '$cambio_veiculo','$combustivel_veiculo','$stock_veiculo','$quantidade_stock','$pronto_stock_veiculo')";
    $acao = 'insert';
    $adicionar_foto = FALSE;
    include('database/inserts_basedados.php');
    }
?>
</body>
</html>