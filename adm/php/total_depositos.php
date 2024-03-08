<?php
include './../../conectarbanco.php';

$conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT SUM(valor) as total FROM confirmar_deposito WHERE status = 'PAID_OUT'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "R$ " . number_format($row["total"], 2, ',', ''); 
} else {
    echo "R$ 0"; 
}

$conn->close();
?>
