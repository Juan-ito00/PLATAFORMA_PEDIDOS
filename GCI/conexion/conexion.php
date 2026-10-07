<?php
function Conectarse()
{
	$link = mysql_connect("localhost", "root", "");

	if (!$link) {
		die("Error conectando: " . mysql_error());
	}

	if (!mysql_select_db("grupocav_pedidos_plataforma_21", $link)) {
		die("Error seleccionando la base de datos: " . mysql_error());
	}

	return $link;
}
