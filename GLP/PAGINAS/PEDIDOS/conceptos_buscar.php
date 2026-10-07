<?php
 $codigo = $_REQUEST['codigo'];
    
 // Database connection
 $con = mysqli_connect("localhost", "grupocav_root", "sistemas2015", "grupocav_pedidos_plataforma_21");
    
    if ($codigo !== "") { 
        $query = mysqli_query($con, "SELECT * FROM conceptos_gcp WHERE codigo='$codigo'");
    
        $row = mysqli_fetch_array($query);
        
        $descripcion = $row["descripcion"];
        $unidad = $row["unidad"];
    }
    
    $result = array(
        "$descripcion",
        "$unidad"
        
    );

    $myJSON = json_encode($result);
    echo $myJSON;
?>