<?php
/** 
* Página contém todo o HTML e PHP com o corpo de emails para serem enviados a clientes
* @author Grupo HTTP404
* @version 1.2
* @since 26 jan 2021
*/

// Desabilita a demonstração de erros, para que não haja a possibilidade de aparecer erros para o usuário final
ini_set('display_errors', 0);

/** $detalhes_importantes_enc: Informações importantes sobre a encomenda definidas pelo cliente */
$detalhes_importantes_enc = "";
/** $sybl: Define o que aparece após o valor dos portes*/
$sybl = "";
/** $valor_produtos: Valor total dos produtos(com portes) */
$valor_produtos = $compra_cliente[2];

if(isset($verifica_compra)){
    /** if($verifica_compra[1] != "sem_inf_adc"): Caso uma compra for feita e as informações adicionais não forem o predefinido, define a variável $detalhes_importantes_enc
     * para mostrar essa informações como resumo no email*/
    if($verifica_compra[1] != "sem_inf_adc"){
        $detalhes_importantes_enc = $verifica_compra[1];
    }
}

if(isset($endereco_cliente)){
    /** $postal_local_pais: Caso o endereço esteja definido, Junta o codigo postal, a localidade e o país na mesma linha para imprimir no email */
    $postal_local_pais = $endereco_cliente[3].' '.$endereco_cliente[4].' '.$endereco_cliente[5];
}
/** if(isset($compra_cliente[4])): Caso os portes estejam definidos, define $sybl e $valor_produtos em função de portes */
if(isset($compra_cliente[4])){
    /** if($compra_cliente[4] != "Grátis"): Caso os portes não forem grátis, define $sybl como o símbolo do euro e diminui o valor dos portes ao valor total dos produtos
     * para obter o valor dos produtos sem portes para mostrar no email. Por fim junta ao valor dos portes, $sybl.
     * Senão, Como os portes são grátis, o preço total dos produtos e preço após portes serão iguais. E $sybl será uma string vazia.
     */
    if($compra_cliente[4] != "Grátis"){
        $sybl = "€";
        $valor_produtos = $compra_cliente[2] - $compra_cliente[4];
        $valor_produtos = $valor_produtos.'€';
    } 
}

$data_atual = date("Y-m-d H:i:s");

// Email de Encomendas
$mensagem_compra = "
<!DOCTYPE html
    PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xmlns:o='urn:schemas-microsoft-com:office:office'
    style='width:100%;font-family:arial, helvetica neue, helvetica,
    sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0'>

<head>
    <meta charset='UTF-8'>
    <meta content='width=device-width, initial-scale=1' name='viewport'>
    <meta name='x-apple-disable-message-reformatting'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta content='telephone=no' name='format-detection'>
    <title>http404 - compra </title>
    <!--[if (mso 16)]><style type='text/css'>     a {text-decoration: none;}     </style><![endif]-->
    <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]-->
    <!--[if gte mso 9]><xml> <o:OfficeDocumentSettings> <o:AllowPNG></o:AllowPNG> <o:PixelsPerInch>96</o:PixelsPerInch>
</o:OfficeDocumentSettings> </xml><![endif]-->
    <style type='text/css'>
        #outlook a {
            padding: 0;
        }

        .ExternalClass {
            width: 100%;
        }

        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {    
            line-height: 100%;
        }

        .es-button {
            mso-style-priority: 100 !important;
            text-decoration: none !important;
        }

        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        .es-desk-hidden {
            display: none;
            float: left;
            overflow: hidden;
            width: 0;
            max-height: 0;
            line-height: 0;
            mso-hide: all;
        }

        @media only screen and (max-width:600px) {

            p,
            ul li,
            ol li,
            a {
                font-size: 14px !important;
                line-height: 150% !important
            }

            h1 {
                font-size: 30px !important;
                text-align: center;
                line-height: 120% !important
            }

            h2 {
                font-size: 26px !important;
                text-align: center;
                line-height: 120% !important
            }

            h3 {
                font-size: 20px !important;
                text-align: center;
                line-height: 120% !important
            }

            h1 a {
                font-size: 30px !important
            }

            h2 a {
                font-size: 26px !important
            }

            h3 a {
                font-size: 20px !important
            }

            .es-menu td a {
                font-size: 14px !important
            }

            .es-header-body p,
            .es-header-body ul li,
            .es-header-body ol li,
            .es-header-body a {
                font-size: 14px !important
            }

            .es-footer-body p,
            .es-footer-body ul li,
            .es-footer-body ol li,
            .es-footer-body a {
                font-size: 14px !important
            }

            .es-infoblock p,
            .es-infoblock ul li,
            .es-infoblock ol li,
            .es-infoblock a {
                font-size: 12px !important
            }

            *[class='gmail-fix'] {
                display: none !important
            }

            .es-m-txt-c,
            .es-m-txt-c h1,
            .es-m-txt-c h2,
            .es-m-txt-c h3 {
                text-align: center !important
            }

            .es-m-txt-r,
            .es-m-txt-r h1,
            .es-m-txt-r h2,
            .es-m-txt-r h3 {
                text-align: right !important
            }

            .es-m-txt-l,
            .es-m-txt-l h1,
            .es-m-txt-l h2,
            .es-m-txt-l h3 {
                text-align: left !important
            }

            .es-m-txt-r img,
            .es-m-txt-c img,
            .es-m-txt-l img {
                display: inline !important
            }

            .es-button-border {
                display: block !important
            }

            .es-btn-fw {
                border-width: 10px 0px !important;
                text-align: center !important
            }

            .es-adaptive table,
            .es-btn-fw,
            .es-btn-fw-brdr,
            .es-left,
            .es-right {
                width: 100% !important
            }

            .es-content table,
            .es-header table,
            .es-footer table,
            .es-content,
            .es-footer,
            .es-header {
                width: 100% !important;
                max-width: 600px !important
            }

            .es-adapt-td {
                display: block !important;
                width: 100% !important
            }

            .adapt-img {
                width: 100% !important;
                height: auto !important
            }

            .es-m-p0 {
                padding: 0px !important
            }

            .es-m-p0r {
                padding-right: 0px !important
            }

            .es-m-p0l {
                padding-left: 0px !important
            }

            .es-m-p0t {
                padding-top: 0px !important
            }

            .es-m-p0b {
                padding-bottom: 0 !important
            }

            .es-m-p20b {
                padding-bottom: 20px !important
            }

            .es-mobile-hidden,
            .es-hidden {
                display: none !important
            }

            tr.es-desk-hidden,
            td.es-desk-hidden,
            table.es-desk-hidden {
                width: auto !important;
                overflow: visible !important;
                float: none !important;
                max-height: inherit !important;
                line-height: inherit !important
            }

            tr.es-desk-hidden {
                display: table-row !important
            }

            table.es-desk-hidden {
                display: table !important
            }

            td.es-desk-menu-hidden {
                display: table-cell !important
            }

            .es-menu td {
                width: 1% !important
            }

            table.es-table-not-adapt,
            .esd-block-html table {
                width: auto !important
            }

            table.es-social {
                display: inline-block !important
            }

            table.es-social td {
                display: inline-block !important
            }

            a.es-button,
            button.es-button {
                font-size: 20px !important;
                display: block !important;
                border-left-width: 0px !important;
                border-right-width: 0px !important
            }
        }
    </style>
</head>

