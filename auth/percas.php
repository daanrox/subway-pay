<?php
include './../conectarbanco.php';
$conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);

# if is not a post request, exit
session_start();
if (!isset($_SESSION['email'])) {
	header("Location: ../");
    exit();
}else if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
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
} else if ($action != 'game' || $type != 'lose') {
	var_dump(json_encode(array('errors' => true, 'message' => 'Deu problema')));
	http_response_code(500);
	exit;
}
// Obtém o email da sessão
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

$updateStmt = $conn->prepare("UPDATE ggr SET total_percas = total_percas + ?");
$updateStmt->bind_param("d", $bet); 
$updateStmt->execute();

$updateStmt = $conn->prepare("UPDATE ggr SET ggr_total = total_percas*0.08, debito_ggr = total_percas*0.08 - ggr_pago");
$updateStmt->execute();

$sqlGGR = sprintf("SELECT * FROM ggr limit 1");
$resultGGR = $conn->query($sqlGGR);
$GGR = $resultGGR->fetch_assoc();
    
$debito = floatval($GGR['debito_ggr']);
$credito = floatval($GGR['credito_ggr']);
$pago = floatval($GGR['ggr_pago']);

if($debito > 0){
    if($credito > 0){
        if ($debito > $credito) {
            $pago = $pago + $credito;
            $debito = $debito - $credito;
            $credito = 0;
        } else {
            $credito = $credito - $debito;
            $pago = $pago + $debito;
            $debito = 0;
        }
    
        $conn->query(sprintf("UPDATE ggr SET debito_ggr = '$debito'"));
        $conn->query(sprintf("UPDATE ggr SET credito_ggr = '$credito'"));
        $conn->query(sprintf("UPDATE ggr SET ggr_pago = '$pago'"));
    }
}


if($pago < $debito) {
    $conn->query(sprintf("UPDATE ggr SET status_ggr = 'IRREGULAR'"));
} else {
    $conn->query(sprintf("UPDATE ggr SET status_ggr = 'REGULAR'"));
}


var_dump(json_encode(array('success' => true, 'message' => 'Atualizado com sucesso!')));
http_response_code(200);
exit;
?>




