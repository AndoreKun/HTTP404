<?php
/** 
* Página que contêm a função de enviar email, também possibilita guardar os emails de cliente interessados na base de dados
* @author Grupo HTTP404
* @version 1.3
* @since 25 jan 2021
*/

function EnviarMail($destinatario, $assunto, $mensagem, $endereco_cliente, $compra_cliente, $verifica_compra)
    /** Função Envia Email dado obrigatoriamente um destinatario, um assunto e uma mensagem. Também aceita mais 3 valores opcionais
     * ATENÇÂO: Para que a função seja operacional deverá seguir os passos para configurar os arquivos da forma certa que se localiza na nossa wiki
        * @author Grupo HTTP404
        * @version 1.2
        * @since 25 jan 2021
        * @param string $destinatario Email do Destinatário
        * @param string $assunto Assunto do email
        * @param string $mensagem Mensagem/Corpo do Email
     **/
{

    /** $de: Email que enviará o email(Atenção essa opção é apenas para fins visuais no cabeçalho, para mudar o email predefinido acesse nossa wiki) */
    $de = "portalhttp404@gmail.com";
    // Configura o Cabeçalho
    $headers = "From: HTTP 404 <'.$de.'>\n";
    $headers .= "Content-Type: Text/HTML; charset=UTF-8\n";
    /** Caso a variável $mensagem seja 'email_venda', inclui o ficheiro com o email que em HTML relativo ao resumo de uma encomenda para clientes */
    switch($mensagem) { 
        case 'email_venda': 
            $mensagem = include("email_html.php");                 
    }
    // Com a função mail() do PHP envia um email
    mail($destinatario,$assunto,$mensagem,$headers);

}


/** if(isset($_POST['email-markenting'])): Caso o formulário que está no rodapé das páginas for submetido, adiciona o email inserido à base de dados */
if(isset($_POST['email-markenting'])){
    /** $email_interessado: Email Inserido do Formulário */
    $email_interessado = $_POST['email_interessado'];
    /** $insert: Query do insert na base de dados */
    $insert = "INSERT INTO interessados(Email) VALUES('$email_interessado')";
    /** $acao: Ação a ser feita(INSERT/UPDATE/DELETE) */
    $acao = "insert";
    /** $adicionar_foto: Verdadeiro caso queria adicionar uma foto na base de ados */
    $adicionar_foto = FALSE;
    /** $cargo: Cargo que será utilizado ao fazer o insert na base de dados */
    $cargo = "admin";
    /** $pass_users: Palavra passe de cargo */
    $pass_users = "http404#2021%";
    /** Inclui o script de INSERTS na base de dados */
    include('database/inserts_basedados.php');
    // Redireciona de volta a checkout
    echo  "<script type='text/javascript'>
                location.href='checkout.php'
            </script>";	
}
?>