<?php
	class estadisticas
	{
		private $pdo;  //para construir cadena de conexion

		//Constructor de la clase
		public function __construct()
		{
			//variables a usar para construir la conexión a la base de datos
			$dbHost = 'localhost';
			$dbName = 'bd_helsa';
			$dbUser = 'root';
			$dbPass = '';
			try
			{
				$this->pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
				$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch(Exception $e)
			{
				echo $e->getMessage();
			}
		}
		public function contar_registrados()
		{
				return $this->pdo->query("SELECT COUNT(*) as registrados from pedido where id_status = 1");
		}
		public function contar_autorizados()
		{
				return $this->pdo->query("SELECT COUNT(*) as autorizados from pedido where id_status = 2");
		}
		public function contar_en_proceso()
		{
				return $this->pdo->query("SELECT COUNT(*) as en_proceso from pedido where id_status = 3");
		}
		public function contar_cancelados()
		{
				return $this->pdo->query("SELECT COUNT(*) as cancelados from pedido where id_status = 4");
		}
		public function contar_rechazados()
		{
				return $this->pdo->query("SELECT COUNT(*) as rechazados from pedido where id_status = 5");
		}
		public function contar_entregados()
		{
				return $this->pdo->query("SELECT COUNT(*) as entregados from pedido where id_status = 6");
		}
	}
?>
