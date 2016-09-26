<?php

/**
 * Conecta la base de datos
 * @return \PDO
 */
function conectar() {
  $dsn = 'mysql:host=localhost;dbname=senasoft';
  $username = 'root';
  $password = '';
  $conn = new PDO($dsn, $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $conn;
}

function validarUsuario(PDO $conn, $user, $password) {
  $sql = 'SELECT id FROM usuario WHERE usuario = :user AND password = :password AND activado = 1';
  $params = array(
      ':user' => $user,
      ':password' => md5($password),
  );
  $stmt = $conn->prepare($sql);
  $stmt->execute($params);
  $rsp = $stmt->fetch(PDO::FETCH_ASSOC);
  if (is_array($rsp) === true and count($rsp) > 0) {
    return true;
  } else {
    return false;
  }
}

function validarUsuarioUnico(PDO $conn, $user) {
  $sql = 'SELECT id FROM usuario WHERE usuario = :user';
  $params = array(
      ':user' => $user
  );
  $stmt = $conn->prepare($sql);
  $stmt->execute($params);
  $rsp = $stmt->fetch(PDO::FETCH_ASSOC);
  if (is_array($rsp) === true and count($rsp) > 0) {
    return true;
  } else {
    return false;
  }
}

function registrarUsuario(PDO $conn, $user, $password) {
  $sql = 'INSERT INTO usuario (usuario, password) VALUES (:user, :password)';
  $params = array(
      ':user' => $user,
      ':password' => md5($password)
  );
  $stmt = $conn->prepare($sql);
  $stmt->execute($params);
  return true;
}

//function traerRegistros(PDO $conn) {
//  $sql = 'SELECT id, nombre, apellido FROM usuario';
//  $stmt = $conn->prepare($sql);
//  $stmt->execute();
//  $rsp = $stmt->fetchAll(PDO::FETCH_ASSOC);
//  if (is_array($rsp) === true and count($rsp) > 0) {
//    return $rsp;
//  } else {
//    return false;
//  }
//}
//
//function userPassword(PDO $conn, $user, $pass) {
//  $sql = 'SELECT id FROM cliente WHERE user = :user and pass = :pass';
//  $params = array(
//      ':user' => $user,
//      ':pass' => md5($pass)
//  );
//  $stmt = $conn->prepare($sql);
//  $stmt->execute($params);
//  $rsp = $stmt->rowCount();
//  if ($rsp > 0) {
//    return true;
//  } else {
//    return false;
//  }
//}
