<?php

function non_null($form, $field)
{
    if (!isset($form[$field])) {
        return "Argumento $field inválido";
    }
    return null;
}

function validate_args($form)
{
    foreach (array('token') as $field) {
        if ($error = non_null($form, $field)) {
            return $error;
        }
    }
    return null;
}

function query($conn, $sql)
{
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


function get_game($conn, $token) {
    $result = query($conn, "SELECT g.entry_value FROM game g INNER JOIN token t ON t.value = '$token' AND t.email = g.email");
    
    if ($result['is_error']) {
        http_response_code(400);
        return null;
    }
    
    return $result['response']->fetch_assoc();
}

$error = validate_args($_GET);

if ($error) {
    http_response_code(400);
    return;
}

$conn = get_connect();


if ($conn->connection_error) {
    http_response_code(400);
    return;
}

$token = $_GET['token'];
$game = get_game($conn, $token);

echo json_encode(array(
    'game' => $game
));

http_response_code(200);
?>