<body style='width:100%;font-family:arial, ' helvetica neue', helvetica,
    sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0'>
    <div class='es-wrapper-color' style='background-color:#F6F6F6'>
        <!--[if gte mso 9]><v:background xmlns:v='urn:schemas-microsoft-com:vml' fill='t'> <v:fill type='tile' color='#f6f6f6'></v:fill> </v:background><![endif]-->
        <table class='es-wrapper' width='100%' cellspacing='0' cellpadding='0'
            style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top'>
            <tr style='border-collapse:collapse'>
                <td valign='top' style='padding:0;Margin:0'>
                    <table class='es-content' cellspacing='0' cellpadding='0' align='center' 
                    style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%'>
                        <tr style='border-collapse:collapse'>
                            <td align='center' style='padding:0;Margin:0'>
                                <table class='es-content-body' cellspacing='0' cellpadding='0' align='center'
                                    style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px'>
                                    <tr style='border-collapse:collapse'>
                                        <td style='Margin:0;padding-top:15px;padding-bottom:15px;padding-left:20px;padding-right:20px;background-color:#051037'
                                            bgcolor='#051037' align='left'>
                                            <table width='100%' cellspacing='0' cellpadding='0'
                                                style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                <tr style='border-collapse:collapse'>
                                                    <td valign='top' align='center'
                                                        style='padding:0;Margin:0;width:560px'>
                                                        <table width='100%' cellspacing='0' cellpadding='0'
                                                            role='presentation'
                                                            style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                            <tr style='border-collapse:collapse'>
                                                                <td align='center'
                                                                    style='padding:0;Margin:0;font-size:0px'>
                                                                    <img src='https://nwvpff.stripocdn.email/content/guids/CABINET_53db3a2d5208a2a89935bb61dcab05a0/images/36141611571100614.png'
                                                                        alt='Http 404 Logo' title='Http 404 Logo'
                                                                        style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic'
                                                                        width='92' height='65'>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr style='border-collapse:collapse'>
                                        <td style='Margin:0;padding-bottom:10px;padding-top:15px;padding-left:20px;padding-right:20px;background-position:center center'
                                            align='left'>
                                            <!--[if mso]><table style='width:560px' cellpadding='0' cellspacing='0'><tr><td style='width:270px' valign='top'><![endif]-->
                                            <table class='es-left' cellspacing='0' cellpadding='0' align='left'
                                                style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left'>
                                                <tr style='border-collapse:collapse'>
                                                    <td align='left' style='padding:0;Margin:0;width:270px'>
                                                        <table width='100%' cellspacing='0' cellpadding='0'
                                                            role='presentation'
                                                            style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                            <tr style='border-collapse:collapse'>
                                                                <td class='es-m-txt-c' align='left'
                                                                    style='padding:0;Margin:0'>
                                                                    <h3
                                                                        style='Margin:0;line-height:19px;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;font-size:16px;font-style:normal;font-weight:normal;color:#333333'>
                                                                        <strong>Número da Encomenda: $compra_cliente[0] </strong><br>
                                                                    </h3>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <!--[if mso]></td><td style='width:20px'></td><td style='width:270px' valign='top'><![endif]-->
                                            <table class='es-right' cellspacing='0' cellpadding='0' align='right'
                                                style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right'>
                                                <tr style='border-collapse:collapse'>
                                                    <td align='left' style='padding:0;Margin:0;width:270px'>
                                                        <table width='100%' cellspacing='0' cellpadding='0'
                                                            role='presentation'
                                                            style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                            <tr style='border-collapse:collapse'>
                                                                <td class='es-m-txt-c' align='right'
                                                                    style='padding:0;Margin:0'>
                                                                    <h5 style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial,
                                                                        helvetica neue, helvetica,
                                                                        sans-serif;line-height:21px;color:#333333'>
                                                                        Encomendado em: $compra_cliente[3]</h5>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <!--[if mso]></td></tr></table><![endif]-->
                                        </td>
                                    </tr>
                                    <tr style='border-collapse:collapse'>
                                        <td align='left' style='padding:0;Margin:0;padding-bottom:10px'>
                                            <table width='100%' cellspacing='0' cellpadding='0'
                                                style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                <tr style='border-collapse:collapse'>
                                                    <td valign='top' align='center'
                                                        style='padding:0;Margin:0;width:600px'>
                                                        <table width='100%' cellspacing='0' cellpadding='0'
                                                            role='presentation'
                                                            style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                            <tr style='border-collapse:collapse'>
                                                                <td align='center'
                                                                    style='padding:0;Margin:0;padding-bottom:5px;font-size:0'>
                                                                    <table width='100%' height='100%' cellspacing='0'
                                                                        cellpadding='0' border='0' role='presentation'
                                                                        style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                                        <tr style='border-collapse:collapse'>
                                                                            <td
                                                                                style='padding:0;Margin:0;border-bottom:1px solid #EFEFEF;background:#FFFFFF none repeat scroll 0% 0%;height:1px;width:100%;margin:0px'>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr style='border-collapse:collapse'>
                                        <td style='Margin:0;padding-top:20px;padding-bottom:20px;padding-left:20px;padding-right:20px;background-position:center top'
                                            align='left'>
                                            <table width='100%' cellspacing='0' cellpadding='0'
                                                style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                <tr style='border-collapse:collapse'>
                                                    <td valign='top' align='center'
                                                        style='padding:0;Margin:0;width:560px'>
                                                        <table width='100%' cellspacing='0' cellpadding='0'
                                                            role='presentation'
                                                            style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                            <tr style='border-collapse:collapse'>
                                                                <td align='center' style='padding:0;Margin:0'>
                                                                    <h1 style='Margin:0;line-height:29px;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;font-size:24px;font-style:normal;font-weight:normal;color:#333333'>
                                                                        Obrigado por escolher a HTTP 404!</h1>
                                                                </td>
                                                            </tr>
                                                            <tr style='border-collapse:collapse'>
                                                                <td align='center'
                                                                    style='Margin:0;padding-top:5px;padding-bottom:10px;padding-left:20px;padding-right:20px;font-size:0'>
                                                                    <table width='10%' height='100%' cellspacing='0'
                                                                        cellpadding='0' border='0' role='presentation'
                                                                        style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                                        <tr style='border-collapse:collapse'>
                                                                            <td
                                                                                style='padding:0;Margin:0;border-bottom:3px solid #F1C232;background:#FFFFFF none repeat scroll 0% 0%;height:1px;width:100%;margin:0px'>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr style='border-collapse:collapse'>
                                                                <td align='center'
                                                                    style='padding:0;Margin:0;padding-top:5px'>
                                                                    <h3 style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial,
                                                                        helvetica neue, helvetica,
                                                                        sans-serif;line-height:21px;color:#333333'>
                                                                        Resumo da sua Encomenda</h3>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr style='border-collapse:collapse'>
                                        <td style='Margin:0;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;background-position:center center'
                                            align='left'>
                                            <table width='100%' cellspacing='0' cellpadding='0'
                                                style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                <tr style='border-collapse:collapse'>
                                                    <td valign='top' align='center'
                                                        style='padding:0;Margin:0;width:560px'>
                                                        <table width='100%' cellspacing='0' cellpadding='0'
                                                            role='presentation'
                                                            style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                            <tr style='border-collapse:collapse'>
                                                                <td align='center'
                                                                    style='padding:0;Margin:0;padding-top:5px;padding-bottom:5px;font-size:0'>
                                                                    <table width='100%' height='100%' cellspacing='0'
                                                                        cellpadding='0' border='0' role='presentation'
                                                                        style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                                        <tr style='border-collapse:collapse'>
                                                                            <td
                                                                                style='padding:0;Margin:0;border-bottom:1px solid #EFEFEF;background:#FFFFFF none repeat scroll 0% 0%;height:1px;width:100%;margin:0px'>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr style='border-collapse:collapse'>
                                        <td style='Margin:0;padding-top:10px;padding-left:20px;padding-right:20px;padding-bottom:40px;background-color:#FFFFFF
                                            bgcolor= #ffffff align=left'>
                                            <!--[if mso]><table style='width:560px' cellpadding='0' cellspacing='0'><tr><td style='width:270px' valign='top'><![endif]-->
                                        <table class='es-left' cellspacing='0' cellpadding='0' align='left'
                                                style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left'>
                                                <tr style='border-collapse:collapse'>
                                                    <td class='es-m-p0r es-m-p20b' valign='top align=center'
                                                        style='padding:0;Margin:0;width:270px'>
                                                        <table width='100%' cellspacing='0' cellpadding='0'
                                                            role='presentation'
                                                            style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                            <tr style='border-collapse:collapse'>
                                                                <td class='es-m-txt-l align='left'
                                                                    style='padding:0;Margin:0;padding-bottom:15px'>
                                                                    <h3
                                                                        style='Margin:0;line-height:24px;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;font-size:20px;font-style:normal;font-weight:normal;color:#333333'>
                                                                        Informações da Encomenda</h3>
                                                                </td>
                                                            </tr>
                                                            <tr style='border-collapse:collapse'>
                                                                <td align='left' style='padding:0;Margin:0'>
                                                                    <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 
                                                                        helvetica neue, helvetica,
                                                                        sans-serif;line-height:21px;color:#333333'>
                                                                        $detalhes_importantes_enc<br></p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr style='border-collapse:collapse'>
                                                    <td class='es-m-p0r es-m-p20b' valign='top align=center'
                                                        style='padding:0;Margin:0;width:270px'>
                                                        <table width='100%' cellspacing='0' cellpadding='0'
                                                            role='presentation'
                                                            style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>       
                                                            <tr style='border-collapse:collapse'>
                                                                <td class='es-m-txt-l align='left'
                                                                    style='padding:0;Margin:0;padding-bottom:15px'>
                                                                    <h3
                                                                        style='Margin:0;line-height:24px;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;font-size:20px;font-style:normal;font-weight:normal;color:#333333'>
                                                                        Morada de Envio/Faturação</h3>
                                                                </td>
                                                            </tr>
                                                            <tr style='border-collapse:collapse'>
                                                                <td align='left' style='padding:0;Margin:0'>
                                                                    <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:13px;font-family:arial, 
                                                                        helvetica neue, helvetica,
                                                                        sans-serif;line-height:20px;color:#333333'>
                                                                        $endereco_cliente[0]<br/> 
                                                                        $endereco_cliente[2]<br/>
                                                                        $postal_local_pais<br/> 
                                                                        $endereco_cliente[6]                                                           
                                                                        </p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <!--[if mso]></td><td style='width:20px'></td><td style='width:270px' valign='top'><![endif]-->
                                            <table cellspacing='0' cellpadding='0' align='right'
                                                style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                <tr style='border-collapse:collapse'>
                                                    <td align='left' style='padding:0;Margin:0;width:270px'>
                                                        <table width='100%' cellspacing='0' cellpadding='0'
                                                            role='presentation'
                                                            style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                            <tr style='border-collapse:collapse'>
                                                                <td class='es-m-txt-l' align='left'
                                                                    style='padding:0;Margin:0;padding-top:10px'>
                                                                    <table
                                                                        style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:100%'
                                                                        class='cke_show_border' cellspacing='0'
                                                                        cellpadding='0' border='0' role='presentation'>
                                                                        <tr style='border-collapse:collapse'>
                                                                            <td width='50%' align='left'
                                                                                style='padding:0;Margin:0'>
                                                                                <h3
                                                                                    style='Margin:0;line-height:26px;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;font-size:17px;font-style:normal;font-weight:normal;color:#333333'>
                                                                                    Produtos</h3>
                                                                            </td>
                                                                            <td align='right'
                                                                                style='padding:0;Margin:0'>
                                                                                <h3
                                                                                    style='Margin:0;line-height:26px;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;font-size:17px;font-style:normal;font-weight:normal;color:#333333'>
                                                                                    $valor_produtos</h3>
                                                                            </td>
                                                                        </tr>
                                                                        <tr style='border-collapse:collapse'>
                                                                            <td width='50%' align='left'
                                                                                style='padding:0;Margin:0'>
                                                                                <h3
                                                                                    style='Margin:0;line-height:26px;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;font-size:17px;font-style:normal;font-weight:normal;color:#333333'>
                                                                                    Portes</h3>
                                                                            </td>
                                                                            <td align='right'
                                                                                style='padding:0;Margin:0'>
                                                                                <h3
                                                                                    style='Margin:0;line-height:26px;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;font-size:17px;font-style:normal;font-weight:normal;color:#333333'>
                                                                                    $compra_cliente[4]$sybl</h3>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr style='border-collapse:collapse'>
                                                                <td class='es-m-txt-l' align='left'
                                                                    style='padding:0;Margin:0'>
                                                                    <table
                                                                        style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:100%'
                                                                        class='cke_show_border' cellspacing='0'
                                                                        cellpadding='0' border='0' role='presentation'>
                                                                        <tr style='border-collapse:collapse'>
                                                                            <td width='50%' align='left'
                                                                                style='padding:0;Margin:0'>
                                                                                <h3
                                                                                    style='Margin:0;line-height:26px;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;font-size:17px;font-style:normal;font-weight:normal;color:#333333'>
                                                                                    <strong>Total</strong></h3>
                                                                            </td>
                                                                            <td align='right'
                                                                                style='padding:0;Margin:0'>
                                                                                <h3
                                                                                    style='Margin:0;line-height:26px;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;font-size:17px;font-style:normal;font-weight:normal;color:#333333'>
                                                                                    <strong>$compra_cliente[2]€</strong></h3>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <!--[if mso]></td></tr></table><![endif]-->
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table class='es-content' cellspacing='0' cellpadding='0' align='center'
                        style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%'>
                        <tr style='border-collapse:collapse'>
                            <td align='center' style='padding:0;Margin:0'>
                                <table class='es-content-body'
                                    style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px'
                                    cellspacing='0' cellpadding='0' bgcolor='#ffffff' align='center'>
                                    <tr style='border-collapse:collapse'>
                                        <td style='padding:10px;Margin:0;background-position:center top' align='left'>
                                            <table width='100%' cellspacing='0' cellpadding='0'
                                                style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                <tr style='border-collapse:collapse'>
                                                    <td valign='top' align='center'
                                                        style='padding:0;Margin:0;width:580px'>
                                                        <table width='100%' cellspacing='0' cellpadding='0'
                                                            role='presentation'
                                                            style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                            <tr style='border-collapse:collapse'>
                                                                <td align='center'
                                                                    style='Margin:0;padding-top:5px;padding-bottom:5px;padding-left:10px;padding-right:10px;font-size:0'>
                                                                    <table width='100%' height='100%' cellspacing='0'
                                                                        cellpadding='0' border='0' role='presentation'
                                                                        style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                                        <tr style='border-collapse:collapse'>
                                                                            <td
                                                                                style='padding:0;Margin:0;border-bottom:1px solid #EFEFEF;background:#FFFFFF none repeat scroll 0% 0%;height:1px;width:100%;margin:0px'>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr style='border-collapse:collapse'>
                                        <td align='left' style='padding:0;Margin:0'>
                                            <table cellspacing='0' cellpadding='0' width='100%'
                                                style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                <tr style='border-collapse:collapse'>
                                                    <td align='left' style='padding:0;Margin:0;width:600px'>
                                                        <table width='100%' cellspacing='0' cellpadding='0'
                                                            role='presentation'
                                                            style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                            <tr style='border-collapse:collapse'>
                                                                <td align='center'
                                                                    style='padding:0;Margin:0;padding-top:40px'>
                                                                    <h3
                                                                        style='Margin:0;line-height:24px;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;font-size:20px;font-style:normal;font-weight:normal;color:#333333'>
                                                                        Suporte Disponível 24/7</h3>
                                                                </td>
                                                            </tr>
                                                            <tr style='border-collapse:collapse'>
                                                                <td align='center'
                                                                    style='padding:0;Margin:0;padding-top:15px;padding-bottom:40px'>
                                                                    <h1
                                                                        style='Margin:0;line-height:36px;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;font-size:30px;font-style:normal;font-weight:normal;color:#333333'>
                                                                        01245 658 698 (Grátis)</h1>
                                                                    <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, helvetica neue, helvetica,sans-serif;line-height:21px;color:#333333'>Ou
                                                                        envie uma mensagem para nós através do nosso Site!</p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table cellpadding='0' cellspacing='0' class='es-footer' align='center'
                        style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top'>
                        <tr style='border-collapse:collapse'>
                            <td align='center' style='padding:0;Margin:0'>
                                <table class='es-footer-body' cellspacing='0' cellpadding='0' align='center'
                                    style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFD500;width:600px'>
                                    <tr style='border-collapse:collapse'>
                                        <td align='left' style='padding:20px;Margin:0'>
                                            <!--[if mso]><table style='width:560px' cellpadding='0' cellspacing='0'><tr><td style='width:178px' valign='top'><![endif]-->
                                            <table class='es-left' cellspacing='0' cellpadding='0' align='left'
                                                style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left'>
                                                <tr style='border-collapse:collapse'>
                                                    <td class='es-m-p0r es-m-p20b' valign='top' align='center'
                                                        style='padding:0;Margin:0;width:178px'>
                                                        <table width='100%' cellspacing='0' cellpadding='0'
                                                            role='presentation'
                                                            style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                            <tr style='border-collapse:collapse'>
                                                                <td align='center'
                                                                    style='padding:0;Margin:0;font-size:0px'><img
                                                                        src='https://nwvpff.stripocdn.email/content/guids/CABINET_53db3a2d5208a2a89935bb61dcab05a0/images/36141611571100614.png'
                                                                        alt='Http 404 Logo' title='Http 404 Logo'
                                                                        width='178'
                                                                        style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic'
                                                                        height='125'></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <!--[if mso]></td><td style='width:20px'></td>
