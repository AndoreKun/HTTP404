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
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
    
    <!-- all css here -->
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
</head>
<body>
    <div class="wrapper">
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
    <div style="text-align: center">
        <h1>Olá, <?php echo $nome_user;?>!</h1>
        <button style="cursor: pointer" id="sair" value="Sair" class="btn-style cr-btn" onclick="location.href ='logout.php';">Sair</button>
    </div>
    <form action="" method="post">
        <label for="actions"><h2>Registar venda de Veículos/Artigos</h2></label><br/> 
        <div id="elemento" name="elemento" style="width:300px; margin:4px;">
                <h5>Cliente:</h5>
                <select name="cliente" style="width:300px; margin:4px;">
                    <option selected name= "" value="">Selecione uma opção...</option>
                    <?php $consulta = "SELECT CONCAT(IDNIF_Cliente, ' - ', Nome) AS clientes FROM clientes";
                    include('database/selects_basedados.php');
                    foreach($dados as $linha){ ?>
                    <option value="<?php echo $linha['clientes'];?>"><?php echo $linha['clientes'];?></option>
                    <?php } ?>
                </select>
                <h5>Veículo:</h5>
                <select name="veiculo" style="width:300px; margin:4px;">
                    <option selected name= "" value="">Selecione uma opção...</option>
                    <?php $consulta = "SELECT CONCAT(IDVeiculo, ' - ', marca, ' ', modelo) AS veiculos FROM veiculos WHERE Em_stock='Sim'";
                    include('database/selects_basedados.php');
                    foreach($dados as $linha){ ?>
                    <option value="<?php echo $linha['veiculos'];?>"><?php echo $linha['veiculos'];?></option>
                    <?php } ?>
                </select>
                <h5>Artigo:</h5>
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
    <?php 
    if(isset($_POST['submit']) || isset($_POST['submit'])){
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

        if ($insertpronto == true){
            if ($veiculoselecionado == "" and $artigoselecionado != ""){
                $consulta = "SELECT preco from artigos WHERE IDArtigo = '$artigoselecionado'";
                include('database/selects_basedados.php');
                foreach($dados as $linha){
                    $valordavenda = $linha['preco'];
                }
                $insert = "INSERT INTO vendas(IDNIF_Cliente, IDArtigo, ValorVenda, IDFuncionario) VALUES ('$clienteselecionado', '$artigoselecionado', '$valordavenda', '$id_users')";

                include('database/inserts_basedados.php');
                exit();
            }
            if ($artigoselecionado == "" and $veiculoselecionado != ""){
                $consulta = "SELECT preco from veiculos WHERE IDVeiculo = '$veiculoselecionado'";
                include('database/selects_basedados.php');
                foreach($dados as $linha){
                    $valordavenda = $linha['preco'];
                }
                $insert = "INSERT INTO vendas(IDNIF_Cliente, IDVeiculo, ValorVenda, IDFuncionario) VALUES ('$clienteselecionado', '$veiculoselecionado', '$valordavenda', '$id_users')";
                include('database/inserts_basedados.php');
                exit();
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
?>

<script src="assets/js/mostraselecao.js"></script>
</body>
</html>