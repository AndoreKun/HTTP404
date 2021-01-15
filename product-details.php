<?php session_start(); 

function feedback ($id, $tipo_produto){
    /**
        *Funcao feedback que retorna uma mensagem quando um produto/artigo é adicionado/removido do carrinho e cria um botão para permitir
        *o redirecionamento para a página que contém o carrinho
        *@author André Pereira
        *@param int $id Número de Identificação do produto/veiculo, utilizado para mostrar a mensagem apenas naquele produto/artigo
        *@param string $tipo_produto Tipo do produto artigo/veículo
        *@param string $feedback Contém o feedback em html quando um produto é adicionado ou removido do carrinho
        *@return array $verificacao Retorna as variáveis id e feedback
        *@version 2.1                                                                                                                                                                                                                                                                               

    */
    $feedback = "";
    if($tipo_produto == "veiculo"){ 
        if(isset($_SESSION['id_veiculo']['id_veiculo'])){
            if ($_SESSION['id_veiculo']['id_veiculo'] == $id){
                $feedback = $_SESSION['feedback']['feedback'];
            }
        }
    }
    if($tipo_produto == "artigo"){
        if(isset($_SESSION['id_artigo']['id_artigo'])){
            if ($_SESSION['id_artigo']['id_artigo'] == $id){
                $feedback = $_SESSION['feedback']['feedback'];
            }
        }
    }
$verificacao = array($id, $feedback);
return $verificacao;
}
?>
<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Loja Virtual</title>
        <meta name="description" content="Live Preview Of Oswan eCommerce HTML5 Template">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		
		<!-- all css here -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/animate.css">
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/css/chosen.min.css">
        <link rel="stylesheet" href="assets/css/easyzoom.css">
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
                                                    <li><a href="checkout.php">Checkout</a>                                                     
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
            <div class="breadcrumb-area pt-255 pb-170" style="background-image: url(assets/img/banner/bannersupra.jpg)">
                <div class="container-fluid">
                    <div class="breadcrumb-content text-center">
                        <h2>LOJA VIRTUAL </h2>
                        <ul>
                            <li>
                                <a href="index.php">Página inicial</a>
                            </li>
                            <li>LOJA</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id=lexus class="product-details-area fluid-padding-3 ptb-130">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-details-img-content">
                                <div class="product-details-tab mr-40">
                                    <div class="product-details-large tab-content">
                                        <div class="tab-pane active" id="pro-details1">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/lexusRC.jpg">
                                                    <img src="assets/img/product-details/lexi1.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="pro-details2">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/lexuslado.jpg">
                                                    <img src="assets/img/product-details/lexuslado.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="pro-details3">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/lexusatras.jpg">
                                                    <img src="assets/img/product-details/lexusatras.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="pro-details4">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/lexusint.jpg">
                                                    <img src="assets/img/product-details/lexusint.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-details-small nav mt-12 product-dec-slider owl-carousel">
                                        <a class="active" href="#pro-details1">
                                            <img src="assets/img/product-details/lexusRC.jpg" alt="">
                                        </a>
                                        <a href="#pro-details2">
                                            <img src="assets/img/product-details/lexuslado.jpg" alt="">
                                        </a>
                                        <a href="#pro-details3">
                                            <img src="assets/img/product-details/lexusatras.jpg" alt="">
                                        </a>
                                        <a href="#pro-details4">
                                            <img src="assets/img/product-details/lexusint.jpg" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="product-details-content">
                                <h2>Lexus RC 200t</h2>
                                <div class="quick-view-rating">
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star-half-empty"></i>
                                    <span> ( 1 Customer Review )</span>
                                </div>
                                <div class="product-price">
                                    <span>50.000 €</span>
                                </div>
                                <div class="product-overview">
                                    <h5 class="pd-sub-title">Resumo do Produto</h5>
                                    <p> Com consumo médio de 7.2 litros/100km, 0 aos 100 km/h em 7.5 segundos, velocidade máxima de 230 km/h, 
                                    um peso de 1755 kgs, o RC 200t está equipado com um motor em linha de 4 cilindros turbo comprimido, a Gasolina.</p>
                                </div>
                                    <div class="quickview-btn-cart">
                                        <form method="get" action="carrinho.php">
                                            <input type="hidden" id="id_veiculo" name="id_veiculo" value="1">
                                            <input type="hidden" id="acao" name="acao" value="adicionar">
                                            <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#lexus">
                                            <input class="btn-style cr-btn" name="mudar_carrinho" value="Adicionar ao Carrinho" type="submit" style="cursor: pointer"></input>
                                        </form>
                                        <form method="get" action="carrinho.php">
                                            <input type="hidden" id="id_veiculo" name="id_veiculo" value="1">
                                            <input type="hidden" id="acao" name="acao" value="remover">
                                            <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#lexus">
                                            <input class="btn-style cr-btn" name="mudar_carrinho" value="Remover do Carrinho" type="submit" style="cursor: pointer"></input>
                                        </form>
                                    <br/>
                                    <?php 
                                    $retorno = feedback(1, "veiculo");
                                    if ($retorno[0] == 1){
                                        echo $retorno[1];
                                    }?>
                                <div class="product-share">
                                    <h5 class="pd-sub-title">Partilhar</h5>
                                   <ul>
										<li class="facebook"><a href="https://www.facebook.com/Http404-104014971631032"><i class="icofont icofont-social-facebook"></i></a></li>
										<li class="twitter"><a href="https://twitter.com/Http404V"><i class="icofont icofont-social-twitter"></i></a></li> 
									</ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id=volvo class="product-details-area fluid-padding-3 ptb-130">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-details-img-content">
                                <div class="product-details-tab mr-40">
                                    <div class="product-details-large tab-content">
                                        <div class="tab-pane active" id="pro-details1">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/volvofrente2.jpg">
                                                    <img src="assets/img/product-details/volvofrente2.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="pro-details2">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/volvotras.jpg">
                                                    <img src="assets/img/product-details/volvotras.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="pro-details3">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/volvoroda.jpg">
                                                    <img src="assets/img/product-details/volvoroda.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="pro-details4">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/volvoint1.jpg">
                                                    <img src="assets/img/product-details/volvoint1.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-details-small nav mt-12 product-dec-slider owl-carousel">
                                        <a class="active" href="#pro-details1">
                                            <img src="assets/img/product-details/volvofrente2.jpg" alt="">
                                        </a>
                                        <a href="#pro-details2">
                                            <img src="assets/img/product-details/volvotras.jpg" alt="">
                                        </a>
                                        <a href="#pro-details3">
                                            <img src="assets/img/product-details/volvotras.jpg" alt="">
                                        </a>
                                        <a href="#pro-details4">
                                            <img src="assets/img/product-details/volvoint1.jpg" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="product-details-content">
                                <h2>Volvo S60 T6 AWD R-Design Platinum 2017 </h2>
                                <div class="quick-view-rating">
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <span> ( 1 Customer Review )</span>
                                </div>
                                <div class="product-price">
                                    <span>30.000 €</span>
                                </div>
                                <div class="product-overview">
                                    <h5 class="pd-sub-title">Resumo do Produto</h5>
                                    <p> Com consumo médio de 10 litros/100km, 0 aos 100 km/h em 5.9 segundos, velocidade máxima de 230 km/h, 
                                    um peso de 1684 kgs, o S60 T6 está equipado com Câmbio automático de 8 marchas e Motor a Gasolina.</p>
                                </div>
                                    <div class="quickview-btn-cart">
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_veiculo" name="id_veiculo" value="2">
                                        <input type="hidden" id="acao" name="acao" value="adicionar">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#volvo">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Adicionar ao Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_veiculo" name="id_veiculo" value="2">
                                        <input type="hidden" id="acao" name="acao" value="remover">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#volvo">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Remover do Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <br/>
                                    <?php 
                                    $retorno = feedback(2, "veiculo");
                                    if ($retorno[0] == 2){
                                        echo $retorno[1];
                                    }?>
                                <div class="product-share">
                                    <h5 class="pd-sub-title">Partilhar</h5>
                                   <ul>
										<li class="facebook"><a href="https://www.facebook.com/Http404-104014971631032"><i class="icofont icofont-social-facebook"></i></a></li>
										<li class="twitter"><a href="https://twitter.com/Http404V"><i class="icofont icofont-social-twitter"></i></a></li> 
									</ul>		
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id=supra class="product-details-area fluid-padding-3 ptb-130">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-details-img-content">
                                <div class="product-details-tab mr-40">
                                    <div class="product-details-large tab-content">
                                        <div class="tab-pane active" id="pro-details1">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/suprafrente.jpg">
                                                    <img src="assets/img/product-details/suprafrente.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="pro-details2">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/supratras.jpg">
                                                    <img src="assets/img/product-details/supratras.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="pro-details3">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/supraint1.jpg">
                                                    <img src="assets/img/product-details/supraint1.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="pro-details4">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/supraint2.jpg">
                                                    <img src="assets/img/product-details/supraint2.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-details-small nav mt-12 product-dec-slider owl-carousel">
                                        <a class="active" href="#pro-details1">
                                            <img src="assets/img/product-details/suprafrente.jpg" alt="">
                                        </a>
                                        <a href="#pro-details2">
                                            <img src="assets/img/product-details/supratras.jpg" alt="">
                                        </a>
                                        <a href="#pro-details3">
                                            <img src="assets/img/product-details/supraint1.jpg" alt="">
                                        </a>
                                        <a href="#pro-details4">
                                            <img src="assets/img/product-details/supraint2.jpg" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="product-details-content">
                                <h2>Toyota GR Supra </h2>
                                <div class="quick-view-rating">
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <span> ( 1 Customer Review )</span>
                                </div>
                                <div class="product-price">
                                    <span>66.000 €</span>
                                </div>
                                <div class="product-overview">
                                    <h5 class="pd-sub-title">Resumo do Produto</h5>
                                    <p> Com consumo médio de 6 litros/100km, 0 aos 100 km/h em 4.3 segundos, velocidade máxima de 250 km/h, 
                                    um peso de 1815 kgs, o GR Supra está equipado com Câmbio automático de 8 marchas e Motor em linha de 6 cilindros, a Gasolina.</p>
                                </div>
                                    <div class="quickview-btn-cart">
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_veiculo" name="id_veiculo" value="3">
                                        <input type="hidden" id="acao" name="acao" value="adicionar">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#supra">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Adicionar ao Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_veiculo" name="id_veiculo" value="3">
                                        <input type="hidden" id="acao" name="acao" value="remover">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#supra">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Remover do Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <br/>
                                    <?php 
                                    $retorno = feedback(3, "veiculo");
                                    if ($retorno[0] == 3){
                                        echo $retorno[1];
                                    }?>
                                <div class="product-share">
                                    <h5 class="pd-sub-title">Partilhar</h5>
                                  <ul>
									<li class="facebook"><a href="https://www.facebook.com/Http404-104014971631032"><i class="icofont icofont-social-facebook"></i></a></li>
									<li class="twitter"><a href="https://twitter.com/Http404V"><i class="icofont icofont-social-twitter"></i></a></li> 
								</ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id=motobmw class="product-details-area fluid-padding-3 ptb-130">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-details-img-content">
                                <div class="product-details-tab mr-40">
                                    <div class="product-details-large tab-content">
                                        <div class="tab-pane active" id="pro-details1">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/motobmw.jpg">
                                                    <img src="assets/img/product-details/motobmw.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="pro-details2">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/mototras.jpg">
                                                    <img src="assets/img/product-details/mototras.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="pro-details3">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/motolado1.jpg">
                                                    <img src="assets/img/product-details/motolado1.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="pro-details4">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/motolado2.jpg">
                                                    <img src="assets/img/product-details/motolado2.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-details-small nav mt-12 product-dec-slider owl-carousel">
                                        <a class="active" href="#pro-details1">
                                            <img src="assets/img/product-details/motobmw.jpg" alt="">
                                        </a>
                                        <a href="#pro-details2">
                                            <img src="assets/img/product-details/mototras.jpg" alt="">
                                        </a>
                                        <a href="#pro-details3">
                                            <img src="assets/img/product-details/motolado1.jpg" alt="">
                                        </a>
                                        <a href="#pro-details4">
                                            <img src="assets/img/product-details/motolado2.jpg" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="product-details-content">
                                <h2> BMW K 1600 GT </h2>
                                <div class="quick-view-rating">
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star-half-empty"></i>
                                    <span> ( 1 Customer Review )</span>
                                </div>
                                <div class="product-price">
                                    <span>17.000 €</span>
                                </div>
                                <div class="product-overview">
                                    <h5 class="pd-sub-title">Resumo do Produto</h5>
                                    <p> Com consumo médio de 6 litros/100km, 0 aos 100 km/h em 3 segundos, velocidade máxima de 250 km/h, um peso de 306 kgs, 
                                    a K 1600 GT está equipada com um motor em linha de 6 cilindros, a Gasolina.</p>
                                </div>
                                    <div class="quickview-btn-cart">
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_veiculo" name="id_veiculo" value="4">
                                        <input type="hidden" id="acao" name="acao" value="adicionar">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#motobmw">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Adicionar ao Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_veiculo" name="id_veiculo" value="4">
                                        <input type="hidden" id="acao" name="acao" value="remover">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#motobmw">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Remover do Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <br/>
                                    <?php 
                                    $retorno = feedback(4, "veiculo");
                                    if ($retorno[0] == 4){
                                        echo $retorno[1];
                                    }?>
                                <div class="product-share">
                                    <h5 class="pd-sub-title">Partilhar</h5>
                                  <ul>
									<li class="facebook"><a href="https://www.facebook.com/Http404-104014971631032"><i class="icofont icofont-social-facebook"></i></a></li>
									<li class="twitter"><a href="https://twitter.com/Http404V"><i class="icofont icofont-social-twitter"></i></a></li> 
								</ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>		
			<div id=rodasupra class="product-details-area fluid-padding-3 ptb-130">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-details-img-content">
                                <div class="product-details-tab mr-40">
                                    <div class="product-details-large tab-content">
                                        <div class="tab-pane active" id="pro-details1">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/roda1c.jpg">
                                                    <img src="assets/img/product-details/roda1c.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        
                                </div>
                            </div>
                        </div>
						</div>
                        <div class="col-lg-6">
                            <div class="product-details-content">
                                <h2> Performance Machine Supra Real Wheel </h2>
                                <div class="quick-view-rating">
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star-half-empty"></i>
                                    <span> ( 1 Customer Review )</span>
                                </div>
                                <div class="product-price">
                                    <span>1399 €</span>
                                </div>
                                <div class="product-overview">
                                    <h5 class="pd-sub-title">Resumo do Produto</h5>
                                    <p> As rodas Performance Machine Forged Aluminum são o carro-chefe de sua linha de rodas e as melhores rodas do mercado atualmente. 
                                    Essas rodas forjadas colocam a maior resistência do material na mesma direção da carga operacional, criando uma roda leve e forte.</p>
                                </div>
                                    <div class="quickview-btn-cart">
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_artigo" name="id_artigo" value="11">
                                        <input type="hidden" id="acao" name="acao" value="adicionar">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#rodasupra">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Adicionar ao Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_artigo" name="id_artigo" value="11">
                                        <input type="hidden" id="acao" name="acao" value="remover">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#rodasupra">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Remover do Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <br/>
                                    <?php 
                                    $retorno = feedback(11, "artigo");
                                    if ($retorno[0] == 11){
                                        echo $retorno[1];
                                    }?>
                                <div class="product-share">
                                    <h5 class="pd-sub-title">Partilhar</h5>
                                    <ul>
										<li class="facebook"><a href="https://www.facebook.com/Http404-104014971631032"><i class="icofont icofont-social-facebook"></i></a></li>
										<li class="twitter"><a href="https://twitter.com/Http404V"><i class="icofont icofont-social-twitter"></i></a></li> 
									</ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>	
			<div id=radioadorninja class="product-details-area fluid-padding-3 ptb-130">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-details-img-content">
                                <div class="product-details-tab mr-40">
                                    <div class="product-details-large tab-content">
                                        <div class="tab-pane active" id="pro-details1">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/radiador1.jpg">
                                                    <img src="assets/img/product-details/radiador1.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        
                                </div>
                            </div>
                        </div>
						</div>
                        <div class="col-lg-6">
                            <div class="product-details-content">
                                <h2> Motorcycle Radiator Cooler For Kawasaki Ninja </h2>
                                <div class="quick-view-rating">
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star-half-empty"></i>
                                    <span> ( 1 Customer Review )</span>
                                </div>
                                <div class="product-price">
                                    <span>83 €</span>
                                </div>
                                <div class="product-overview">
                                    <h5 class="pd-sub-title">Resumo do Produto</h5>
                                    <p> Feito de alumínio de alta qualidade, multicamadas para garantir a dissipação de calor, fabricação profissional, alto desempenho e durável. 
                                    Com o objetivo de fazer seu veículo funcionar com mais eficiência, o resfriador de óleo pode resfriar rapidamente o óleo, reduzir o desgaste do motor, 
                                    aumentar a potência, melhorar a função de dissipação de calor do motor, e garantir um alto desempenho, tornar o seu motor mais potente!</p>
                                </div>
                                    <div class="quickview-btn-cart">
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_artigo" name="id_artigo" value="12">
                                        <input type="hidden" id="acao" name="acao" value="adicionar">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#radioadorninja">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Adicionar ao Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_artigo" name="id_artigo" value="12">
                                        <input type="hidden" id="acao" name="acao" value="remover">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#radioadorninja">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Remover do Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <br/>
                                    <?php 
                                    $retorno = feedback(12, "artigo");
                                    if ($retorno[0] == 12){
                                        echo $retorno[1];
                                    }?>
                                <div class="product-share">
                                    <h5 class="pd-sub-title">Partilhar</h5>
                                    <ul>
										<li class="facebook"><a href="https://www.facebook.com/Http404-104014971631032"><i class="icofont icofont-social-facebook"></i></a></li>
										<li class="twitter"><a href="https://twitter.com/Http404V"><i class="icofont icofont-social-twitter"></i></a></li> 
									</ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>	
			<div id=bancomoto class="product-details-area fluid-padding-3 ptb-130">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-details-img-content">
                                <div class="product-details-tab mr-40">
                                    <div class="product-details-large tab-content">
                                        <div class="tab-pane active" id="pro-details1">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/assento1.jpg">
                                                    <img src="assets/img/product-details/assento1.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        
                                </div>
                            </div>
                        </div>
						</div>
                        <div class="col-lg-6">
                            <div class="product-details-content">
                                <h2> Universal Motorcycle Retro Diamond Flat Style Seat </h2>
                                <div class="quick-view-rating">
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star-half-empty"></i>
                                    <span> ( 1 Customer Review )</span>
                                </div>
                                <div class="product-price">
                                    <span>40 €</span>
                                </div>
                                <div class="product-overview">
                                    <h5 class="pd-sub-title">Resumo do Produto</h5>
                                    <p>Couro durável, impermeável e flexível de alta qualidade, inclui três suportes de metal removíveis e seis parafusos e porcas.</p>
                                </div>
                                    <div class="quickview-btn-cart">
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_artigo" name="id_artigo" value="13">
                                        <input type="hidden" id="acao" name="acao" value="adicionar">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#bancomoto">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Adicionar ao Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_artigo" name="id_artigo" value="13">
                                        <input type="hidden" id="acao" name="acao" value="remover">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#bancomoto">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Remover do Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <br/>
                                    <?php 
                                    $retorno = feedback(13, "artigo");
                                    if ($retorno[0] == 13){
                                        echo $retorno[1];
                                    }?>
                                <div class="product-share">
                                    <h5 class="pd-sub-title">Partilhar</h5>
                                    <ul>
										<li class="facebook"><a href="https://www.facebook.com/Http404-104014971631032"><i class="icofont icofont-social-facebook"></i></a></li>
										<li class="twitter"><a href="https://twitter.com/Http404V"><i class="icofont icofont-social-twitter"></i></a></li> 
									</ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>	
				<div id=farol class="product-details-area fluid-padding-3 ptb-130">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-details-img-content">
                                <div class="product-details-tab mr-40">
                                    <div class="product-details-large tab-content">
                                        <div class="tab-pane active" id="pro-details1">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/luz1.jpg">
                                                    <img src="assets/img/product-details/luz1.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        
                                </div>
                            </div>
                        </div>
						</div>
                        <div class="col-lg-6">
                            <div class="product-details-content">
                                <h2> Halo Motorcycle Headlight </h2>
                                <div class="quick-view-rating">
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star-half-empty"></i>
                                    <span> ( 1 Customer Review )</span>
                                </div>
                                <div class="product-price">
                                    <span>79 €</span>
                                </div>
                                <div class="product-overview">
                                    <h5 class="pd-sub-title">Resumo do Produto</h5>
                                    <p>O farol Halo tem 5,75 polegadas de diâmetro e pode ser montado na lateral ou na parte inferior do veiculo. 
                                    Tem uma característica HALO quando em uso, LEDs brancos brilham em um anel ao redor da borda do refletor. 
                                    Tem um corpo de estilo clássico de rua.</p>
                                </div>
                                    <div class="quickview-btn-cart">
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_artigo" name="id_artigo" value="14">
                                        <input type="hidden" id="acao" name="acao" value="adicionar">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#farol">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Adicionar ao Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_artigo" name="id_artigo" value="14">
                                        <input type="hidden" id="acao" name="acao" value="remover">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#farol">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Remover do Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <br/>
                                    <?php 
                                    $retorno = feedback(14, "artigo");
                                    if ($retorno[0] == 14){
                                        echo $retorno[1];
                                    }?>
                                <div class="product-share">
                                    <h5 class="pd-sub-title">Partilhar</h5>
                                   <ul>
										<li class="facebook"><a href="https://www.facebook.com/Http404-104014971631032"><i class="icofont icofont-social-facebook"></i></a></li>
										<li class="twitter"><a href="https://twitter.com/Http404V"><i class="icofont icofont-social-twitter"></i></a></li> 
									</ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div id=tanque class="product-details-area fluid-padding-3 ptb-130">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-details-img-content">
                                <div class="product-details-tab mr-40">
                                    <div class="product-details-large tab-content">
                                        <div class="tab-pane active" id="pro-details1">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/tanque1.jpg">
                                                    <img src="assets/img/product-details/tanque1.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        
                                </div>
                            </div>
                        </div>
						</div>
                        <div class="col-lg-6">
                            <div class="product-details-content">
                                <h2>Dished Wassell Peanut Motorcycle Gas Tank </h2>
                                <div class="quick-view-rating">
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star-half-empty"></i>
                                    <span> ( 1 Customer Review )</span>
                                </div>
                                <div class="product-price">
                                    <span>199 €</span>
                                </div>
                                <div class="product-overview">
                                    <h5 class="pd-sub-title">Resumo do Produto</h5>
                                    <p>Este tanque de gasolina estilo Wassell é uma volta às bicicletas de demonstração dos anos sessenta. 
                                    O disco embutido combina perfeitamente com as linhas externas do tanque e é formado durante o processo de 
                                    estampagem. Ao contrário de outros tanques que cortam os painéis e os soldam de volta ao contrário, 
                                    nossas bordas são perfeitamente lisas. Por ser uma peça de um só carimbo, você não terá que se preocupar com 
                                    rachaduras nas costuras de solda ou gastar muito tempo preparando a tinta. Este é um tanque de montagem Frisco, 
                                    portanto, ficará no alto do backbone.</p>
                                </div>
                                    <div class="quickview-btn-cart">
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_artigo" name="id_artigo" value="15">
                                        <input type="hidden" id="acao" name="acao" value="adicionar">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#tanque">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Adicionar ao Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_artigo" name="id_artigo" value="15">
                                        <input type="hidden" id="acao" name="acao" value="remover">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#tanque">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Remover do Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <br/>
                                    <?php 
                                    $retorno = feedback(15, "artigo");
                                    if ($retorno[0] == 15){
                                        echo $retorno[1];
                                    }?>
                                <div class="product-share">
                                    <h5 class="pd-sub-title">Partilhar</h5>
                                   <ul>
										<li class="facebook"><a href="https://www.facebook.com/Http404-104014971631032"><i class="icofont icofont-social-facebook"></i></a></li>
										<li class="twitter"><a href="https://twitter.com/Http404V"><i class="icofont icofont-social-twitter"></i></a></li> 
									</ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div id=velocimetro class="product-details-area fluid-padding-3 ptb-130">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-details-img-content">
                                <div class="product-details-tab mr-40">
                                    <div class="product-details-large tab-content">
                                        <div class="tab-pane active" id="pro-details1">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/velocimetro1.jpg">
                                                    <img src="assets/img/product-details/velocimetro1.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        
                                </div>
                            </div>
                        </div>
						</div>
                        <div class="col-lg-6">
                            <div class="product-details-content">
                                <h2>Fydun Motorcycle Speedometer</h2>
                                <div class="quick-view-rating">
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star-half-empty"></i>
                                    <span> ( 1 Customer Review )</span>
                                </div>
                                <div class="product-price">
                                    <span>69 €</span>
                                </div>
                                <div class="product-overview">
                                    <h5 class="pd-sub-title">Resumo do Produto</h5>
                                    <p>Este é um velocímetro digital LCD, que pode indicar sua velocidade com precisão, e com isso aumentar sua segurança rodoviária. 
                                    O velocímetro é feito de robusta carcaça de ABS galvanizado, totalmente à prova d'água e permite resistir a pequenas colisões</p>
                                </div>
                                    <div class="quickview-btn-cart">
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_artigo" name="id_artigo" value="16">
                                        <input type="hidden" id="acao" name="acao" value="adicionar">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#velocimetro">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Adicionar ao Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_artigo" name="id_artigo" value="16">
                                        <input type="hidden" id="acao" name="acao" value="remover">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#velocimetro">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Remover do Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <br/>
                                    <?php 
                                    $retorno = feedback(16, "artigo");
                                    if ($retorno[0] == 16){
                                        echo $retorno[1];
                                    }?>
                                <div class="product-share">
                                    <h5 class="pd-sub-title">Partilhar</h5>
                                   <ul>
										<li class="facebook"><a href="https://www.facebook.com/Http404-104014971631032"><i class="icofont icofont-social-facebook"></i></a></li>
										<li class="twitter"><a href="https://twitter.com/Http404V"><i class="icofont icofont-social-twitter"></i></a></li> 
									</ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div id=medidor class="product-details-area fluid-padding-3 ptb-130">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-details-img-content">
                                <div class="product-details-tab mr-40">
                                    <div class="product-details-large tab-content">
                                        <div class="tab-pane active" id="pro-details1">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/combustivel1.jpg">
                                                    <img src="assets/img/product-details/combustivel1.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        
                                </div>
                            </div>
                        </div>
						</div>
                        <div class="col-lg-6">
                            <div class="product-details-content">
                                <h2>Racetech Fuel Level Gauge</h2>
                                <div class="quick-view-rating">
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star-half-empty"></i>
                                    <span> ( 1 Customer Review )</span>
                                </div>
                                <div class="product-price">
                                    <span>40 €</span>
                                </div>
                                <div class="product-overview">
                                    <h5 class="pd-sub-title">Resumo do Produto</h5>
                                    <p>Medidor elétrico de nível do tanque de combustível Racetech. 52 mm de diâmetro, face preta, moldura preta, 
                                    iluminada para uso noturno.</p>
                                </div>
                                    <div class="quickview-btn-cart">
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_artigo" name="id_artigo" value="119">
                                        <input type="hidden" id="acao" name="acao" value="adicionar">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#medidor">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Adicionar ao Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_artigo" name="id_artigo" value="119">
                                        <input type="hidden" id="acao" name="acao" value="remover">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#medidor">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Remover do Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <br/>
                                    <?php 
                                    $retorno = feedback(119, "artigo");
                                    if ($retorno[0] == 119){
                                        echo $retorno[1];
                                    }?>
                                <div class="product-share">
                                    <h5 class="pd-sub-title">Partilhar</h5>
                                   <ul>
										<li class="facebook"><a href="https://www.facebook.com/Http404-104014971631032"><i class="icofont icofont-social-facebook"></i></a></li>
										<li class="twitter"><a href="https://twitter.com/Http404V"><i class="icofont icofont-social-twitter"></i></a></li> 
									</ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div id=capacete class="product-details-area fluid-padding-3 ptb-130">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-details-img-content">
                                <div class="product-details-tab mr-40">
                                    <div class="product-details-large tab-content">
                                        <div class="tab-pane active" id="pro-details1">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/capacete1.jpg">
                                                    <img src="assets/img/product-details/capacete1.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        
                                </div>
                            </div>
                        </div>
						</div>
                        <div class="col-lg-6">
                            <div class="product-details-content">
                                <h2>Adult Full Face Matto Blue Helmet</h2>
                                <div class="quick-view-rating">
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star-half-empty"></i>
                                    <span> ( 1 Customer Review )</span>
                                </div>
                                <div class="product-price">
                                    <span>63.88€</span>
                                </div>
                                <div class="product-overview">
                                    <h5 class="pd-sub-title">Resumo do Produto</h5>
                                    <p>O capacete full face Typhoon K77 oferece um capacete leve para uso diário repleto de recursos e projetado para o conforto do viajante.
                                    Com ventilação ajustável e robusta, revestimento anti-umidade e canalização do fluxo de ar interno, 
                                    o K77 é perfeito para andar em climas quentes ou frios. Um protetor facial anti-riscos e resistente a impactos vem instalado com suportes 
                                    de troca rápida. Um defletor de respiração removível ajuda a reduzir a condensação e a manter o capacete fresco. Garantir um ajuste
                                    adequado e remover o capacete K77 é fácil graças à correia de liberação rápida.</p>
                                </div>
                                    <div class="quickview-btn-cart">
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_artigo" name="id_artigo" value="17">
                                        <input type="hidden" id="acao" name="acao" value="adicionar">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#capacete">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Adicionar ao Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_artigo" name="id_artigo" value="17">
                                        <input type="hidden" id="acao" name="acao" value="remover">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#capacete">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Remover do Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <br/>
                                    <?php 
                                    $retorno = feedback(17, "veiculo");
                                    if ($retorno[0] == 17){
                                        echo $retorno[1];
                                    }?>
                                <div class="product-share">
                                    <h5 class="pd-sub-title">Partilhar</h5>
                                   <ul>
										<li class="facebook"><a href="https://www.facebook.com/Http404-104014971631032"><i class="icofont icofont-social-facebook"></i></a></li>
										<li class="twitter"><a href="https://twitter.com/Http404V"><i class="icofont icofont-social-twitter"></i></a></li> 
									</ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div id=casaco class="product-details-area fluid-padding-3 ptb-130">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-details-img-content">
                                <div class="product-details-tab mr-40">
                                    <div class="product-details-large tab-content">
                                        <div class="tab-pane active" id="pro-details1">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/casaco1.jpg">
                                                    <img src="assets/img/product-details/casaco1.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        
                                </div>
                            </div>
                        </div>
						</div>
                        <div class="col-lg-6">
                            <div class="product-details-content">
                                <h2>Racing 3 Leather Jacket</h2>
                                <div class="quick-view-rating">
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star-half-empty"></i>
                                    <span> ( 1 Customer Review )</span>
                                </div>
                                <div class="product-price">
                                    <span>489€</span>
                                </div>
                                <div class="product-overview">
                                    <h5 class="pd-sub-title">Resumo do Produto</h5>
                                    <p>Couro resistente com entradas de ar e zonas de resfriamento perfuradas mantém o clima corporal da melhor forma. 
                                    Já o tecido S1 e as zonas elásticas Microelastic 2.0 em versões dedicadas para homens e mulheres garantem um ajuste perfeito. 
                                    Leve, flexível e ágil para viver a liberdade da estrada.</p>
                                </div>
                                    <div class="quickview-btn-cart">
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_artigo" name="id_artigo" value="18">
                                        <input type="hidden" id="acao" name="acao" value="adicionar">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#casaco">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Adicionar ao Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_artigo" name="id_artigo" value="18">
                                        <input type="hidden" id="acao" name="acao" value="remover">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#casaco">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Remover do Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <br/>
                                    <?php 
                                    $retorno = feedback(18, "artigo");
                                    if ($retorno[0] == 18){
                                        echo $retorno[1];
                                    }?>
                                <div class="product-share">
                                    <h5 class="pd-sub-title">Partilhar</h5>
                                  <ul>
									<li class="facebook"><a href="https://www.facebook.com/Http404-104014971631032"><i class="icofont icofont-social-facebook"></i></a></li>
									<li class="twitter"><a href="https://twitter.com/Http404V"><i class="icofont icofont-social-twitter"></i></a></li> 
								</ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div id=botas class="product-details-area fluid-padding-3 ptb-130">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-details-img-content">
                                <div class="product-details-tab mr-40">
                                    <div class="product-details-large tab-content">
                                        <div class="tab-pane active" id="pro-details1">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/botas1.jpg">
                                                    <img src="assets/img/product-details/botas1.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        
                                </div>
                            </div>
                        </div>
						</div>
                        <div class="col-lg-6">
                            <div class="product-details-content">
                                <h2>FORMA Adventure Off-Road Motorcycle Boots</h2>
                                <div class="quick-view-rating">
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star-half-empty"></i>
                                    <span> ( 1 Customer Review )</span>
                                </div>
                                <div class="product-price">
                                    <span>270€</span>
                                </div>
                                <div class="product-overview">
                                    <h5 class="pd-sub-title">Resumo do Produto</h5>
                                    <p>Projetadas especificamente para pilotos ADV, as Botas de Aventura Forma combinam o conforto e a 
                                    flexibilidade de uma bota de estrada com os recursos de proteção e altura total de botas off-road. 
                                    Equipadas com acabamento em couro vintage e forro à prova d'água / respirável drytex, as botas Adventure
                                    mantêm seus pés secos sem limitar a amplitude de movimento. A sola de dupla densidade oferece excelente 
                                    aderência à bicicleta e oferece aos pilotos uma superfície confortável e aderente para caminhar quando 
                                    descem da bicicleta. Os reforços e inserções de TPU integrados fornecem proteção contra lesões por impacto
                                    e as fivelas de plástico GH inquebráveis ​​garantem que você não será afastado se sofrer uma queda.</p>
                                </div>
                                    <div class="quickview-btn-cart">
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_artigo" name="id_artigo" value="19">
                                        <input type="hidden" id="acao" name="acao" value="adicionar">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#botas">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Adicionar ao Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_artigo" name="id_artigo" value="19">
                                        <input type="hidden" id="acao" name="acao" value="remover">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#botas">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Remover do Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <br/>
                                    <?php 
                                    $retorno = feedback(19, "artigo");
                                    if ($retorno[0] == 19){
                                        echo $retorno[1];
                                    }?>
                                <div class="product-share">
                                    <h5 class="pd-sub-title">Partilhar</h5>
                                  <ul>
									<li class="facebook"><a href="https://www.facebook.com/Http404-104014971631032"><i class="icofont icofont-social-facebook"></i></a></li>
									<li class="twitter"><a href="https://twitter.com/Http404V"><i class="icofont icofont-social-twitter"></i></a></li> 
								</ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div id=joelheiras class="product-details-area fluid-padding-3 ptb-130">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-details-img-content">
                                <div class="product-details-tab mr-40">
                                    <div class="product-details-large tab-content">
                                        <div class="tab-pane active" id="pro-details1">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/joelheiras1.jpg">
                                                    <img src="assets/img/product-details/joelheiras1.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        
                                </div>
                            </div>
                        </div>
						</div>
                        <div class="col-lg-6">
                            <div class="product-details-content">
                                <h2>HEROBIKER Motorcycle Knee Pads</h2>
                                <div class="quick-view-rating">
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star-half-empty"></i>
                                    <span> ( 1 Customer Review )</span>
                                </div>
                                <div class="product-price">
                                    <span>36€</span>
                                </div>
                                <div class="product-overview">
                                    <h5 class="pd-sub-title">Resumo do Produto</h5>
                                    <p>Design para conforto e segurança e proteção profissional da marca Herobier, 
                                    ergonomicamente projetado para máxima mobilidade. Proteção ultra alta resistência: acolchoamento de espuma 
                                    EVA durável amortece seus joelhos por horas a fio. Um escudo espesso de poliéster protege contra cortes ou 
                                    arranhões em qualquer terreno.</p>
                                </div>
                                    <div class="quickview-btn-cart">
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_artigo" name="id_artigo" value="110">
                                        <input type="hidden" id="acao" name="acao" value="adicionar">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#joelheiras">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Adicionar ao Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_artigo" name="id_artigo" value="110">
                                        <input type="hidden" id="acao" name="acao" value="remover">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#joelheiras">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Remover do Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <br/>
                                    <?php 
                                    $retorno = feedback(110, "artigo");
                                    if ($retorno[0] == 110){
                                        echo $retorno[1];
                                    }?>
                                <div class="product-share">
                                    <h5 class="pd-sub-title">Partilhar</h5>
                                  <ul>
										<li class="facebook"><a href="https://www.facebook.com/Http404-104014971631032"><i class="icofont icofont-social-facebook"></i></a></li>
										<li class="twitter"><a href="https://twitter.com/Http404V"><i class="icofont icofont-social-twitter"></i></a></li> 
									</ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div id=capacete2 class="product-details-area fluid-padding-3 ptb-130">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-details-img-content">
                                <div class="product-details-tab mr-40">
                                    <div class="product-details-large tab-content">
                                        <div class="tab-pane active" id="pro-details1">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/capacete2.jpg">
                                                    <img src="assets/img/product-details/capacete2.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        
                                </div>
                            </div>
                        </div>
						</div>
                        <div class="col-lg-6">
                            <div class="product-details-content">
                                <h2>LS2 Helmets Full Face Blaze Adventure Motorcycle Helmet, Matte Titanium 436B-103</h2>
                                <div class="quick-view-rating">
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star-half-empty"></i>
                                    <span> ( 1 Customer Review )</span>
                                </div>
                                <div class="product-price">
                                    <span>134€</span>
                                </div>
                                <div class="product-overview">
                                    <h5 class="pd-sub-title">Resumo do Produto</h5>
                                    <p>Capacete LS2 MX436 Pioneer Evo Titanio. Capacete extremamente versátil concebido para ser usado em qualquer 
                                    terreno e em qualquer circunstância. Dispõe de visor solar integrado e de uma boa ventilação,
                                    com múltiplas entradas e saídas de ar.</p>
                                </div>
                                    <div class="quickview-btn-cart">
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_artigo" name="id_artigo" value="112">
                                        <input type="hidden" id="acao" name="acao" value="adicionar">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#capacete2">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Adicionar ao Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_artigo" name="id_artigo" value="112">
                                        <input type="hidden" id="acao" name="acao" value="remover">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#capacete2">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Remover do Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <br/>
                                    <?php 
                                    $retorno = feedback(112, "artigo");
                                    if ($retorno[0] == 112){
                                        echo $retorno[1];
                                    }?>
                                <div class="product-share">
                                    <h5 class="pd-sub-title">Partilhar</h5>
                                  <ul>
										<li class="facebook"><a href="https://www.facebook.com/Http404-104014971631032"><i class="icofont icofont-social-facebook"></i></a></li>
										<li class="twitter"><a href="https://twitter.com/Http404V"><i class="icofont icofont-social-twitter"></i></a></li> 
									</ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div id=cobertos class="product-details-area fluid-padding-3 ptb-130">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-details-img-content">
                                <div class="product-details-tab mr-40">
                                    <div class="product-details-large tab-content">
                                        <div class="tab-pane active" id="pro-details1">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/capadiversos.png">
                                                    <img src="assets/img/product-details/capadiversos.png" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        
                                </div>
                            </div>
                        </div>
						</div>
                        <div class="col-lg-6">
                            <div class="product-details-content">
                                <h2>SUNFLOWER CAR</h2>
                                <div class="quick-view-rating">
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star-half-empty"></i>
                                    <span> ( 1 Customer Review )</span>
                                </div>
                                <div class="product-price">
                                    <span>95€</span>
                                </div>
                                <div class="product-overview">
                                    <h5 class="pd-sub-title">Resumo do Produto</h5>
                                    <p>12 Peças fáceis de instalar com tema de girassol. Inclui 1 capa de volante em girassol, 2 capas de assento dianteiro de carro, 
                                    1 capa de console central em girassol, 2 bases para copos de girassóis para carro, 2 anéis de girassóis diferentes, 
                                    2 ambientadores de girassol para carros e 2 bases para copos de carro. 
                                    Todos os 12 acessórios estarão em uma linda caixa de presente azul, 
                                    este é absolutamente o presente perfeito para sua família e amigos.</p>
                                </div>
                                    <div class="quickview-btn-cart">
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_artigo" name="id_artigo" value="113">
                                        <input type="hidden" id="acao" name="acao" value="adicionar">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#cobertos">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Adicionar ao Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_artigo" name="id_artigo" value="113">
                                        <input type="hidden" id="acao" name="acao" value="remover">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#cobertos">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Remover do Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <br/>
                                    <?php 
                                    $retorno = feedback(113, "artigo");
                                    if ($retorno[0] == 113){
                                        echo $retorno[1];
                                    }?>
                                <div class="product-share">
                                    <h5 class="pd-sub-title">Partilhar</h5>
                                  <ul>
										<li class="facebook"><a href="https://www.facebook.com/Http404-104014971631032"><i class="icofont icofont-social-facebook"></i></a></li>
										<li class="twitter"><a href="https://twitter.com/Http404V"><i class="icofont icofont-social-twitter"></i></a></li> 
								</ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div id=capa class="product-details-area fluid-padding-3 ptb-130">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-details-img-content">
                                <div class="product-details-tab mr-40">
                                    <div class="product-details-large tab-content">
                                        <div class="tab-pane active" id="pro-details1">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/cobertoracarro.jpg">
                                                    <img src="assets/img/product-details/cobertorcarro.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        
                                </div>
                            </div>
                        </div>
						</div>
                        <div class="col-lg-6">
                            <div class="product-details-content">
                                <h2>Waterproof Car Cover - Large Sedan</h2>
                                <div class="quick-view-rating">
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star-half-empty"></i>
                                    <span> ( 1 Customer Review )</span>
                                </div>
                                <div class="product-price">
                                    <span>90€</span>
                                </div>
                                <div class="product-overview">
                                    <h5 class="pd-sub-title">Resumo do Produto</h5>
                                    <p> Capa de carro feita de material grosso e durável com uma parte inferior macia semelhante a lã. 
                                    Protege contra cortes, arranhões, sujeira e outros elementos externos, costuras seladas garantem desempenho à prova de água. 
                                    Inclui um saco para armazenar a capa quando não estiver em uso. Esta capa cabe em carros de até 204 polegadas de comprimento.</p>
                                </div>
                                    <div class="quickview-btn-cart">
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_artigo" name="id_artigo" value="114">
                                        <input type="hidden" id="acao" name="acao" value="adicionar">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#capa">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Adicionar ao Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_artigo" name="id_artigo" value="114">
                                        <input type="hidden" id="acao" name="acao" value="remover">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#capa">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Remover do Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <br/>
                                    <?php 
                                    $retorno = feedback(114, "artigo");
                                    if ($retorno[0] == 114){
                                        echo $retorno[1];
                                    }?>
                                <div class="product-share">
                                    <h5 class="pd-sub-title">Partilhar</h5>
                                   <ul>
										<li class="facebook"><a href="https://www.facebook.com/Http404-104014971631032"><i class="icofont icofont-social-facebook"></i></a></li>
										<li class="twitter"><a href="https://twitter.com/Http404V"><i class="icofont icofont-social-twitter"></i></a></li> 
									</ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div id=organizador class="product-details-area fluid-padding-3 ptb-130">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-details-img-content">
                                <div class="product-details-tab mr-40">
                                    <div class="product-details-large tab-content">
                                        <div class="tab-pane active" id="pro-details1">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/organizador.png">
                                                    <img src="assets/img/product-details/organizador.png" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        
                                </div>
                            </div>
                        </div>
						</div>
                        <div class="col-lg-6">
                            <div class="product-details-content">
                                <h2>Organizador de itens</h2>
                                <div class="quick-view-rating">
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star-half-empty"></i>
                                    <span> ( 1 Customer Review )</span>
                                </div>
                                <div class="product-price">
                                    <span>25€</span>
                                </div>
                                <div class="product-overview">
                                    <h5 class="pd-sub-title">Resumo do Produto</h5>
                                    <p>Organizador de carro grande: tamanho perfeito de 24 x 16 para todos os tipos de veículos, 
                                    correias superiores e inferiores ajustáveis ​​que permanecem ocultas e fora do caminho para que o passageiro dianteiro 
                                    e o motorista não as sintam. Tecido resistente à água e lavável à máquina para fácil manutenção, 9 Bolsos no banco traseiro 
                                    de armazenamento: vários compartimentos de armazenamento para armazenamento prático de lanches, brinquedos infantis, 
                                    garrafas de água, bebidas, livros, revistas, CD, mais bolsos de armazenamento do que outros vendedores. </p>
                                </div>
                                    <div class="quickview-btn-cart">
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_artigo" name="id_artigo" value="115">
                                        <input type="hidden" id="acao" name="acao" value="adicionar">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#organizador">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Adicionar ao Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_artigo" name="id_artigo" value="115">
                                        <input type="hidden" id="acao" name="acao" value="remover">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#organizador">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Remover do Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <br/>
                                    <?php 
                                    $retorno = feedback(115, "artigo");
                                    if ($retorno[0] == 115){
                                        echo $retorno[1];
                                    }?>
                                <div class="product-share">
                                    <h5 class="pd-sub-title">Partilhar</h5>
                                   <ul>
										<li class="facebook"><a href="https://www.facebook.com/Http404-104014971631032"><i class="icofont icofont-social-facebook"></i></a></li>
										<li class="twitter"><a href="https://twitter.com/Http404V"><i class="icofont icofont-social-twitter"></i></a></li> 
									</ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div id=luzes class="product-details-area fluid-padding-3 ptb-130">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-details-img-content">
                                <div class="product-details-tab mr-40">
                                    <div class="product-details-large tab-content">
                                        <div class="tab-pane active" id="pro-details1">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/luzcarro.png">
                                                    <img src="assets/img/product-details/luzcarro.png" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        
                                </div>
                            </div>
                        </div>
						</div>
                        <div class="col-lg-6">
                            <div class="product-details-content">
                                <h2> Govee luzes interiores para carro </h2>
                                <div class="quick-view-rating">
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star-half-empty"></i>
                                    <span> ( 1 Customer Review )</span>
                                </div>
                                <div class="product-price">
                                    <span>25 €</span>
                                </div>
                                <div class="product-overview">
                                    <h5 class="pd-sub-title">Resumo do Produto</h5>
									<p>Design de 2 linhas: possui 2 linhas conectando 4 luzes de faixa, fios longos e
                                    adequados para qualquer modelo de carro. Existem 2 métodos de controle: por meio do aplicativo ou através do controlador
                                    Govee Home, que controla as luzes através de um sensor avançado: com um microfone embutido
                                    a faixa de luzes muda de cor de acordo com o ritmo da música. Luzes Multi-cores: personalize as cores que deseja 
                                    para aprimorar o seu carro.</p>
                                </div>
                                    <div class="quickview-btn-cart">
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_artigo" name="id_artigo" value="116">
                                        <input type="hidden" id="acao" name="acao" value="adicionar">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#luzes">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Adicionar ao Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_artigo" name="id_artigo" value="116">
                                        <input type="hidden" id="acao" name="acao" value="remover">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#luzes">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Remover do Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <br/>
                                    <?php 
                                    $retorno = feedback(116, "artigo");
                                    if ($retorno[0] == 116){
                                        echo $retorno[1];
                                    }?>
                                <div class="product-share">
                                    <h5 class="pd-sub-title">Partilhar</h5>
                                  <ul>
									<li class="facebook"><a href="https://www.facebook.com/Http404-104014971631032"><i class="icofont icofont-social-facebook"></i></a></li>
									<li class="twitter"><a href="https://twitter.com/Http404V"><i class="icofont icofont-social-twitter"></i></a></li> 
								</ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div id=holder class="product-details-area fluid-padding-3 ptb-130">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-details-img-content">
                                <div class="product-details-tab mr-40">
                                    <div class="product-details-large tab-content">
                                        <div class="tab-pane active" id="pro-details1">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/phoneholder.png">
                                                    <img src="assets/img/product-details/phoneholder.png" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        
                                </div>
                            </div>
                        </div>
						</div>
                        <div class="col-lg-6">
                            <div class="product-details-content">
                                <h2>PhoneHolder</h2>
                                <div class="quick-view-rating">
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star-half-empty"></i>
                                    <span> ( 1 Customer Review )</span>
                                </div>
                                <div class="product-price">
                                    <span>20 €</span>
                                </div>
                                <div class="product-overview">
                                    <h5 class="pd-sub-title">Resumo do Produto</h5>
									<p>As duas metades do suporte são conectadas por um mecanismo de mola. 
                                    o smartphone fica preso na abertura do suporte entre duas almofadas 
                                    de borracha fina, design extremamente simples. O revestimento externo de plástico sólido 
                                    fecha e depois fica plano no suporte. Suporte universal para de qualquer tipo de dispositivo entre
                                    3,5 a 5,5 polegadas. Também pode ser usado por diferentes motoristas de carro em diferentes 
                                    posições. Não há resíduos de adesivo no painel. </p>
                                </div>
                                    <div class="quickview-btn-cart">
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_artigo" name="id_artigo" value="117">
                                        <input type="hidden" id="acao" name="acao" value="adicionar">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#holder">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Adicionar ao Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_artigo" name="id_artigo" value="117">
                                        <input type="hidden" id="acao" name="acao" value="remover">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#holder">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Remover do Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <br/>
                                    <?php 
                                    $retorno = feedback(117, "artigo");
                                    if ($retorno[0] == 117){
                                        echo $retorno[1];
                                    }?>
                                <div class="product-share">
                                    <h5 class="pd-sub-title">Partilhar</h5>
                                  <ul>
										<li class="facebook"><a href="https://www.facebook.com/Http404-104014971631032"><i class="icofont icofont-social-facebook"></i></a></li>
										<li class="twitter"><a href="https://twitter.com/Http404V"><i class="icofont icofont-social-twitter"></i></a></li> 
									</ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div id=capavolante class="product-details-area fluid-padding-3 ptb-130">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-details-img-content">
                                <div class="product-details-tab mr-40">
                                    <div class="product-details-large tab-content">
                                        <div class="tab-pane active" id="pro-details1">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/capavolante.jpg">
                                                    <img src="assets/img/product-details/capavolante.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        
                                </div>
                            </div>
                        </div>
						</div>
                        <div class="col-lg-6">
                            <div class="product-details-content">
                                <h2>Capa para volante</h2>
                                <div class="quick-view-rating">
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star-half-empty"></i>
                                    <span> ( 1 Customer Review )</span>
                                </div>
                                <div class="product-price">
                                    <span>3 €</span>
                                </div>
                                <div class="product-overview">
                                    <h5 class="pd-sub-title">Resumo do Produto</h5>
									<p>Tampa do volante do carro respirável antiderrapante de couro para volante, 
                                    adequado para 37-38 cm. Decoração de fibra de carbono </p>
                                </div>
                                    <div class="quickview-btn-cart">
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_artigo" name="id_artigo" value="118">
                                        <input type="hidden" id="acao" name="acao" value="adicionar">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#capavolante">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Adicionar ao Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <form method="get" action="carrinho.php">
                                        <input type="hidden" id="id_artigo" name="id_artigo" value="118">
                                        <input type="hidden" id="acao" name="acao" value="remover">
                                        <input type="hidden" id="voltar_para" name="voltar_para" value="product-details.php#capavolante">
                                        <input class="btn-style cr-btn" name="mudar_carrinho" value="Remover do Carrinho" type="submit" style="cursor: pointer"></input>
                                    </form>
                                    <br/>
                                    <?php 
                                    $retorno = feedback(118, "artigo");
                                    if ($retorno[0] == 118){
                                        echo $retorno[1];
                                    }?>
                                <div class="product-share">
                                    <h5 class="pd-sub-title">Partilhar</h5>
                                    <ul>
										<li class="facebook"><a href="https://www.facebook.com/Http404-104014971631032"><i class="icofont icofont-social-facebook"></i></a></li>
										<li class="twitter"><a href="https://twitter.com/Http404V"><i class="icofont icofont-social-twitter"></i></a></li> 
									</ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                        <p><span>HTTP4</span> A maior loja de veiculos online </p>
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