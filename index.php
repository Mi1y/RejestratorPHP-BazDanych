<?php
    session_start();

    if((isset($_SESSION['logged'])) && ($_SESSION['logged']==true))
    {
        header('Location: users.php');
        exit();
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
    Rejestrator PHP & Baz danych </br></br>

    <a href="rejestracja.php">Rejestracja! </a></br></br>
     
    <form action="zaloguj.php" method="post">
        Login: </br> <input type="text" name='login'></br>
        Haslo: </br> <input type="password" name='haslo'></br>
    </br><input type="submit" value="Zaloguj sie">

    </form>
<?php
    if(isset($_SESSION['error']))
    echo $_SESSION['error'];
?>

</body>
</html>