<td style='width:362px' valign='top'><![endif]-->
                                            <table cellspacing='0' cellpadding='0' align='right'
                                                style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                <tr style='border-collapse:collapse'>
                                                    <td align='left' style='padding:0;Margin:0;width:362px'>
                                                        <table width='100%' cellspacing='0' cellpadding='0'
                                                            role='presentation'
                                                            style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                            <tr style='border-collapse:collapse'>
                                                                <td class='es-m-txt-l' align='center'
                                                                    style='padding:0;Margin:0;padding-bottom:10px'>
                                                                    <h3
                                                                        style='Margin:0;line-height:24px;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;font-size:20px;font-style:normal;font-weight:normal;color:#333333'>
                                                                        Fale Connosco</h3>
                                                                </td>
                                                            </tr>
                                                            <tr style='border-collapse:collapse'>
                                                                <td class='es-m-txt-c' align='center'
                                                                    style='padding:0;Margin:0'>
                                                                    <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 
                                                                        helvetica neue, helvetica,
                                                                        sans-serif;line-height:21px;color:#333333'>Rua
                                                                        8, Tavira</p>
                                                                    <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 
                                                                        helvetica neue, helvetica,
                                                                        sans-serif;line-height:21px;color:#333333'>+090
                                                                        12568 369 987</p>
                                                                    <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 
                                                                        helvetica neue, helvetica,
                                                                        sans-serif;line-height:21px;color:#333333'>
                                                                        info@http404.com</p>
                                                                </td>
                                                            </tr>
                                                            <tr style='border-collapse:collapse'>
                                                                <td class='es-m-txt-c' align='center'
                                                                    style='padding:0;Margin:0;padding-top:10px;font-size:0'>
                                                                    <table class='es-social es-table-not-adapt'
                                                                        cellspacing='0' cellpadding='0'
                                                                        role='presentation'
                                                                        style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                                        <tr style='border-collapse:collapse'>
                                                                            <td valign='top' align='center'
                                                                                style='padding:0;Margin:0;padding-right:10px'>
                                                                                <a target='_blank'
                                                                                    href='https://twitter.com/Http404Vhttps://'
                                                                                    style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 
                                                                                    helvetica neue, helvetica,
                                                                                    sans-serif;font-size:14px;text-decoration:underline;color:#333333'><img
                                                                                        title='Twitter'
                                                                                        src='https://nwvpff.stripocdn.email/content/assets/img/social-icons/logo-black/twitter-logo-black.png'
                                                                                        alt='Tw' width='32' height='32'
                                                                                        style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic'></a>
                                                                            </td>
                                                                            <td valign='top' align='center'
                                                                                style='padding:0;Margin:0;padding-right:10px'>
                                                                                <a target='_blank'
                                                                                    href='https://twitter.com/Http404V'
                                                                                    style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 
                                                                                    helvetica neue, helvetica,
                                                                                    sans-serif;font-size:14px;text-decoration:underline;color:#333333'><img
                                                                                        title='Facebook'
                                                                                        src='https://nwvpff.stripocdn.email/content/assets/img/social-icons/logo-black/facebook-logo-black.png'
                                                                                        alt='Fb' width='32' height='32'
                                                                                        style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic'></a>
                                                                            </td>
                                                                            <td valign='top' align='center'
                                                                                style='padding:0;Margin:0'><a
                                                                                    target='_blank'
                                                                                    href='https://www.instagram.com/lojahttp404/'
                                                                                    style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial,
                                                                                    helvetica neue, helvetica,
                                                                                    sans-serif;font-size:14px;text-decoration:underline;color:#333333'>
                                                                                    <img title='Instagram'
                                                                                        src='https://nwvpff.stripocdn.email/content/assets/img/social-icons/logo-black/instagram-logo-black.png'
                                                                                        alt='Ig' width='32' height='32'
                                                                                        style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic'></a>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <!--[if mso]></td></tr></table><![endif]-->
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
    <div style='position:absolute;left:-9999px;top:-9999px'></div>
