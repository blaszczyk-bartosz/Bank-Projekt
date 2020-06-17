<?php

session_start();
require_once 'connect.php';
$conn = @new mysqli($host, $db_user, $db_password, $db_name); 

function blad()
{
    $_SESSION['blad'] = 'Uzupełnij wszystkie pola';
    header('location: zarejestruj.php');
}


if (isset($_POST['imie']))
{
    $ok = true;
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $pesel = $_POST['pesel'];
    $nrdowodu = $_POST['nrdowodu'];
    $datadowodu = $_POST['datadowodu'];
    $ulica = $_POST['ulica'];
    $kod = $_POST['kod'];
    $miejscowosc = $_POST['miejscowosc'];
    $mail = $_POST['mail'];
    $telefon = $_POST['telefon'];
    $kraj = $_POST['kraj'];
    $okonto = $_POST['okonto'];
    $zkonto = $_POST['zkonto'];
    $numerid = $_POST['numerid'];
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $saldo = 0;
    $idkoszcz = 2;
    $idkzero = 1;

    $_SESSION['imie'] = $imie;
    $_SESSION['nazwisko'] = $nazwisko;
    $_SESSION['pesel'] = $pesel;
    $_SESSION['nrdowodu'] = $nrdowodu;
    $_SESSION['datadowodu'] = $datadowodu;
    $_SESSION['ulica'] = $ulica;
    $_SESSION['kod'] = $kod;
    $_SESSION['miejscowosc'] = $miejscowosc;
    $_SESSION['mail'] = $mail;
    $_SESSION['telefon'] = $telefon;
    $_SESSION['kraj'] = $kraj;
    $_SESSION['okonto'] = $okonto;
    $_SESSION['zkonto'] = $zkonto;
    $_SESSION['numerid'] = $numerid;

    if ($imie == '' || $nazwisko == '' || $pesel == '' || $nrdowodu == '' || $datadowodu == '' || $ulica == '' || $kod == '' || $miejscowosc == ''
    || $mail == '' || $telefon == '' || $kraj == '' || $okonto == '' || $zkonto == '' || $numerid == '' || $pass1 == '' || $pass2 == '')
    {
        $ok = false;
        blad();
    }

    if ($pesel != '')
    {
        $lenghtpesel = strlen($pesel);

        if ($lenghtpesel != 11)
        {
            $ok == false;
            $_SESSION['blad'] = 'Numer PESEL powinien składać się z 11 cyfr'; 
            header('location: zarejestruj.php');
        }

        if (!(is_numeric($pesel)))
        {
            $ok = false;
            $_SESSION['blad'] = 'Numer PESEL powinien składać się wyłącznie z cyfr';
            header('location: zarejestruj.php');
        }
    }

    if ($nrdowodu != '')
    {
        $numer = substr($nrdowodu,3,6);
        $seria1 = substr($nrdowodu,0,1);
        $seria2 = substr($nrdowodu,1,1);
        $seria3 = substr($nrdowodu,2,1);

        if (!(is_numeric($numer)))
        {
            $ok = false;
            $_SESSION['blad'] = 'Wprowadono błędny numer dowodu';
            header('location: zarejestruj.php');
        }

        if ((ord($seria1)<65 || ord($seria1)>90) || (ord($seria2)<65 || ord($seria2)>90) || (ord($seria3)<65 || ord($seria3)>90))
        {
            $ok = false;
            $_SESSION['blad'] = 'Wprowadzono błędną serię dowodu';
            header('location: zarejestruj.php');
        }

        if ($conn->connect_errno!=0)              
        {
            echo "Error: ".$conn->connect_errno;    
        }
        else
        {
            $nrdowodu = htmlentities($nrdowodu, ENT_QUOTES, "UTF-8");
             
            if ($rezultat = $conn->query("SELECT * FROM dowod WHERE NumerDowodu = '$nrdowodu'"))
            {   
                $ile = $rezultat->num_rows;
                if ($ile != 0)
                {
                $ok = false;
                $_SESSION['blad'] = "Podany numer dowodu istnieje w bazie danych";
                header('location: zarejestruj.php');
                }
            }
        }
    }

    if ($datadowodu != '')
    {
        if ($datadowodu < date('Y-m-d'))
        {
            $ok = false;
            $_SESSION['blad'] = 'Upłynął termin ważności dokumentu';
            header('location: zarejestruj.php');
        }
    }

    if ($ulica != "")
    {
        $lenghtulica = strlen($ulica);
        $a = substr($ulica, $lenghtulica-1, 1);
        $b = substr($ulica, $lenghtulica-2, 1);
        $c = substr($ulica, $lenghtulica-3, 1);

        if (!(is_numeric($a)))
        {
            if (!(is_numeric($b)))
            {
                if ( !(is_numeric($c)))
                {
                    $ok = false;
                    $_SESSION['blad'] = "Wprowadź poprawną nazwę ulicy wraz z numerem";
                    header('location: zarejestruj.php');
                }
            }
        }
    }

    if ($kod != "")
    {
    $kod1 = substr($kod,0,2);
    $kod2 = substr($kod,2,1);
    $kod3 = substr($kod,3,3);

        if (!(is_numeric($kod1)) || $kod2!="-" || !(is_numeric($kod3)))
        {
            $ok=false;
            $_SESSION['blad'] = 'Wprowadź poprawny kod pocztowy';
            header('location: zarejestruj.php');
        }
    }

    if ($miejscowosc != "")
    {
        $lenghtmiejscowosc = strlen($miejscowosc);
        for ($i=0; $i<$lenghtmiejscowosc; $i++)
        {
            $a = substr($miejscowosc, $i,1);
            if (preg_match('/[a-z|A-Z|ąĄćĆęĘłŁńŃoÓśŚźŹżŻ -]/', $a) == false)
            {
            $ok=false;
            $_SESSION['blad'] = 'Wprowadź poprawną nazwę miejscowości';
            header('location: zarejestruj.php');
            }
        }
    }

    if ($mail != '')
    {
        $mails = filter_var($mail, FILTER_SANITIZE_EMAIL);

        if((filter_var($mails, FILTER_VALIDATE_EMAIL) == false) || ($mails != $mail))
        {
            $ok=false;
            $_SESSION['blad'] = "Wprowadź poprawny adres email!";
            header('location: zarejestruj.php');
        }

        if((strlen($mail) < 4) || (strlen($mail) > 50 ))
        {
            $ok = false;
            $_SESSION['blad'] = "Wprowadź poprawny adres email!";
            header('location: zarejestruj.php');
        }
    }

    if ($telefon != '')
    {
        if(!(is_numeric($telefon)))
        {
            $ok = false;
            $_SESSION['e_dtel'] = "Wprowadź poprawny numer telefonu";
            header('location: zarejestruj.php');
        }
    }

    if($kraj != "")
    {
        $lenghtkraj = strlen($kraj);
        for ($i=0; $i<$lenghtkraj; $i++)
        { 
            $a = substr($kraj, $i, 1);
            if (preg_match('/[a-z|A-Z|ąĄćĆęĘłŁńŃoÓśŚźŹżŻ -]/', $a) == false)
            {
            $ok=false;
            $_SESSION['blad'] = 'Wprowadź poprawną nazwę kraju';
            header('location: zarejestruj.php');
            }
        }   
    }

    if ($okonto != "")
    {
        $lenghtokonto = strlen($okonto);
        if($lenghtokonto !=26 || !(is_numeric($okonto)))
        {
            $ok = false;
            $_SESSION['blad'] = 'Błędny format numeru Konta Oszczędnościowego';
            header('location: zarejestruj.php');
        }

        if ($conn->connect_errno!=0)              
        {
            echo "Error: ".$conn->connect_errno;    
        }
        else
        {
            $okonto = htmlentities($okonto, ENT_QUOTES, "UTF-8");
             
            if ($rezultat = $conn->query("SELECT * FROM koszcz WHERE NrKonta = '$okonto'"))
            {   
                $ile = $rezultat->num_rows;
                if ($ile != 0)
                {
                $ok = false;
                $_SESSION['blad'] = "Podany numer Konta Oszczędnościowego istnieje w bazie";
                header('location: zarejestruj.php');
                }
            }
        }
    }

    if ($zkonto != "")
    {
        $lengthzkonto = strlen($zkonto);
        if($lengthzkonto !=26 || !(is_numeric($zkonto)))
        {
            $ok = false;
            $_SESSION['blad'] = 'Błędny format numeru Konta Za Zero';
            header('location: zarejestruj.php');
        }

        if ($conn->connect_errno!=0)              
        {
            echo "Error: ".$conn->connect_errno;    
        }
        else
        {
            $zkonto = htmlentities($zkonto, ENT_QUOTES, "UTF-8");
             
            if ($rezultat = $conn->query("SELECT * FROM kzero WHERE NrKonta = '$zkonto'"))
            {   
                $ile = $rezultat->num_rows;
                if ($ile != 0)
                {
                $ok = false;
                $_SESSION['blad'] = "podany numer Konta Za Zero istnieje w bazie";
                header('location: zarejestruj.php');
                }
            }
        }
    }

    if ($numerid != "")
    {
        $lenghtnumerid = strlen($numerid);
        if($lenghtnumerid !=8 || !(is_numeric($numerid)))
        {
            $ok = false;
            $_SESSION['blad'] = 'Błędny format numeru klienta';
            header('location: zarejestruj.php');
        }

        if ($conn->connect_errno!=0)              
        {
            echo "Error: ".$conn->connect_errno;    
        }
        else
        {
            $numerid = htmlentities($numerid, ENT_QUOTES, "UTF-8");
             
            if ($rezultat = $conn->query("SELECT * FROM klient WHERE NumerID = '$numerid'"))
            {   
                $ile = $rezultat->num_rows;
                if ($ile != 0)
                {
                $ok = false;
                $_SESSION['blad'] = "Podany klient istnieje w bazie danych";
                header('location: zarejestruj.php');
                }
            }
        }
    }

    if ($pass1 !='')
    {
        if ($_POST['pass1'] != $_POST['pass2']) 
        {
            $ok = false;
            $_SESSION['blad'] = 'Wprowadzone hasła są różne';
            header('location: zarejestruj.php');
        }
    }

    if (!isset($_POST['regulamin'])) 
    {
        $ok = false;
        $_SESSION['blad'] = 'Wymagana akceptacja regulaminy';
        header('location: zarejestruj.php');
    }

    if (!isset($_POST['prawda'])) 
    {
        $ok = false;
        $_SESSION['blad'] = 'Wymagane oświadczenie prawdy';
        header('location: zarejestruj.php');
    }

    $pass1 = password_hash($pass1, PASSWORD_ARGON2ID);

    if ($ok == true)
    {


        if ($conn->connect_errno!=0)              
        {
            echo "Error: ".$conn->connect_errno;    
        }
        else
        {
            $sql = "INSERT INTO klient VALUES (?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $numerid, $imie , $nazwisko, $pesel, $pass1);

            $sql1 = "INSERT INTO dane VALUES (?,?,?,?,?,?,?)";
            $stmt1 = $conn->prepare($sql1);
            $stmt1->bind_param("sssssss", $numerid, $ulica , $miejscowosc, $kod, $telefon, $mail, $kraj);

            $sql2 = "INSERT INTO dowod VALUES (?,?,?)";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->bind_param("sss", $nrdowodu, $numerid , $datadowodu);


            $sql3 = "INSERT INTO koszcz VALUES (?,?,?,?)";
            $stmt3 = $conn->prepare($sql3);
            $stmt3->bind_param("ssss", $okonto, $idkoszcz, $saldo, $numerid);

            
            $sql4 = "INSERT INTO kzero VALUES (?,?,?,?)";
            $stmt4 = $conn->prepare($sql4);
            $stmt4->bind_param("ssss", $zkonto, $idkzero, $saldo, $numerid);

            $sql5 = "INSERT INTO adreskor VALUES (?,?,?,?,?)";
            $stmt5 = $conn->prepare($sql5);
            $stmt5->bind_param("sssss", $numerid, $ulica, $miejscowosc, $kod, $kraj);


            if ($stmt->execute() && $stmt1->execute() && $stmt2->execute() && $stmt3->execute() && $stmt4->execute() && $stmt5->execute()) 
            {
                $stmt->close();
                $stmt1->close();
                $stmt2->close();
                $stmt3->close();
                $stmt4->close();
                $stmt5->close();
                $conn->close();
                $_SESSION['udanarejestracja'] = 'Gratulacje! Zostałeś klientem naszego baku. Zaloguj się do swojego konta.';
                header('location: index.php');
                exit();
            }
        }
    }
}
?>