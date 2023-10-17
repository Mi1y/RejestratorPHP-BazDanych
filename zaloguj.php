<?php
    session_start();

    if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
        {
            header('Location: index.php');
            exit();
        }
    require_once 'connect.php';
    $connecting=@new mysqli($host, $db_user, $db_password, $db_name);
    
    if ($connecting->connect_errno!=0) 
    {
        echo "Error: ".$connecting->connect_errno." Opis: ".$connecting->connect_error;
    }
    else   
    {
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];

        //wstrzykiwanie SQL Injection (unikanie)
        $login= htmlentities($login, ENT_QUOTES, "UTF-8");
        
        //uzywalo sie przed sql injection
        //$sql= "SELECT * FROM uzytkownicy WHERE user='$login' and pass='$haslo'";

        if ($results= @$connecting->query(
        sprintf("SELECT * FROM uzytkownicy WHERE user='%s'",
        mysqli_real_escape_string($connecting,$login))))
        {
            $number_users=$results->num_rows;
            if ($number_users>0)
            {
                $wiersz = $results->fetch_assoc();

                if (password_verify($haslo, $wiersz['pass']))
                {
                $_SESSION['logged']= true; 
                //$wiersz to inaczej nazwa tablica asosjacyjna
                $_SESSION['id']=$wiersz['id'];
                $_SESSION['user']=$wiersz['user'];
                $_SESSION['email']=$wiersz['email'];
                $_SESSION['day']=$wiersz['day'];

                //nazwa kolumny w bazie 
                unset($_SESSION['error']);
                $results->free_result();
                header('Location: users.php');
                }
                else{
                    $_SESSION['error']='<span style="color:red">Nieprawidlowy login lub haslo!</span>';
                    header('Location: index.php');
                }
            }
            else{
                $_SESSION['error']='<span style="color:red">Nieprawidlowy login lub haslo!</span>';
                header('Location: index.php');
            }
        }
        $connecting->close();
    }
?>