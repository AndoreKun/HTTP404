<?php
/** 
* Página é apresentada quando uma compra é realizada com sucesso
* @author Grupo HTTP404
* @version 1.2
* @since 24 jan 2021
*/
// Desabilita a demonstração de erros, para que não haja a possibilidade de aparecer erros para o usuário final
ini_set('display_errors', 0);
// Inicia a sessão
session_start();
/** include("envia_email.php"): Inclui o script que contém a função para enviar emails */
include("envia_email.php");

// Declara as Variáveis
$id_encomenda = "";
$nif_do_cliente = "";
$valor_total_venda = "";
$data_encomenda = "";
$compra_cliente = "";
$endereco_cliente = "";

/** $verifica_compra: Array que contém informação se uma compra foi feita, e informação sobre informações a mais sobre a encomenda */
$verifica_compra = array("nao", "sem_inf_adc");
if(isset($_SESSION['compra_sucess'])){
    $verifica_compra[0] = $_SESSION['compra_sucess'][0];
    $verifica_compra[1] = $_SESSION['compra_sucess'][1];
    $compra_cliente = $_SESSION['compra_sucess'][2];
    $endereco_cliente = $_SESSION['compra_sucess'][3];
    // Limpa todo o carrinho
    unset($_SESSION['produtos']['produtos']);
    unset($_SESSION['carrinho_veiculos']);
    unset($_SESSION['carrinho_artigos']);
    unset($_SESSION['prod_veiculos_antigos']);
    unset($_SESSION['id_veiculo']['id_veiculo']);
    unset($_SESSION['id_artigo']['id_artigo']);
    unset($_SESSION['abilitar_remover_veiculos']);
    unset($_SESSION['abilitar_remover_artigos']);
    unset($_SESSION['produtos_veiculos']);
    unset($_SESSION['produtos_artigos']);
    unset($_SESSION['feedback']['feedback']);
}
/** if ($verifica_compra[0] == "nao" ): verifica se uma compra foi feita, senão redireciona o cliente devolta para checkout.php */
if ($verifica_compra[0] == "nao" ){	    
    echo  "<script type='text/javascript'>
                location.href='checkout.php'
            </script>";	
    exit();
} else {
    /** $id_encomenda: Número da encomenda feita(Caso o cliente tenha encomendados varios produtos, o último id de encomenda prevalece) */
    $id_encomenda = $compra_cliente[0];
    /** $nif_do_cliente: NIF do cliente */
    $nif_do_cliente =  $compra_cliente[1];
    /** $valor_total_venda: Valor total da Encomenda */
    $valor_total_venda = $compra_cliente[2];
    /** $data_encomenda: Data completa exata que a encomenda foi realizada */
    $data_encomenda = $compra_cliente[3];
    // Variáveis para a função EnviarMail
    /** $email: Email do cliente */
    $email = $endereco_cliente[1];
    /** $assunto: Assunto do email */
    $assunto = "Obrigado Pela Sua Compra!";
    /** $mensagem: Mensagem/Corpo do email */
    $mensagem = "email_venda";
    /** EnviarMail($email, $assunto, $mensagem, $endereco_cliente, $compra_cliente, $verifica_compra): Chama a função que envia email com os dados da encomenda para o cliente */
    EnviarMail($email, $assunto, $mensagem, $endereco_cliente, $compra_cliente, $verifica_compra);
    $_SESSION['compra_sucess'] = array();
    /** Limpa o array associativo em compra_sucess, para caso o cliente recarregue a página, a mesma não envie outro email, mas sim o redirecione de volta para checkout */
    unset($_SESSION['compra_sucess']);
}

