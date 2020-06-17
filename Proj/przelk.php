<?php

session_start();
require_once 'connect.php';
$conn = @new mysqli($host, $db_user, $db_password, $db_name); 

$log = (string)$_SESSION['lo'];


if (isset($_POST['konto']))
{
    $wok = true;
    $konto = $_POST['konto'];
    $odbiorcak = $_POST['odbiorcak'];
    $numerk = $_POST['numerk'];
    $tytul = $_POST['tytulk'];
    $ilek = (float) $_POST['ilek'];
    $datak = $_POST['datak'];
    $r = substr($konto,0,1);
    $o = substr($numerk,0,1);
    $nadawcak = $_SESSION['imie'].' '.$_SESSION['nazwisko'];
    if ($konto == "")
    {
        $wok = false;
        $_SESSION['k_error'] = "Nie wybrano konta nadwacy";
        header('location: kraj.php');

    }

    if ($konto != "")
    {
            if ($r == 9 )
            {
                if ($_SESSION['saldo2'] < $ilek)
                {
                    $wok = false;
                    $_SESSION['k_error'] = "Brak wystarczających środków 2";
                    header('location: kraj.php');
                }
            }
       
            if ($r < 3 )
            {
                if ($_SESSION['saldo1'] < $ilek)
                {
                    $wok = false;
                    $_SESSION['k_error'] = "Brak wystarczających środków 1";
                    header('location: kraj.php');
                }
            }
    }

    if ($odbiorcak == "")
    {
        $wok = false;
        $_SESSION['k_error'] = "Nie podano nazwy odbiorcy";
        header('location: kraj.php');
    }

    if ($tytul == "")
    {
        $wok = false;
        $_SESSION['k_error'] = "Nie podano tytuły przelewu";
        header('location: kraj.php');

    }

    if ($ilek== "" || !is_numeric($ilek))
    {
        $wok = false;
        $_SESSION['k_error'] = "Wprowadź poprawną kwotę! Spróbój ponownie.";
        header('location: kraj.php');
    }

    if ($numerk == "")
    {
        $wok = false;
        $_SESSION['k_error'] = "Nie podano numeru konta odbiorcy";
        header('location: kraj.php');
    }
    
    if ($numerk != "")
    {
        $len = strlen($numerk);
        if($len !=26 || !(is_numeric($numerk)))
        {
            $wok = false;
            $_SESSION['k_error'] = "Nie poprawny format numeru konta odbiorcy";
            header('location: kraj.php');
        }
    }

    



    if ($wok == true)
    {
    if ($conn->connect_errno!=0)              
    {
        echo "Error: ".$conn->connect_errno;    
    }
    else
        {        
            if($r == 9 && $o == 9)
            {
                if ($conn->query("UPDATE koszcz SET saldo=saldo+'$ilek' WHERE NrKonta='$numerk' ") 
                && $conn->query("UPDATE koszcz SET saldo=saldo-'$ilek' WHERE NrKonta='$konto' "))
                 
               if($conn->query("INSERT INTO historia VALUES (NULL, CURDATE(), '$odbiorcak', '$nadawcak', '$ilek', '$tytul', '$numerk')")
                    && $conn->query("INSERT INTO historia VALUES (NULL, CURDATE(), '$odbiorcak', '$nadawcak', '-$ilek', '$tytul', '$konto')"))

                $_SESSION['k_ok'] = "Przelew wykonany";
                header('location: kraj.php');
            }
    
            if ($r == 9 && $o < 3)
            {
                if ($conn->query("UPDATE kzero SET saldo=saldo+'$ilek' WHERE NrKonta='$numerk' ") 
                && $conn->query("UPDATE koszcz SET saldo=saldo-'$ilek' WHERE NrKonta='$konto' "))

                if($conn->query("INSERT INTO historia VALUES (NULL, CURDATE(), '$odbiorcak', '$nadawcak', '$ilek', '$tytul', '$numerk')")
                && $conn->query("INSERT INTO historia VALUES (NULL, CURDATE(), '$odbiorcak', '$nadawcak', '-$ilek', '$tytul', '$konto')"))

                $_SESSION['k_ok'] = "Przelew wykonany";
                header('location: kraj.php');
            }

            if($r<3 && $o == 9)
            {

                if ($conn->query("UPDATE koszcz SET saldo=saldo+'$ilek' WHERE NrKonta='$numerk' ") 
                && $conn->query("UPDATE kzero SET saldo=saldo-'$ilek' WHERE NrKonta='$konto' "))

                if($conn->query("INSERT INTO historia VALUES (NULL, CURDATE(), '$odbiorcak', '$nadawcak', '$ilek', '$tytul', '$numerk')")
                && $conn->query("INSERT INTO historia VALUES (NULL, CURDATE(), '$odbiorcak', '$nadawcak', '-$ilek', '$tytul', '$konto')"))

                $_SESSION['k_ok'] = "Przelew wykonany";
                header('location: kraj.php');
            }

            if($r<3 && $o<3)
            {
                if ($conn->query("UPDATE kzero SET saldo=saldo+'$ilek' WHERE NrKonta='$numerk' ") 
                && $conn->query("UPDATE kzero SET saldo=saldo-'$ilek' WHERE NrKonta='$konto' "))

                if($conn->query("INSERT INTO historia VALUES (NULL, CURDATE(), '$odbiorcak', '$nadawcak', '$ilek', '$tytul', '$numerk')")
                && $conn->query("INSERT INTO historia VALUES (NULL, CURDATE(), '$odbiorcak', '$nadawcak', '-$ilek', '$tytul', '$konto')"))
                 
                $_SESSION['k_ok'] = "Przelew wykonany";
                header('location: kraj.php');
            }

        }


    }


}



?>


