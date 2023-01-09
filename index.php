<?php
  //Abrimos la sesion de la base de datos
  session_start();
  //Llamamos al documento encargado de realizar la conexión con la base de datos
  require 'database.php';
  // Comprobamos si existe la variable sesion y si contiene la variable user_id
  if (isset($_SESSION['user_id'])) {
	//Realizamos una consulta a la base de datos solicitando el id, email y password, guardandolos en la variable records
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
	//Vinculamos el parámetro id con lo que tengamos en la variable con la función POST
    $records->bindParam(':id', $_SESSION['user_id']);
	//Ejecutamos la query
    $records->execute();
	//Creamos la variable results relacionándolo los datos de la consulta
    $results = $records->fetch(PDO::FETCH_ASSOC);
	//Inicializamos una variable usuario vacía
    $user = null;
	//Comprobamos que los resultados no están vacíos
    if (count($results) > 0) {
	   //Llenamos la variable user con los resultados
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	<!--Ponemos el título a la pestaña-->
    <title>Welcome to you WebApp</title>
	<!--Conseguimos la fuente para estilizar-->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<!--Creamos la referencia a la hoja de estilos para poder usarla-->
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <!--Hacemos que se vea el header llamando al documento-->
    <?php require 'partials/header.php' ?>
	<!--Comprobamos si la variable usuario está vacía-->
    <?php if(!empty($user)): ?>
	<!--Damos la bienvenida al usuario si no está vacía-->
      <br> Welcome. <?= $user['email']; ?>
      <br>You are Successfully Logged In
	  <br>
	  <h2>Hacer alta en la tabla autores</h2>
	<center>
	<!--relacionamos el documento html con el documento php mediante el metodo POST-->
	<FORM action='alta2.php' method='POST'>
	<!--incializamos la tabla-->
	<TABLE border=0>
	<!--añadimos una fila a la tabla para guardar la variable nombre-->
		<TR>
			<TD>Nombre</TD>
			<TD><INPUT type='text' name='nombre' size='30'
				maxlength='30'></TD>
		</TR>
	<!--añadimos una fila a la tabla para guardar la variable apellidos-->
		<TR>
			<TD>Apellidos</TD>
			<TD><INPUT type='text' name='apellidos' size='30' maxlength='30'></TD>
		</TR>
	<!--añadimos una fila a la tabla para guardar la variable nacionalidad-->
		<TR>
			<TD>Nacionalidad</TD>
			<TD><INPUT type='text' name='nacionalidad' size='20' maxlength='20'></TD>
		</TR>
	</table>
	<!--añadimos una variable de tipo submit (boton)-->
		<INPUT type='submit' value='Aceptar'>
	</FORM>
	</center>
	  <!--Ofrecemos la opción para salir llamando al documento que se encarga de cerrar la sesion-->
      <br><a href="logout.php"> Logout</a>
    <?php else: ?>
	<!--Ofrecemos la opcion de registrarse o iniciar sesión en caso de no tener una variable usuario llena-->
      <h1>Please Login or SignUp</h1>
	<!--LLamamos a los documentos encargados de realizar dichos procesos-->
      <a href="login.php">Login</a> or
      <a href="signup.php">SignUp</a>
    <?php endif; ?>
  </body>
</html>
