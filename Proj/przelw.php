<?php

session_start();
require_once 'connect.php';
$conn = @new mysqli($host, $db_user, $db_password, $db_name); 

$log = (string)$_SESSION['lo'];

if (isset($_POST['konto1']))
    {
    $wok = true;

    $skad = $_POST['konto1'];
    $gdzie = $_POST['konto2'];
    $ilew = (float) $_POST['ilew'];
    $odbiorcaw = $_SESSION['imie'].' '.$_SESSION['nazwisko'];
    $nadawca = $_SESSION['imie'].' '.$_SESSION['nazwisko'];
    $tytulw = $_POST['tytulw'];

    }

    if ($skad == "")
    {
        $wok = false;
        $_SESSION['w_error'] = "Wprowadzono błędne dane! Spróbuj ponownie.";
        header('location: wlasny.php');
    }

    if ($gdzie == "")
    {
        $wok = false;
        $_SESSION['w_error'] = "Wprowadzono błędne dane! Spróbuj ponownie.";
        header('location: wlasny.php');
    }

    if ($odbiorcaw == "")
    {
        $wok = false;
        $_SESSION['w_error'] = "Wprowadź nazwę odbiorcy! Spróbuj ponownie.";
        header('location: wlasny.php');
    }

    if ($tytulw == "")
    {
        $wok = false;
        $_SESSION['w_error'] = "Wprowadź tytuł odbiorcy! Spróbuj ponownie.";
        header('location: wlasny.php');
    }

    if ($ilew== "" || !is_numeric($ilew))
    {
        $wok = false;
        $_SESSION['w_error'] = "Wprowadź poprawną kwotę! Spróbuj ponownie.";
        header('location: wlasny.php');
    }


    if ($wok == true)
    {
        if ($conn->connect_errno!=0)              
        {
            echo "Error: ".$conn->connect_errno;    
        }
        else
            {        
                if(($skad>$gdzie) && ($ilew<$_SESSION['saldo2']))
                {
                    if ($conn->query("UPDATE kzero SET saldo=saldo+'$ilew' WHERE NumerID='$log' AND NrKonta='$gdzie' ") 
                    && $conn->query("UPDATE koszcz SET saldo=saldo-'$ilew' WHERE NumerID='$log' AND NrKonta='$skad' "))
                    
                    if($conn->query("INSERT INTO historia VALUES (NULL, CURDATE(), '$odbiorcaw', '$nadawca', '-$ilew', '$tytulw', '$skad')")
                    && $conn->query("INSERT INTO historia VALUES (NULL, CURDATE(), '$odbiorcaw', '$nadawca', '$ilew', '$tytulw', '$gdzie')"))

                    $_SESSION['w_ok'] = "Przelew wykonany!";
                    header('location: wlasny.php');
                    exit();
                }

                

                if(($skad<$gdzie) && ($ilew<$_SESSION['saldo1']))
                {
                    if ($conn->query("UPDATE koszcz SET saldo=saldo+'$ilew' WHERE NumerID='$log' AND NrKonta='$gdzie' ")
                    && $conn->query("UPDATE kzero SET saldo=saldo-'$ilew' WHERE NumerID='$log' AND NrKonta='$skad' "))

                    if($conn->query("INSERT INTO historia VALUES (NULL, CURDATE(), '$odbiorcaw', '$nadawca', '-$ilew', '$tytulw', '$skad')")
                    && $conn->query("INSERT INTO historia VALUES (NULL, CURDATE(), '$odbiorcaw', '$nadawca', '$ilew', '$tytulw', '$gdzie')"))

                    $_SESSION['w_ok'] = "Przelew wykonany!"; 
                    header('location: wlasny.php');
                }
                else{
                    $_SESSION['w_error'] = "Brak wystarczających środków na koncie";
                    header('location: wlasny.php');
                }


                if($skad == $gdzie)
                {
                    $_SESSION['w_error'] = "Numery kont muszą się różnić"; 
                    header('location: wlasny.php');
                }

                
        
            }
        }
        $conn->close();
    
?>


