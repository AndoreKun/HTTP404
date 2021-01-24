<?php
/** 
 * Página dos funcionários reservada apenas para a vendedores, outros funcionários são imediatamente redirecionados
 * @author Grupo HTTP 404
 * @version 3.0
 * @since 1 jan 2021
 */
// Desabilita a demonstração de erros, para que não haja a possibilidade de aparecer erros para o usuário final
ini_set('display_errors', 0);
// Inicia a sessão
session_start();
ob_start();
// Desabilita a demonstração de erros, para que não haja a possibilidade de aparecer erros para o usuário final
ini_set('display_errors', 0);
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
// Define o Local e lingua, para as funções strftime e strtotime funcionarem bem na página
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
    <form action="vendedores_procedimentos.php" method="post">
        <label for="actions"><h2>Registar venda de Veículos/Artigos</h2></label><br/> 
        <div id="registarvenda" name="registarvenda" style="width:300px; margin:4px;">
                <h5>Cliente: </h5>
                <!-- Conexão à base de dados para mostrar os clientes em uma lista !-->
                <select name="cliente" required>
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
    /** Feedback definido em inserts_basedados.php, resultado de um insert/update/remove da base de dados */
    if(isset($_SESSION['feedback_insert'])){
        if($_SESSION['registar_vendas'] == "S"){ 
            echo $_SESSION['feedback_insert'];
            unset($_SESSION['feedback_insert']);
        }
    }
    ?>
<!-- Formulários para clientes(Adicionar/Remover/Atualizar) !-->
<label for="actions"><h2>Opções de Clientes</h2></label><br/>
<select name="clientes" id="clientes" style="width:300px; margin:4px;" onchange="admSelectCheck(this, true);">
    <option selected id="" name="" value="">Selecione uma opcao...</option>
    <option id="opcao" value="nvcliente">Adicionar novo cliente</option>
    <option id="opcao2" value="rmcliente">Remover cliente</option>
    <option id="opcao3" value="atcliente">Atualizar dados de um cliente</option>
</select>
<div id="elemento" name="elemento" style="display: none">
    <form id="nvcliente" name="nvcliente" action="vendedores_procedimentos.php" method="post" enctype="multipart/form-data"><form>
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
            <br/>
        </div>   
        <input style="cursor: pointer; width:300px; margin:4px;" name="criarcliente" type="submit" value="submit" class="btn-style cr-btn"/>
    </form>
</div>
<div id="elemento2" name="elemento2" style="display: none">
    <form id="removercliente" name="removercliente" action="vendedores_procedimentos.php" method="post">
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
    <form id="update_cliente" name="update_cliente" action="vendedores_procedimentos.php" method="post" enctype="multipart/form-data"><form>
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
    /** Feedback definido em inserts_basedados.php, resultado de um insert/update/remove da base de dados */
    if(isset($_SESSION['feedback_insert'])){
        if($_SESSION['clientes'] == "S"){ 
            echo $_SESSION['feedback_insert'];
            unset($_SESSION['feedback_insert']);
        }
    }
    ?>
<!-- Formulários para veículos(Adicionar/Remover/Atualizar)!-->
<br/><br/>
<label for="actions"><h2>Opções de Veículos</h2></label><br/>
<select name="veiculos" id="veiculos" style="width:300px; margin:4px;" onchange="admSelectCheck2(this, true);">
    <option selected id="" name="" value="">Selecione uma opcao...</option>
    <option id="opcao4" value="veiculos">Adicionar novo veículo</option>
    <option id="opcao5" value="rm_veiculo">Remover veículo</option>
    <option id="opcao6" value="at_veiculo">Atualizar dados de um veículo</option>
