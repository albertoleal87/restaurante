<?php
session_start();
@$_SESSION['user'] = $_POST['user'];
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/scripts.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Restaurante</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<center>
    <form action="" method="post">
    
<table style="margin-top:150px">
  <tr><td></td><td>Administrador</td></tr>
  <tr><td>Usuario:</td><td><input type="text" id="user" name="user" value="<?php echo @$_POST['user']; ?>"></td></tr>
  <tr><td>Contraseña:</td><td><input type="password" name="pass" value="<?php echo @$_POST['pass']; ?>" ></td></tr>
  <tr><td></td><td><button type="submit">Sign in</button></td></tr>
  </form>


<?php

function simpleLogin ($pass,$user)
{
$mysql_connect = mysql_connect("localhost", "restaurante", "12345") or die (mysql_error());
mysql_select_db("restaurante", $mysql_connect) or die (mysql_error());
$query ="SELECT pass FROM usuarios WHERE user = '$user' ";
$mysql_query = mysql_query($query) or die (mysql_error());
if($mysql_query)
{
$array = mysql_fetch_assoc($mysql_query);
if ($pass == $array['pass']) 
{return true;}
else
{return false;}
}
else
{return false;}
}

@$user = $_POST['user'];
@$pass = $_POST['pass'];
    
if (isset($user) && isset($pass) &&  !empty($user) && !empty($pass))
{
if(simpleLogin($pass,$user))
{
echo "<script type='text/javascript'>document.location='cajero.php';</script>";}
else {
echo "<script type='text/javascript'>alert('Los datos proporcionados son incorrectos');</script>";
}
}

elseif (isset($user) or isset($pass))
{echo "<script type='text/javascript'>alert('Favor de ingresar usuario y contraseña');</script>";}
?>




</body>
</html>