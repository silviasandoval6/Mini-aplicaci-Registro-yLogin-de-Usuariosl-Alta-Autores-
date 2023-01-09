<html>
<head>
<title>alta2</title>
<meta name="GENERATOR" content="Quanta Plus">

<meta http-equiv="Content-Type" content="text/html; charset=iso-
8859-1">

</head>
<body>
<?php
//declaramos las variables de nuestra tabla y les damos el valor correspondiente mediante el metodo POST 
$f_nombre=$_POST['nombre'];
$f_apellidos=$_POST['apellidos'];
$f_nacionalidad=$_POST['nacionalidad'];
//construimos la consulta mediante las variables $linea1 y $linea2 uniendolas con con la variable $consulta
$linea1="INSERT INTO autores (nombre, apellidos, nacionalidad) ";
$linea2=" VALUES ('$f_nombre', '$f_apellidos', '$f_nacionalidad') ";
$consulta=$linea1.$linea2;
//declaramos la variable link para realizar la conexion indicando la IP del servidor y el usuario
$link = new mysqli('127.0.0.1', 'root');
//comprobamos que la conexion se ha realizado correctamente
if (!$link)
{
echo "<a href=index.html>Error al conectar</a>";
exit ;
}
//comprobamos que nuestra base de datos existe
if (!mysqli_select_db($link, "php_login_database"))
{
echo "<a href=index.html>Error al seleccionar BDD</a>";
exit;
}
//comprobamos que nuestra consulta funciona
if (!$result=mysqli_query($link,$consulta))
{
echo "<a href=index.html>Error en la consulta</a>";
exit;
}
//como ha funcionado la conexion y la consulta lo informamos mediante echos
echo "<br>Alta correcta";
echo "<br><br><a href='index.php'>Otra alta</a>";
echo "<br><br><a href='index.php'>Inicio</a>";
//cerramos la conexion con la base de datos
mysqli_close($link);
?>
</body>
</html>