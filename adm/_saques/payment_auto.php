<?php

include './../../conectarbanco.php';



$conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);



if ($conn->connect_error) {

    die("Conexão falhou: " . $conn->connect_error);

}



$sql = "SELECT client_id, client_secret FROM gateway WHERE id = 2";

$result = $conn->query($sql);



if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();

    $client_id = $row['client_id'];

    $client_secret = $row['client_secret'];



    $chavepix = $_POST['chavepix'] ?? '';

    $valor = $_POST['valor'] ?? 0;



    if ($chavepix && $valor > 0 && $valor <= 5) {

        $valor = number_format($valor, 2, '.', '');

        $id = $_POST['id'] ?? 0;

        $filename = 'used_ids.json';

        $used_ids = [];



        if (file_exists($filename)) {

            $used_ids = json_decode(file_get_contents($filename), true);

        }



        if (in_array($id, $used_ids)) {

            die("Anti-fraude acionado: Este ID já foi usado.");

        }



        $used_ids[] = $id;

        file_put_contents($filename, json_encode($used_ids));

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



        if (strpos($enviarpagamento, '"response":"OK"') !== false) {

            die("Pagamento realizado com sucesso");

        } else {

            die("Erro ao processar o pagamento: $enviarpagamento");

        }



        curl_close($curl);

    } else {

        echo "Chave Pix inválida, valor inválido ou valor fora do limite permitido.";

        exit;

    }

} else {

    echo "Credenciais suitpay não encontradas no banco de dados.";

    exit;

}

$conn->close();

?>