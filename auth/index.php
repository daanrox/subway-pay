<?php
include './../conectarbanco.php';
$conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);

# if is not a post request, exit
session_start();
if (!isset($_SESSION['email'])) {
	header("Location: ../");
    exit();
}else if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    exit;
}

$session = $_POST['session'];
$action = $_GET['action'];
$type = $_GET['type'];
$bet = $_GET['bet'];
$acumulado = $_GET['val'];

if ($action == 'game' && $type == 'demo'){
	var_dump(json_encode(array('errors' => true, 'message' => 'JOGO DEMO')));
	http_response_code(200);
	exit;
} else if ($action != 'game' || $type != 'win') {
	var_dump(json_encode(array('errors' => true, 'message' => 'Deu problema')));
	http_response_code(500);
	exit;
}
// Obtém o email da sessão
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

$updateStmt = $conn->prepare("UPDATE appconfig SET saldo = saldo + {$acumulado}, ganhos = ganhos + {$acumulado} WHERE email = ?");
$updateStmt->bind_param('s', $email);
$updateStmt->execute();

var_dump(json_encode(array('success' => true, 'message' => 'Atualizado com sucesso!')));
http_response_code(200);
exit;
?>