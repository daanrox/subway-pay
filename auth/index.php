<?php

include "./../conectarbanco.php";

$conn = new mysqli(
    "localhost",
    $config["db_user"],
    $config["db_pass"],
    $config["db_name"]
);

session_start();

if (!isset($_SESSION["email"])) {
    header("Location: ../");

    exit();
} elseif ($_SERVER["REQUEST_METHOD"] !== "GET") {
    exit();
}

$session = $_POST["session"];

$action = $_GET["action"];

$type = $_GET["type"];

$bet = $_GET["bet"];

$acumulado = $_GET["val"];

if ($action == "game" && $type == "demo") {
    var_dump(json_encode(["errors" => true, "message" => "JOGO DEMO"]));

    http_response_code(200);

    exit();
} elseif ($action != "game" || $type != "win") {
    var_dump(json_encode(["errors" => true, "message" => "Deu problema"]));

    http_response_code(500);

    exit();
}

$email = isset($_SESSION["email"]) ? $_SESSION["email"] : "";

$updateStmt = $conn->prepare(
    "UPDATE appconfig SET saldo = saldo + {$acumulado}, ganhos = ganhos + {$acumulado} WHERE email = ?"
);

$updateStmt->bind_param("s", $email);

$updateStmt->execute();

var_dump(
    json_encode(["success" => true, "message" => "Atualizado com sucesso!"])
);

http_response_code(200);

exit();

?>
