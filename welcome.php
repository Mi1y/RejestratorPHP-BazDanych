<?php
    session_start();

    if((isset($_SESSION['completedregister'])))
    {
        header('Location: index.php');
        exit();
    }
    else
    {
        unset($_SESSION['completedregister']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestrator - Strona Glowna</title>
</head>
<body>
    Dziekujemy za rejestracje! </br></br>

    <a href="index.php">Zaloguj sie na swoje konto! </a></br></br>
     
</body>
</html>