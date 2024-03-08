<?php
session_start();

if (!isset($_SESSION['emailadm'])) {
    header("Location: ../login");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit;
}


function get_conn()
{
    $dbname = "u574069177_frutinhamoney";
    $dbuser = "u574069177_tki3";
    $dbpass = "Severino@123";

    return new mysqli('localhost', $dbuser, $dbpass, $dbname);
}

function required($form, $field)
{
    if (!isset($form[$field]) || !$form[$field]) {
        return "$field é requerido";
    }

    return null;
}

function validate_form($form, $fields)
{
    foreach ($fields as $field) {
        if ($error = required($form, $field)) {
            return $error;
        }
    }

    return null;
}

function get_form()
{
    return array(
        'access_key' => $_POST['access_key'],
        'secret_key' => $_POST['secret_key'],
    );
}

$conn = get_conn();

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

$form = get_form();
$error = validate_form($form, ['access_key', 'secret_key']);

$access_key = $form['access_key'];
$secret_key = $form['secret_key'];


$sql_check = "SELECT * FROM integracao_chaves";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows > 0) {
    $sql_update = "UPDATE integracao_chaves SET access_key = '$access_key', secret_key = '$secret_key'";
    $result_update = $conn->query($sql_update);

    if ($result_update === TRUE) {
        header("Location: ./");
        exit();
    } else {
        header("Location: ./");
        exit();
    }
} else {
    $sql_insert = "INSERT INTO integracao_chaves SET access_key = '$access_key', secret_key = '$secret_key'";
    $result_insert = $conn->query($sql_insert);

    if ($result_insert === TRUE) {
        header("Location: ./");
        exit();
    } else {
        header("Location: ./");
        exit();
    }
}

$conn->close();
?>