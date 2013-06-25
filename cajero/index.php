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
{return 'true';}
else {return 'false';}
mysql_close($mysql_connect);
}


?>

<form action="" method="POST">
<center>
<table>

<tr>
<td>Mesa:</td>
<td>
<input type="text" name="mesa" readonly="true" value ="
<?php
@$mesa = $_GET['mesa'];
echo "$mesa";
?>"
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
$total = sprintf('%01.0f', $total);
echo "--------------------- \n Total: $$total ";
mysql_close($mysql_connect);
?>


	</textarea></td>
</tr>



<script type="text/javascript">
//CALCULAR
	function calcular()
        {	
	    var total = document.getElementById('total').value;
        var pago = document.getElementById('pago').value;
        var cambio = pago-total;
document.getElementById('cambio').value = cambio;
         }
  </script>






<tr><td>Total:</td><td><input type="text" name="total" id="total" readonly="yes" value="<?php echo $total ; ?>"></td></tr>
<tr><td>Pago:</td><td><input type="text" name="pago" id="pago" onblur='calcular();' onkeyup='calcular();' ></td></tr>
<tr><td>Cambio:</td><td><input type="text" name="cambio"  id="cambio"></td></tr>
<tr><td><input type="submit" value="Habilitar mesa" ></td><td><input type="button" value="Salir" onclick="window.opener.document.location='../cajero.php'; window.close();"></td></tr>
</table>

<?php

@$postmesa = $_POST['mesa'];

if(
isset($postmesa) && !empty($postmesa)
)

{
$mysql_connect = mysql_connect("localhost", "restaurante", "12345") or die (mysql_error());
mysql_select_db("restaurante", $mysql_connect) or die (mysql_error());
$query = "DELETE FROM mesas WHERE mesa = '$mesa' ";
$mysql_query = mysql_query($query) or die (mysql_error());
if($mysql_query)
{echo "<script type='text/javascript'>alert('Mesa habilitada'); window.opener.document.location='../cajero.php'; window.close();</script>";}
mysql_close($mysql_connect);
}

?>


</body>
</html>