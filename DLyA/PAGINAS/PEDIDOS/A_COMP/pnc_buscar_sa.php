<?php
    $fol_a = $_REQUEST['folio_aviso'];
    
    // Database connection
    $con = mysqli_connect("localhost", "grupocav_root", "sistemas2015", "grupocav_pedidos_plataforma_21");
    
    if ($fol_a !== "") { 
        $query = mysqli_query($con, "SELECT * FROM solicitudes_anticipo WHERE folio='$fol_a'");
    
        $row = mysqli_fetch_array($query);
        
        $pedido = $row["folio_compras"];
        $proveedor = htmlspecialchars($row["proveedor"]);
        $recibio = htmlspecialchars($row["coordinador"]);
    }
    
    $result = array(
        "$pedido",
        "$proveedor",
        "$recibio"
    );

    $myJSON = json_encode($result);
    echo $myJSON;
?>