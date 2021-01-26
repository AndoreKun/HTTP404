<?php
/** 
* Página do Checkout - Permite comprar produtos e limpar o carrinho
* @author Grupo HTTP404
* @version 5.2
* @since 26 dez 2020
*/ 
session_start();
/** Total do Valor dos produtos */
$total_valor_produtos = 0;
// Desabilita a demonstração de erros, para que não haja a possibilidade de aparecer erros para o usuário final
ini_set('display_errors', 0);
if(!isset($nome_produtos)){
    $nome_produtos = array();
}
// Define o Local e lingua 
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
?>
<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Checkout</title>
        <meta name="description" content="Página de Checkout de produtos">
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
        <script src="assets/js/mostraselecao.js"></script>
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
                        <div class="col-lg-6 col-md-12 col-12" >
                        <form id="auto-checkout" name="auto-checkout" method="post" action="">
                            <div id="elemento" name="elemento" style="display: none">
                            <h3>Digite o seu NIF e sua Senha de Checkout:</h3>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>NIF <span class="required">*</span></label>										
                                        <input name="nif_login" type="text" placeholder="" minlength="9" maxlength="9" required/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Senha<span class="required">*</span></label>										
                                        <input name="nif_password" type="password" placeholder="" minlength="6" maxlength="15" required/>
                                    </div>
                                    <div class="order-notes">
                                        <div class="checkout-form-list mrg-nn">
                                            <label>Informações adicionais</label>
                                            <textarea id="mais_informacoes_login" name="mais_informacoes_login" cols="30" rows="10" placeholder="Introduza aqui outras informações importantes relacionadas com a sua encomenda." ></textarea>
                                        </div>
                                </div>   
                                <h5>Novo por aqui? Insira seus dados de entrega e uma senha no formulário abaixo para habilitar o checkout automático!</h5>
                                <div class="order-button-payment">
                                    <input style="text-align: center;" id="login_autocheckout" name="login_autocheckout" type="submit" value="Fazer Pedido" />
                                    <br/><br/>
                                </div> 
                            </div> 
                        </div>
                        </form>
                            <form id="dados_entrega" name="dados_entrega" action="" method="post">
                                <div class="checkbox-form">						
                                    <h3>DADOS DE ENTREGA</h3>
                                    <div class="row">
                                        <!-- login de cliente para importar dados de checkout!-->
                                        <div id="dados_entrega_auto">
                                            <div class="col-md-12"> 
                                                <select id="cliente_exits" name="cliente_exits" required onchange="admSelectCheck(this, false)">
                                                    <option id="manual" name="cliente_novo" value="cliente_novo" selected>Inserir Dados de Checkout Manualmente</option>
                                                    <option id="opcao" name="cliente_existe" value="cliente_existe">Inserir Dados de Checkout Automaticamente</option>
                                                </select> 
                                            </div>  
                                        </div>
                                        <div class="col-md-12">
                                            <div class="country-select">
                                                <label>País<span class="required">*</span></label>
                                                <select name="pais" required>
                                                    <option value="">Selecione uma opção</option>
                                                    <option value="Portugal">Portugal</option>
                                                    <option value="Espanha">Espanha</option>
                                                    <option value="França">França</option>
                                                    <option value="Alemanha">Alemanha</option>
                                                    <option value="Inglaterra">Inglaterra</option>
                                                    <option value="China">China</option>
                                                    <option value="Korea">Korea</option>
                                                    <option value="Japao">Japão</option>                                                
                                                </select> 										
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Nome <span class="required">*</span></label>										
                                                <input name="nome" type="text" placeholder="" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Apelido <span class="required">*</span></label>										
                                                <input name="apelido" type="text" placeholder="" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>NIF <span class="required">*</span></label>										
                                                <input name="nif" type="text" placeholder="" minlength="9" maxlength="9" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label> Senha de Checkout<span class="required">*</span></label>										
                                                <input name="senha_checkout" type="password" placeholder="Digite uma Senha" minlength="6" maxlength="15" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Morada <span class="required">*</span></label>
                                                <input name="morada" type="text" placeholder="Rua..." required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">									
                                                <input name="mais_morada" type="text" placeholder="Apartamento, casa, unidade etc. (opcional)" />
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Localidade <span class="required">*</span></label>										
                                                <input name="localidade" type="text" placeholder="" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Código postal <span class="required">*</span></label>										
                                                <input name="cod_postal" type="text" maxlength="10"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Email<span class="required">*</span></label>										
                                                <input name="email" type="email" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Telemóvel <span class="required">*</span></label>										
                                                <input name="telemovel" type="text"  maxlength="12"/>
                                            </div>
                                        </div>
                                    <div id="carrinho"></div> 							
                                    </div>
                                        <div class="order-notes">
                                            <div class="checkout-form-list mrg-nn">
                                                <label>Informações adicionais</label>
                                                <textarea id="mais_informacoes" name="mais_informacoes" cols="30" rows="10" placeholder="Introduza aqui outras informações importantes relacionadas com a sua encomenda." ></textarea>
                                            </div>									
                                        </div>
                                    <div class="order-button-payment">
                                        <input id="fazer_pedido" name="fazer_pedido" type="submit" value="Fazer Pedido" />
                                        <br/><br/>
                                    </div>  
                                    </div>													
                                </div>
                            </form>
                        </div>
                        
                        <br/>
                        <!-- Revisão Encomenda !-->	
                        <div class="col-lg-6 col-md-12 col-12" style="text-align: center;">
                            <div class="your-order">
                                <h3>A SUA ENCOMENDA</h3>
                                <?php 
                                /** Caso esteja definido algum produto no array, imprime-os ao na secção de encomendas, senão imprime ao usuário que não existem produtos no carrinho */
                                if(isset($_SESSION['produtos']['produtos'])){?>
                                <div class="your-order-table table-responsive" >
                                    <table>
                                    <?php
                                    /** $produtos: Array com todos os produtos do Carrinho */
                                    $produtos = $_SESSION['produtos']['produtos'];
                                    /** $nomeproduto: Posição do nome dos produtos no array */
                                    $nomeproduto = 0; 
                                    /** $qntdproduto: Posição da quantidade dos produtos no array */
                                    $qntdproduto = 1;
                                    /** $precoproduto: Posição do preço dos produtos no array */
                                    $precoproduto = 2;
                                    /** $num_produtos_total: Número total de produtos */
                                    // Divide por 3 logo que cada produto possui ocupa 3 posições do array: 9 posições / 3 = 3 Produtos
                                    $num_produtos_total = count($produtos) / 3;
                                    /** $pos_preco: Posição do preço no array do produtos */
                                    $pos_preco = 2;                                                                   
                                    /** for($preco_veiculos = 0; $num_produtos_total > $preco_veiculos; $preco_veiculos++): Calcula o valor total da compra */
                                    for($preco_veiculos = 0; $num_produtos_total > $preco_veiculos; $preco_veiculos++){
                                        /** $total_valor_produtos: Valor Total dos produtos */  
                                        $total_valor_produtos += $produtos[$pos_preco];
                                        // Adiciona mais três logo que cada preço de produto está a 3 posições a frente de outro  
                                        $pos_preco += 3;
                                    }
                                    /** for($num_linhas = 0; $num_produtos_total > $num_linhas; $num_linhas++): Ciclo que apresenta todos os produtos para o cliente */
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
                                        array_push($nome_produtos, $produtos[$nomeproduto]);
                                        // Adiciona mais três ao fim de cada ciclo para que aos posições corretas do produtos sejam apresentadas,
                                        // ex.: nome do produto 1 está na posição 0, enquanto o nome do produto 2 está na posição 3
                                        $nomeproduto += 3; 
                                        $qntdproduto += 3;
                                        $precoproduto += 3;
                                        }
                                        $portes = 10; 
                                        $symbl = "€";
                                        if($total_valor_produtos > 99){
                                            $portes = 5; 
                                        }
                                        if($total_valor_produtos > 999){
                                            $portes = "Grátis";
                                            $symbl = "";
                                        }
                                        if($portes != "Grátis"){
                                            $total_valor_produtos = $total_valor_produtos + $portes;
                                        }
                                        
                                    ?>
                                        <tr class="cart_item">
                                            <th>Portes</th>
                                            <td>
                                                <strong><span class="amount">
                                                <?php echo $portes.$symbl?></span></strong>
                                            </td>
                                        </tr>
                                    
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
            <!-- Subscrição dos clientes -->	
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
                                        <form action="envia_email.php" method="post" id="markenting-emails" name="mc-embedded-subscribe-form" class="validate">
                                            <div id="mc_embed_signup_scroll" class="mc-form">
                                                <input type="email" id="email_interessado" name="email_interessado" class="email" placeholder="Deixe aqui o seu email..." required>
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
<?php
// Adiciona Cliente
$nif = "";
/** $dados_checkout: É verdadeiro quando existem dados de checkout(nome do cliente, morada, etc) para prevenir que o sistema faça o insert de uma venda apena ao carregar a página checkout */
$dados_checkout = FALSE;
/** $acao: Ação a ser feita com dados de entrega de clientes na base de dados(INSERT ou UPDATE) */
$acao = 'insert';
/** $adicionar_foto: Define se deseja adicionar uma foto no INSERT da base de dados */
$adicionar_foto = FALSE;
/** $cargo: Define o Cargo que será utilizado para fazer a ligação à base de dados */
$cargo = "admin";
/** $pass_users: Define a palavra passe do Cargo que será utilizado para fazer a ligação à base de dados */
$pass_users = "http404#2021%";
/** $mais_informacoes: Contém mais informações sobre a encomenda feita */
$mais_informacoes = "";
/** $nome_mais_informacoes: Contém o nome da coluna da base de dados em que será inserido as infomações */
$nome_mais_informacoes = "";
/** $mais_informacoes_insert: Define a sintaxe do insert de $mais_informacoes */
$mais_informacoes_insert = "";
/** $inserir_dados_login: Verdadeiro Caso esteja tudo pronto para adicionar os dados de login de checkout de clientes */
$inserir_dados_login = TRUE;

