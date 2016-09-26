<?php

// cabecera para json
header('Content-Type: application/json');
require 'coneccion.php';

$user = filter_input(INPUT_POST, 'user');
$password1 = filter_input(INPUT_POST, 'password1');
$password2 = filter_input(INPUT_POST, 'password2');

$conn = conectar();
$flagValidate = false;

if (validarUsuarioUnico($conn, $user) === true) {
  $flagValidate = true;
  $validate['code'] = 300;
  $validate['usuario']['invalido'] = 'El usuario ya existe.';
} elseif (preg_match("/^([a-z])+/", $user)) {

} else {
  $flagValidate = true;
  $validate['code'] = 300;
  $validate['usuario']['invalido'] = 'Tipo de entrada no valida para el usuario.';
}

if ($password1 !== $password2) {
  $flagValidate = true;
  $validate['code'] = 300;
  $validate['password']['invalido'] = 'Las contraseñas no coinciden.';
}

if ($flagValidate === true) {
  echo json_encode($validate);
} else {
  registrarUsuario($conn, $user, $password1);
  $rsp = array(
      'code' => 200,
      'msg' => 'El usuario fue registrado satisfactoriamente'
  );
  echo json_encode($rsp);
}
