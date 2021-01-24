<?php
/** 
 * Página que Autentica o login dos funcionários
 * @author Grupo HTTP 404
 * @version 1.1
 * @since 24 dez 2020
 */	
require_once('Conexao.class.php');
	
class Autentica extends Conexao{
	private $data = array();

	public function __construct(){
		$this->erro = '';
	}
	
	public function __set($name, $value){
		$this->data[$name] = $value;
	}

	public function __get($name){
		if (array_key_exists($name, $this->data)) {
			return $this->data[$name];
		}

		$trace = debug_backtrace();
		trigger_error(
			'Undefined property via __get(): ' . $name .
			' in ' . $trace[0]['file'] .
			' on line ' . $trace[0]['line'],
			E_USER_NOTICE);
		return null;
	}
		
		public function Validar_Usuario(){
			/** 
			 * Função Que valida o login de um usuário
			 * @author Grupo HTTP 404
			 * @version 1.1
			 * @since 24 dez 2020
			 * @param $pdo instancia da classe conexao que foi herdada 
			 * @param $resultado Resultado da consulta
			 */
			$pdo = new Conexao(); 
			//chamada do metodo select da classe conexao que nos retornara um conjunto de dados
			$resultado = $pdo->select("SELECT * FROM users WHERE email = '".$this->email."' AND pass = '".$this->pass."'");
			//desconectamos
			$pdo->desconectar();
			//agora vamos resgatar os valores obtidos pelo nosso metodo atraves do foreach
			//verificamos se houve registros dentro de nossa var se sim entra no if
			if(count($resultado)){
				foreach ($resultado as $res) {
					//comecamos nossa sessao para podermos usar os dados do usuario em nossa aplicacao atraves de
					//session, na qual podemos usar para controle de verificar se o user esta logado ou nao, mostrar o nome do user na tela e etc.
					session_start();
					ob_start();
					//setamos as session com os valores obtido da tabela
					$_SESSION['id_users'] = $res['id_users'];
					$_SESSION['nome'] = $res['nome'];
					$_SESSION['email'] = $res['email'];
					$_SESSION['pass'] = $res['pass'];
					$_SESSION['logado'] = 'S';
					$_SESSION['cargo'] = $res['cargo'];
			}
				//se tudo ocorrer bem retornamos true, ou seja verdade
				return true;
			}else{
				//se algo deu errado retornamos false
				return false;
			}
		}
}
?>