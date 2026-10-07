<?php
    $rzs = $_REQUEST['razon'];
    
    // Database connection
    $con = mysqli_connect("localhost", "grupocav_root", "sistemas2015", "grupocav_pedidos_plataforma_21");
    
    if ($rzs !== "") { 
        $query = mysqli_query($con, "SELECT * FROM proveedores WHERE razon_social='$rzs'");
        $row = mysqli_fetch_array($query);
        
        $rfc = htmlspecialchars($row["rfc"]);
        $direccion = htmlspecialchars($row["direccion"]);
        $contacto = $row["contacto"];
        $prod_serv = $row["ps1"];

        //consultar números de avisos de compra
        $compras_realizadas = '00';
    }
    
    $result = array(
        "$rfc",
        "$direccion",
        "$contacto",
        "$prod_serv",
        "$compras_realizadas"
    );

    $myJSON = json_encode($result);
    echo $myJSON;
?>