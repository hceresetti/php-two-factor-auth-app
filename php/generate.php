<!-- PHP -->
<?php
    session_start();
    require "authenticate.php";

    $authenticate = new authenticate();
    
    if (!isset($_SESSION["auth_secret"])) {
        $secret = $authenticate -> generateRandomSecret();
        $_SESSION["auth_secret"] = $secret;
    }
    
    $qrCodeUrl = $authenticate -> getQR("EGYPT", $_SESSION["auth_secret"]);
    
    if (!isset($_SESSION["failed"])) {
        $_SESSION["failed"] = false;
    }
?>

<!-- HTML -->
<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ISG018 - Two Factor Auth</title>
    </head>
    <style>
        * {
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

        .formBlank {
            position: absolute;
            top: 40px;
            padding: 30px;
            background: #fff;
            box-shadow: 0 5px 45px rgba(0,0,0,0.15);
        }

        .formBlank .form {
            position: absolute;
            left: 0;
            width: 100%;
            padding: 50px;
            transition: 0.5s;
        }

        .formBlank .form form {
            display: flex;
            flex-direction: column;
        }

        .formBlank .form form h2 {
            margin-bottom: 20px;
            font-weight: 600;
        }

        .formBlank .form form input {
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
            <p class="title">
                <span lang="pt-br">Orlando Medeiros Júnior</span> and <span lang="pt-br">Henry Melo Ceresetti</span>
            </p>

            <p><strong>Attention:</strong> another authentication code was requested. The referred code was sent to your authenticator web service app.</p>

            <div class="container">
                <div class="form signIn">
                    <?php
                        if ($_SESSION["failed"]):
                    ?>
                    
                    <div class="title">Invalid authentication.</div>
                    
                    <?php   
                        $_SESSION["failed"] = false;
                    ?>
                    
                    <?php
                        endif
                    ?> 

                    <form method="POST" action="check.php" class="formBlank">
                        <h2>Sign In</h2>
                        <img alt="A regular QR code" src="<?php echo $qrCodeUrl ?>">
                        <br><br>
                        <p>Type the six numeric digits that appears on your authenticator app before it expires.</p>
                        <label for="qrCode">6-digits code:</label>         
                        <input type="text" id="qrCode" name="qrCode">
                        <br><br>
                        <button type="submit" class="signUp">Verify</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>