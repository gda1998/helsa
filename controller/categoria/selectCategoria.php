<?php
    include '../config/conexion.php';
    if($conexion!=null){
        $query = "SELECT * FROM Categoria;";
        $acentos = $conexion->query("SET NAMES 'utf8'");
        if(!$resultado = $conexion->query($query)){
            echo '
            <script>
                $("#divAlert").attr("style","display:block");
                $("#pAlert").html("'.$conexion->error.'");
            </script>';
            return;
        }
        $cadena = "<option disabled='disabled' selected>Seleccione una opción</option>";
        $cadena = $cadena."<option value='0'>Sin Filtros</option>";
        while($datos=$resultado->fetch_assoc()){
            $cadena = $cadena.'<option value="'.$datos['id_categoria'].'">'.$datos['descripcion'].'</option>';
        }
        $conexion->close();
        echo $cadena;
    }
?>