<?php
// Adicione este código no início do arquivo redirect.php
header("Location: ./index.php");
exit;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="0;url=../painel/">
    <title>Redirecionando...</title>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        // Adiciona um ouvinte de eventos para detectar quando o usuário tenta voltar
        window.addEventListener('popstate', function (event) {
            window.location.href = '../painel/';
        });
    </script>
</head>
<body>
    Se você não foi redirecionado, <a href="../painel/">clique aqui</a>.
</body>
</html>