</body>
</html>
";
$mensagem_marketing = "
<!DOCTYPE html
    PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xmlns:o='urn:schemas-microsoft-com:office:office'
    style='width:100%;font-family:arial, helvetica neue, helvetica,
    sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0'>

<head>
    <meta charset='UTF-8'>
    <meta content='width=device-width, initial-scale=1' name='viewport'>
    <meta name='x-apple-disable-message-reformatting'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta content='telephone=no' name='format-detection'>
    <title>http404 - compra </title>
    <!--[if (mso 16)]><style type='text/css'>     a {text-decoration: none;}     </style><![endif]-->
    <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]-->
    <!--[if gte mso 9]><xml> <o:OfficeDocumentSettings> <o:AllowPNG></o:AllowPNG> <o:PixelsPerInch>96</o:PixelsPerInch>
</o:OfficeDocumentSettings> </xml><![endif]-->
    <style type='text/css'>
        #outlook a {
            padding: 0;
        }

        .ExternalClass {
            width: 100%;
        }

        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {    
            line-height: 100%;
        }

        .es-button {
            mso-style-priority: 100 !important;
            text-decoration: none !important;
        }

        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        .es-desk-hidden {
            display: none;
            float: left;
            overflow: hidden;
            width: 0;
            max-height: 0;
            line-height: 0;
            mso-hide: all;
        }

        @media only screen and (max-width:600px) {

            p,
            ul li,
            ol li,
            a {
                font-size: 14px !important;
                line-height: 150% !important
            }

            h1 {
                font-size: 30px !important;
                text-align: center;
                line-height: 120% !important
            }

            h2 {
                font-size: 26px !important;
                text-align: center;
                line-height: 120% !important
            }

            h3 {
                font-size: 20px !important;
                text-align: center;
                line-height: 120% !important
            }

            h1 a {
                font-size: 30px !important
            }

            h2 a {
                font-size: 26px !important
            }

            h3 a {
                font-size: 20px !important
            }

            .es-menu td a {
                font-size: 14px !important
            }

            .es-header-body p,
            .es-header-body ul li,
            .es-header-body ol li,
            .es-header-body a {
                font-size: 14px !important
            }

            .es-footer-body p,
            .es-footer-body ul li,
            .es-footer-body ol li,
            .es-footer-body a {
                font-size: 14px !important
            }

            .es-infoblock p,
            .es-infoblock ul li,
            .es-infoblock ol li,
            .es-infoblock a {
                font-size: 12px !important
            }

            *[class='gmail-fix'] {
                display: none !important
            }

            .es-m-txt-c,
            .es-m-txt-c h1,
            .es-m-txt-c h2,
            .es-m-txt-c h3 {
                text-align: center !important
            }

            .es-m-txt-r,
            .es-m-txt-r h1,
            .es-m-txt-r h2,
            .es-m-txt-r h3 {
                text-align: right !important
            }

            .es-m-txt-l,
            .es-m-txt-l h1,
            .es-m-txt-l h2,
            .es-m-txt-l h3 {
                text-align: left !important
            }

            .es-m-txt-r img,
            .es-m-txt-c img,
            .es-m-txt-l img {
                display: inline !important
            }

            .es-button-border {
                display: block !important
            }

            .es-btn-fw {
                border-width: 10px 0px !important;
                text-align: center !important
            }

            .es-adaptive table,
            .es-btn-fw,
            .es-btn-fw-brdr,
            .es-left,
            .es-right {
                width: 100% !important
            }

            .es-content table,
            .es-header table,
            .es-footer table,
            .es-content,
            .es-footer,
            .es-header {
                width: 100% !important;
                max-width: 600px !important
            }

            .es-adapt-td {
                display: block !important;
                width: 100% !important
            }

            .adapt-img {
                width: 100% !important;
                height: auto !important
            }

            .es-m-p0 {
                padding: 0px !important
            }

            .es-m-p0r {
                padding-right: 0px !important
            }

            .es-m-p0l {
                padding-left: 0px !important
            }

            .es-m-p0t {
                padding-top: 0px !important
            }

            .es-m-p0b {
                padding-bottom: 0 !important
            }

            .es-m-p20b {
                padding-bottom: 20px !important
            }

            .es-mobile-hidden,
            .es-hidden {
                display: none !important
            }

            tr.es-desk-hidden,
            td.es-desk-hidden,
            table.es-desk-hidden {
                width: auto !important;
                overflow: visible !important;
                float: none !important;
                max-height: inherit !important;
                line-height: inherit !important
            }

            tr.es-desk-hidden {
                display: table-row !important
            }

            table.es-desk-hidden {
                display: table !important
            }

            td.es-desk-menu-hidden {
                display: table-cell !important
            }

            .es-menu td {
                width: 1% !important
            }

            table.es-table-not-adapt,
            .esd-block-html table {
                width: auto !important
            }

            table.es-social {
                display: inline-block !important
            }

            table.es-social td {
                display: inline-block !important
            }

            a.es-button,
            button.es-button {
                font-size: 20px !important;
                display: block !important;
                border-left-width: 0px !important;
                border-right-width: 0px !important
            }
        }
    </style>
</head>

