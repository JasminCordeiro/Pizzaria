<?php

  session_start();

  $user = "root";
  $pass = "Samlat03";
  $db = "pizzaria";
  $host = "localhost:3307";

  try {

    $conn = new PDO("mysql:host={$host};dbname={$db}", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  } catch (PDOException $e) {

    print "Erro: " . $e->getMessage() . "<br/>";
    die();

  }

?>