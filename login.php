<?php

// cabecera para json
header('Content-Type: application/json');
require 'coneccion.php';

$user = filter_input(INPUT_POST, 'user');
$password = filter_input(INPUT_POST, 'password');

$conn = conectar();

if (validarUsuario($conn, $user, $password) === true) {
  $rsp = array(
      'code' => '200'
  );
} else {
  $rsp = array(
      'code' => '500',
      'msg' => 'Usuario inválido'
  );
}

echo json_encode($rsp);