<body style='width:100%;font-family:arial, ' helvetica neue', helvetica,
    sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0'>
    <div class='es-wrapper-color' style='background-color:#F6F6F6'>
        <!--[if gte mso 9]><v:background xmlns:v='urn:schemas-microsoft-com:vml' fill='t'> <v:fill type='tile' color='#f6f6f6'></v:fill> </v:background><![endif]-->
        <table class='es-wrapper' width='100%' cellspacing='0' cellpadding='0'
            style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top'>
            <tr style='border-collapse:collapse'>
                <td valign='top' style='padding:0;Margin:0'>
                    <table class='es-content' cellspacing='0' cellpadding='0' align='center' 
                    style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%'>
                        <tr style='border-collapse:collapse'>
                            <td align='center' style='padding:0;Margin:0'>
                                <table class='es-content-body' cellspacing='0' cellpadding='0' align='center'
                                    style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px'>
                                    <tr style='border-collapse:collapse'>
                                        <td style='Margin:0;padding-top:15px;padding-bottom:15px;padding-left:20px;padding-right:20px;background-color:#051037'
                                            bgcolor='#051037' align='left'>
                                            <table width='100%' cellspacing='0' cellpadding='0'
                                                style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                <tr style='border-collapse:collapse'>
                                                    <td valign='top' align='center'
                                                        style='padding:0;Margin:0;width:560px'>
                                                        <table width='100%' cellspacing='0' cellpadding='0'
                                                            role='presentation'
                                                            style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                            <tr style='border-collapse:collapse'>
                                                                <td align='center'
                                                                    style='padding:0;Margin:0;font-size:0px'>
                                                                    <img src='https://nwvpff.stripocdn.email/content/guids/CABINET_53db3a2d5208a2a89935bb61dcab05a0/images/36141611571100614.png'
                                                                        alt='Http 404 Logo' title='Http 404 Logo'
                                                                        style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic'
                                                                        width='92' height='65'>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr style='border-collapse:collapse'>
                                        <td style='Margin:0;padding-bottom:10px;padding-top:15px;padding-left:20px;padding-right:20px;background-position:center center'
                                            align='left'>
                                            <!--[if mso]><table style='width:560px' cellpadding='0' cellspacing='0'><tr><td style='width:270px' valign='top'><![endif]-->
                                            <table class='es-left' cellspacing='0' cellpadding='0' align='left'
                                                style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left'>
                                                <tr style='border-collapse:collapse'>
                                                    <td align='left' style='padding:0;Margin:0;width:270px'>
                                                        <table width='100%' cellspacing='0' cellpadding='0'
                                                            role='presentation'
                                                            style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                            <tr style='border-collapse:collapse'>
                                                                <td class='es-m-txt-c' align='left'
                                                                    style='padding:0;Margin:0'>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <!--[if mso]></td><td style='width:20px'></td><td style='width:270px' valign='top'><![endif]-->
                                            <table class='es-right' cellspacing='0' cellpadding='0' align='right'
                                                style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right'>
                                                <tr style='border-collapse:collapse'>
                                                    <td align='left' style='padding:0;Margin:0;width:270px'>
                                                        <table width='100%' cellspacing='0' cellpadding='0'
                                                            role='presentation'
                                                            style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                            <tr style='border-collapse:collapse'>
                                                                <td class='es-m-txt-c' align='right'
                                                                    style='padding:0;Margin:0'>
                                                                    <h5 style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial,
                                                                        helvetica neue, helvetica,
                                                                        sans-serif;line-height:21px;color:#333333'>
                                                                       Enviado em: $data_atual</h5>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <!--[if mso]></td></tr></table><![endif]-->
                                        </td>
                                    </tr>
                                    <tr style='border-collapse:collapse'>
                                        <td align='left' style='padding:0;Margin:0;padding-bottom:10px'>
                                            <table width='100%' cellspacing='0' cellpadding='0'
                                                style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                <tr style='border-collapse:collapse'>
                                                    <td valign='top' align='center'
                                                        style='padding:0;Margin:0;width:600px'>
                                                        <table width='100%' cellspacing='0' cellpadding='0'
                                                            role='presentation'
                                                            style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                            <tr style='border-collapse:collapse'>
                                                                <td align='center'
                                                                    style='padding:0;Margin:0;padding-bottom:5px;font-size:0'>
                                                                    <table width='100%' height='100%' cellspacing='0'
                                                                        cellpadding='0' border='0' role='presentation'
                                                                        style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                                        <tr style='border-collapse:collapse'>
                                                                            <td
                                                                                style='padding:0;Margin:0;border-bottom:1px solid #EFEFEF;background:#FFFFFF none repeat scroll 0% 0%;height:1px;width:100%;margin:0px'>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr style='border-collapse:collapse'>
                                        <td style='Margin:0;padding-top:20px;padding-bottom:20px;padding-left:20px;padding-right:20px;background-position:center top'
                                            align='left'>
                                            <table width='100%' cellspacing='0' cellpadding='0'
                                                style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                <tr style='border-collapse:collapse'>
                                                    <td valign='top' align='center'
                                                        style='padding:0;Margin:0;width:560px'>
                                                        <table width='100%' cellspacing='0' cellpadding='0'
                                                            role='presentation'
                                                            style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                            <tr style='border-collapse:collapse'>
                                                                <td align='center' style='padding:0;Margin:0'>
                                                                    <h1 style='Margin:0;line-height:29px;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;font-size:24px;font-style:normal;font-weight:normal;color:#333333'>
                                                                        Obrigado por subscrever ao alertas da HTTP 404!</h1>
                                                                </td>
                                                            </tr>
                                                            <tr style='border-collapse:collapse'>
                                                                <td align='center'
                                                                    style='Margin:0;padding-top:5px;padding-bottom:10px;padding-left:20px;padding-right:20px;font-size:0'>
                                                                    <table width='10%' height='100%' cellspacing='0'
                                                                        cellpadding='0' border='0' role='presentation'
                                                                        style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                                        <tr style='border-collapse:collapse'>
                                                                            <td
                                                                                style='padding:0;Margin:0;border-bottom:3px solid #F1C232;background:#FFFFFF none repeat scroll 0% 0%;height:1px;width:100%;margin:0px'>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr style='border-collapse:collapse'>
                                                                <td align='center'
                                                                    style='padding:0;Margin:0;padding-top:5px'>
                                                                    <h3 style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial,
                                                                        helvetica neue, helvetica,
                                                                        sans-serif;line-height:21px;color:#333333'>
                                                                        Agora irá sempre receber um email quando temos alguma novidade para si!</h3>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                    <table class='es-content' cellspacing='0' cellpadding='0' align='center'
                        style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%'>
                        <tr style='border-collapse:collapse'>
                            <td align='center' style='padding:0;Margin:0'>
                                <table class='es-content-body'
                                    style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px'
                                    cellspacing='0' cellpadding='0' bgcolor='#ffffff' align='center'>
                                    <tr style='border-collapse:collapse'>
                                        <td style='padding:10px;Margin:0;background-position:center top' align='left'>
                                            <table width='100%' cellspacing='0' cellpadding='0'
                                                style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                <tr style='border-collapse:collapse'>
                                                    <td valign='top' align='center'
                                                        style='padding:0;Margin:0;width:580px'>
                                                        <table width='100%' cellspacing='0' cellpadding='0'
                                                            role='presentation'
                                                            style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                            <tr style='border-collapse:collapse'>
                                                                <td align='center'
                                                                    style='Margin:0;padding-top:5px;padding-bottom:5px;padding-left:10px;padding-right:10px;font-size:0'>
                                                                    <table width='100%' height='100%' cellspacing='0'
                                                                        cellpadding='0' border='0' role='presentation'
                                                                        style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                                        <tr style='border-collapse:collapse'>
                                                                            <td
                                                                                style='padding:0;Margin:0;border-bottom:1px solid #EFEFEF;background:#FFFFFF none repeat scroll 0% 0%;height:1px;width:100%;margin:0px'>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr style='border-collapse:collapse'>
                                        <td align='left' style='padding:0;Margin:0'>
                                            <table cellspacing='0' cellpadding='0' width='100%'
                                                style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                <tr style='border-collapse:collapse'>
                                                    <td align='left' style='padding:0;Margin:0;width:600px'>
                                                        <table width='100%' cellspacing='0' cellpadding='0'
                                                            role='presentation'
                                                            style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                            <tr style='border-collapse:collapse'>
                                                                <td align='center'
                                                                    style='padding:0;Margin:0;padding-top:40px'>
                                                                    <h3
                                                                        style='Margin:0;line-height:24px;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;font-size:20px;font-style:normal;font-weight:normal;color:#333333'>
                                                                        Suporte Disponível 24/7</h3>
                                                                </td>
                                                            </tr>
                                                            <tr style='border-collapse:collapse'>
                                                                <td align='center'
                                                                    style='padding:0;Margin:0;padding-top:15px;padding-bottom:40px'>
                                                                    <h1
                                                                        style='Margin:0;line-height:36px;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;font-size:30px;font-style:normal;font-weight:normal;color:#333333'>
                                                                        01245 658 698 (Grátis)</h1>
                                                                    <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, helvetica neue, helvetica,sans-serif;line-height:21px;color:#333333'>Ou
                                                                        envie uma mensagem para nós através do nosso Site!</p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table cellpadding='0' cellspacing='0' class='es-footer' align='center'
                        style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top'>
                        <tr style='border-collapse:collapse'>
                            <td align='center' style='padding:0;Margin:0'>
                                <table class='es-footer-body' cellspacing='0' cellpadding='0' align='center'
                                    style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFD500;width:600px'>
                                    <tr style='border-collapse:collapse'>
                                        <td align='left' style='padding:20px;Margin:0'>
                                            <!--[if mso]><table style='width:560px' cellpadding='0' cellspacing='0'><tr><td style='width:178px' valign='top'><![endif]-->
                                            <table class='es-left' cellspacing='0' cellpadding='0' align='left'
                                                style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left'>
                                                <tr style='border-collapse:collapse'>
                                                    <td class='es-m-p0r es-m-p20b' valign='top' align='center'
                                                        style='padding:0;Margin:0;width:178px'>
                                                        <table width='100%' cellspacing='0' cellpadding='0'
                                                            role='presentation'
                                                            style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                            <tr style='border-collapse:collapse'>
                                                                <td align='center'
                                                                    style='padding:0;Margin:0;font-size:0px'><img
                                                                        src='https://nwvpff.stripocdn.email/content/guids/CABINET_53db3a2d5208a2a89935bb61dcab05a0/images/36141611571100614.png'
                                                                        alt='Http 404 Logo' title='Http 404 Logo'
                                                                        width='178'
                                                                        style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic'
                                                                        height='125'></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <!--[if mso]></td><td style='width:20px'></td>
