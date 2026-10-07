<?php
	session_start();
	if(!isset($_SESSION['usuario']) && !isset($_SESSION['nombre']) && !isset($_SESSION['tipo_usuario']))
	{
		header('Location: ../../index');
		exit();
	}
  	include("../../conexion/conexion.php"); 
   	$conexion=Conectarse(); 
   	mysql_query("SET NAMES 'utf8'");
   	$nombre=$_GET['nombre'];
   	$nombre2 = ucwords(strtolower($nombre));
    $sql = "INSERT INTO obras (nombre) VALUES ('$nombre2')";
    $result = mysql_query($sql) or die(mysql_error());
    
   	header("Location:obras"); 
?>