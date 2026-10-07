<?php 
	function Conectarse() 
	{ 
   		if (!($link=@mysql_connect("localhost","grupocav_root","sistemas2015"))) 
   		{ 
      			echo "Error conectando a la base de datos."; 
      			exit(); 
   		} 	
   		if (!mysql_select_db("grupocav_pedidos_plataforma_21",$link)) 
   		{ 
      			echo "Error seleccionando la base de datos."; 
      			exit(); 
   		} 
   		return $link; 
	} 
	$link=Conectarse(); 
	echo ""; 
	mysql_close($link);
?>