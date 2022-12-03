<?php
session_start();
require "Authenticator.php";


$Authenticator = new Authenticator();
if (!isset($_SESSION['auth_secret'])) {
    $secret = $Authenticator->generateRandomSecret();
    $_SESSION['auth_secret'] = $secret;
}


$qrCodeUrl = $Authenticator->getQR('ORLANDO', $_SESSION['auth_secret']);


if (!isset($_SESSION['failed'])) {
    $_SESSION['failed'] = false;
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="css/main.css"> -->
    <title>PROJETO DE SEGURANÇA</title>
</head>
<style>
    *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif;
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: linear-gradient(135deg, #65ADE2, #BA83C0);
    transition: 0,5s;
}

.container {
    position: relative;
    width: 800px;
    height: 550px;
    margin: 20px;
    justify-content: center;
}

.whiteForm {
    position: absolute;
    top: 40px;
    padding: 30px;
    background: #fff;
    box-shadow: 0 5px 45px rgba(0,0,0,0.15);
}

.whiteForm .form {
    position: absolute;
    left: 0;
    width: 100%;
    padding: 50px;
    transition: 0.5s;
}

.whiteForm .form form {
    display: flex;
    flex-direction: column;
}


.whiteForm .form form h2 {
    margin-bottom: 20px;
    font-weight: 600;
}


.whiteForm .form form input {
    width: 100%;
    margin-bottom: 20px;
    padding: 10px;
    outline: none;
    font-size: 16px;
    border: 1px solid #333;
}
</style>
<body>
   
        
            <div class="login">
                
                <p class="titulo">Orlando Medeiros - Henry Ceresetti</p>
                <p>OUTRA AUTENTICAÇÃO - CÓDIGO ENVIADO AO GOOGLE AUTHENTICATOR</p>

                <div class="container">
                        <div class="form signin">

                        <?php if ($_SESSION['failed']): ?>
                            <div class="titulo">
                                        Autenticação inválida 
                            </div>
                            <?php   
                                $_SESSION['failed'] = false;
                            ?>
                        <?php endif ?> 

                            <form action="check.php" method="post" class="whiteForm">
                                <h2>Entrar</h2>
                                <img src="<?php   echo $qrCodeUrl ?>" alt="Verify this Google Authenticator"><br><br>          
                                <input type="text" name="code" placeholder="Código"><br> <br>    
                                <button type="submit" class="cadastrar">Verificar</button>
                            </form>
                        </div>
                </div>
            </div>
        
    
</body>
</html>