?>
<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Compra Sucedida!</title>
        <meta name="description" content="Sucesso na compra">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		
		<!-- css -->
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
            <header>
                <div class="header-area transparent-bar ptb-55">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-4">
                                <div class="logo-small-device">
                                    <a href="index.html"><img alt="" src="assets/img/logo/logo.png"></a>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8 col-8">
                                <div class="header-contact-menu-wrapper pl-45">
                                    <div class="header-contact">
                                    </div>
                                    <div class="menu-wrapper text-center">
                                        <button class="menu-toggle">
                                            <img class="s-open" alt="" src="assets/img/icon-img/menu.png">
                                            <img class="s-close" alt="" src="assets/img/icon-img/menu-close.png">
                                        </button>
                                        <div class="main-menu">
                                            <nav>
                                                <ul>
                                                    <li><a href="index.html">PÁGINA INICIAL</a></li>
                                                    <li class="active"><a href="about-us.html">SOBRE NÓS</a></li>
                                                    <li><a href="#">LOJA</a>
                                                        <ul>
                                                            <li><a href="product-details.php">Loja</a></li>                                                       
                                                            <li><a href="checkout.php">Checkout</a></li>                                                         
                                                        </ul>
                                                    </li>
                                                    <li><a href="">ACESSOS</a>
                                                        <ul>
                                                            <li><a href="login.php">Acesso Reservado</a></li>
                                                        </ul>
                                                    </li>              
                                                    <li><a href="contact.html">Contactos</a></li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div> 
                            </div>                         
                        </div>
                    </div>
                </div>
            </header>
            <div class="breadcrumb-area pt-255 pb-170" >
                <div class="container-fluid">
                    <div style="text-align: center">
                        <h1>Compra realizada com sucesso!</h1>
                        <h3>Muito Obrigado por escolher a HTTP 404!<br/>O número da sua encomenda é <b><?php echo $id_encomenda; ?></b>, iremos lhe enviar um email com o resumo da sua encomenda.</h3>
                    </div>
                </div>
            </div>
            
            </header>
            <div>
            </div>
            <!-- Subscrição dos clientes -->	
            <div id="subscricao_markenting" class="newsletter-area">
                <div class="container">
                    <div class="newsletter-wrapper-all theme-bg-2">
                        <div class="row">
                           
                            <div class="col-lg-20 col-12 col-md-12">
                                <div class="newsletter-wrapper text-center">
                                    <div class="newsletter-title">
                                        <h3>Subscreva aos nossos alertas</h3>
                                    </div>
                                    <div id="mc_embed_signup" class="subscribe-form">
                                        <form action="envia_email.php" method="post" id="markenting-emails" name="mc-embedded-subscribe-form" class="validate">
                                            <div id="mc_embed_signup_scroll" class="mc-form">
                                                <input type="email" id="email_interessado" name="email_interessado" class="email" placeholder="Deixe aqui o seu email..." required>
                                                <input type="hidden" id="voltar_para" name="voltar_para" value="compra_sucess.php#subscricao_markenting">
                                                <div class="clear"><input type="submit" value="Subscribe" name="email-markenting" id="mc-embedded-subscribe" class="button"></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer>
                <div class="footer-top pt-210 pb-98 theme-bg">
                    <div class="container">
                       <div class="row">
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="footer-widget mb-30">
                                    <div class="footer-logo">
                                        <a href="index.html">
                                            <img src="assets/img/logo/logo.png" alt="">
                                        </a>
                                    </div>
                                    <div class="footer-about">
                                        <p><span>HTTP4</span> A maior loja de veículos online </p>
                                        <div class="footer-support">
                                            <h5>Suporte técnico</h5>
                                            <span> 01245 658 698 (Grátis)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="footer-widget mb-30 pl-60">
                                    <div class="footer-widget-title">
                                        <h3>Hiperligações</h3>
                                    </div>
                                    <div class="quick-links">
                                        <ul>
                                            <li><a href="about-us.html">Sobre nós</a></li>
                                            <li><a href="shop.html">Loja</a></li>
                                            <li><a href="contact.html">Contactar</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="footer-widget mb-30">
                                    <div class="footer-widget-title">
                                        <h3>Redes sociais</h3>
                                    </div>
                                    <div class="food-widget-content pr-30">
                                        <div class="single-tweet">
                                            <p><a href="#">@José,</a> Acabei de comprar uma mota e estou muito feliz</p>
                                        </div>
                                        <div class="single-tweet">
                                            <p><a href="#">@Carlos,</a> Acabei de comprar um capacete e estou muito contente</p>
                                        </div>
                                        <div class="single-tweet">
                                            <p><a href="#">@Afonso,</a> Tentei ligar para o suporte mas ninguém me atendeu</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="footer-widget mb-30">
                                    <div class="footer-widget-title">
                                        <h3>Informações de contacto</h3>
                                    </div>
                                    <div class="food-info-wrapper">
                                        <div class="food-address">
                                            <div class="food-info-title">
                                                <span>Morada</span>
                                            </div>
                                            <div class="food-info-content">
                                                <p>Rua 8, Tavira</p>
                                            </div>
                                        </div>
                                        <div class="food-address">
                                            <div class="food-info-title">
                                                <span>Telefone</span>
                                            </div>
                                            <div class="food-info-content">
                                                <p>+090 12568 369 987</p>
                                            </div>
                                        </div>
                                        <div class="food-address">
                                            <div class="food-info-title">
                                                <span>Email</span>
                                            </div>
                                            <div class="food-info-content">
                                                <a href="#">info@http404.com</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom ptb-35 black-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-12">
                                <div class="copyright">
                                    <p>©Copyright, 2020 All Rights Reserved </p>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="footer-payment-method">
                                    <a href="#"><img alt="" src="assets/img/icon-img/payment.png"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>	
		<!-- javascripts -->
        <script src="assets/js/vendor/jquery-1.12.0.min.js"></script>
        <script src="assets/js/popper.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/isotope.pkgd.min.js"></script>
        <script src="assets/js/imagesloaded.pkgd.min.js"></script>
        <script src="assets/js/jquery.counterup.min.js"></script>
        <script src="assets/js/waypoints.min.js"></script>
        
        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>
