<?php
/** Página do logout, quando é chamada faz o logout do funcionário e destrói a sessão e todos os dados.
 * @author Grupo HTTP 404
 * @version 2.0
 * @since 2 jan 2021
 **/
//inicia a sessao e destroi todos os dados gravados em cache e assim como todo os produtos do carrinho e valores em SESSION
session_start();
ob_start();
// Desabilita a demonstração de erros, para que não haja a possibilidade de aparecer erros para o usuário final
ini_set('display_errors', 0);
$_SESSION = array();
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
@session_destroy();
        
echo  "<script type='text/javascript'>
                alert('Saindo do sistema...');location.href='login.php'
    </script>";
?>