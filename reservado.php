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
	if ($logado == "N" || $cargo == ""){	    
		echo  "<script type='text/javascript'>
					location.href='reservado.php'
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
        <label for="actions"><h2>Finanças</h2></label>
        <select name="downloadfile" id="download" onchange="javascript:this.form.submit()">
            <option name= "" value="">Select a option...</option>
            <option name="download "value="download">Download</option>
            <option name="reset" value="reset">Reset</option>
            <option name="submit" value="submit">Submit</option> 
        </select>
        <input style="cursor: pointer" name="submit" type="submit" value="submit" class="btn-style cr-btn"></input>
    </form>
    <?php 
    if(isset($_POST['submit']) ){
        $opcao = $_POST['downloadfile'];
        switch($opcao){
            case 'download':
                $consulta = "SELECT * FROM vendas";
            
                //downloadfile($cargo, $pass_users, $consulta);
                break;
            case 'submit':
                echo "<script type='text/javascript'>
                    location.href='product-details.html'
                    </script>";
                break;
            case 'reset':
                echo "<script type='text/javascript'>
                    location.href='about-us.html'
                    </script>";
                break;
            case '':
                "<script type='text/javascript'>
                alert('Escolha uma Opcao!')
		        </script>";
            }
        }

?>
</body>
</html>