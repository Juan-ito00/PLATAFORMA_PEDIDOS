<?php
    $fol_c = $_REQUEST['folio_compr'];
    
    // Database connection
    $con = mysqli_connect("localhost", "grupocav_root", "sistemas2015", "grupocav_pedidos_plataforma_21");
    
    if ($fol_c !== "") { 
        $query = mysqli_query($con, "SELECT * FROM cotizaciones WHERE folio_compras='$fol_c'");
    
        $row = mysqli_fetch_array($query);
        
        $supervisor = $row["solicitante"];
        $fecha = $row["fecha_recibido"];
        $folio = $row["folio_compras"];
        $ubicacion = $row["gerencia"];
        $proyecto = $row["proyecto"];

        $unidad = $row["unid1"];
        $descripcion = htmlspecialchars($row["desc1"]);

        $unidad2 = $row["unid2"];
        $descripcion2 = htmlspecialchars($row["desc2"]);

        $unidad3 = $row["unid3"];
        $descripcion3 = htmlspecialchars($row["desc3"]);

        $unidad4 = $row["unid4"];
        $descripcion4 = htmlspecialchars($row["desc4"]);

        $unidad5 = $row["unid5"];
        $descripcion5 = htmlspecialchars($row["desc5"]);

        $unidad6 = $row["unid6"];
        $descripcion6 = htmlspecialchars($row["desc6"]);

        $unidad7 = $row["unid7"];
        $descripcion7 = htmlspecialchars($row["desc7"]);

        $unidad8 = $row["unid8"];
        $descripcion8 = htmlspecialchars($row["desc8"]);

        $unidad9 = $row["unid9"];
        $descripcion9 = htmlspecialchars($row["desc9"]);

        $unidad10 = $row["unid10"];
        $descripcion10 = htmlspecialchars($row["desc10"]);

        $unidad11 = $row["unid11"];
        $descripcion11 = htmlspecialchars($row["desc11"]);

        $unidad12 = $row["unid12"];
        $descripcion12 = htmlspecialchars($row["desc12"]);

        $unidad13 = $row["unid13"];
        $descripcion13 = htmlspecialchars($row["desc13"]);

        $unidad14 = $row["unid14"];
        $descripcion14 = htmlspecialchars($row["desc14"]);

        $unidad15 = $row["unid15"];
        $descripcion15 = htmlspecialchars($row["desc15"]);

        $unidad16 = $row["unid16"];
        $descripcion16 = htmlspecialchars($row["desc16"]);

        $unidad17 = $row["unid17"];
        $descripcion17 = htmlspecialchars($row["desc17"]);

        $unidad18 = $row["unid18"];
        $descripcion18 = htmlspecialchars($row["desc18"]);

        $unidad19 = $row["unid19"];
        $descripcion19 = htmlspecialchars($row["desc19"]);

        $unidad20 = $row["unid20"];
        $descripcion20 = htmlspecialchars($row["desc20"]);
    }
    
    $result = array(
        "$supervisor",
        "$fecha",
        "$folio",
        "$ubicacion",
        "$proyecto",
        "$unidad","$descripcion",
        "$unidad2","$descripcion2",
        "$unidad3","$descripcion3",
        "$unidad4","$descripcion4",
        "$unidad5","$descripcion5",
        "$unidad6","$descripcion6",
        "$unidad7","$descripcion7",
        "$unidad8","$descripcion8",
        "$unidad9","$descripcion9",
        "$unidad10","$descripcion10",
        "$unidad11","$descripcion11",
        "$unidad12","$descripcion12",
        "$unidad13","$descripcion13",
        "$unidad14","$descripcion14",
        "$unidad15","$descripcion15",
        "$unidad16","$descripcion16",
        "$unidad17","$descripcion17",
        "$unidad18","$descripcion18",
        "$unidad19","$descripcion19",
        "$unidad20","$descripcion20"
    );

    $myJSON = json_encode($result);
    echo $myJSON;
?>