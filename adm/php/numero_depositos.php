<?php
include "./../../conectarbanco.php";

$conn = new mysqli(
    "localhost",
    $config["db_user"],
    $config["db_pass"],
    $config["db_name"]
);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$status = isset($_GET["status"]) ? $_GET["status"] : null;

$sqlCountDeposits =
    "SELECT COUNT(*) as depositCount FROM confirmar_deposito WHERE status='PAID_OUT'";

if (!empty($status)) {
    $sqlCountDeposits .= " AND status = ?";
}

$stmt = $conn->prepare($sqlCountDeposits);

if (!empty($status)) {
    $stmt->bind_param("s", $status);
}

$stmt->execute();
$resultCountDeposits = $stmt->get_result();
$stmt->close();

if ($resultCountDeposits->num_rows > 0) {
    $rowCountDeposits = $resultCountDeposits->fetch_assoc();
    echo $rowCountDeposits["depositCount"];
} else {
    echo "0";
}

$conn->close();
?>
