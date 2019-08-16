<?php 
require_once "Conexion.php"; 
$cone=conectarse();
$tabla="";

if (($_POST['func'] == 'NuevoCliente') ) 
{
$Nombre=$_POST['nom'];
$Username=$_POST['user'];
$Password=$_POST['pass'];
$Correo=$_POST['cor'];
$Tel=$_POST['tel'];
$Represent=$_POST['rep'];


$query = "INSERT INTO `cliente` (`nombre`, `username`, `PASSWORD`, `correo`, `telefono`, `representante`) VALUES ('".$Nombre."', '".$Username."', '".$Password."', '".$Correo."', '".$Tel."', '".$Represent."');";
if(!$resultado = $cone->query($query)){
	echo $cone->error;
	return;
}
else{
	echo 'Se ha agregado un Cliente';
	returN;
}

}
if (($_POST['func'] == 'NuevoEmpleado') ) 
{
$Nombre=$_POST['nom'];
$App=$_POST['app'];
$Apm=$_POST['apm'];
$Sueldo=$_POST['suel'];
$Username=$_POST['use'];
$Password=$_POST['pass'];
$TipEmp=$_POST['tip'];

$query="INSERT INTO `empleado` (`nombre`, `apepat`, `apemat`, `sueldo`, `username`, `PASSWORD`, `id_tipo_emp`) VALUES ('".$Nombre."', '".$App."', '".$Apm."', '".$Sueldo."', '".$Username."', '".$Password."', '".$TipEmp."');";
//$query = "INSERT INTO `cliente` (`nombre`, `username`, `PASSWORD`, `correo`, `telefono`, `representante`) VALUES ('".$Nombre."', '".$Username."', '".$Password."', '".$Correo."', '".$Tel."', '".$Represent."');";
if(!$resultado = $cone->query($query)){
	echo $cone->error;
	return;
}
else{
	echo 'Se ha agregado una Empleado';
	returN;
}

}
?>
