<?php

// cabecera para json
header('Content-Type: application/json');

$params = json_decode(file_get_contents('php://input'));
//print_r($params);
//exit();
//$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
//$password = filter_input(INPUT_POST, 'password');
//$rememberme = filter_input(INPUT_POST, 'rememberme', FILTER_VALIDATE_BOOLEAN);
// VALIDACIONES

$e = 'julian@gmail.com';
$p = '123';

if ($params->email == $e and $params->password == $p) {
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
