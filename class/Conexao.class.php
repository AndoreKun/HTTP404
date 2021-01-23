<?php 
/** 
 * Página que faz a conexão com a base de dados de forma segura para confirmar o login
 * @author Grupo HTTP 404
 * @version 1.0
 * @since 24 dez 2020
 */	   
	class Conexao {
		private $data = array();
		/** variavel da classe Base */
		protected $pdo = null;
		
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
		/** metodo que retorna a variavel $pdo */
		public function getPdo() {
			return $this->pdo;
		}

		function __construct($pdo = null) {
			/** 
			 * Método que controi a classe
			 * @author Grupo HTTP 404
			 * @version 1.0
			 * @since 24 dez 2020
			 */
			$this->pdo = $pdo;
			if ($this->pdo == null)
				$this->conectar();
		}

		public function conectar() {
			/** 
			 * Método que conecta com a base de de dados
			 * @author Grupo HTTP 404
			 * @version 1.0
			 * @since 24 dez 2020
			 */
			try{
				$this->pdo = new PDO("mysql:host=localhost;dbname=adc_http404",
								"admin",
								"http404#2021%",
								array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			}catch (PDOException $e) {
				print "Error!: " . $e->getMessage() ."<br/>";
				die();
			}
		}

		public function desconectar() {
			/**
			 * Método que desconecta com a base de dados
			 * @author Grupo HTTP 404
			 * @version 1.0
			 * @since 24 dez 2020
			 */
			$this->pdo = null;
		}
		
		public function select($sql){
			/**
			 * Função pública que faz o select da base de dados
			 * @author Grupo HTTP 404
			 * @version 1.0
			 * @since 24 dez 2020
			 */
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
}
?>