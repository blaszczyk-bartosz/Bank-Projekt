<?php

    session_start();
    require_once "connect.php";        
    $conn = @new mysqli($host, $db_user, $db_password, $db_name);  

    $log = (string)$_SESSION['lo'];
    $nadawca = $_SESSION['imie'].' '.$_SESSION['nazwisko'];
    $numer = $_SESSION['znrkonta'];
    if (isset($_POST['Produkt']))
    {
        $wok = true;
        $produkt = $_POST['Produkt'];
        $cel = $_POST['Cel'];
        $poczatek = 0;

        if ($produkt=="")
        {
            $wok=false;
            $_SESSION['p_blad'] = "Nazwa nie może być pusta. Spróbuj ponownie!";
            header('location: oszczednosci.php');
        }

        if ($cel=="")
        {
            $wok=false;
            $_SESSION['p_blad'] = "Cel musi być określony. Spróbuj ponownie!";
            header('location: oszczednosci.php');
        }

        if (!(is_numeric($cel)))
        {
            $wok=false;
            $_SESSION['p_blad'] = "Cel musi być liczbą. Spróbuj ponownie!";
            header('location: oszczednosci.php');
        }

        if ($wok == true)
        {
            if ($conn->connect_errno!=0)              
            {
            echo "Error: ".$conn->connect_errno;    
            }
            else        
            if ($conn->query("INSERT INTO oszczednosci VALUES (NULL, '$produkt', '$cel','$poczatek','$log') ")) 
            $_SESSION['error'] = "Dodanie produktu powiodło się";               
            header('location: oszczednosci.php');
        }   
    }


    if(isset($_POST['ile']))
    {
        $ok = true;
        $ile = $_POST['ile'];
        $ktore = $_POST['ktore'];
        $co = $_POST['co'];
        $konto = substr($ktore,0,1);

        if ($ile== "" || !is_numeric($ile))
        {
            $ok = false;
            $_SESSION['p_blad'] = "Wprowadź poprawną kwotę! Spróbuj ponownie.";
            header('location: oszczednosci.php');
        }

        if ($ktore == "")
        {
            $ok = false;
            $_SESSION['p_blad'] = "Pole z kontem nie może być puste!";
            header('location: oszczednosci.php');
        }

        if ($co =="")
        {
            $ok = false;
            $_SESSION['p_blad'] = "Nie wybrano produktu!";
            header('location: oszczednosci.php');
        }

        if ($ile != "")
        {
                if ($konto == 9 )
                {
                    if ($_SESSION['saldo2'] < $ile)
                    {
                        $ok = false;
                        $_SESSION['p_blad'] = "Brak wystarczających środków!";
                        header('location: oszczednosci.php');
                    }
                }
           
                if ($konto < 3 )
                {
                    if ($_SESSION['saldo1'] < $ile)
                    {
                        $ok = false;
                        $_SESSION['p_blad'] = "Brak wystarczających środków!";
                        header('location: oszczednosci.php');
                    }
                }
        }

        if ($ok == true)
        {
            if ($conn->connect_errno!=0)              
            {
            echo "Error: ".$conn->connect_errno;    
            }
            else       
            {
                if ($konto == 9)
                {
                    if($conn->query("UPDATE koszcz SET saldo=saldo-'$ile' WHERE NrKonta='$ktore' ") 
                    && $conn->query("UPDATE oszczednosci SET kwota=kwota+'$ile' WHERE NumerID='$log' AND Produkt='$co' "))

                    if($conn->query("INSERT INTO historia VALUES (NULL, CURDATE(), 'OSZCZĘDNOŚCI', '$nadawca', '-$ile', 'OSZCZĘDNOŚCI', '$ktore')"))

                    $_SESSION['error'] = "Pomyślnie przelano środki";
                    header('location: oszczednosci.php');
                }

                if ($konto < 3)
                {
                    if($conn->query("UPDATE kzero SET saldo=saldo-'$ile' WHERE NrKonta='$ktore' ") 
                    && $conn->query("UPDATE oszczednosci SET kwota=kwota+'$ile' WHERE NumerID='$log' AND Produkt='$co' "))

                    if($conn->query("INSERT INTO historia VALUES (NULL, CURDATE(), 'OSZCZĘDNOŚCI', '$nadawca', '-$ile', 'OSZCZĘDNOŚCI', '$ktore')"))

                    $_SESSION['error'] = "Pomyślnie przelano środki";
                    header('location: oszczednosci.php');
                }
            }
        }
    }


    if (isset($_POST['usun']))
    {
    $usun = $_POST['usun'];

            if ($oszczednosci = $conn->query("SELECT * FROM oszczednosci WHERE NumerID='$log'" ))
            {
                $osz = $oszczednosci->num_rows;
                if ($osz > 0)
                $prod = $oszczednosci->fetch_assoc();
                $kwota = $prod['Kwota'];
                
                
             if ($conn->query("UPDATE kzero SET saldo=saldo+'$kwota' WHERE NumerID='$log' ") 
                && $conn->query("DELETE FROM oszczednosci WHERE produkt='$usun' AND NumerID='$log' ")) 

            if($conn->query("INSERT INTO historia VALUES (NULL, CURDATE(), '$kwota', 'OSZCZĘDNOŚCI', '$kwota', 'OSZCZĘDNOŚCI', '$numer')"))

                $_SESSION['error'] = "Produkt został usunięty";               
                header('location: oszczednosci.php');
                $oszczednosci->close();
                
            
    } 

    }



    $conn->close();
?>
