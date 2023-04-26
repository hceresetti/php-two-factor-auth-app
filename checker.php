<?php
session_start();


require "Authenticator.php";
if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header("location: valida.php");
    die();
}
$Authenticator = new Authenticator();




$checkResult = $Authenticator->verifyCode($_SESSION['auth_secret'], $_POST['code'], 2);    // 2 = 2*30sec clock tolerance

if (!$checkResult) {
    $_SESSION['failed'] = true;
    header("location: valida.php");
    die();
} 


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Autenticação concluida!</title>
    <style>
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif;
}

body {
    display: flex;
    font-size: 50px;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: linear-gradient(120deg, #00001F, #17F2AD);
    transition: 0,5s;
}

.whitecampo {
    display: flex;
    justify-content: center;
    background: #fff;
    padding: 15px;
}

.titulo {
    align-items: center;
}
    </style>
<link rel="stylesheet" href="css/main.css">

</head>
<body>
    <div class="whitecampo">
        <p class="titulo">Autenticação concluida com sucesso.</p>
    </div>
</body>
</html>