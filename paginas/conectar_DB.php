<?php
// Conectar a la base de datos...
  $dbhost = 'localhost';
  $dbname = 'indicadores';
  $dbuser ='root';
  $dbpass = '';

  try {
    $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  }
  catch(PDOException $e) {
    echo 'Error: '. $e->getMessage();
  }

?>
