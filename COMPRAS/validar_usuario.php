<?php
include("conexion/conexion.php");
$conexion = Conectarse();
mysql_query("SET NAMES 'utf8'");
$usuario = $_POST["username"];
$password = $_POST["password"];
$result = mysql_query("SELECT * FROM supervisor WHERE usuario='$usuario'");
if ($row = mysql_fetch_array($result)) {
	if ($row["password"] == $password && $row["tipo_usuario"] == 'compras') {
		session_start();
		$_SESSION['id_sup'] = $id_sup;
		$_SESSION['usuario'] = $usuario;
		$_SESSION['nombre'] = $row["nombre"];
		$_SESSION['tipo_usuario'] = $row["tipo_usuario"];
		$_SESSION['password'] = $row["password"];
		$_SESSION['direccion'] = $row["direccion"];
		$_SESSION['correo'] = $row["correo"];
		$_SESSION['telefono'] = $row["telefono"];
		header("Location: PAGINAS/PEDIDOS/inicio");
	} else if ($row["password"] == $password && $row["tipo_usuario"] == 'mod_avisos') {
		session_start();
		$_SESSION['usuario'] = $usuario;
		$_SESSION['nombre'] = $row["nombre"];
		$_SESSION['tipo_usuario'] = $row["tipo_usuario"];
		$_SESSION['password'] = $row["password"];
		$_SESSION['direccion'] = $row["direccion"];
		$_SESSION['correo'] = $row["correo"];
		$_SESSION['telefono'] = $row["telefono"];
		header("Location: PAGINAS/A_COMP/inicio");
	} else {
?>
		<script language="javascript">
			alert("Contraseña Incorrecta");
			location.href = "index";
		</script>
		<?php
	}
} else {
	$resultp = mysql_query("SELECT * FROM usuarios_proveedores WHERE usuario='$usuario'");
	if ($rowp = mysql_fetch_array($resultp)) {
		if ($rowp["pass"] == $password) {
			session_start();
			$_SESSION['usuario'] = $usuario;
			header("Location: usuario_prov_mod?prov=" . $usuario);
		} else {
		?>
			<script language="javascript">
				alert("Contraseña Incorrecta");
				location.href = "index";
			</script>
		<?php
		}
	} else {
		?>
		<script language="javascript">
			alert("El nombre de usuario es incorrecto!");
			location.href = "index";
		</script>
<?php
	}
}
mysql_free_result($result);
mysql_close();
?>