<?php
    session_start();
    
    //walidacja
    if (isset($_POST['email1']))
    {
        $all_right=true;
        //sprawdzenie poprawnosc nickname
        $login1=$_POST['login1'];
        
        if ((strlen($login1)<5) || (strlen($login1)>15))
        {
            $all_right=false;
            $_SESSION['false_login']="Login musi posiadac od 5 do 15 znakow";
        } 
        if (ctype_alnum($login1)==false)
        {
            $all_right==false;
            $_SESSION['false_login']= "Login sklada sie tylko z liter i cyfr";
        }
        // haslo
        $haslo1=$_POST['haslo1'];
        $powhaslo1=$_POST['powhaslo1'];

        if ((strlen($haslo1)<8) || (strlen($haslo1)>20))
        {
            $all_right=false;
            $_SESSION['false_haslo']="Haslo musi posiadac od 8 do 20 znakow";
        } 
        if ($haslo1!=$powhaslo1)
        {
            $all_right=false;
            $_SESSION['false_haslo']="Haslo nie jest identyczne";
        }
        $haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
        echo $haslo_hash; exit();

        
        //  e-mail
        $email =$_POST['email1'];
        $emailV = filter_var($email, FILTER_SANITIZE_EMAIL);

        if((filter_var($emailV, FILTER_VALIDATE_EMAIL)==false) || ($emailV!=$email))
        {
            $all_right==false;
            $_SESSION['false_email']="Podaj poprawny adres e-mail";
        }

        echo $emailV; exit();


        if ($all_right==true)
        {
            echo "Walidacja udana"; exit();
        }
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestrator - Rejestracja</title>
    <script src='https://www.google.com/recaptcha/api.js'></script>

    <style>
        .error
        {
            color:red;
            margin: bottom 5px;
            margin: top 5px;
        }
    </style>
</head>
<body>
    <form method="post">
        User: </br> <input type="text" name="login1"/></br>

        <?php
            if(isset($_SESSION['false_login']))
            {
                echo '<div class="error">'.$_SESSION['false_login'].'</div>';
                unset($_SESSION['false_login']);
            }
        ?>
        Password: </br> <input type="text" name="haslo1"/></br>
        <?php
            if(isset($_SESSION['false_haslo']))
            {
                echo '<div class="error">'.$_SESSION['false_haslo'].'</div>';
                unset($_SESSION['false_haslo']);
            }
        ?>
        Powtorz Password: </br> <input type="text" name="powhaslo1"/></br>
        Email: </br> <input type="text" name="email1"/></br>
        <?php
            if(isset($_SESSION['false_email']))
            {
                echo '<div class="error">'.$_SESSION['false_email'].'</div>';
                unset($_SESSION['false_email']);
            }
        ?>

        <label>
        <input type="checkbox" name="rule"/> Akceptuję regulamin
        </label>
        <div class="g-recaptcha" data-sitekey="6LeEfaQoAAAAADjt3rdEeUTV9uHX3BWdOP4oWD"></div>

        </br>
        <input type="submit" value="Zarejestruj sie"/>
    </form>

</body>
</html>