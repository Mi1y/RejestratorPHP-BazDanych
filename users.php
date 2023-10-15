<?php
    session_start();
    if(!isset($_SESSION['logged']))
    {
        header('Location: index.php');
        exit();
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestrator - User</title>
</head>
<body>
    
<?php
    echo "<p>Witaj ".$_SESSION['user'].'![ <a href="logout.php">Log out</a>]</p>';

    echo "</br><p>Email: ".$_SESSION['email']." | ";
    echo "Dzien: ".$_SESSION['day']."</p>";
?>

</body>
</html>