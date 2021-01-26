<?php


function EnviarMail($destinatario, $assunto, $mensagem, $endereco_cliente, $compra_cliente)
{
    $de = "portalhttp404@gmail.com";
    $headers = "From: HTTP 404 <'.$de.'>\n";
    $headers = "Content-Type: Text/HTML; charset=UTF-8\n";
    // formatação da mensagem em HTML
    switch($mensagem) { 
        case 'email_venda': 
            $mensagem = include("email_html.php");                 
    }
    mail($destinatario,$assunto,$mensagem,$headers);

}
?>