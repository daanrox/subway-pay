<?php

error_reporting(0);

include './../../conectarbanco.php';

$conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);

if ($conn->connect_error) {

    die("Conexão falhou: " . $conn->connect_error);

}



if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "SELECT valor, chavepix FROM saques WHERE externalreference = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s", $id);

    $stmt->execute();

    $stmt->bind_result($valor, $chavepix);

    $stmt->fetch();

    $stmt->close();



    if ($valor && $chavepix) {

        $valor = number_format($valor, 2, '.', '');

        $sql_credenciais = "SELECT client_id, client_secret FROM gateway WHERE id = 2";

        $stmt_credenciais = $conn->prepare($sql_credenciais);

        $stmt_credenciais->execute();

        $stmt_credenciais->bind_result($client_id, $client_secret);

        $stmt_credenciais->fetch();

        $stmt_credenciais->close();



        if ($client_id && $client_secret) {

            $curl = curl_init();

            curl_setopt_array($curl, array(

                CURLOPT_URL => 'https://ws.suitpay.app/api/v1/gateway/pix-payment',

                CURLOPT_RETURNTRANSFER => true,

                CURLOPT_ENCODING => '',

                CURLOPT_MAXREDIRS => 10,

                CURLOPT_TIMEOUT => 0,

                CURLOPT_FOLLOWLOCATION => true,

                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

                CURLOPT_CUSTOMREQUEST => 'POST',

                CURLOPT_POSTFIELDS => '{

                    "value":' . $valor . ',

                    "key":"' . $chavepix . '",

                    "typeKey":"document"

                }',

                CURLOPT_HTTPHEADER => array(

                    'Client_id: ' . $client_id,

                    'Client_secret: ' . $client_secret,

                    'Content-Type: application/json'

                ),

            ));



            $enviarpagamento = curl_exec($curl);

            $responsejson = json_decode($enviarpagamento);

            $message_gateway = $responsejson->message;

            $response_gateway = $responsejson->response;



            if (strpos($enviarpagamento, '"response":"OK"') !== false) {

                $sql_update = "UPDATE saques SET status = 'Concluído' WHERE externalreference = ?";

                $stmt_update = $conn->prepare($sql_update);

                $stmt_update->bind_param("s", $id);

                $stmt_update->execute();

    

                if ($stmt_update->affected_rows > 0) {

                    echo json_encode(["success" => true]);

                } else {

                    echo json_encode(["success" => false, "message" => "Erro ao atualizar o status do pagamento no banco de dados."]);

                }

    

                $stmt_update->close();

            } else {

                echo json_encode(["success" => false, "message" => "$response_gateway - $message_gateway"]);

            }

    

            curl_close($curl);

        } else {

            echo json_encode(["success" => false, "message" => "Credenciais 'ci' ou 'cs' não encontradas na tabela 'suitpay'."]);

        }

    } else {

        $response = [

            'success' => false,

            'message' => 'Parâmetro "id" não fornecido.'

        ];

    

        header('Content-Type: application/json');

    

        echo json_encode($response);

    }

}

?>