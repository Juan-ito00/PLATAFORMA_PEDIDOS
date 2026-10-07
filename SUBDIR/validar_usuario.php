<?php 
include("conexion/conexion.php");
$conexion=Conectarse();
mysql_query("SET NAMES 'utf8'");
$usuario=$_POST["username"];
$password=$_POST["password"];
$result=mysql_query("SELECT * FROM supervisor WHERE usuario='$usuario' AND gerencia='SUBDIR'");
if($row=mysql_fetch_array($result))
{
	if($row["password"]== $password)
	{
		session_start();
		$_SESSION['usuario']=$usuario;
		$_SESSION['nombre']=$row["nombre"];
		$_SESSION['tipo_usuario']=$row["tipo_usuario"];
		$_SESSION['user_epp']=$row["user_epp"];
		$_SESSION['password']=$row["password"];
		$_SESSION['direccion']=$row["direccion"];
		$_SESSION['correo']=$row["correo"];
		$_SESSION['telefono']=$row["telefono"];
		header("Location: PAGINAS/PEDIDOS/inicio");
	}
	else
	{
		?>
        <script language="javascript">
		alert("Contraseña Incorrecta");
		location.href="index.php";
		</script>
        <?php
	}
}
else
{
	?>
    <script language="javascript">
	alert("¡Acceso incorrecto!");
	location.href="index.php";
	</script>
    <?php
}
mysql_free_result($result);
mysql_close();
?>