<?php
	//inicia a sessao e destroi todos os dados gravados em cache etc
    session_start();
	ob_start();
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