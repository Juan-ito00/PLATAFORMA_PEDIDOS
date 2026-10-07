<?php
date_default_timezone_set("Mexico/General");
session_start();
if (!isset($_SESSION['usuario']) && !isset($_SESSION['nombre']) && !isset($_SESSION['tipo_usuario'])) {
  header('Location: ../../index');
  exit();
}
include("../../conexion/conexion.php");
$conexion = Conectarse();

// use PHPMailer\PHPMailer\PHPMailer;

require_once('../../autoload.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modificar Pedido</title>
  <!-- Bootstrap -->
  <link href="../../css/bootstrap.min.css" rel="stylesheet">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
  <!--Barra de titulo-->
  <nav class="navbar navbar-inverse" role="navigation">
    <p align="center" style="color: white; margin-top: 12px; font-size: 18px;">SISTEMA DE PEDIDOS</p>
  </nav>
  <!--Barra de pie de pagina
    <nav class="navbar navbar-inverse navbar-fixed-bottom">
      <div align="center"><img class="img-responsive" height="55" width="165" src="../img/cavi.png"> </img></div>
    </nav>-->
  <!--Contenedor donde va todo el contenido de la pagina-->
  <div class="container" style="padding-top: 1px;">

    <!--Menu horizontal de la parte superior-->
    <nav class="navbar navbar-default nav" style="margin-top:5px;" role="navigation">
      <!-- El logotipo y el icono que despliega el menú se agrupan
        para mostrarlos mejor en los dispositivos móviles -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Desplegar navegación</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="inicio"><span class="glyphicon glyphicon-home"></span> Inicio</a>
      </div>
      <!-- Agrupar los enlaces de navegación, los formularios y cualquier
          otro elemento que se pueda ocultar al minimizar la barra -->
      <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
          <li class="dropdown">
            <a href="vehiculos_gen"><span class="glyphicon glyphicon-list"> </span> Vehículos
            </a>
          </li>
          <li class="dropdown">
            <a href="mantenimientos_gen"><span class="glyphicon glyphicon-list"> </span> Mantenimientos
            </a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list-alt"> </span> Reportes<b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
              <li><a href="reporte_general_mec">General</a></li>
              <li><a href="reporte_gerencia_mec">Gerencia</a></li>
              <li><a href="reporte_obra_mec">Obra</a></li>
            </ul>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <p class="navbar-text"><span class="glyphicon glyphicon-user"> </span><?php echo " Bienvenido " . $_SESSION['usuario'] . " "; ?><a class="glyphicon glyphicon-off" href="../../logout"></a></p>
        </ul>
      </div>
    </nav>
    <!--Panel con el titulo de la pagina y contenido-->
    <div class="panel panel-default" style="margin-top: 5px; overflow: auto;white-space: nowrap;">
      <div align="center" class="panel-heading">Modificar Pedido</div>
      <div class="panel-body">
        <?php
        header("Content-Type: text/html;charset=utf-8");
        error_reporting(E_ALL ^ E_NOTICE);
        mysql_query("SET NAMES 'utf8'");
        $estado = $_POST['estado'];
        $folio = $_POST['folio'];
        $enviado = "No enviado";
        $autorizado = 'No Autorizado';
        $supervisor_nom = $_POST['supervisor'];

        $result = mysql_query("SELECT * FROM supervisor WHERE nombre='$supervisor_nom'");
        while ($rowS = mysql_fetch_array($result)) {
          $mail_sup = $rowS['correo'];
        }

        $result2 = mysql_query("SELECT * FROM pedidos_int WHERE folio='$folio'");
        while ($rowS2 = mysql_fetch_array($result2)) {
          $mail_ger = $rowS2['gerencia'];
        }

        $mailto = $mail_sup; //Correo del destinatario

        if ($mail_ger == 'GCHSO') //Correo del gerente correspondiente
        {
          $mailcc = 'diana_marisela_hinojoza@grupocavi.com.mx';
        } else if ($mail_ger == 'GCI') //Correo del gerente correspondiente
        {
          $mailcc = 'yasmin_gonzalez@grupocavi.com.mx';
        } else if ($mail_ger == 'NOMINAS') //Correo del gerente correspondiente
        {
          $mailcc = 'angeles_ortiz@grupocavi.com.mx';
        } else if ($mail_ger == 'GCSO1') //Correo del gerente correspondiente
        {
          $mailcc = 'moises_fernandez@grupocavi.com.mx';
        } else if ($mail_ger == 'GCSO2') //Correo del gerente correspondiente
        {
          $mailcc = 'arturo_castrejon@grupocavi.com.mx';
        } else if ($mail_ger == 'GCSO3') //Correo del gerente correspondiente
        {
          $mailcc = 'davidjimenez@grupocavi.com.mx';
        } else if ($mail_ger == 'GF') //Correo del gerente correspondiente
        {
          $mailcc = 'rocio_martinez@grupocavi.com.mx';
        } else if ($mail_ger == 'GLP') //Correo del gerente correspondiente
        {
          $mailcc = 'davidjimenez@grupocavi.com.mx';
        } else if ($mail_ger == 'GOAF') //Correo del gerente correspondiente
        {
          $mailcc = 'luisadrian_castrejon@grupocavi.com.mx';
        } else if ($mail_ger == 'GSIM') //Correo del gerente correspondiente
        {
          $mailcc = 'segovia_manuel@grupocavi.com.mx';
        } else if ($mail_ger == 'GSST') //Correo del gerente correspondiente
        {
          $mailcc = 'maricruz_flores@grupocavi.com.mx';
        } else if ($mail_ger == 'CONCRETOS') //Correo del gerente correspondiente
        {
          $mailcc = 'antonio_ulloa@grupocavi.com.mx';
        }

        $folio = nl2br($_POST['folio']); //Folio del pedido
        $estatus = nl2br($_POST['estado']); //Estatus del pedido


        if (isset($_POST["submit"]) and $estado == 'Revisar Notas') {
          $query = "UPDATE pedidos_int SET estado='" . $_POST["estado"] . "', fecha_revision='" . $_POST["fecha_seguimiento"] . "', notas_seguimiento='" . $_POST["notas_seguimiento"] . "', enviado='$enviado', autorizado='$autorizado' WHERE id_pedido='" . $_POST["id"] . "'";
          $result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

          echo "<script languaje='javascript'>
                    alert('Se han modificado los datos del pedido con folio " . $_POST["folio"] . "')
        javascript:history.go(-2)
                  </script>";

          $mail = new PHPMailer();
          $mail->IsSMTP();
          $mail->SMTPAuth = true;
          $mail->SMTPSecure = "ssl";
          $mail->Host = "mut.hosting-mexico.net";
          $mail->Port       = 465;
          $mail->SMTPOptions = array(
            'ssl' => array(
              'verify_peer' => false,
              'verify_peer_name' => false,
              'allow_self_signed' => true
            )
          );
          $mail->Username = "x";
          $mail->Password = "b.2,qKfCMNho";

          $mail->setFrom('x', 'MANTENIMIENTOS');
          $mail->AddAddress($mailto);

          $mail->WordWrap = 50;
          $mail->IsHTML(true);
          $mail->CharSet = 'UTF-8';

          $mail->Subject = "Sistema de Pedidos GRUPO CAVI | Actualización de Estatus";
          $mail->Body = "<h3>|  ACTUALIZACIÓN DE ESTATUS DE PEDIDO  |</h3><br><p>Estimado " . $supervisor_nom . ":</p><p>Te informamos que tu pedido de Mantenimiento" . $folio . ", tiene el siguiente estatus: " . $estatus . ".</p><p>¡Saludos!</p><img src='cid:firma' width='1096' height='90'/><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
                  Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico:  oporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";
          $mail->AddCC($mailcc);

          if (!$mail->Send()) {
            echo "Fallo";
          } else {
            echo "Éxito";
          }
        }
        if (isset($_POST["submit"]) and $estado == 'Solicitud Surtido') {
          $query = "UPDATE pedidos_int SET estado='" . $_POST["estado"] . "', notas_seguimiento='" . $_POST["notas_seguimiento"] . "' WHERE id_pedido='" . $_POST["id"] . "'";
          $result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

          echo "<script languaje='javascript'>
                    alert('Se han modificado los datos del pedido con folio " . $_POST["folio"] . "')
        javascript:history.go(-2)
                  </script>";

          $mail = new PHPMailer();
          $mail->IsSMTP();
          $mail->SMTPAuth = true;
          $mail->SMTPSecure = "ssl";
          $mail->Host = "mut.hosting-mexico.net";
          $mail->Port       = 465;
          $mail->SMTPOptions = array(
            'ssl' => array(
              'verify_peer' => false,
              'verify_peer_name' => false,
              'allow_self_signed' => true
            )
          );
          $mail->Username = "jesus_valdez@grupocavi.com.mx";
          $mail->Password = "b.2,qKfCMNho";

          $mail->setFrom('jesus_valdez@grupocavi.com.mx', 'MANTENIMIENTOS');
          $mail->AddAddress($mailto);

          $mail->WordWrap = 50;
          $mail->IsHTML(true);
          $mail->CharSet = 'UTF-8';

          $mail->Subject = "Sistema de Pedidos GRUPO CAVI | Actualización de Estatus";
          $mail->Body = "<h3>|  ACTUALIZACIÓN DE ESTATUS DE PEDIDO  |</h3><br><p>Estimado " . $supervisor_nom . ":</p><p>Te informamos que tu pedido de Mantenimiento" . $folio . ", tiene el siguiente estatus: " . $estatus . ".</p><p>¡Saludos!</p><img src='cid:firma' width='1096' height='90'/><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
                  Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico:  oporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";
          $mail->AddCC($mailcc);

          if (!$mail->Send()) {
            echo "Fallo";
          } else {
            echo "Éxito";
          }
        } else if (isset($_POST["submit"]) and $estado == 'Recibido') {
          $sql_id = "INSERT INTO folios_man SET idsdgg='0'";
          $result_id = mysql_query($sql_id) or die(mysql_error());
          $id_id = mysql_insert_id();
          $folio_id =  strtoupper("MAN " . str_pad($id_id, 3, '0', STR_PAD_LEFT));

          $sql = "UPDATE folios_man SET folio='" . $folio_id . "' WHERE id='" . $id_id . "'";
          $result = mysql_query($sql) or die(mysql_error());

          $query = "UPDATE pedidos_int SET estado='" . $_POST["estado"] . "', fecha='" . $_POST["fecha_seguimiento"] . "', fecha_recibido='" . $_POST["fecha_seguimiento"] . "', notas_seguimiento='" . $_POST["notas_seguimiento"] . "', folio_af='" . $folio_id . "' WHERE id_pedido='" . $_POST["id"] . "'";
          $result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

          echo "<script languaje='javascript'>
                    alert('Se han modificado los datos del pedido con folio " . $_POST["folio"] . "')
        javascript:history.go(-2)
                  </script>";
          $mail = new PHPMailer();
          $mail->IsSMTP();
          $mail->SMTPAuth = true;
          $mail->SMTPSecure = "ssl";
          $mail->Host = "mut.hosting-mexico.net";
          $mail->Port       = 465;
          $mail->SMTPOptions = array(
            'ssl' => array(
              'verify_peer' => false,
              'verify_peer_name' => false,
              'allow_self_signed' => true
            )
          );
          $mail->Username = "jesus_valdez@grupocavi.com.mx";
          $mail->Password = "b.2,qKfCMNho";

          $mail->setFrom('jesus_valdez@grupocavi.com.mx', 'MANTENIMIENTOS');
          $mail->AddAddress($mailto);

          $mail->WordWrap = 50;
          $mail->IsHTML(true);
          $mail->CharSet = 'UTF-8';

          $mail->Subject = "Sistema de Pedidos GRUPO CAVI | Actualización de Estatus";
          $mail->Body = "<h3>|  ACTUALIZACIÓN DE ESTATUS DE PEDIDO  |</h3><br><p>Estimado " . $supervisor_nom . ":</p><p>Te informamos que tu pedido de Mantenimiento" . $folio . ", tiene el siguiente estatus: " . $estatus . ".</p><p>¡Saludos!</p><img src='cid:firma' width='1096' height='90'/><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
                  Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico:  oporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";
          $mail->AddCC($mailcc);

          if (!$mail->Send()) {
            echo "Fallo";
          } else {
            echo "Éxito";
          }
        } else if (isset($_POST["submit"]) and $estado == 'Surtido') {

          $query = "UPDATE pedidos_int SET estado='" . $_POST["estado"] . "', fecha_surtido='" . $_POST["fecha_seguimiento"] . "',folio_af='" . $_POST["folio_af"] . "' WHERE id_pedido='" . $_POST["id"] . "'";
          $result = mysql_query($query, $conexion) or die("Error: " . mysql_error());

          echo "<script languaje='javascript'>
                    alert('Se han modificado los datos del pedido con folio " . $_POST["folio"] . "')
        javascript:history.go(-2)
                  </script>";
          $mail = new PHPMailer();
          $mail->IsSMTP();
          $mail->SMTPAuth = true;
          $mail->SMTPSecure = "ssl";
          $mail->Host = "mut.hosting-mexico.net";
          $mail->Port       = 465;
          $mail->SMTPOptions = array(
            'ssl' => array(
              'verify_peer' => false,
              'verify_peer_name' => false,
              'allow_self_signed' => true
            )
          );
          $mail->Username = "jesus_valdez@grupocavi.com.mx";
          $mail->Password = "b.2,qKfCMNho";

          $mail->setFrom('jesus_valdez@grupocavi.com.mx', 'MANTENIMIENTOS');
          $mail->AddAddress($mailto);

          $mail->WordWrap = 50;
          $mail->IsHTML(true);
          $mail->CharSet = 'UTF-8';

          $mail->Subject = "Sistema de Pedidos GRUPO CAVI | Actualización de Estatus";
          $mail->Body = "<h3>|  ACTUALIZACIÓN DE ESTATUS DE PEDIDO  |</h3><br><p>Estimado " . $supervisor_nom . ":</p><p>Te informamos que tu pedido de Mantenimiento" . $folio . ", tiene el siguiente estatus: " . $estatus . ".</p><p>¡Saludos!</p><img src='cid:firma' width='1096' height='90'/><br><br><span style='font-size: 12px; font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif'><b>AVISO DE PRIVACIDAD</b><br> GRUPO CAVI, con domicilio en calle Benemérito de las Américas No 137, Colonia López Mateos en Sombrerete, Zacatecas, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente: La información personal que llegáramos a recabar es exclusivamente con la finalidad de proveer los servicios y productos que ofrecemos en estricto apego a lo señalado en la Ley Federal de Protección de Datos Personales en Posesión de Particulares. La Información contenida en este correo y sus archivos anexos es restringida, confidencial y privilegiada de esta Empresa, y está dirigida solamente a las direcciones de correo señaladas, por lo tanto queda prohibido su uso a personas ajenas al destinatario,de tal forma GRUPO CAVI, no se hace responsable de dichos usos y se reserva de cualquier tipo de acción legal que se pueda derivar contra quien o quienes resulten responsables de su divulgación, reproducción o uso, sin previa autorización por escrito por parte de GRUPO CAVI. 
                  Para mayor información acerca de este aviso de privacidad, podrá consultarlo en la siguiente dirección web: <a href='http://www.grupocavi.com.mx/avisoPrivacidad.html'>http://www.grupocavi.com.mx/ visoPrivacidad</a> o para revocar su consentimiento podrá hacerlo por correo electrónico:  oporte@grupocavi.com.mx o comunicándose a los teléfonos (433)93 5 22 32 o (433)93 5 28 33.</span>";
          $mail->AddCC($mailcc);

          if (!$mail->Send()) {
            echo "Fallo";
          } else {
            echo "Éxito";
          }
        } else {


          $id_pedido = $_GET['id_pedido'];
          $sql_query = "SELECT * FROM pedidos_int WHERE id_pedido='" . $id_pedido . "'";
          $resultado = mysql_query($sql_query, $conexion) or die("Error: " . mysql_error());
          if (mysql_num_rows($resultado) > 0) {
            while ($Rs = mysql_fetch_array($resultado)) {
        ?>
              <form method="post" name=frm action="modificar_man">
                <div class="row form-horizontal">
                  <div class="col-xs-2">
                    <label class="control-label" for="tipo_compra">Tipo de Servicio</label>
                    <input class="form-control input-sm" readonly name="tipo_servicio" type="text" value="<?php echo $Rs['tipo_servicio']; ?>" size="17" />
                  </div>
                  <div class="col-xs-4"></div>
                  <div class="col-xs-2">
                    <input name="id" type="hidden" class="form-control input-sm" required value="<?php echo $Rs['id_pedido']; ?>" size="17" />
                  </div>
                  <div class="col-xs-2">
                    <label class="control-label" for="folio">Folio</label>
                    <input name="folio" readonly type="text" class="form-control input-sm" required value="<?php echo $Rs['folio']; ?>" size="17" />
                  </div>
                  <div class="col-xs-2">
                    <label class="control-label">Folio Interno</label>
                    <input name="folio_af" type="text" class="form-control input-sm" readonly value="<?php echo $Rs['folio_af']; ?>" />
                  </div>
                </div>
                <div class="row form-horizontal">
                  <div class="col-xs-2">
                    <label class="control-label" for="fecha">Fecha</label>
                    <input class="form-control input-sm" name="fecha_solicitud" type="date" readonly required value="<?php echo $Rs['fecha_solicitud']; ?>" size="15" />
                  </div>
                  <div class="col-xs-5">
                    <label class="control-label" for="proyecto">Proyecto</label>
                    <?php
                    mysql_query("SET NAMES 'UTF8'");
                    $consulta_mysql = 'select * from obras ORDER BY nombre ASC';
                    $resultado_consulta_mysql = mysql_query($consulta_mysql, $conexion);
                    echo "<select name='proyecto' disabled class='form-control input-sm'>";
                    echo "<option> {$Rs['proyecto']}</option>";
                    while ($fila = mysql_fetch_array($resultado_consulta_mysql)) {
                      echo "<option value='" . $fila['nombre'] . "'>" . $fila['nombre'] . "</option>";
                    }
                    echo "</select>";
                    ?>
                  </div>
                  <div class="col-xs-3">
                    <label class="control-label" for="supervisor">Supervisor</label>
                    <input class="form-control input-sm" readonly name="supervisor" type="text" required value="<?php echo $Rs['supervisor']; ?>" size="50" />
                  </div>
                  <div class="col-xs-2">
                    <label class="control-label" for="ubicacion">Ubicación</label>
                    <input class="form-control input-sm" name="ubicacion" readonly type="text" value="<?php echo $Rs['ubicacion']; ?>" size="17" />
                  </div>
                </div>
                <div class="row form-horizontal">
                  <div class="col-xs-8"></div>
                  <div class="col-xs-2">
                    <label class="control-label">Estado</label>
                    <select name="estado" class="form-control input-sm" required>
                      <option class="form-control input-sm"><?php echo $Rs['estado']; ?></option>
                      <option class="form-control input-sm" name=uno value="Revisar Notas">Revisar Notas</option>
                      <option class="form-control input-sm" name=uno value="Recibido">Recibido</option>
                      <option class="form-control input-sm" name=uno value="Solicitud Surtido">Solicitar Surtido</option>
                      <?php
                      if ($Rs['estado'] == "Aceptado") {
                        echo "<option class='form-control input-sm' name=uno value='Surtido'>Surtido</option>";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-xs-2">
                    <label class="control-label">Fecha</label>
                    <input name="fecha_seguimiento" type="date" class="form-control input-sm" required type="text" value="<?php echo date("d/m/Y"); ?>" />
                  </div>
                </div>
                <div class="row form-horizontal">
                  <div class="col-xs-8">
                    <label class="control-label" for="descripcion1">Descripción del Servicio</label>
                    <textarea name="servicio1" class="form-control" readonly><?php echo htmlspecialchars($Rs['servicio1']); ?></textarea>
                  </div>
                  <div class="col-xs-4" style="text-align: center;">
                    <label class="control-label" for="rango_fechas">Rango de Fechas</label>
                  </div>
                  <div class="col-xs-2">
                    <input name="fecha_entrega1" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['fecha_entrega1']; ?>" />
                  </div>
                  <div class="col-xs-2">
                    <input name="fecha_devolucion1" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['fecha_devolucion1']; ?>" />
                  </div>
                </div>
                <div class="row form-horizontal">
                  <div class="col-xs-8">
                    <label class="control-label" for="descripcion1"></label>
                    <textarea name="servicio2" class="form-control" readonly><?php echo htmlspecialchars($Rs['servicio2']); ?></textarea>
                  </div>
                  <div class="col-xs-4" style="text-align: center;">
                    <label class="control-label" for="rango_fechas"></label>
                  </div>
                  <div class="col-xs-2">
                    <input name="fecha_entrega2" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['fecha_entrega2']; ?>" />
                  </div>
                  <div class="col-xs-2">
                    <input name="fecha_devolucion2" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['fecha_devolucion2']; ?>" />
                  </div>
                </div>
                <div class="row form-horizontal">
                  <div class="col-xs-8">
                    <label class="control-label" for="descripcion1"></label>
                    <textarea name="servicio3" class="form-control" readonly><?php echo htmlspecialchars($Rs['servicio3']); ?></textarea>
                  </div>
                  <div class="col-xs-4" style="text-align: center;">
                    <label class="control-label" for="rango_fechas"></label>
                  </div>
                  <div class="col-xs-2">
                    <input name="fecha_entrega3" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['fecha_entrega3']; ?>" />
                  </div>
                  <div class="col-xs-2">
                    <input name="fecha_devolucion3" class="form-control input-sm" type="text" readonly value="<?php echo $Rs['fecha_devolucion3']; ?>" />
                  </div>
                </div>
                <br>
                <div class="row form-horizontal">
                  <div class="col-xs-2">
                    <label class="control-label">Notas</label>
                    <textarea name="notas_seguimiento" class="form-control "><?php echo $Rs['notas_seguimiento']; ?></textarea>
                  </div>
                </div>
                <br>
                <div id="btn-form">
                  <input class="btn form-btn btn-primary" type="submit" name="submit" value="Aceptar">
                </div>
                <br>
              </form>
        <?php
            }
          } else {
            echo "<script languaje='javascript'>
                  alert('No fue posible realizar la operacion solicitada al pedido con ID" . $id_pedido . "')
              javascript:history.go(-2)
                    </script>";
          }
        }
        // Cerramos la conexión
        mysql_close($conexion);
        ?>
      </div>
    </div>
  </div>


  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="../../js/bootstrap.min.js"></script>
</body>

</html>