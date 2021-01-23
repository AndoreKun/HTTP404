<?php
/** Página dos funcionários reservada apenas para o patrão e admins, outros funcionários são imediatamente redirecionados.
 * @author Grupo HTTP 404
 * @version 1.3
 * @since 26 dez 2020
 */
// Inicia a sessão
session_start();
ob_start();
// Desabilita a demonstração de erros, para que não haja a possibilidade de aparecer erros para o usuário final
ini_set('display_errors', 0);
/** Resgata o ID do funcionário logado em uma variável através do valor da session. **/
$id_users = isset($_SESSION['id_users']) ? $_SESSION['id_users']: "";
/** Resgata o Nome do funcionário logado em uma variável através do valor da session. **/
$nome_user = isset($_SESSION['nome']) ? $_SESSION['nome']: "";
/** Resgata o Email do funcionário logado em uma variável através do valor da session. **/
$email_users = isset($_SESSION['email']) ? $_SESSION['email']: "";
/** Resgata a palavra passe do funcionário logado em uma variável através do valor da session. **/
$pass_users = isset($_SESSION['pass']) ? $_SESSION['pass']: "";
/** Resgata o estado de login do funcionário em uma variável através do valor da session. **/
$logado = isset($_SESSION['logado']) ? $_SESSION['logado']: "N";
/** Resgata o Cargo do funcionário logado em uma variável através do valor da session. **/
$cargo = isset($_SESSION['cargo']) ? $_SESSION['cargo']: "";	
/** verifica se a var logado contem o valor (S) OU (N), se conter N quer dizer que a pessoa não fez o login corretamente
* que no caso satisfará nossa condição no if e a pessoa sera redirecionada para a tela de login novamente. **/
if ($logado == "N" || $id_users == ""){	    
    echo  "<script type='text/javascript'>
                location.href='login.php'
            </script>";	
    exit();
}
/** Caso o cargo for de vendedor, redireciona-o para a sua página. **/
if ($cargo == "vendedores"){
    echo  "<script type='text/javascript'>
                location.href='vendedores.php'
            </script>";	
    exit();
}
// Define o Local e lingua, para as funções strftime e strtotime funcionarem bem na página
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
    <!-- Favicon - icones favoritos -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
    
    <!-- Chamda de todos os css -->
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
        <button style="cursor: pointer" id="sair" value="Sair" class="btn-style cr-btn" onclick="location.href = 'logout.php';">Sair</button>
    </div>
    <form action="" method="post">
        <label for="actions"><h2>Venda de Veículos/Artigos</h2></label><br/>
        <select name="vendaveiculos" id="vendaveiculos" style="width:300px; margin:4px;" onchange="admSelectCheck(this, false);">
            <option selected name= "" value="">Selecione uma opção...</option>
            <option name="vertodos" value="vertodos">Ver Dados - TODOS</option>
            <option id="opcao" name="mesatual" value="mesatual">Ver Dados - POR MÊS</option>
        </select>  
        <select id="elemento" name="elemento" style="width:300px; margin:4px; display: inline; display:none;">
            <option selected name= "mesatual" value="mesatual">Mês Atual</option>
            <option name="novembro2020" value="novembro2020">Outobro de 2020</option>
            <option name="dezembro2020" value="dezembro2020">Dezembro de 2020</option>
            <option name="janeiro2021" value="janeiro">Janeiro de 2021</option>
        </select>
        <input style="cursor: pointer; width:300px; margin:4px;" name="submit" type="submit" value="submit" class="btn-style cr-btn"></input>
    </form>
    <?php 
    /** Caso o formulário tiver sido submetido, imprime a informação desejada. **/
    if(isset($_POST['submit']) || isset($_POST['submit'])){
        /** $ver_dados: Variável que define a ação a ser tomada, Caso for "vertodos", mostra os dados de vendas de veiculos e artigos no total, 
        * Caso for "mesatual", mostra os dados de vendas e veiculos apenas do mês selecionado/atual. **/
        $ver_dados = $_POST['vendaveiculos'];
        switch($ver_dados){
            case 'vertodos':
                // Query da base de dados
                $consulta = 'SELECT * from vendas';
                // Chama o ficheiro de conexão à base de dados
                include "database/selects_basedados.php";      
                ?>
                <!-- Imprime os resultado obtidos em uma tabela !-->
                <div class="container">
                <br/>
                <br/>
                <h2 style='color:black'>Venda de Veículo/Artigos (Total)</h2>
                    <br/>
                    <table class="table table-striped table-bordered"> 
                            <tr> 
                                <th>Número da Venda</th>
                                <th>NIF do Cliente</th>
                                <th>Número do Veiculo</th>
                                <th>Número do Artigo</th>
                                <th>Valor da Venda</th>
                                <th>Data da Venda</th>
                                <th>Número do Funcionário</th>
                            </tr>
                        <tbody>
                            <?php 
                            /** $vendas: Número total do valor de vendas. **/
                            $vendas = 0;
                            // Ciclo para definir variáveis com resultado do consulta
                            foreach($dados as $linha) { ?>
                            <tr>
                                <td><?php echo $linha ['IDVenda']; ?></td>
                                <td><?php echo $linha ['IDNIF_Cliente']; ?></td>
                                <td><?php echo $linha ['IDVeiculo']; ?></td>
                                <td><?php echo $linha ['IDArtigo']; ?></td>
                                <td><?php echo $linha ['ValorVenda']; ?></td>
                                <td><?php echo $linha ['DataVenda']; ?></td>
                                <td><?php echo $linha ['IDFuncionario']; ?></td>
                                <?php $vendas += (float)$linha['ValorVenda'];?>
                            </tr>
                            <?php } ?>
                            </tbody>
                    </table>
                    <table>
                    <tr>
                        <th>Total de Vendas</th>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            echo $vendas.'€'; 
                            $nomevalorextra = "Valor Total de Vendas";
                            ?>
                        </td>
                    </table>
                    <!-- Chama o ficheiro download.php para fazer o download dos dados selecionados em formato excel !-->
                    <button onclick="location.href='database/download.php?consulta=<?php echo $consulta ?>&valorextra=<?php echo $vendas?>&nomevalorextra=<?php echo $nomevalorextra?>&adicionarvalor=S'" 
                    name="downloadfile" value="Exportar Para Excel" class="btn btn-success" style="cursor: pointer; width:300px; float:right; margin-top:-40px">Exportar Para Excel</button>
                </div>
                <?php
                break;
            case 'mesatual':
                /** $mes: Mês selecionado através de um formulário, se for "mestual" mostra os dados do mes atual, se for "novembro2020" mostra os dados se novembro de 2020, e assim continua. **/
                $mes = $_POST['elemento'];
                switch($mes){
                    case "mesatual":
                        /** $consultatmp: Consulta temporária, será atualizada de acordo com o mês que estiver na variável $mes. **/
                        $consultatmp = 'SELECT * from vendas WHERE YEAR(DataVenda) = YEAR(CURRENT_DATE()) AND MONTH(DataVenda) = MONTH(CURRENT_DATE())';
                        /** $dataatual: Define a data atual com a função strftime e strtotime do php. **/
                        $dataatual = strftime('%B de %Y', strtotime('today'));
                        /** $titulotabela: Titulo da tabela que será apresentada(Preenchida com dados do resultado da consulta). **/
                        $titulotabela = "Valor Total de Vendas($dataatual)"; 
                        break;
                    case "novembro2020":
                        $consultatmp = 'SELECT * from vendas WHERE YEAR(DataVenda) = 2020 AND MONTH(DataVenda) = 11';
                        $titulotabela = "Valor Total de Vendas(Novembro de 2020)"; 
                        break;
                    case "dezembro2020":
                        $consultatmp = 'SELECT * from vendas WHERE YEAR(DataVenda) = 2020 AND MONTH(DataVenda) = 12';
                        $titulotabela = "Valor Total de Vendas(Dezembro de 2020)"; 
                        break;
                    case "janeiro2021":
                        $consultatmp = 'SELECT * from vendas WHERE YEAR(DataVenda) = 2021 AND MONTH(DataVenda) = 1';
                        $titulotabela = "Valor Total de Vendas(Janeiro de 2021)"; 
                        break;
                }
                $consulta = $consultatmp;
                $nomevalorextra = $titulotabela;
                // Chamda ficheiro de conexão à base de dados
                include "database/selects_basedados.php";      
                ?>
                <!-- Imprime os resultado obtidos em uma tabela !-->
                <div class="container">
                <br/>
                <br/>
                <h2 style='color:black'><?php echo $titulotabela;?></h2>
                    <br/>
                    <table class="table table-striped table-bordered"> 
                            <tr> 
                                <th>Número da Venda</th>
                                <th>NIF do Cliente</th>
                                <th>Número do Veiculo</th>
                                <th>Número do Artigo</th>
                                <th>Valor da Venda</th>
                                <th>Data da Venda</th>
                                <th>Número do Funcionário</th>
                            </tr>
                        <tbody>
                            <?php 
                            $vendas = 0;
                            foreach($dados as $linha) { ?>
                            <tr>
                                <td><?php echo $linha ['IDVenda']; ?></td>
                                <td><?php echo $linha ['IDNIF_Cliente']; ?></td>
                                <td><?php echo $linha ['IDVeiculo']; ?></td>
                                <td><?php echo $linha ['IDArtigo']; ?></td>
                                <td><?php echo $linha ['ValorVenda']; ?></td>
                                <td><?php echo $linha ['DataVenda']; ?></td>
                                <td><?php echo $linha ['IDFuncionario']; ?></td>
                                <?php $vendas += (float)$linha['ValorVenda'];?>
                            </tr>
                            <?php } ?>
                            </tbody>
                    </table>
                    <table>
                    <tr>
                        <th>Total de Vendas</th>
                    </tr>
                    <tr>
                        <td>
                            <?php 
                            echo $vendas.'€';
                            ?> 
                        </td>
                    </table>
                    <button onclick="location.href='database/download.php?consulta=<?php echo $consulta ?>&valorextra=<?php echo $vendas?>&nomevalorextra=<?php echo $nomevalorextra?>&adicionarvalor=S'" 
                    name="downloadfile" value="Exportar Para Excel" class="btn btn-success" style="cursor: pointer; width:300px; float:right; margin-top:-40px">Exportar Para Excel</button>
                </div>
                <?php
                break;
            }       
        }
?>
<!-- Chamada do js !-->
<script src="assets/js/mostraselecao.js"></script>
</body>
</html>