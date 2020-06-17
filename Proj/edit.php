<?php

    session_start();
    require_once "connect.php";        
    $conn = @new mysqli($host, $db_user, $db_password, $db_name);  

    $log = (string)$_SESSION['lo'];

if (isset($_POST['ulica']))
{
    $ok=true;

    $ul = $_POST['ulica'];
    $kp = $_POST['kodpocztowy'];
    $ms = $_POST['miejscowosc'];
    $kr = $_POST['kraj'];

    if ($ul == "")
    {
    $ok=false;
    $_SESSION['e_kor'] = "Wprowadzono błędne dane";
    header('location: settings.php');
    }

    if ($ul != "")
    {
        $dlul = strlen($ul);
        for ($i=0; $i<$dlul; $i++)
        {
        $a = substr($ul, $i, 1);
            if (preg_match('/[a-z|A-Z|ąĄćĆęĘłŁńŃoÓśŚźŹżŻ\\/ |0-9-]/', $a)==false)
            {
                $ok = false;
                $_SESSION['e_kor'] = "Wprowadzono błędne dane";
                header('location: settings.php');
                exit();
            }
        }
    }


    if ($kp== "")
    {
    $ok=false;
    $_SESSION['e_kor'] = "Wprowadzono błędne dane";
    header('location: settings.php');
    }


    if ($kp != "")
    {
    $kp1 = substr($kp,0,2);
    $kp2 = substr($kp,2,1);
    $kp3 = substr($kp,3,3);

        if (!(is_numeric($kp1)) || $kp2!="-" || !(is_numeric($kp3)))
        {
            $ok=false;
            $_SESSION['e_kor'] = 'Wprowadzono błędne dane!';
            header('location: Settings.php');
        }
    }

    if ($ms == "")
    {
    $ok=false;
    $_SESSION['e_kor'] = "Wprowadzono błędne dane";
    header('location: settings.php');
    }

    if($ms != "")
    {
        $dlms = strlen($ms);
        for ($i=0; $i<$dlms; $i++)
        {
            $a = substr($ms, $i,1);
            if (preg_match('/[a-z|A-Z|ąĄćĆęĘłŁńŃoÓśŚźŹżŻ -]/', $a) == false)
            {
            $ok=false;
            $_SESSION['e_kor'] = 'Wprowadzono błędne dane!';
            header('location: Settings.php');
            exit();
            }
        }
    }

    if ($kr == "")
    {
    $ok=false;
    $_SESSION['e_kor'] = "Wprowadzono błędne dane";
    header('location: settings.php');
    }

    if($kr != "")
    {
        $krlen = strlen($kr);
        for ($i=0; $i<$krlen;$i++)
        { 
            $a = substr($kr, $i, 1);
            if (preg_match('/[a-z|A-Z|ąĄćĆęĘłŁńŃoÓśŚźŹżŻ -]/', $a) == false)
            {
            $ok=false;
            $_SESSION['e_kor'] = 'Wprowadzono błędne dane!';
            header('location: Settings.php');
            exit();
            }
        }   
    }

    if( $ok==true)
    {
        if ($conn->connect_errno!=0)              
        {
            echo "Error: ".$conn->connect_errno;    
        }
        else
            {        
            if ($conn->query("UPDATE adreskor SET ulica='$ul', KodPocztowy='$kp', miejscowosc='$ms', kraj='$kr' WHERE NumerID='$log' "))
            $_SESSION['korok'] = "Zmiany będą widoczne po ponownym zalogowaniu"; 
            header('location: settings.php');
            }
    }


}
?>
