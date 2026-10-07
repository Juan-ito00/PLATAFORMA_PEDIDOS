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
   	mysql_query("SET NAMES 'utf8'");

   	$id = $_GET['folio']; 
   	mysql_query("UPDATE oficios_generales SET estado='Cancelado' WHERE id = $id",$conexion);
   	header("Location: historial_ofg"); 
?>