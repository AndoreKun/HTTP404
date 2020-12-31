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
        <h1><?php echo $nome_user;?>, Bem vindo!</h1>
        <button style="cursor: pointer" id="sair" value="Sair" class="btn-style cr-btn" onclick="location.href = 'logout.php';">Sair</button>
    </div>
    <form action="" method="post">
        <label for="actions"><h2>Venda de Veículos/Artigos</h2></label>
        <select name="vendaveiculos" id="vendaveiculos">
            <option selected name= "" value="">Selecione uma opção...</option>
            <option name="vertodos" value="vertodos">Ver Dados - TODOS</option>
            <option name="mesatual" value="mesatual">Ver Dados - ESSE MÊS</option>
        <input style="cursor: pointer" name="submit" type="submit" value="submit" class="btn-style cr-btn"></input>
    </form>
    <?php 
    if(isset($_POST['submit']) || isset($_POST['submit'])){
        $opcao = $_POST['vendaveiculos'];
        switch($opcao){
            case 'vertodos':
                $consulta = 'SELECT * from vendas';
                break;
            case 'mesatual':
            $consulta = 'SELECT * from vendas WHERE YEAR(DataVenda) = YEAR(CURRENT_DATE()) AND MONTH(DataVenda) = MONTH(CURRENT_DATE())';
            include "selects_basedados.php";      
            ?>
            <div class="container">
            <br/>
            <br/>
            <h2 style='color:black'>Venda de Veículo/Artigos (Total)</h2>
            <div class="col-sm-12">
                <button onclick="location.href='download.php?consulta=<?php echo $consulta ?>'" name="downloadfile"
                value="Exportar Para Excel" class="btn btn-success" style="cursor: pointer">Exportar Para Excel</button>
            </div>
                <br/>
                <table class="table table-striped table-bordered"> 
                        <tr> 
                            <th>IDVenda</th>
                            <th>IDCliente</th>
                            <th>IDVeiculo</th>
                            <th>IDArtigo</th>
                            <th>ValorVenda</th>
                            <th>DataVenda</th>
                        </tr>
                    <tbody>
                        <?php foreach($dados as $row) { ?>
                        <tr>
                            <td><?php echo $row ['IDVenda']; ?></td>
                            <td><?php echo $row ['IDCliente']; ?></td>
                            <td><?php echo $row ['IDVeiculo']; ?></td>
                            <td><?php echo $row ['IDArtigo']; ?></td>
                            <td><?php echo $row ['ValorVenda']; ?></td>
                            <td><?php echo $row ['DataVenda']; ?></td>
                        </tr>
                        <?php } ?>
                        </tbody>
                </table>
            </div>
                <?php
            break;
        }       
    }
?>
</body>
</html>