<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

# if is not a post request, exit
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit;
}

function bad_request()
{
    http_response_code(400);
    exit;
}

# get the payload
$payload = file_get_contents('php://input');

# decode the payload
$payload = json_decode($payload, true);
file_put_contents('teste.txt', $payload);

# if the payload is not valid json, exit
if (is_null($payload)) {
    bad_request();
}

# if the payload is not a pix payment, exit
if ($payload['typeTransaction'] !== 'PIX') {
    bad_request();
}

function get_conn()
{
  include './../conectarbanco.php';

    return new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);

}

$externalReference = $payload['idTransaction'];
$status = $payload['statusTransaction'];

# if the payment is confirmed
if ($status === 'PAID_OUT') {
    $conn = get_conn();
    
    
    # get the payment from the database
    $sql = sprintf("SELECT * FROM confirmar_deposito WHERE externalreference = '$externalReference'");
    $result = $conn->query($sql);

    $result = $result->fetch_assoc();

    # if the payment is not found, exit
    if (!$result) {
        bad_request();
    }

    # if the payment is already confirmed, exit
    if ($result['status'] === 'PAID_OUT') {
        bad_request();
    }

    # update the payment status
    $sql = sprintf("UPDATE confirmar_deposito SET status = 'PAID_OUT' WHERE externalreference = '%s'", $externalReference);
    $conn->query($sql);
    
	
	// CPA AUTOMATIZADO
	$valor_depositado = $result['valor'];
	$email = $result['email'];
	$sqlUser = sprintf("SELECT * FROM appconfig WHERE email = '{$email}'");
    $resultUser = $conn->query($sqlUser);
    $resultUser = $resultUser->fetch_assoc();
	
	$sqlApp = sprintf("SELECT * FROM app limit 1");
    $resultApp = $conn->query($sqlApp);
    $resultApp = $resultApp->fetch_assoc();
	
	$sqlDeposito = sprintf("SELECT count(*) as total FROM confirmar_deposito WHERE email = '{$email}'");
    $resultDeposito = $conn->query($sqlDeposito);
    $resultDeposito = $resultDeposito->fetch_assoc();
	$conn->query(sprintf("UPDATE appconfig SET depositou = depositou + '{$valor_depositado}' WHERE email = '{$email}'"));
	

                                          
	if ($resultDeposito['total'] >= 1) {
	    
		if (!is_null($resultUser['afiliado']) && !empty($resultUser['afiliado'])) {
		    
			if (intval($result['valor']) >= $resultApp['deposito_min_cpa']) {
			    $randomNumber = rand(0, 100);
			    
                if($randomNumber <= intval($resultApp['chance_afiliado'])){
                    
                    if($resultUser['cpa'] > 0){
        			    $conn->query(sprintf("UPDATE appconfig SET status_primeiro_deposito=1 WHERE email = '{$resultUser['email']}'"));
        				$conn->query(sprintf("UPDATE appconfig SET saldo_cpa = saldo_cpa + %s WHERE id = '%s'", intval($resultUser['cpa']), $resultUser['afiliado']));
                    }else{
                        $conn->query(sprintf("UPDATE appconfig SET status_primeiro_deposito=1 WHERE email = '{$resultUser['email']}'"));
        				$conn->query(sprintf("UPDATE appconfig SET saldo_cpa = saldo_cpa + %s WHERE id = '%s'", intval($resultApp['cpa']), $resultUser['afiliado']));
                    }
                }
			}
		}
	}
	// END AUTOMATIZADO
	
	
    # update the user balance original
    //$result = $conn->query(sprintf("UPDATE appconfig SET saldo = saldo + %s WHERE email = '%s'", intval($result['valor']) + intval($value), $result['email']));
    $result = $conn->query(sprintf("UPDATE appconfig SET saldo = saldo + %s WHERE email = '%s'", intval($result['valor']), $result['email']));
	
    # return a success response
    var_dump(json_encode(array('success' => true, 'message' => 'Pagamento do PIX confirmado.')));
    http_response_code(200);
    exit;
}