$acao_dados_login = 'insert';

/** if(isset($_POST['login_autocheckout'])): Caso o formulário que contém o checkout automatico de produtos for submetido, prepara essas infomações para o checkout*/
if(isset($_POST['login_autocheckout'])){
    /** $nif_login: nif do cliente, inserido no formulário */
    $nif_login = $_POST['nif_login'];
    /** $nif_password: senha do cliente, inserido no formulário */
    $nif_password = $_POST['nif_password'];
    /** if(isset($_POST['mais_informacoes_login'])): Caso no login automatico sejam inseridas mais informações sobre a encomenda, as prepara para adicionar à base de dados */
    if(isset($_POST['mais_informacoes_login'])){
        $mais_informacoes = $_POST['mais_informacoes_login'];
        $mais_informacoes_insert = ",'$mais_informacoes'";
        $nome_mais_informacoes = ", Informacoes_Encomenda";
    }
    /** $consulta: Query da consulta à base de dados */
    $consulta = "SELECT NIF_Cliente, Senha_Cliente FROM login_clientes WHERE NIF_Cliente = '$nif_login' AND Senha_Cliente = '$nif_password'";
    /** include('database/selects_basedados.php'): Inclui o script de consulta à base de dados */
    include('database/selects_basedados.php');
    /** if($dados): Caso o mesmo retorne dados significa que o login está correto, logo começa a preparar os dados para adicionar na base de dados 
     * Caso não retorne dados, limpa o array POST e imprime uma mensagem ao cliente que seu login está errado
     * Limpa o array POST para que não sejam enviados dados apenas ao recarregar a página
    */
    if($dados){
        // define que dados serão adicionados
        $dados_checkout = TRUE;
        $nif = $nif_login;
        $inserir_dados_login = FALSE;
        $_POST = array();
        /** unset($_POST): Limpa o array para que dados nao forem inseridos novamente na base de dados apenas ao carregar a pagina */
        unset($_POST);
    } else { 
        $dados_checkout = FALSE;
        // Limpa o array post
        $_POST = array(); 
        unset($_POST);
        echo  "<script type='text/javascript'>
                        alert('ATEN\u00c7\u00c4O, NIF ou Senha inv\u00e1lidos...');location.href='checkout.php'
                    </script>";
    }
}
/** if(isset($_POST['fazer_pedido'])): Caso o pedido for feito através de inserir dados manualmente no formulario em checkout, começa a preparar esse dados para enviar à base de dados */
if(isset($_POST['fazer_pedido'])){
    /** $nif: NIF do Cliente */
    $nif = $_POST['nif'];
    /** $consulta: Query da consulta */
    $consulta = "SELECT IDNIF_Cliente FROM clientes WHERE IDNIF_Cliente = '$nif'";
    /** include('database/selects_basedados.php'): Chama Script de consulta à base de dados */
    include('database/selects_basedados.php');
    /** Caso Retorne dados significa que o nif já existe na base de dados, logo define a acao como update */
    if($dados){
        /** $acao: Ao ser definida para 'update', vai atualizar os dados do cliente com aquele nif na base de dados */
        $acao = 'update';
        /** $acao_dados_login: Ao se definido para 'update', vai atualizar a password associado ao nif do cliente que foi introduzido*/
        $acao_dados_login = 'update';
    }
    /** $senha_checkout: Senha escolhida pelo utilizador para que possa usar a funcionalidade de chekout automatico */
    $senha_checkout = $_POST['senha_checkout'];
    /** $pais: Pais de residência do cliente */
    $pais = $_POST['pais'];
    $nome = $_POST['nome'];
    $apelido = $_POST['apelido'];
    /** $nome: Nome Completo do Cliente */
    $nome = $nome.' '.$apelido;
    /** $morada: Morada do cliente */
    $morada = $_POST['morada'];
    /** if(isset($_POST['mais_morada']): Caso exista mais morada(Definida na segunda linha do formulário) a concatena com morada para formar a morada completa do cliente */
    if(isset($_POST['mais_morada'])){
        $mais_morada = $_POST['mais_morada'];
        $morada = $morada." ".$mais_morada;
    }
    /** $localidade: Localidade do cliente */
    $localidade = $_POST['localidade'];
    /** $cod_postal: Código Postal do cliente */
    $cod_postal = $_POST['cod_postal'];
    /** $email: Email do cliente */
    $email = $_POST['email'];
    /** $telemovel: Telemovel do Cliente */
    $telemovel = $_POST['telemovel'];
    /** if(isset($_POST['mais_informacoes'])): Caso mais informações sobre a encomenda sejam definidas no formulário, as prepara para inserir na base de dados */
    if(isset($_POST['mais_informacoes'])){
        $mais_informacoes = $_POST['mais_informacoes'];
        $mais_informacoes_insert = ",'$mais_informacoes'";
        $nome_mais_informacoes = ", Informacoes_Encomenda";
    }
    /** if($acao == 'insert'): Caso a acao seja 'insert'(Dados colocados manualmente no formulário), os envia para a base de dados */
    if($acao == 'insert'){
        $insert = "INSERT INTO clientes(IDNIF_Cliente, Nome, Email, Telemovel, Pais, Morada, Cod_Postal, Localidade) 
        VALUES ('$nif', '$nome', '$email', '$telemovel', '$pais', '$morada', '$cod_postal', '$localidade')";
        include('database/inserts_basedados.php');
    /** elseif($acao == 'update'): Senão, se for 'update'(NIF do cliente já existe na base de dados), atualiza os dados de entrega do cliente */
    } elseif($acao == 'update') {
        $insert = "UPDATE clientes SET Nome='$nome', Email='$email', Telemovel='$telemovel', Pais='$pais', Morada='$morada', Cod_Postal='$cod_postal', Localidade='$localidade' WHERE IDNIF_Cliente = '$nif'";
        include('database/inserts_basedados.php');
    }
    /** $dados_checkout: Define os dados como prontos para fazer o checkout */
    $dados_checkout = TRUE;
    /** unset($_POST): Limpa o array para que dados nao forem inseridos novamente na base de dados apenas ao carregar a pagina */
    $_POST = array();
    unset($_POST);
}
// Adiciona Venda

