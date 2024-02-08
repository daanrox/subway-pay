<?php

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
    //echo "Running query: " . $sql;
    
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
$dbname = "u756913841_subwaypaypv";
$dbuser = "u756913841_tki20";
$dbpass = "Severino@123";
    
    $host = "localhost";
    $conn = new mysqli($host, $dbuser, $dbpass, $dbname);
    
    if ($conn->connect_error) {
        http_response_code(500); // internal server error
        die('Connection Error: '. $conn->connection_error);
        return;
    }
    
    return $conn;
}

$email = $_SESSION['email'];
$error = validate_form($_GET);
$out = $_GET['out'] * 100;
$token = $_GET['token'];


if ($error) {
    echo $error;
    http_response_code(400);
    return;
}

$conn = get_connect();
query($conn, "UPDATE game g INNER JOIN token t ON g.email = t.email AND t.value = '$token' SET g.out_value = $out");
query($conn, "UPDATE appconfig a INNER JOIN token t ON t.value = '$token' AND a.email = t.email SET a.saldo = a.saldo + $out");
query($conn, "DELETE FROM token WHERE value = '$token'");

header('Location: https://subwaypay.tech/painel/');