<?php 
// Desabilita a demonstração de erros, para que não haja a possibilidade de aparecer erros para o usuário final
ini_set('display_errors', 0);
session_start();

// Definição de variáveis
$total_valor_produtos = 0;
$num_produtos_total = 0;
$veiculo_nome = "";
$line_cost = 0;
$total_veiculo = 0; 
$total_artigo = 0;
$tipo_produto = "";

// Apenas inicia o processo de um veiculo/artigo tiver sido adicionado ao carrinho através da loja
if(isset($_SESSION['produtos_veiculos']) || isset($_SESSION['produtos_artigos'])){
    
    // Se um artigo foi adicionado ao carrinho, define as variáveis do mesmo
    if(isset($_SESSION['produtos_artigos'])){
        $id_artigo = $_SESSION['id_artigo']['id_artigo'];

        $acao_artigo = $_SESSION['produtos_artigos'];
        $tipo_produto = "artigo";
    } 
    // Se um veiculo foi adicionado ao carrinho, define as variáveis do mesmo
    if(isset($_SESSION['produtos_veiculos'])){
        $id_veiculo =  $_SESSION['id_veiculo']['id_veiculo'];
        $id_veiculo = $id_veiculo[0];
        $acao_veiculo = $_SESSION['produtos_veiculos'];
        $tipo_produto = "veiculo";
    }
    
    $produtos = array();
    $prod_veiculos_antigos = array();
    if($tipo_produto == "veiculo"){

        // Condição que não permite que sejam definidos produtos que não tenham sido adicionados em carrinho.php(ou que foram removidos)
        if(isset($_SESSION['carrinho_veiculos'][$id_veiculo])){ 
            // Quantidade é definida em carrinho.php
            $quantidade_veiculo = $_SESSION['carrinho_veiculos'][$id_veiculo];       
            // Define o query da consulta e chama o ficheiro para conectar à base de dados
            $consulta = "SELECT modelo, marca, preco FROM veiculos WHERE IDVeiculo = '$id_veiculo'";
            $pass_users = 'http404#2021%';
            $cargo = "admin";
            include('database/selects_basedados.php');
            // Ciclo que extrai para variáveis o resultado da consulta

            if($dados) {
                foreach($dados as $linha){
                    $modelo = $linha['modelo'];
                    $marca = $linha['marca'];
                    $preco_veiculo = $linha['preco'];                                           
                }
            }

            // Define as variáveis finais
            $veiculo_nome = $marca.' '.$modelo;
            // Define o preço por veiculo
            $line_cost = $preco_veiculo * $quantidade_veiculo; 
            // Adiciona ao valor total
            $total_veiculo = $total_veiculo + $line_cost; 
            $sem_produtos = TRUE;
            // Caso já existam produtos no carrinho, se o novo produto for igual a um dos que já existem, redefine as posições do produto para o novo

            if(isset($_SESSION['produtos']['produtos'])){
                $produtos = $_SESSION['produtos']['produtos'];
                
                $num_produtos = count($produtos);
                for($produtos_repetidos = 0; $num_produtos > $produtos_repetidos; $produtos_repetidos++){
                    
                    if($veiculo_nome == $produtos[$produtos_repetidos]){
                        
                        $produtos[$produtos_repetidos] = $veiculo_nome;
                        $produtos[$produtos_repetidos + 1] = $quantidade_veiculo;
                        $produtos[$produtos_repetidos + 2] = $total_veiculo;
                        $sem_produtos = FALSE;
                        break;        
                    }
                }
            }
            // Caso não haja produtos, empurra os valores para o array dos produtos
            if($sem_produtos == TRUE){
                array_push($produtos, $veiculo_nome, $quantidade_veiculo, $total_veiculo);   
            }
        } else {
            $produtos = $_SESSION['produtos']['produtos'];
        
        }
    }
    echo $_SESSION['carrinho_artigos'][$id_artigo];
    // Caso um artigo tiver sido adicionado, repete o mesmo processo que o dos veículos
    if($tipo_produto == "artigo"){
        
        // Condição que não permite que sejam definidos produtos que não tenham sido adicionados em carrinho.php(ou que foram removidos)
        if(isset($_SESSION['carrinho_artigos'][$id_artigo])){
            
            // Quantidade é definida em carrinho_artigos.php
            $quantidade_artigo = $_SESSION['carrinho_artigos'][$id_artigo];
            $id_artigo = (substr($id_artigo, 1));
            // Conexão à base de dados
            $consulta = "SELECT nome, preco FROM artigos WHERE IDArtigo = '$id_artigo'";
            $pass_users = 'http404#2021%';
            $cargo = "admin";
            include('database/selects_basedados.php');

            // Ciclo para extrair resultado
            if($dados) {
                foreach($dados as $linha){

                    $nome = $linha['nome'];
                    $preco_artigo = $linha['preco'];                                           

                }
            }
            // Define o preço por artigo
            $line_cost = $preco_artigo * $quantidade_artigo; 
            // Adiciona ao valor total
            $total_artigo = $total_artigo + $line_cost; 
            $sem_produtos = TRUE;
            // Caso já existam produtos no carrinho, se o novo produto for igual a um dos que já existem, redefine as posições do produto para o novo
            if(isset($_SESSION['produtos']['produtos'])){
                $produtos = $_SESSION['produtos']['produtos'];
                $num_produtos = count($produtos);
                
                for($produtos_repetidos = 0; $num_produtos > $produtos_repetidos; $produtos_repetidos++){
                    
                    if($nome == $produtos[$produtos_repetidos]){
                        
                        $produtos[$produtos_repetidos] = $nome;
                        $produtos[$produtos_repetidos + 1] = $quantidade_artigo;
                        $produtos[$produtos_repetidos + 2] = $total_artigo;
                        $sem_produtos = FALSE;
                        break;
                    }
                }
            }
            // Caso não haja produtos, empurra os valores para o array dos produtos
            if($sem_produtos == TRUE){
                array_push($produtos, $nome, $quantidade_artigo, $total_artigo);   
            }
        }
    }
    // Transforma o array associativo session de todos os produtos para não permitir que o processo acima seja repetida apenas ao recarregar da página
    unset($_SESSION['produtos_veiculos']);
    unset($_SESSION['produtos_artigos']);
    // Guarda os produtos todos no array associativo
    if(isset($produtos)){
        $_SESSION['produtos']['produtos'] = $produtos;
    }
    // Caso o count de produtos seja igual a zero, significa que não há produtos, logo remove o array associativo dos produtos
    if(count($produtos) == 0){
        unset($_SESSION['produtos']['produtos']);
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
            <!-- Inicio da área do checkout -->
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
                                <?php if(isset($_SESSION['produtos']['produtos'])){?>
                                <div class="your-order-table table-responsive" >
                                    <table>
                                    <?php
                                    // Caso estejam definidos produtos no carrinho, guarda os produtos no array produtos
                                    $produtos = $_SESSION['produtos']['produtos'];
                                    $nomeproduto = 0; 
                                    $qntdproduto = 1;
                                    $precoproduto = 2;
                                    $num_produtos_total = count($produtos) / 3;
                                    $pos_preco = 2;                                                                   
                                    // Calcula o valor total da compra
                                    for($preco_veiculos = 0; $num_produtos_total > $preco_veiculos; $preco_veiculos++){  
                                        $total_valor_produtos += $produtos[$pos_preco];  
                                        $pos_preco += 3;
                                    // Apresenta todos os produtos para o cliente 
                                    }
                                    for($num_linhas = 0; $num_produtos_total > $num_linhas; $num_linhas++) {
                                        ?>
                                        <thead>
                                            <tr class="cart_item">
                                                <td id="teste" class="product-name">
                                                <label>Nome:</label>
                                                    <?php echo $produtos[$nomeproduto]; ?>   
                                                </td>
                                                <td>             
                                                <label>Quantidade:</label>
                                                    <strong><?php echo "X".$produtos[$qntdproduto];?></strong>
                                                </td>
                                                <td class="product-total">
                                                    <label>Preço:</label>
                                                    <span class="amount"><?php echo $produtos[$precoproduto];?>€</span>
                                                </td>
                                            </tr>
                                        </thead>
                                    <?php 
                                        // Adiciona mais três ao fim de cada ciclo para que aos posições corretas do produtos sejam apresentadas,
                                        // ex.: nome do produto 1 está na posição 0, enquanto o nome do produto 2 está na posição 3
                                        $nomeproduto += 3; 
                                        $qntdproduto += 3;
                                        $precoproduto += 3;
                                        }
                                    ?>
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
            <!-- Fim da área do checkout -->	
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
