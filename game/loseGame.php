<?php

if (!isset($_SESSION['email'])) {
    http_response_code(401);
    return;
}

if (!isset($_GET['token'])) {
    http_response_code(400);
    return;
}

function non_null($form, $field) {
    if (!isset($form[$field])) {
        return "Campo $field inválido";
    }
    return null;
}

function validate_form($form) {
    foreach (array('out') as $field) {
        if ($error = non_null($form, $field)) {
            return $error;
        }
    }
    return null;
}

function query($conn, $sql) {
    // echo "Running query: " . $sql;
    
    $response = $conn->query($sql);

    if ($conn->error) {
        return [
        'is_error' => true,
        'response' => $conn->error
        ];
    }

    return [
        'is_error' => false,
        'response' => $response
    ];
}

function get_connect() {
    include './../conectarbanco.php';

    $conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);
    
    if ($conn->connect_error) {
        http_response_code(500); // internal server error
        die('Connection Error: '. $conn->connection_error);
        return;
    }
    
    return $conn;
}

$email = $_SESSION['email'];
$error = validate_form($_GET);
$token = $_GET['token'];


if ($error) {
    echo $error;
    http_response_code(400);
    return;
}

$conn = get_connect();
$result = query($conn,   "UPDATE game g 
                         INNER JOIN token t ON g.email = '$email' AND g.email = t.email AND t.value = '$token' 
                         INNER JOIN appconfig a ON g.email = a.email
                         SET a.saldo = a.saldo - (g.entry_value)");


if ($result['is_error']) {
    http_response_code(400);
    return;
}

$result = query($conn, "DELETE FROM token WHERE value = '$token'");

header("Location: ../painel");

echo $out;
