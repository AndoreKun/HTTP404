<?php	
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
			//instancio minha classe conex�o que foi herdada
			$pdo = new Conexao(); 
			//chamamos nosso m�todo select da classe conex�o que nos retornar� um conjunto de dados
			$resultado = $pdo->select("SELECT * FROM users WHERE email = '".$this->email."' AND pass = '".$this->pass."'");
			//desconectamos
			$pdo->desconectar();
			//agora vamos resgatar os valores obtidos pelo nosso m�todo atrav�s do foreach
			//verificamos se houve registros dentro de nossa var se sim entra no if
			if(count($resultado)){
				foreach ($resultado as $res) {
					//come�amos nossa sess�o para podermos usar os dados do usuario em nossa aplica��o atrav�s de
					//session, na qual podemos usar para controle de verificar se o user est� logado ou n�o, mostrar o nome do user na tela e etc.
					session_start();
					ob_start();
					//setamos as session com os valores obtido da tabela
					$_SESSION['id_users'] = $res['id_users'];
					$_SESSION['nome'] = $res['nome'];
					$_SESSION['email'] = $res['email'];
					$_SESSION['pass'] = $res['pass'];
					$_SESSION['logado'] = 'S';
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