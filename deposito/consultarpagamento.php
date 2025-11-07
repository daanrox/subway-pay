<?php

function bad_request()
{
    echo "a";
    http_response_code(400);
    exit();
}

if (!isset($_GET["token"])) {
    bad_request();
}

$externalReference = $_GET["token"];

include "./../conectarbanco.php";

$conn = new mysqli(
    "localhost",
    $config["db_user"],
    $config["db_pass"],
    $config["db_name"]
);
if ($conn->connect_error) {
    echo "error";
    return;
}

$sql = sprintf(
    "SELECT status FROM confirmar_deposito WHERE externalreference = '%s'",
    $externalReference
);

$result = $conn->query($sql);

$result = $result->fetch_assoc();

if (!$result) {
    echo json_encode(["message" => "Token inválido"]);
    http_response_code(400);
    return;
}

echo json_encode($result);
http_response_code(200);
?>
