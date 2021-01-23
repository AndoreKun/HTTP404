<?php
/**
*Pagina para login de funcionários, tem a função de redirecionar os utilizadores para sua area (vendedores, técnicos, patrão).
*@author Grupo HTTP404
*@version 2.0
*@since 26 dez 2020
**/
?>
<!DOCTYPE HTML>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>HTTP 404</title>
    <meta name="description" content="HTTP 404 - O melhor site de vendas de veículos">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon - icones favoritos -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
    
    <!-- Chamada de todos os css -->
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
                    <h2>login</h2>
                    <ul>
                        <li>
                            <a href="index.html">home</a>
                        </li>
                        <li>acesso reservado</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="login-register-area ptb-130">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 ml-auto mr-auto">
                        <div class="login-register-wrapper">
                            <div class="login-register-tab-list nav">
                                <h2> Login </h2>
                            </div>
                            <div class="tab-content">
                                <div id="lg1" class="tab-pane active">
                                    <div class="login-form-container">
                                        <div class="login-form">
                                            <article>
                                                <form name="form_pesquisa" id="form_pesquisa" method="post" action="">
                                                    <div id="login-box-name">Email:</div>
                            <div id="login-box-field">
                                <input name="email" class="form-login" title="Username" value="" size="30"/>
                            </div>
                            <div id="login-box-name">Password:</div>
                            <div id="login-box-field">
                                <input name="pass" type="password" class="form-login" title="Password" value="" size="30"/>
                            </div>
                            <button name="acao" class="btn-style cr-btn" type="submit" form="form_pesquisa" value="logar">Login</button>
                                                </form>
                                            </article>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
/** Define a ação a ser feita através do formulário de login. **/
$action = isset($_POST['acao']) ? trim($_POST['acao']) : '';
/** Caso ação esteja definida e não seja uma string vazia, faz o login do funcionário e o redireciona. **/
if(isset($action) && $action != ""){ 
    
    switch($action){
        case 'logar':
            /** require_once('class/Autentica.class.php'): requerimos nossa classe de autenticação passando os valores dos inputs como parâmetros. **/
            require_once('class/Autentica.class.php');
            /** $Autentica = new Autentica(): instancio a classse para podermos usar o método nela contida. **/
            $Autentica = new Autentica();
            /** $Autentica->email	= $_POST['email']: Definimos o email do funcionário. **/
            $Autentica->email	= $_POST['email'];
            /** $Autentica->pass	= $_POST['pass']: Definimos a palavra passe do funcionário. **/
            $Autentica->pass	= $_POST['pass'];
            /** if($Autentica->Validar_Usuario()): chama o método para verificar o funcionário, caso ele seja verificado, redireciona para a página reservados
            * senão imprime que as informações de login estão erradas. **/
            if($Autentica->Validar_Usuario()){
                echo  "<script type='text/javascript'>
                            location.href='reservado.php'
                        </script>"; 
                }else{
                echo  "<script type='text/javascript'>
                        alert('ATEN\u00c7\u00c4O, Login ou Senha inv\u00e1lidos...');location.href='login.php'
                    </script>"; 
                }
        break;
    }	
}
?>