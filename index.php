<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/scripts.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Restaurante</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="refresh" content="3" />
</head>
<body>

<?php

function mesas ($mesa)
{
$mysql_connect = mysql_connect("localhost", "restaurante", "12345") or die (mysql_error());
mysql_select_db("restaurante", $mysql_connect) or die (mysql_error());
$selectplatillos = "SELECT * FROM mesas WHERE mesa = $mesa ";
$mysql_query = mysql_query($selectplatillos) or die (mysql_error());
$array = mysql_fetch_assoc($mysql_query);
if ($array >= '1')
{echo "style='border:2px solid #FF0000' onclick=\"alert('Mesa ocupada, seleccione otra mesa para tomar su orden.');\" ";}
else {echo "onclick=\"window.open('menu?mesa=$mesa', '', '');\"";}
mysql_close($mysql_connect);
}




?>



<table>
	<tr>
<td><img src="img/wc.png" ;></td><td></td><td><img src="img/Ventana.png"></td><td></td><td><img src="img/puerta.png"></td><td></td><td><img src="img/Ventana.png"></td><td></td>
	</tr>
	<tr>
<td></td><td><img <?php mesas('1');?> src="img/mesa_6_2.png"></td><td></td><td><img src="img/mesa_6_2.png" <?php mesas('2');?>></td><td></td><td><img src="img/mesa_6_2.png" <?php mesas('3');?>></td><td></td><td><img src="img/mesa_6_2.png" <?php mesas('4');?>></td>
	</tr>
	<tr>
<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
	</tr>
	<tr>
<td></td><td><img src="img/mesa_4.png" <?php mesas('5');?>></td><td></td><td><img src="img/mesa_4.png" <?php mesas('6');?>></td><td></td><td><img src="img/mesa_4.png" <?php mesas('7');?>></td><td></td><td><img src="img/mesa_4.png" <?php mesas('8');?>></td>
	</tr>
	<tr>
<td></td><td><img src="img/mesa_2h.png" <?php mesas('9');?>></td><td></td><td><img src="img/mesa_2h.png" <?php mesas('10');?>></td><td></td><td><img src="img/mesa_2h.png" <?php mesas('11');?>></td><td></td><td><img src="img/mesa_2h.png" <?php mesas('12');?>></td>
	</tr>
	<tr>
<td></td><td></td><td><img src="img/Ventana.png"></td><td></td><td><img src="img/Ventana.png"></td><td></td><td><img src="img/Ventana.png"></td><td></td>
	</tr>
</table>
</body>
</html>