/** $id_veiculo: ID do Veículo comprado, nulo caso não foram comprados veículos */
$id_veiculo = "";
/** $nome_coluna_veiculo: Nome da coluna na base de dados onde está o id de veículo, finalidade de caso id de veiculo seja nulo, o query do insert possa ser alterado */
$nome_coluna_veiculo = "";
/** $id_artigo: ID do Artigo comprado, nulo caso não foram comprados artigos */
$id_artigo = "";        
/** $nome_coluna_artigo: Nome da coluna na base de dados onde está o id de artigoo, finalidade de caso id de artigo seja nulo, o query do insert possa ser alterado */
$nome_coluna_artigo = "";
/** $id_veiculotmp: Variável guarda informações temporárias de veiculos*/
$id_veiculotmp = "";
/** $id_artigotmp: Variável guarda informações tempórarias de artigos */
$id_artigotmp = "";
/** $valor_produto: Valor total de um único produto */
$valor_produto = "";
/** if(isset($_SESSION['produtos']['produtos'])): Caso existam produtos no carrinho, passa a segunda verificação */
if(isset($_SESSION['produtos']['produtos'])){
    /** if($dados_checkout == TRUE): Caso os dados estiverem prontos para fazer checkout, começa a prepará-los para enviar à base de dados
     */
    if($dados_checkout == TRUE){
        /** for($posicao_produto = 0; $num_produtos_total > $posicao_produto; $posicao_produto++): Repete o ciclo o número de produtos em total dentro do carrinho 
        * Com a marca de um veiculo, define seu id com uma consulta. Caso dados foram retornados significa que $nome_produtos naquela posição é um veiculo, logo então
        * define as variáveis para inserir um veiculo na base de dados. Senão, significa que naquela posicao está um artigo e repete o mesmo processo
        */
        for($posicao_produto = 0; $num_produtos_total > $posicao_produto; $posicao_produto++) {
            // Testa Veículo
            $marca_veiculo = explode(" ", $nome_produtos[$posicao_produto]);
            /** $marca_veiculo_final: Marca do Veículo(s) Comprado */
            $marca_veiculo_final = $marca_veiculo[0];
            /** $consulta:  Query Consulta de veiculos e seus precos em funcao da marca */
            $consulta = "SELECT IDVeiculo, preco FROM veiculos WHERE marca = '$marca_veiculo_final'";
            // Script consulta
            include('database/selects_basedados.php');
            if($dados){
                /** foreach($dados as $linha): Repete o ciclo em função do número de linhas retornadas da base de dados */
                foreach($dados as $linha){
                    $id_veiculotmp = $linha['IDVeiculo'];
                    $preco_veiculo_insert = $linha['preco'];
                }
                /** $consulta: Consulta de marcas e modelos de veiculos em funcao do id */
                $consulta = "SELECT CONCAT(marca, ' ', modelo) AS veiculo_nome FROM veiculos WHERE IDVeiculo = '$id_veiculotmp'";
                include('database/selects_basedados.php');
                if($dados){
                    foreach($dados as $linha){
                        $veiculo_verificacao = $linha['veiculo_nome'];
                    }
                    if($veiculo_verificacao == $nome_produtos[$posicao_produto]){
                        $id_veiculo = ",'$id_veiculotmp'";
                        $nome_coluna_veiculo = ", IDVeiculo";
                        $valor_produto = $preco_veiculo_insert;
                    }
                }
            } else {
                // Testa Artigo
                $consulta = "SELECT IDArtigo, preco from artigos WHERE nome = '$nome_produtos[$posicao_produto]'";
                include('database/selects_basedados.php');
                if($dados){   
                    foreach($dados as $linha){
                        $id_artigotmp = $linha['IDArtigo'];
                        $preco_artigo_insert = $linha['preco'];
                    }
                    $id_artigo = ",'$id_artigotmp'";
                    $nome_coluna_artigo = ", IDArtigo";
                    $valor_produto = $preco_artigo_insert;
                    $id_veiculo = "";
                    $nome_coluna_veiculo = "";
                }
            }
            /** $insert: Faz a venda propriamente dita(INSERT na tabela vendas) dos valores finais definidos */
            $insert = "INSERT INTO vendas(IDNIF_Cliente$nome_coluna_veiculo$nome_coluna_artigo, ValorVenda, Venda_online$nome_mais_informacoes) 
            VALUES ('$nif'$id_veiculo$id_artigo, '$total_valor_produtos', 'Sim'$mais_informacoes_insert)";
            /** $acao: Define a Acao atual como insert na base de dados */
            $acao = 'insert';
            /** include('database/inserts_basedados.php'): Chama o Script de Inserts, Updates e deletes na base de dados */
            include('database/inserts_basedados.php');
            /** $data_atual: Define a data completa atual */
            $data_atual = date("Y-m-d H:i:s");
            /** if($inserir_dados_login == TRUE): Caso foi definido para inserir dados de login de checkout para o atual cliente, começa as operações para o mesmo */
            if($inserir_dados_login == TRUE){
                switch($acao_dados_login){
                    /** case 'insert': Caso a Ação seja de 'insert', insere os valores na base de dados */
                    case 'insert':
                        $insert = "INSERT INTO login_clientes(NIF_Cliente, Senha_Cliente) VALUES('$nif', '$senha_checkout')";
                        include('database/inserts_basedados.php');
                        break;
                    /** case 'insert': Caso a Ação seja de 'update', atualiza os valores na base de dados em função do nif do cliente atual */
                    case 'update':
                        $insert = "UPDATE login_clientes SET Senha_Cliente = '$senha_checkout' WHERE NIF_Cliente = '$nif'";
                        include('database/inserts_basedados.php');
                        break;
                }
            }
    }
    /** $compras_do_cliente: Array que Contém O Número da Venda, O nif do cliente, o Valor da Venda, a data da Venda e os portes */
    $compras_do_cliente = array();
    /** $consulta: query da consulta à base de dados, consulta todos os valores necessários para enviar para email do cliente*/
    $consulta = "SELECT v.IDVenda, v.ValorVenda, v.DataVenda, c.Nome, c.Email, c.Morada, c.Cod_Postal, c.Localidade, c.Pais, c.Telemovel FROM vendas AS v, clientes AS c 
    WHERE c.IDNIF_Cliente = '$nif' AND v.DataVenda = '$data_atual' ORDER BY v.DataVenda DESC";
    // Script de consulta na base de dados
    include('database/selects_basedados.php');
    if($dados){
        /** Caso Retorne dados,  repete o ciclo em função do número de linhas retornadas da consulta feita */
        foreach($dados as $linha){
            // Empurra para o array de $compras_do_cliente os dados relacionados com a encomenda feita
            array_push($compras_do_cliente, $linha['IDVenda'], $nif, $linha['ValorVenda'], $linha['DataVenda'], $portes);
            /** $endereço_enviado: Define o Endereço completo do cliente atual, para enviar como revisão para o email */
            $endereço_enviado = array($linha['Nome'], $linha['Email'], $linha['Morada'], $linha['Cod_Postal'], $linha['Localidade'], $linha['Pais'], $linha['Telemovel']);
        }
    }
    /** $_SESSION['compra_sucess']: Define o array associativo session com todos os dados para enviar ao email do cliente */
    $_SESSION['compra_sucess'] = array("sim", $mais_informacoes, $compras_do_cliente, $endereço_enviado);
    // Redireciona o cliente para compra_sucess.php
    echo "<script type='text/javascript'>
            location.href='compra_sucess.php'
            </script>";
    }
}
?>