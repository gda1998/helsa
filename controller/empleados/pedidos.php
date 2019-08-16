<?php
	class pedidos
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
		public function listar_pedidos()
		{
			return $this->pdo->query("SELECT cod_pedido, fecha_registro, fecha_entrega, status.descripcion as estado, progreso,
				cliente.nombre as cliente, empleado.nombre as empleado from pedido
				join status on status.id_status = pedido.id_status
				join cliente on cliente.id_cliente = pedido.id_cliente
				join empleado on empleado.id_empleado = pedido.id_empleado");
		}//listar_pedidos()
		public function listar_status()
		{
			return $this->pdo->query("SELECT * from status");
		}//listar_pedidos()
		public function seleccionar_pedido($cod_pedido)
		{
			return $this->pdo->query("SELECT * FROM pedido WHERE cod_pedido=".$cod_pedido);
		}//seleccionar_pedido($id)
		public function editar_pedido($cod_pedido, $fecha_entrega, $id_status, $progreso)
		{
			$sql = "UPDATE pedido SET id_status = :id_status, fecha_entrega= :fecha_entrega, progreso = :progreso WHERE cod_pedido = :cod_pedido";
			$query = $this->pdo->prepare($sql);
			$query->bindParam(":id_status", $id_status);
			$query->bindParam(":progreso", $progreso);
			$query->bindParam(":cod_pedido", $cod_pedido);
			$query->bindParam(":fecha_entrega", $fecha_entrega);
			$query->execute();
		}
		public function editar_pedido_con_empleado($cod_pedido, $fecha_entrega, $id_status, $progreso, $id_empleado)
		{
			$sql = "UPDATE pedido SET id_status = :id_status, fecha_entrega = :fecha_entrega, progreso = :progreso, id_empleado = :id_empleado WHERE cod_pedido = :cod_pedido";
			$query = $this->pdo->prepare($sql);
			$query->bindParam(":id_status", $id_status);
			$query->bindParam(":progreso", $progreso);
			$query->bindParam(":cod_pedido", $cod_pedido);
			$query->bindParam(":fecha_entrega", $fecha_entrega);
			$query->bindParam(":id_empleado", $id_empleado);
			$query->execute();
		}
	}
?>
