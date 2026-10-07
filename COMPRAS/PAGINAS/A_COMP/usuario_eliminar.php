<?php
	date_default_timezone_set("Mexico/General");
	session_start();
	if(!isset($_SESSION['usuario']) && !isset($_SESSION['nombre']) && !isset($_SESSION['tipo_usuario']))
	{
		header('Location: ../../index');
		exit();
	}
	include("../../conexion/conexion.php"); 
   	$conexion=Conectarse(); 

   	mysql_query("SET NAMES 'UTF8'");
	mysql_query("SET lc_time_names = 'es_MX'");

	$proveedor=$_POST['proveedor'];
   	mysql_query("DELETE FROM usuarios_proveedores WHERE usuario='".$proveedor."'",$conexion); 

	$query2 = "UPDATE proveedores SET registrado='No' WHERE rfc='".$proveedor."'";
	$result2=mysql_query($query2,$conexion) or die("Error: ".mysql_error());
   	
       echo "<script languaje='javascript'>
       alert('Usuario eliminado.')
       location.href='usuarios_p';
   </script>";
?>