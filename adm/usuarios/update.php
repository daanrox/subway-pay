<?php

session_start();

if (!isset($_SESSION['emailadm'])) {
    header("Location: ../login");
    exit();
}

# if is not a post request, exit
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit;
}

include './../../conectarbanco.php';
$conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);



function required($form, $field)
{
    if (!isset($form[$field]) || $form[$field] === null) {
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
        'id' => $_POST['id'],
        'email' => $_POST['email'],
        'senha' => $_POST['senha'],
        'telefone' => $_POST['telefone'],
        'saldo' => $_POST['saldo'],
        'linkafiliado' => $_POST['linkafiliado'],
        'plano' => $_POST['plano'],
        'bloqueado' => $_POST['bloqueado'],
        'cpa' => $_POST['cpa'],
    );
}


if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

$form = get_form();

$sql = sprintf(
    "UPDATE appconfig SET email='%s', senha='%s', telefone='%s', saldo='%s', linkafiliado='%s', plano='%s', bloc='%s', cpa='%s' WHERE id='%s'",
    $form['email'],
    $form['senha'],
    $form['telefone'],
    $form['saldo'],
    $form['linkafiliado'],
    $form['plano'],
    $form['bloqueado'],
   
    $form['cpa'],
    
    $form['id']
);

try {
    if ($conn->query($sql)) {
        $msg = 'Dados Atualizados com successo';
        http_response_code(200);
    } else {
        $msg = "Erro na atualização dos dados: " . $conn->error;
        http_response_code(400);
    }
} catch (Exception $ex) {
    http_response_code(500);
}

header("Location: ../usuarios");

$conn->close();