</select>
<div id="elemento4" name="elemento_veiculos" style="display: none">
    <form id="nv_veiculo" name="nv_veiculo" action="vendedores_procedimentos.php" method="post">
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
            <h5>Tipo do Veículo: <span style="color: red" >*</span><h5>
            <select name="tipo_veiculo" required>
                <option value="" selected>Selecione Uma Opção</option>
                <option value="Carro">Carro</option>
                <option value="Moto">Moto</option>
                <option value="Scooter">Scooter</option>
            </select>
        </div>
        <div style="width:300px; margin:4px; float:left;">
            <h5>Estado do Veículo: <span style="color: red">*</span><h5>
            <select name="estado_veiculo" required>
                <option value="" selected>Selecione Uma Opção</option>
                <option value="Novo">Novo</option>
                <option value="Semi-Novo">Semi-Novo</option>
                <option value="Usado">Usado</option>
            </select>
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
            <select name="cambio_veiculo" required>
                <option value="" selected>Selecione Uma Opção</option>
                <option value="Automatico">Automatico</option>
                <option value="Semi-Automatico">Semi-Automático</option>
                <option value="Manual">Manual</option>
            </select>
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
        <div style="width:300px; margin:4px;" >
            <h5>Pronto Para Adicionar ao Stock: <span style="color: red" >*</span><h5>
            <select name="pronto_stock_veiculo" required>
                <option value="Sim" selected>Sim</option>
                <option value="Nao">Não</option>
            </select>
            <br/>
        </div>
        <input style="cursor: pointer; width:300px; margin:4px; " name="criarveiculo" type="submit" value="submit" class="btn-style cr-btn"/>
    </form>
</div>
<div id="elemento5" name="remover_veiculo" style="display: none">
    <form id="removerveiculo" name="removerveiculo" action="vendedores_procedimentos.php" method="post">
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
    <form id="update_veiculo" name="atualizar_veiculo" action="vendedores_procedimentos.php" method="post" >
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
            <select name="estado_veiculo" required>
                <option value="" selected>Selecione Uma Opção</option>
                <option value="Novo">Novo</option>
                <option value="Semi-Novo">Semi-Novo</option>
                <option value="Usado">Usado</option>
            </select>
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
    /** Feedback definido em inserts_basedados.php, resultado de um insert/update/remove da base de dados */
    if(isset($_SESSION['feedback_insert'])){
        if($_SESSION['veiculos'] == "S"){ 
            echo $_SESSION['feedback_insert'];
            unset($_SESSION['feedback_insert']);
        }
    }
    ?>
<!-- Formulários para Artigos(Adicionar/Remover/Atualizar)!-->
<br/><br/>
<label for="actions"><h2>Opções de Artigos</h2></label><br/>
<select name="artigos" id="artigos" style="width:300px; margin:4px;" onchange="admSelectCheck3(this, true);">
    <option selected id="" name="" value="">Selecione uma opcao...</option>
    <option id="opcao7" value="artigos">Adicionar novo Artigo</option>
    <option id="opcao8" value="rm_artigo">Remover Artigo</option>
    <option id="opcao9" value="at_artigo">Atualizar dados de um Artigo</option>
</select>
<div id="elemento7" name="elemento_artigos" style="display: none">
    <form id="nvartigo" name="nvartigo" action="vendedores_procedimentos.php" method="post">
        <div style="width:300px; margin:4px; float:left;">
            <h5>Nome do Artigo: <span style="color: red" >*</span><h5>
            <input name="nome_artigo" value="" minlength="1" required/>
        </div>
        <div style="width:300px; margin:4px; float:left;">
            <h5>Descricao do Artigo: <span style="color: red">*</span><h5>
            <input name="desc_artigo" value="" minlength="1" required/>
        </div>
        <div style="width:300px; margin:4px; float:left;">
            <h5>Preço do Artigo: <span style="color: red" >*</span><h5>
            <input name="preco_artigo" value="" minlength="1" required/>
        </div>
        <div style="width:300px; margin:4px; float:left;">
            <h5>Tipo do Artigo: <span style="color: red" >*</span><h5>
            <select name="tipo_artigo" required>
                <option value="" selected>Selecione Uma Opção</option>
                <option value="Peças">Peças</option>
                <option value="Acessorios">Acessorios</option>
            </select>
        </div>
        <div style="width:300px; margin:4px; float:left;">
            <h5>Em Stock: <span style="color: red" >*</span><h5>
            <select name="stock_artigo" required>
                <option value="Sim" selected>Sim</option>
                <option value="Nao">Não</option>
            </select>
        </div>
        <div style="width:300px; margin:4px; float:left;">
            <h5>Quantidade em Stock: <span style="color: red" >*</span><h5>
            <input name="quantidade_stock_artigo" value="" minlength="1" required/>
        </div>
        <div style="width:300px; margin:4px;">
            <input style="cursor: pointer;" name="criarartigo" type="submit" value="submit" class="btn-style cr-btn"/>
        </div>
    </form>
