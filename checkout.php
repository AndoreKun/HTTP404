<?php
/** 
* Página do Checkout - Permite comprar produtos e limpar o carrinho
* @author Grupo HTTP404
* @version 5.0
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
                        <div class="col-md-12">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-12" >
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
                                            <form>
                                            <div id="elemento" name="elemento" style="display: none">
                                                <div class="col-md-12">
                                                    <div class="checkout-form-list">
                                                        <label>NIF <span class="required">*</span></label>										
                                                        <input name="nif" type="text" placeholder="" minlength="9" maxlength="9" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="checkout-form-list">
                                                        <label>Password<span class="required">*</span></label>										
                                                        <input name="nif_password" type="text" placeholder="" minlength="5" required/>
                                                    </div>
                                                
                                                <div class="order-button-payment">
                                                    <input style="width: 350px; text-align: center;" id="login" name="login" type="submit" value="Login" />
                                                    <br/><br/>
                                                </div> 
                                                </div> 
                                            </div>
                                        </form>  
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
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>NIF <span class="required">*</span></label>										
                                                <input name="nif" type="text" placeholder="" minlength="9" maxlength="9" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Morada <span class="required">*</span></label>
                                                <input name="morada" type="text" placeholder="Rua.." required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">									
                                                <input name="mais_morada" type="text" placeholder="Apartamento, casa, unidade etc. (opcional)" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Cidade <span class="required">*</span></label>
                                                <input name="cidade" type="text" required/>
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
                                                <input name="cod_postal" type="text" />
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
                                                <input name="telemovel" type="text" />
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
                                        $total_valor_produtos = $total_valor_produtos + $portes;
                                        if($total_valor_produtos > 999){
                                            $portes = "Grátis";
                                            $symbl = "";
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
<?php
// Adiciona Cliente
$nif = "";
if(isset($_POST['fazer_pedido'])){
    $pais = $_POST['pais'];
    $nome = $_POST['nome'];
    $apelido = $_POST['apelido'];
    $nif = $_POST['nif'];
    $morada = $_POST['morada'];
    if(isset($_POST['mais_morada'])){
        $mais_morada = $_POST['mais_morada'];
        $morada = $morada." ".$mais_morada;
    }
    $cidade = $_POST['cidade'];
    $localidade = $_POST['localidade'];
    $cod_postal = $_POST['cod_postal'];
    $email = $_POST['email'];
    $telemovel = $_POST['telemovel'];
    $mais_informacoes = "";
    if(isset($_POST['mais_informacoes'])){
        $mais_informacoes = $_POST['mais_informacoes'];
    }
    $insert = "INSERT INTO clientes(IDNIF_Cliente, Nome, Email, Telemovel, Pais, Morada, Cod_Postal, Localidade) 
    VALUES ('$nif', '$nome', '$email', '$telemovel', '$pais', '$morada', '$cod_postal', '$localidade')";
    $cargo = "admin";
    $pass_users = "http404#2021%";
    $acao = 'insert';
    $feedback = "";
    $adicionar_foto = FALSE;
    include('database/inserts_basedados.php');

    // Adiciona Venda
    $id_veiculo = "";
    $nome_coluna_veiculo = "";
    $id_artigo = "";            
    $nome_coluna_artigo = "";
    $id_veiculotmp = "";
    $id_artigotmp = "";
    $valor_produto = "";
    $num_produtos_encomendados = 0;
   
    if(isset($_SESSION['produtos']['produtos'])){
        for($posicao_produto = 0; $num_produtos_total > $posicao_produto; $posicao_produto++) {
            $marca_veiculo = explode(" ", $nome_produtos[$posicao_produto]);
            $marca_veiculo_final = $marca_veiculo[0];
            $consulta = "SELECT IDVeiculo, preco FROM veiculos WHERE marca = '$marca_veiculo_final'";
            include('database/selects_basedados.php');
            if($dados){
                foreach($dados as $linha){
                    $id_veiculotmp = $linha['IDVeiculo'];
                    $preco_veiculo_insert = $linha['preco'];
                }
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
            $insert = "INSERT INTO vendas(IDNIF_Cliente$nome_coluna_veiculo$nome_coluna_artigo, ValorVenda, Venda_online) 
            VALUES ('$nif'$id_veiculo$id_artigo, '$valor_produto', 'Sim')";
            $acao = 'insert';
            $adicionar_foto = FALSE;
            include('database/inserts_basedados.php');
            $data_atual = date("Y-m-d H:i:s");
    }
    $compras_do_cliente = array();
    $consulta = "SELECT v.IDVenda, v.ValorVenda, v.DataVenda, c.Nome, c.Email, c.Morada, c.Cod_Postal, c.Localidade, c.Pais, c.Telemovel FROM vendas AS v, clientes AS c 
    WHERE c.IDNIF_Cliente = '$nif' AND v.DataVenda = '$data_atual' ORDER BY v.DataVenda DESC";
    include('database/selects_basedados.php');
    if($dados){
        foreach($dados as $linha){
            array_push($compras_do_cliente, $linha['IDVenda'], $nif, $linha['ValorVenda'], $linha['DataVenda'], $portes);
            $endereço_enviado = array($linha['Nome'], $linha['Email'], $linha['Morada'], $linhas['Cod_Postal'], $linha['Localidade'], $linha['Pais'], $linha['Telemovel']);
        }
    }

    $_SESSION['compra_sucess'] = array("sim", $mais_informacoes, $compras_do_cliente, $endereço_enviado);
    
    echo "<script type='text/javascript'>
            location.href='compra_sucess.php'
            </script>";
    }
    
}
?>