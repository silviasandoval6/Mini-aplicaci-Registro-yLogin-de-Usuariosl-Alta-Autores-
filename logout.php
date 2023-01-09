<?php
  //Abrimos la sesión
  session_start();
  //Apagamos la sesión 
  session_unset();

  session_destroy();

  header('Location: /php-login');
?>