</div>
<div id="elemento8" name="remover_veiculo" style="display: none">
    <form id="removerartigo" name="removerartigo" action="vendedores_procedimentos.php" method="post">
        <div style="width:300px; margin:4px;">
            <h5>ID do Artigo: <span style="color: red" >*</span></h5>
            <select name="rm_artigo" required>
                <option selected name= "" value="">Selecione uma opção...</option>
                <?php $consulta = "SELECT CONCAT(IDArtigo, ' - ', nome) AS artigo FROM artigos";
                include('database/selects_basedados.php');
                foreach($dados as $linha){ ?>
                <option name="rm_artigo" value="<?php echo $linha['artigo'];?>"><?php echo $linha['artigo'];?></option>
                <?php } ?>
            </select>
        </div>
        <input style="cursor: pointer; width:300px; margin:4px;" name="removerartigo" type="submit" value="submit" class="btn-style cr-btn"/>
    </form>
</div>
<div id="elemento9" name="atualizar_artigo" style="display: none">
    <form id="atualizar_artigo" name="atualizar_artigo" action="vendedores_procedimentos.php" method="post" >
        <div style="width:300px; margin:4px; float:left;">
            <h5>ID do Artigo: <span style="color: red" >*</span></h5>
            <select name="updt_id_artigo" required>
                <option selected name= "" value="">Selecione uma opção...</option>
                <?php $consulta = "SELECT CONCAT(IDArtigo, ' - ', nome) AS artigo FROM artigos";
                include('database/selects_basedados.php');
                foreach($dados as $linha){ ?>
                <option name="id_artigo" value="<?php echo $linha['artigo'];?>"><?php echo $linha['artigo'];?></option>
                <?php } ?>
            </select>
        </div>
        <div style="width:300px; margin:4px; float:left;">
            <h5>Nome do Artigo: <span style="color: red" >*</span><h5>
            <input name="updt_nome_artigo" value="" minlength="1" required/>
        </div>
        <div style="width:300px; margin:4px; float:left;">
            <h5>Descricao do Artigo: <span style="color: red">*</span><h5>
            <input name="updt_descricao_veiculo" value="" minlength="1" required/>
        </div>
        <div style="width:300px; margin:4px; float:left;">
            <h5>Preço do Artigo: <span style="color: red" >*</span><h5>
            <input name="updt_preco_veiculo" value="" minlength="1" required/>
        </div>
        <div style="width:300px; margin:4px; float:left;">
            <h5>Em Stock: <span style="color: red" >*</span><h5>
            <select name="updt_stock_veiculo" required>
                <option value="Sim" selected>Sim</option>
                <option value="Nao">Não</option>
            </select>
        </div>
        <div style="width:300px; margin:4px; float:left;">
            <h5>Quantidade em Stock: <span style="color: red" >*</span><h5>
            <input name="updt_quantidade_stock_artigos" value="" minlength="1" required/>
        </div>
        <div style="width:300px; margin:4px;">
            <input style="cursor: pointer;" name="atualizarartigo" type="submit" value="submit" class="btn-style cr-btn"/>
        </div>
    </form>
</div>
<?php
    /** Feedback definido em inserts_basedados.php, resultado de um insert/update/remove da base de dados */
    if(isset($_SESSION['feedback_insert'])){
        if($_SESSION['artigos'] == "S"){ 
            echo $_SESSION['feedback_insert'];
            unset($_SESSION['feedback_insert']);
        }
    }
    ?>
</body>
</html>