<td style='width:362px' valign='top'><![endif]-->
                                            <table cellspacing='0' cellpadding='0' align='right'
                                                style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                <tr style='border-collapse:collapse'>
                                                    <td align='left' style='padding:0;Margin:0;width:362px'>
                                                        <table width='100%' cellspacing='0' cellpadding='0'
                                                            role='presentation'
                                                            style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                            <tr style='border-collapse:collapse'>
                                                                <td class='es-m-txt-l' align='center'
                                                                    style='padding:0;Margin:0;padding-bottom:10px'>
                                                                    <h3
                                                                        style='Margin:0;line-height:24px;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;font-size:20px;font-style:normal;font-weight:normal;color:#333333'>
                                                                        Fale Connosco</h3>
                                                                </td>
                                                            </tr>
                                                            <tr style='border-collapse:collapse'>
                                                                <td class='es-m-txt-c' align='center'
                                                                    style='padding:0;Margin:0'>
                                                                    <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 
                                                                        helvetica neue, helvetica,
                                                                        sans-serif;line-height:21px;color:#333333'>Rua
                                                                        8, Tavira</p>
                                                                    <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 
                                                                        helvetica neue, helvetica,
                                                                        sans-serif;line-height:21px;color:#333333'>+090
                                                                        12568 369 987</p>
                                                                    <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 
                                                                        helvetica neue, helvetica,
                                                                        sans-serif;line-height:21px;color:#333333'>
                                                                        info@http404.com</p>
                                                                </td>
                                                            </tr>
                                                            <tr style='border-collapse:collapse'>
                                                                <td class='es-m-txt-c' align='center'
                                                                    style='padding:0;Margin:0;padding-top:10px;font-size:0'>
                                                                    <table class='es-social es-table-not-adapt'
                                                                        cellspacing='0' cellpadding='0'
                                                                        role='presentation'
                                                                        style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                                        <tr style='border-collapse:collapse'>
                                                                            <td valign='top' align='center'
                                                                                style='padding:0;Margin:0;padding-right:10px'>
                                                                                <a target='_blank'
                                                                                    href='https://twitter.com/Http404Vhttps://'
                                                                                    style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 
                                                                                    helvetica neue, helvetica,
                                                                                    sans-serif;font-size:14px;text-decoration:underline;color:#333333'><img
                                                                                        title='Twitter'
                                                                                        src='https://nwvpff.stripocdn.email/content/assets/img/social-icons/logo-black/twitter-logo-black.png'
                                                                                        alt='Tw' width='32' height='32'
                                                                                        style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic'></a>
                                                                            </td>
                                                                            <td valign='top' align='center'
                                                                                style='padding:0;Margin:0;padding-right:10px'>
                                                                                <a target='_blank'
                                                                                    href='https://twitter.com/Http404V'
                                                                                    style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 
                                                                                    helvetica neue, helvetica,
                                                                                    sans-serif;font-size:14px;text-decoration:underline;color:#333333'><img
                                                                                        title='Facebook'
                                                                                        src='https://nwvpff.stripocdn.email/content/assets/img/social-icons/logo-black/facebook-logo-black.png'
                                                                                        alt='Fb' width='32' height='32'
                                                                                        style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic'></a>
                                                                            </td>
                                                                            <td valign='top' align='center'
                                                                                style='padding:0;Margin:0'><a
                                                                                    target='_blank'
                                                                                    href='https://www.instagram.com/lojahttp404/'
                                                                                    style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial,
                                                                                    helvetica neue, helvetica,
                                                                                    sans-serif;font-size:14px;text-decoration:underline;color:#333333'>
                                                                                    <img title='Instagram'
                                                                                        src='https://nwvpff.stripocdn.email/content/assets/img/social-icons/logo-black/instagram-logo-black.png'
                                                                                        alt='Ig' width='32' height='32'
                                                                                        style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic'></a>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <!--[if mso]></td></tr></table><![endif]-->
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
    <div style='position:absolute;left:-9999px;top:-9999px'></div>
</body>
</html>
";
$mensagem_produto = "
<!DOCTYPE html
    PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xmlns:o='urn:schemas-microsoft-com:office:office'
    style='width:100%;font-family:arial, helvetica neue, helvetica,
    sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0'>

<head>
    <meta charset='UTF-8'>
    <meta content='width=device-width, initial-scale=1' name='viewport'>
    <meta name='x-apple-disable-message-reformatting'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta content='telephone=no' name='format-detection'>
    <title>http404 - compra </title>
    <!--[if (mso 16)]><style type='text/css'>     a {text-decoration: none;}     </style><![endif]-->
    <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]-->
    <!--[if gte mso 9]><xml> <o:OfficeDocumentSettings> <o:AllowPNG></o:AllowPNG> <o:PixelsPerInch>96</o:PixelsPerInch>
