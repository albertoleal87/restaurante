<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="../css/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="../js/scripts.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Restaurante</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php

function selectDinamico ($query,$key)
{
$mysql_connect = mysql_connect("localhost", "restaurante", "12345") or die (mysql_error());
mysql_select_db("restaurante", $mysql_connect) or die (mysql_error());
$mysql_query = mysql_query($query) or die (mysql_error());
while ($array = mysql_fetch_assoc($mysql_query)) 
{echo "<option>$array[$key]</option>";}
mysql_close($mysql_connect);
}

function simpleQuery($query)
{
$mysql_connect = mysql_connect("localhost", "restaurante", "12345") or die (mysql_error());
mysql_select_db("restaurante", $mysql_connect) or die (mysql_error());
if (mysql_query($query))
{return true;}
else {return false;}
mysql_close($mysql_connect);
}

@$mesa = $_GET['mesa'];

echo<<<formulario
<table align="left">
	<tr>
<td><img onclick="document.location='?mesa=$mesa&platillo=Enchiladas';" src="../img/thumbs_enchilada.png"></td><td><img onclick="document.location='?mesa=$mesa&platillo=Sopes';" src="../img/thumbs_sopes.png"></td>
	</tr>

	<tr>
<td>Enchiladas $40</td><td>Sopes $35</td>
	</tr>



	<tr>
<td><img onclick="document.location='?mesa=$mesa&platillo=Ensalada';" src="../img/thumbs_ensalada.png"></td><td><img onclick="document.location='?mesa=$mesa&platillo=Tacos';" src="../img/thumbs_tacos.png"></td>
	</tr>

	<tr>
<td>Ensalada $30</td><td>Tacos $35</td>
	</tr>

	<tr>
<td><img onclick="document.location='?mesa=$mesa&platillo=Flautas';" src="../img/thumbs_flautas.png"></td><td><img onclick="document.location='?mesa=$mesa&platillo=Tostadas';" src="../img/thumbs_tostadas.png"></td>
	</tr>

	<tr>
<td>Flautas $40</td><td>Tostadas $30</td>
	</tr>
</table>

<form action="" method="POST">


<table align="center">

<tr>
<td>Mesa:</td>
<td>
<input type="text"name="mesa" readonly="true" value ="$mesa"
</td>
</tr>

<tr>
	<td>Platillos: </td>
	<td><select name="platillo">
	<option></option>
formulario;
$selecplatillos = " SELECT * FROM platillos WHERE disponible = '1' ";
selectDinamico ($selecplatillos,'platillo');
?>
</select>

<tr>
	<td>Bebidas: </td>
	<td><select name="bebida">
<option></option>
<?php
$selecplatillos = " SELECT * FROM bebidas WHERE disponible = '1' ";
selectDinamico ($selecplatillos,'bebida');
?>
</select>
</td>
</tr>

<tr>
	<td colspan="2"><textarea rows="15" cols="25" >
<?php
$mysql_connect = mysql_connect("localhost", "restaurante", "12345") or die (mysql_error());
mysql_select_db("restaurante", $mysql_connect) or die (mysql_error());
$selectplatillos = "SELECT * FROM mesas WHERE mesa = '$mesa' ";
$mysql_query = mysql_query($selectplatillos) or die (mysql_error());
$total = 0 ;
while ($array = mysql_fetch_assoc($mysql_query))
{
echo "$array[platillo] - $array[precio] \n";

@$total = $total + $array['precio'] ;

}
$total = sprintf('%01.2f', $total);
echo "--------------------- \n Total: $$total ";
mysql_close($mysql_connect);

echo<<<formulario
</textarea></td>
</tr>

<tr>

<td><input type="submit" value="Agregar"></td><td><input type="button" value="Borrar pedido" onclick="document.location='?mesa=$mesa&borrar=1' ; "><input type="button" value="Salir" onclick="window.opener.document.location='../'; window.close();"></td>

</tr>


</table>
formulario;

if(@$_POST['platillo'])
{$platillo = $_POST['platillo'];}
elseif(@$_GET['platillo'])
{$platillo = $_GET['platillo'];}

if(@$_POST['bebida'])
{$bebida = $_POST['bebida'];}
elseif(@$_GET['bebida'])
{$bebida = $_GET['bebida'];}

if(
isset($platillo) && !empty($platillo)
or 
isset($bebida) && !empty($bebida)
)

{
$mysql_connect = mysql_connect("localhost", "restaurante", "12345") or die (mysql_error());
mysql_select_db("restaurante", $mysql_connect) or die (mysql_error());
@$selectplatillo = "SELECT precio FROM platillos WHERE platillo = '$platillo' ";
@$selectbebida = "SELECT precio FROM bebidas WHERE bebida = '$bebida' ";

$mysql_query = mysql_query($selectplatillo) or die (mysql_error());
$array = mysql_fetch_assoc($mysql_query); 
$precioplatillo = $array['precio']; 

$mysql_query = mysql_query($selectbebida) or die (mysql_error());
$array = mysql_fetch_assoc($mysql_query); 
$preciobebida = $array['precio']; 
mysql_close($mysql_connect);

if($precioplatillo)
{
$insertplatillo = "INSERT INTO mesas (`mesa` , `platillo` , `precio`) VALUES ('$mesa' , '$platillo' , '$precioplatillo');";
if (simpleQuery($insertplatillo))
	{	
		echo "<script type='text/javascript'>document.location='?mesa=$mesa'</script>";
	}
}

if($preciobebida)
{
$insertbebida = "INSERT INTO mesas (`mesa` , `platillo` , `precio`) VALUES ('$mesa' , '$bebida' , '$preciobebida');";
if (simpleQuery($insertbebida))
	{echo "<script type='text/javascript'>document.location='?mesa=$mesa'</script>";}

}
}

@$borrar = $_GET['borrar'];

if(isset($borrar) && !empty($borrar))
{
$borrarpedido = "DELETE FROM mesas WHERE mesa ='$mesa' ";
if(simpleQuery($borrarpedido))
{
echo"<script type='text/javascript'>document.location='?mesa=$mesa' </script>";}
}

?>



</body>
</html>