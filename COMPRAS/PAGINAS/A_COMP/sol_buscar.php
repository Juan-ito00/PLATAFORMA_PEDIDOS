<?php
    $fol_c = $_REQUEST['folio_compr'];
    
    // Database connection
    $con = mysqli_connect("localhost", "grupocav_root", "sistemas2015", "grupocav_pedidos_plataforma_21");
    
    if ($fol_c !== "") { 
        $query = mysqli_query($con, "SELECT * FROM pedidos WHERE folio_af='$fol_c'");
    
        $row = mysqli_fetch_array($query);
        
        $tipo_compra = $row["tipo_compra"];
        $supervisor = $row["supervisor"];
        $fecha = $row["fecha"];
        $folio = $row["folio"];
        $empresa = $row["empresa"];
        $ubicacion = $row["ubicacion"];
        $proyecto = $row["proyecto"];
        $cantidad = $row["cant1"];
        $unidad = $row["unid1"];
        $descripcion = htmlspecialchars($row["desc1"]);
        $uso = htmlspecialchars($row["uso1"]);
        $cantidad2 = $row["cant2"];
        $unidad2 = $row["unid2"];
        $descripcion2 = htmlspecialchars($row["desc2"]);
        $uso2 = htmlspecialchars($row["uso2"]);
        $cantidad3 = $row["cant3"];
        $unidad3 = $row["unid3"];
        $descripcion3 = htmlspecialchars($row["desc3"]);
        $uso3 = htmlspecialchars($row["uso3"]);
        $cantidad4 = $row["cant4"];
        $unidad4 = $row["unid4"];
        $descripcion4 = htmlspecialchars($row["desc4"]);
        $uso4 = htmlspecialchars($row["uso4"]);
        $cantidad5 = $row["cant5"];
        $unidad5 = $row["unid5"];
        $descripcion5 = htmlspecialchars($row["desc5"]);
        $uso5 = htmlspecialchars($row["uso5"]);
        $cantidad6 = $row["cant6"];
        $unidad6 = $row["unid6"];
        $descripcion6 = htmlspecialchars($row["desc6"]);
        $uso6 = htmlspecialchars($row["uso6"]);
        $cantidad7 = $row["cant7"];
        $unidad7 = $row["unid7"];
        $descripcion7 = htmlspecialchars($row["desc7"]);
        $uso7 = htmlspecialchars($row["uso7"]);
        $cantidad8 = $row["cant8"];
        $unidad8 = $row["unid8"];
        $descripcion8 = htmlspecialchars($row["desc8"]);
        $uso8 = htmlspecialchars($row["uso8"]);
        $cantidad9 = $row["cant9"];
        $unidad9 = $row["unid9"];
        $descripcion9 = htmlspecialchars($row["desc9"]);
        $uso9 = htmlspecialchars($row["uso9"]);
        $cantidad10 = $row["cant10"];
        $unidad10 = $row["unid10"];
        $descripcion10 = htmlspecialchars($row["desc10"]);
        $uso10 = htmlspecialchars($row["uso10"]);
        $cantidad11 = $row["cant11"];
        $unidad11 = $row["unid11"];
        $descripcion11 = htmlspecialchars($row["desc11"]);
        $uso11 = htmlspecialchars($row["uso11"]);
        $cantidad12 = $row["cant12"];
        $unidad12 = $row["unid12"];
        $descripcion12 = htmlspecialchars($row["desc12"]);
        $uso12 = htmlspecialchars($row["uso12"]);
        $cantidad13 = $row["cant13"];
        $unidad13 = $row["unid13"];
        $descripcion13 = htmlspecialchars($row["desc13"]);
        $uso13 = htmlspecialchars($row["uso13"]);
        $cantidad14 = $row["cant14"];
        $unidad14 = $row["unid14"];
        $descripcion14 = htmlspecialchars($row["desc14"]);
        $uso14 = htmlspecialchars($row["uso14"]);
        $cantidad15 = $row["cant15"];
        $unidad15 = $row["unid15"];
        $descripcion15 = htmlspecialchars($row["desc15"]);
        $uso15 = htmlspecialchars($row["uso15"]);
        $cantidad16 = $row["cant16"];
        $unidad16 = $row["unid16"];
        $descripcion16 = htmlspecialchars($row["desc16"]);
        $uso16 = htmlspecialchars($row["uso16"]);
        $cantidad17 = $row["cant17"];
        $unidad17 = $row["unid17"];
        $descripcion17 = htmlspecialchars($row["desc17"]);
        $uso17 = htmlspecialchars($row["uso17"]);
        $cantidad18 = $row["cant18"];
        $unidad18 = $row["unid18"];
        $descripcion18 = htmlspecialchars($row["desc18"]);
        $uso18 = htmlspecialchars($row["uso18"]);
        $cantidad19 = $row["cant19"];
        $unidad19 = $row["unid19"];
        $descripcion19 = htmlspecialchars($row["desc19"]);
        $uso19 = htmlspecialchars($row["uso19"]);
        $cantidad20 = $row["cant20"];
        $unidad20 = $row["unid20"];
        $descripcion20 = htmlspecialchars($row["desc20"]);
        $uso20 = htmlspecialchars($row["uso20"]);
    }
    
    $result = array(
        "$tipo_compra",
        "$supervisor",
        "$fecha",
        "$folio",
        "$empresa",
        "$ubicacion",
        "$proyecto",
        "$cantidad","$unidad","$descripcion","$uso",
        "$cantidad2","$unidad2","$descripcion2","$uso1",
        "$cantidad3","$unidad3","$descripcion3","$uso3",
        "$cantidad4","$unidad4","$descripcion4","$uso4",
        "$cantidad5","$unidad5","$descripcion5","$uso5",
        "$cantidad6","$unidad6","$descripcion6","$uso6",
        "$cantidad7","$unidad7","$descripcion7","$uso7",
        "$cantidad8","$unidad8","$descripcion8","$uso8",
        "$cantidad9","$unidad9","$descripcion9","$uso9",
        "$cantidad10","$unidad10","$descripcion10","$uso10",
        "$cantidad11","$unidad11","$descripcion11","$uso11",
        "$cantidad12","$unidad12","$descripcion12","$uso12",
        "$cantidad13","$unidad13","$descripcion13","$uso13",
        "$cantidad14","$unidad14","$descripcion14","$uso14",
        "$cantidad15","$unidad15","$descripcion15","$uso15",
        "$cantidad16","$unidad16","$descripcion16","$uso16",
        "$cantidad17","$unidad17","$descripcion17","$uso17",
        "$cantidad18","$unidad18","$descripcion18","$uso18",
        "$cantidad19","$unidad19","$descripcion19","$uso19",
        "$cantidad20","$unidad20","$descripcion20","$uso20"
    );

    $myJSON = json_encode($result);
    echo $myJSON;
?>