</o:OfficeDocumentSettings> </xml><![endif]-->
    <style type='text/css'>
        #outlook a {
            padding: 0;
        }

        .ExternalClass {
            width: 100%;
        }

        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {    
            line-height: 100%;
        }

        .es-button {
            mso-style-priority: 100 !important;
            text-decoration: none !important;
        }

        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        .es-desk-hidden {
            display: none;
            float: left;
            overflow: hidden;
            width: 0;
            max-height: 0;
            line-height: 0;
            mso-hide: all;
        }

        @media only screen and (max-width:600px) {

            p,
            ul li,
            ol li,
            a {
                font-size: 14px !important;
                line-height: 150% !important
            }

            h1 {
                font-size: 30px !important;
                text-align: center;
                line-height: 120% !important
            }

            h2 {
                font-size: 26px !important;
                text-align: center;
                line-height: 120% !important
            }

            h3 {
                font-size: 20px !important;
                text-align: center;
                line-height: 120% !important
            }

            h1 a {
                font-size: 30px !important
            }

            h2 a {
                font-size: 26px !important
            }

            h3 a {
                font-size: 20px !important
            }

            .es-menu td a {
                font-size: 14px !important
            }

            .es-header-body p,
            .es-header-body ul li,
            .es-header-body ol li,
            .es-header-body a {
                font-size: 14px !important
            }

            .es-footer-body p,
            .es-footer-body ul li,
            .es-footer-body ol li,
            .es-footer-body a {
                font-size: 14px !important
            }

            .es-infoblock p,
            .es-infoblock ul li,
            .es-infoblock ol li,
            .es-infoblock a {
                font-size: 12px !important
            }

            *[class='gmail-fix'] {
                display: none !important
            }

            .es-m-txt-c,
            .es-m-txt-c h1,
            .es-m-txt-c h2,
            .es-m-txt-c h3 {
                text-align: center !important
            }

            .es-m-txt-r,
            .es-m-txt-r h1,
            .es-m-txt-r h2,
            .es-m-txt-r h3 {
                text-align: right !important
            }

            .es-m-txt-l,
            .es-m-txt-l h1,
            .es-m-txt-l h2,
            .es-m-txt-l h3 {
                text-align: left !important
            }

            .es-m-txt-r img,
            .es-m-txt-c img,
            .es-m-txt-l img {
                display: inline !important
            }

            .es-button-border {
                display: block !important
            }

            .es-btn-fw {
                border-width: 10px 0px !important;
                text-align: center !important
            }

            .es-adaptive table,
            .es-btn-fw,
            .es-btn-fw-brdr,
            .es-left,
            .es-right {
                width: 100% !important
            }

            .es-content table,
            .es-header table,
            .es-footer table,
            .es-content,
            .es-footer,
            .es-header {
                width: 100% !important;
                max-width: 600px !important
            }

            .es-adapt-td {
                display: block !important;
                width: 100% !important
            }

            .adapt-img {
                width: 100% !important;
                height: auto !important
            }

            .es-m-p0 {
                padding: 0px !important
            }

            .es-m-p0r {
                padding-right: 0px !important
            }

            .es-m-p0l {
                padding-left: 0px !important
            }

            .es-m-p0t {
                padding-top: 0px !important
            }

            .es-m-p0b {
                padding-bottom: 0 !important
            }

            .es-m-p20b {
                padding-bottom: 20px !important
            }

            .es-mobile-hidden,
            .es-hidden {
                display: none !important
            }

            tr.es-desk-hidden,
            td.es-desk-hidden,
            table.es-desk-hidden {
                width: auto !important;
                overflow: visible !important;
                float: none !important;
                max-height: inherit !important;
                line-height: inherit !important
            }

            tr.es-desk-hidden {
                display: table-row !important
            }

            table.es-desk-hidden {
                display: table !important
            }

            td.es-desk-menu-hidden {
                display: table-cell !important
            }

            .es-menu td {
                width: 1% !important
            }

            table.es-table-not-adapt,
            .esd-block-html table {
                width: auto !important
            }

            table.es-social {
                display: inline-block !important
            }

            table.es-social td {
                display: inline-block !important
            }

            a.es-button,
            button.es-button {
                font-size: 20px !important;
                display: block !important;
                border-left-width: 0px !important;
                border-right-width: 0px !important
            }
        }
    </style>
</head>

<body style='width:100%;font-family:arial, ' helvetica neue', helvetica,
    sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0'>
    <div class='es-wrapper-color' style='background-color:#F6F6F6'>
        <!--[if gte mso 9]><v:background xmlns:v='urn:schemas-microsoft-com:vml' fill='t'> <v:fill type='tile' color='#f6f6f6'></v:fill> </v:background><![endif]-->
        <table class='es-wrapper' width='100%' cellspacing='0' cellpadding='0'
            style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top'>
            <tr style='border-collapse:collapse'>
                <td valign='top' style='padding:0;Margin:0'>
                    <table class='es-content' cellspacing='0' cellpadding='0' align='center' 
                    style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%'>
                        <tr style='border-collapse:collapse'>
                            <td align='center' style='padding:0;Margin:0'>
                                <table class='es-content-body' cellspacing='0' cellpadding='0' align='center'
                                    style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px'>
                                    <tr style='border-collapse:collapse'>
                                        <td style='Margin:0;padding-top:15px;padding-bottom:15px;padding-left:20px;padding-right:20px;background-color:#051037'
                                            bgcolor='#051037' align='left'>
                                            <table width='100%' cellspacing='0' cellpadding='0'
                                                style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                <tr style='border-collapse:collapse'>
                                                    <td valign='top' align='center'
                                                        style='padding:0;Margin:0;width:560px'>
                                                        <table width='100%' cellspacing='0' cellpadding='0'
                                                            role='presentation'
                                                            style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                            <tr style='border-collapse:collapse'>
                                                                <td align='center'
                                                                    style='padding:0;Margin:0;font-size:0px'>
                                                                    <img src='https://nwvpff.stripocdn.email/content/guids/CABINET_53db3a2d5208a2a89935bb61dcab05a0/images/36141611571100614.png'
                                                                        alt='Http 404 Logo' title='Http 404 Logo'
                                                                        style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic'
                                                                        width='92' height='65'>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr style='border-collapse:collapse'>
                                        <td style='Margin:0;padding-bottom:10px;padding-top:15px;padding-left:20px;padding-right:20px;background-position:center center'
                                            align='left'>
                                            <!--[if mso]><table style='width:560px' cellpadding='0' cellspacing='0'><tr><td style='width:270px' valign='top'><![endif]-->
                                            <table class='es-left' cellspacing='0' cellpadding='0' align='left'
                                                style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left'>
                                                <tr style='border-collapse:collapse'>
                                                    <td align='left' style='padding:0;Margin:0;width:270px'>
                                                        <table width='100%' cellspacing='0' cellpadding='0'
                                                            role='presentation'
                                                            style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                            <tr style='border-collapse:collapse'>
                                                                <td class='es-m-txt-c' align='left'
                                                                    style='padding:0;Margin:0'>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <!--[if mso]></td><td style='width:20px'></td><td style='width:270px' valign='top'><![endif]-->
                                            <table class='es-right' cellspacing='0' cellpadding='0' align='right'
                                                style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right'>
                                                <tr style='border-collapse:collapse'>
                                                    <td align='left' style='padding:0;Margin:0;width:270px'>
                                                        <table width='100%' cellspacing='0' cellpadding='0'
                                                            role='presentation'
                                                            style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                            <tr style='border-collapse:collapse'>
                                                                <td class='es-m-txt-c' align='right'
                                                                    style='padding:0;Margin:0'>
                                                                    <h5 style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial,
                                                                        helvetica neue, helvetica,
                                                                        sans-serif;line-height:21px;color:#333333'>
                                                                       Enviado em: $data_atual</h5>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <!--[if mso]></td></tr></table><![endif]-->
                                        </td>
                                    </tr>
                                    <tr style='border-collapse:collapse'>
                                        <td align='left' style='padding:0;Margin:0;padding-bottom:10px'>
                                            <table width='100%' cellspacing='0' cellpadding='0'
                                                style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                <tr style='border-collapse:collapse'>
                                                    <td valign='top' align='center'
                                                        style='padding:0;Margin:0;width:600px'>
                                                        <table width='100%' cellspacing='0' cellpadding='0'
                                                            role='presentation'
                                                            style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                            <tr style='border-collapse:collapse'>
                                                                <td align='center'
                                                                    style='padding:0;Margin:0;padding-bottom:5px;font-size:0'>
                                                                    <table width='100%' height='100%' cellspacing='0'
                                                                        cellpadding='0' border='0' role='presentation'
                                                                        style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                                        <tr style='border-collapse:collapse'>
                                                                            <td
                                                                                style='padding:0;Margin:0;border-bottom:1px solid #EFEFEF;background:#FFFFFF none repeat scroll 0% 0%;height:1px;width:100%;margin:0px'>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr style='border-collapse:collapse'>
                                        <td style='Margin:0;padding-top:20px;padding-bottom:20px;padding-left:20px;padding-right:20px;background-position:center top'
                                            align='left'>
                                            <table width='100%' cellspacing='0' cellpadding='0'
                                                style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                <tr style='border-collapse:collapse'>
                                                    <td valign='top' align='center'
                                                        style='padding:0;Margin:0;width:560px'>
                                                        <table width='100%' cellspacing='0' cellpadding='0'
                                                            role='presentation'
                                                            style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                            <tr style='border-collapse:collapse'>
                                                                <td align='center' style='padding:0;Margin:0'>
                                                                    <h1 style='Margin:0;line-height:29px;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;font-size:24px;font-style:normal;font-weight:normal;color:#333333'>
                                                                        Está Um Novo Produto Disponível Na Nossa Loja!</h1>
                                                                </td>
                                                            </tr>
                                                            <tr style='border-collapse:collapse'>
                                                                <td align='center'
                                                                    style='Margin:0;padding-top:5px;padding-bottom:10px;padding-left:20px;padding-right:20px;font-size:0'>
                                                                    <table width='10%' height='100%' cellspacing='0'
                                                                        cellpadding='0' border='0' role='presentation'
                                                                        style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                                        <tr style='border-collapse:collapse'>
                                                                            <td
                                                                                style='padding:0;Margin:0;border-bottom:3px solid #F1C232;background:#FFFFFF none repeat scroll 0% 0%;height:1px;width:100%;margin:0px'>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr style='border-collapse:collapse'>
                                                                <td align='center'
                                                                    style='padding:0;Margin:0;padding-top:5px'>
                                                                    <h3 style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial,
                                                                        helvetica neue, helvetica,
                                                                        sans-serif;line-height:21px;color:#333333'>
                                                                        Adicione-o ao Carrinho antes que o estoque acabe!</h3>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                    <table class='es-content' cellspacing='0' cellpadding='0' align='center'
                        style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%'>
                        <tr style='border-collapse:collapse'>
                            <td align='center' style='padding:0;Margin:0'>
                                <table class='es-content-body'
                                    style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px'
                                    cellspacing='0' cellpadding='0' bgcolor='#ffffff' align='center'>
                                    <tr style='border-collapse:collapse'>
                                        <td style='padding:10px;Margin:0;background-position:center top' align='left'>
                                            <table width='100%' cellspacing='0' cellpadding='0'
                                                style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                <tr style='border-collapse:collapse'>
                                                    <td valign='top' align='center'
                                                        style='padding:0;Margin:0;width:580px'>
                                                        <table width='100%' cellspacing='0' cellpadding='0'
                                                            role='presentation'
                                                            style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                            <tr style='border-collapse:collapse'>
                                                                <td align='center'
                                                                    style='Margin:0;padding-top:5px;padding-bottom:5px;padding-left:10px;padding-right:10px;font-size:0'>
                                                                    <table width='100%' height='100%' cellspacing='0'
                                                                        cellpadding='0' border='0' role='presentation'
                                                                        style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                                        <tr style='border-collapse:collapse'>
                                                                            <td
                                                                                style='padding:0;Margin:0;border-bottom:1px solid #EFEFEF;background:#FFFFFF none repeat scroll 0% 0%;height:1px;width:100%;margin:0px'>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr style='border-collapse:collapse'>
                                        <td align='left' style='padding:0;Margin:0'>
                                            <table cellspacing='0' cellpadding='0' width='100%'
                                                style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                <tr style='border-collapse:collapse'>
                                                    <td align='left' style='padding:0;Margin:0;width:600px'>
                                                        <table width='100%' cellspacing='0' cellpadding='0'
                                                            role='presentation'
                                                            style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                            <tr style='border-collapse:collapse'>
                                                                <td align='center'
                                                                    style='padding:0;Margin:0;padding-top:40px'>
                                                                    <h3
                                                                        style='Margin:0;line-height:24px;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;font-size:20px;font-style:normal;font-weight:normal;color:#333333'>
                                                                        Suporte Disponível 24/7</h3>
                                                                </td>
                                                            </tr>
                                                            <tr style='border-collapse:collapse'>
                                                                <td align='center'
                                                                    style='padding:0;Margin:0;padding-top:15px;padding-bottom:40px'>
                                                                    <h1
                                                                        style='Margin:0;line-height:36px;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;font-size:30px;font-style:normal;font-weight:normal;color:#333333'>
                                                                        01245 658 698 (Grátis)</h1>
                                                                    <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, helvetica neue, helvetica,sans-serif;line-height:21px;color:#333333'>Ou
                                                                        envie uma mensagem para nós através do nosso Site!</p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table cellpadding='0' cellspacing='0' class='es-footer' align='center'
                        style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top'>
                        <tr style='border-collapse:collapse'>
                            <td align='center' style='padding:0;Margin:0'>
                                <table class='es-footer-body' cellspacing='0' cellpadding='0' align='center'
                                    style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFD500;width:600px'>
                                    <tr style='border-collapse:collapse'>
                                        <td align='left' style='padding:20px;Margin:0'>
                                            <!--[if mso]><table style='width:560px' cellpadding='0' cellspacing='0'><tr><td style='width:178px' valign='top'><![endif]-->
                                            <table class='es-left' cellspacing='0' cellpadding='0' align='left'
                                                style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left'>
                                                <tr style='border-collapse:collapse'>
                                                    <td class='es-m-p0r es-m-p20b' valign='top' align='center'
                                                        style='padding:0;Margin:0;width:178px'>
                                                        <table width='100%' cellspacing='0' cellpadding='0'
                                                            role='presentation'
                                                            style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                            <tr style='border-collapse:collapse'>
                                                                <td align='center'
                                                                    style='padding:0;Margin:0;font-size:0px'><img
                                                                        src='https://nwvpff.stripocdn.email/content/guids/CABINET_53db3a2d5208a2a89935bb61dcab05a0/images/36141611571100614.png'
                                                                        alt='Http 404 Logo' title='Http 404 Logo'
                                                                        width='178'
                                                                        style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic'
                                                                        height='125'></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <!--[if mso]></td><td style='width:20px'></td>
