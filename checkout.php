<?php 
session_start();
$produtos = array();
$total_valor_produtos = 0;
$num_produtos_artigos = 0;
$num_produtos_veiculos = 0;
$artigos = "";
$veiculos = "";
$posicao_veiculo = 0;
$posicao_artigo = 1;
$produtos_novos = array();

if(isset($_SESSION['produtos_veiculos']) || isset($_SESSION['produtos_artigos'])){
    if(isset($_SESSION['produtos_artigos'])){
        $artigos = $_SESSION['produtos_artigos'];
    } 
    if(isset($_SESSION['produtos_veiculos'])) {
        $veiculos = $_SESSION['produtos_veiculos'];
    }
    if(isset($_SESSION['produtos'])){
        $prod_novo_tmp = $_SESSION['produtos'];
        $prod_novo_tmp = $prod_novo_tmp[0];
        array_push($produtos_novos, $prod_novo_tmp);

    }

    if ($veiculos == ""){
        $posicao_artigo = 0;
        array_push($produtos, $artigos); 
        $num_produtos_artigos = count($produtos[$posicao_artigo]) / 3;
        $pos_preco = 2;
        for($preco_artigos = 0; $num_produtos_artigos > $preco_artigos; $preco_artigos++){  
            $total_valor_produtos += $produtos[$posicao_artigo][$pos_preco]; 
            $pos_preco += 3; 
        }     
    } elseif($artigos == ""){
        $posicao_veiculo = 0;
        array_push($produtos, $veiculos);
        $num_produtos_veiculos = count($produtos[$posicao_veiculo]) / 3;
        $pos_preco = 2;
        // Calcula o valor total da compra
        for($preco_veiculos = 0; $num_produtos_veiculos > $preco_veiculos; $preco_veiculos++){  
            $total_valor_produtos += $produtos[$posicao_veiculo][$pos_preco];  
            $pos_preco += 3; 
        }
    } else {
        $posicao_veiculo = 0;
        $posicao_artigo = 1;
        array_push($produtos, $veiculos, $artigos);
        $num_produtos_artigos = count($produtos[$posicao_artigo]) / 3;
        $num_produtos_veiculos = count($produtos[$posicao_veiculo]) / 3;
        $pos_preco = 2;
        // Calcula o valor total da compra
        for($preco_veiculos = 0; $num_produtos_veiculos > $preco_veiculos; $preco_veiculos++){  
            $total_valor_produtos += $produtos[$posicao_veiculo][$pos_preco];  
            $pos_preco += 3;
        }
        $pos_preco = 2;
        for($preco_artigos = 0; $num_produtos_artigos > $preco_artigos; $preco_artigos++){  
            $total_valor_produtos += $produtos[$posicao_artigo][$pos_preco]; 
            $pos_preco += 3; 
        }  
    }



}
?>
<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Checkout</title>
        <meta name="description" content="Live Preview Of Oswan eCommerce HTML5 Template">
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
                                                    <li><a href="product-details.php">LOJA</a>
                                                    </li>
                                                    <li><a href="#">ACESSOS</a>
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
            <div class="breadcrumb-area pt-255 pb-170" style="background-image: url(assets/img/banner/banner-4.jpg)">
                <div class="container-fluid">
                    <div class="breadcrumb-content text-center">
                        <h2>Página de checkout</h2>
                        <ul>
                            <li>
                                <a href="#">Página inicial</a>
                            </li>
                            <li>Checkout</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- checkout-area start -->
            <div class="checkout-area pt-130 pb-100">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-12">
                            <form action="#">
                                <div class="checkbox-form">						
                                    <h3>DADOS DE ENTREGA</h3>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="country-select">
                                                <label>PAÍS <span class="required">*</span></label>
                                                <select>
												  <option value="volvo">Portugal</option>
                                                  <option value="volvo">Espanha</option>
                                                  <option value="saab">França</option>
                                                  <option value="mercedes">Alemanha</option>
                                                  <option value="audi">Inglaterra</option>
                                                  <option value="audi2">China</option>
                                                  <option value="audi3">Korea</option>
                                                  <option value="audi4">Japão</option>                                                
                                                </select> 										
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Nome <span class="required">*</span></label>										
                                                <input type="text" placeholder="" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Apelido <span class="required">*</span></label>										
                                                <input type="text" placeholder="" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Empresa</label>
                                                <input type="text" placeholder="" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Morada <span class="required">*</span></label>
                                                <input type="text" placeholder="Rua.." />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">									
                                                <input type="text" placeholder="Apartment, suite, unit etc. (optional)" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Cidade <span class="required">*</span></label>
                                                <input type="text" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Localidade <span class="required">*</span></label>										
                                                <input type="text" placeholder="" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Código postal <span class="required">*</span></label>										
                                                <input type="text" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Email<span class="required">*</span></label>										
                                                <input type="email" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Telefone <span class="required">*</span></label>										
                                                <input type="text" />
                                            </div>
                                        </div>
                                    <div id="carrinho"></div> 							
                                    </div>
                                        <div class="order-notes">
                                            <div class="checkout-form-list mrg-nn">
                                                <label>Informações adicionais</label>
                                                <textarea id="checkout-mess" cols="30" rows="10" placeholder="Introduza aqui outras informações importantes relacionadas com a sua encomenda." ></textarea>
                                            </div>									
                                        </div>
                                    </div>													
                                </div>
                            </form>
                        </div>	
                        <div class="col-lg-6 col-md-12 col-12" style="text-align: center;">
                            <div class="your-order">
                                <h3>A SUA ENCOMENDA</h3>
                                <?php if(isset($_SESSION["produtos"]["produtos"])){?>
                                <div class="your-order-table table-responsive" >
                                    <table>
                                    <?php
                                    $nomeproduto = 0; 
                                    $qntdproduto = 1;
                                    $precoproduto = 2;
                                    for($num_linhas = 0; $num_produtos_veiculos > $num_linhas; $num_linhas++) {
                                        ?>
                                        <thead>
                                            <tr class="cart_item">
                                                <td id="teste" class="product-name">
                                                <label>Nome:</label>
                                                    <?php echo $produtos[$posicao_veiculo][$nomeproduto]; ?>   
                                                </td>
                                                <td>             
                                                <label>Quantidade:</label>
                                                    <strong><?php echo "X".$produtos[$posicao_veiculo][$qntdproduto];?></strong>
                                                </td>
                                                <td class="product-total">
                                                    <label>Preço:</label>
                                                    <span class="amount"><?php echo $produtos[$posicao_veiculo][$precoproduto];?>€</span>
                                                </td>
                                            </tr>
                                        </thead>
                                    <?php 
                                        $nomeproduto += 3; 
                                        $qntdproduto += 3;
                                        $precoproduto += 3;
                                        }
                                    $nomeproduto = 0; 
                                    $qntdproduto = 1;
                                    $precoproduto = 2;
                                    for($num_linhas = 0; $num_produtos_artigos > $num_linhas; $num_linhas++) {
                                        ?>
                                        <thead>                          
                                            <tr class="cart_item">
                                                <td id="teste" class="product-name">
                                                <label>Nome:</label>
                                                    <?php echo $produtos[$posicao_artigo][$nomeproduto]; ?>   
                                                </td>
                                                <td>
                                                <label>Quantidade:</label>
                                                    <strong><?php echo "X".$produtos[$posicao_artigo][$qntdproduto];?></strong>
                                                </td>
                                                <td class="product-total">
                                                    <label>Preço:</label>
                                                    <span class="amount"><?php echo $produtos[$posicao_artigo][$precoproduto];?>€</span>
                                                </td>
                                    <?php 
                                        $nomeproduto += 3; 
                                        $qntdproduto += 3;
                                        $precoproduto += 3;
                                        } 
                                        ?> 
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr class="order-total">
                                                <th>Total</th>
                                                <td><strong><span class="amount"><?php echo $total_valor_produtos;?>€</span></strong>
                                                </td>
                                            </tr>								
                                        </tfoot>
                                    </table>
                                    <div class="order-button-payment">
                                        <form method="get" action="carrinho.php">
                                            <input type="hidden" id="acao" name="acao" value="limpar">
                                            <input type="hidden" id="voltar_para" name="voltar_para" value="checkout.php#carrinho">
                                            <input style="color:red;" name="mudar_carrinho" value="Limpar Carrinho" type="submit"></input>
                                        </form>
                                    <div>
                                    <div class="order-button-payment">
                                            <input type="submit" value="Fazer Pedido" />
                                        </div>    
                                </div>
                                <?php } else { echo "<h4>Não há nenhum produto no carrinho</h4>"; } ?>                         
                                        <div class="order-button-payment">
                                            <a href="product-details.php">
                                            <input class='btn-style cr-btn' value='Voltar para a Loja' type='button' style='cursor: pointer;'></input>
                                            </a>
                                        </div>								
                                    </div>
                                </div>
                                <br/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- checkout-area end -->	
            <div class="newsletter-area">
                <div class="container">
                    <div class="newsletter-wrapper-all theme-bg-2">
                        <div class="row">
                           
                            <div class="col-lg-20 col-12 col-md-12">
                                <div class="newsletter-wrapper text-center">
                                    <div class="newsletter-title">
                                        <h3>Subscreva aos nossos alertas</h3>
                                    </div>
                                    <div id="mc_embed_signup" class="subscribe-form">
                                        <form action="#" method="post" id="#" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                            <div id="mc_embed_signup_scroll" class="mc-form">
                                                <input type="email" value="" name="EMAIL" class="email" placeholder="Deixe aqui o seu email..." required>
                                                <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                                <div class="mc-news" aria-hidden="true"><input type="text" name="b_6bbb9b6f5827bd842d9640c82_05d85f18ef" tabindex="-1" value=""></div>
                                                <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
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
		<!-- all js here -->
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
