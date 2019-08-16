<?php 
function conectarse() 
{
	$user="root";
	$pass="";
	$host="localhost";

    if (!($con=new mysqli($host, $user, $pass))) 
    {
        echo "Error al conectarse a la base de Datos";
        exit();
    }

    if (!mysqli_select_db($con, "bd_helsa")) 
    {
        echo "Error al seleccionar la base de datos.";
        exit();
    }
    return $con;
}

function desconectarse($con) 
{
    mysqli_close($con);
}
 

?>