<td style='width:362px' valign='top'><![endif]-->
                                            <table cellspacing='0' cellpadding='0' align='right'
                                                style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                <tr style='border-collapse:collapse'>
                                                    <td align='left' style='padding:0;Margin:0;width:362px'>
                                                        <table width='100%' cellspacing='0' cellpadding='0'
                                                            role='presentation'
                                                            style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                            <tr style='border-collapse:collapse'>
                                                                <td class='es-m-txt-l' align='center'
                                                                    style='padding:0;Margin:0;padding-bottom:10px'>
                                                                    <h3
                                                                        style='Margin:0;line-height:24px;mso-line-height-rule:exactly;font-family:tahoma, verdana, segoe, sans-serif;font-size:20px;font-style:normal;font-weight:normal;color:#333333'>
                                                                        Fale Connosco</h3>
                                                                </td>
                                                            </tr>
                                                            <tr style='border-collapse:collapse'>
                                                                <td class='es-m-txt-c' align='center'
                                                                    style='padding:0;Margin:0'>
                                                                    <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 
                                                                        helvetica neue, helvetica,
                                                                        sans-serif;line-height:21px;color:#333333'>Rua
                                                                        8, Tavira</p>
                                                                    <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 
                                                                        helvetica neue, helvetica,
                                                                        sans-serif;line-height:21px;color:#333333'>+090
                                                                        12568 369 987</p>
                                                                    <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 
                                                                        helvetica neue, helvetica,
                                                                        sans-serif;line-height:21px;color:#333333'>
                                                                        info@http404.com</p>
                                                                </td>
                                                            </tr>
                                                            <tr style='border-collapse:collapse'>
                                                                <td class='es-m-txt-c' align='center'
                                                                    style='padding:0;Margin:0;padding-top:10px;font-size:0'>
                                                                    <table class='es-social es-table-not-adapt'
                                                                        cellspacing='0' cellpadding='0'
                                                                        role='presentation'
                                                                        style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                                                                        <tr style='border-collapse:collapse'>
                                                                            <td valign='top' align='center'
                                                                                style='padding:0;Margin:0;padding-right:10px'>
                                                                                <a target='_blank'
                                                                                    href='https://twitter.com/Http404Vhttps://'
                                                                                    style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 
                                                                                    helvetica neue, helvetica,
                                                                                    sans-serif;font-size:14px;text-decoration:underline;color:#333333'><img
                                                                                        title='Twitter'
                                                                                        src='https://nwvpff.stripocdn.email/content/assets/img/social-icons/logo-black/twitter-logo-black.png'
                                                                                        alt='Tw' width='32' height='32'
                                                                                        style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic'></a>
                                                                            </td>
                                                                            <td valign='top' align='center'
                                                                                style='padding:0;Margin:0;padding-right:10px'>
                                                                                <a target='_blank'
                                                                                    href='https://twitter.com/Http404V'
                                                                                    style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 
                                                                                    helvetica neue, helvetica,
                                                                                    sans-serif;font-size:14px;text-decoration:underline;color:#333333'><img
                                                                                        title='Facebook'
                                                                                        src='https://nwvpff.stripocdn.email/content/assets/img/social-icons/logo-black/facebook-logo-black.png'
                                                                                        alt='Fb' width='32' height='32'
                                                                                        style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic'></a>
                                                                            </td>
                                                                            <td valign='top' align='center'
                                                                                style='padding:0;Margin:0'><a
                                                                                    target='_blank'
                                                                                    href='https://www.instagram.com/lojahttp404/'
                                                                                    style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial,
                                                                                    helvetica neue, helvetica,
                                                                                    sans-serif;font-size:14px;text-decoration:underline;color:#333333'>
                                                                                    <img title='Instagram'
                                                                                        src='https://nwvpff.stripocdn.email/content/assets/img/social-icons/logo-black/instagram-logo-black.png'
                                                                                        alt='Ig' width='32' height='32'
                                                                                        style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic'></a>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <!--[if mso]></td></tr></table><![endif]-->
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
    <div style='position:absolute;left:-9999px;top:-9999px'></div>
</body>
</html>
";
return $mensagem = array($mensagem_compra, $mensagem_marketing, $mensagem_produto);

?>