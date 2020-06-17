<?php

    session_start();
    require_once "connect.php";        
    $conn = @new mysqli($host, $db_user, $db_password, $db_name);  

    $log = (string)$_SESSION['lo'];
   
     

if (isset($_POST['dulica']))
{
    $ok = true;
    $dul = $_POST['dulica'];
    $dkp = $_POST['dkodpocztowy'];
    $dms = $_POST['dmiejscowosc'];
    $dkr = $_POST['dkraj'];

    $dkp1 = substr($dkp,0,2);
    $dkp2 = substr($dkp,2,1);
    $dkp3 = substr($dkp,3,3);

    if($dul == "" || is_numeric($dul))
    {
        $ok=false;
        $_SESSION['e_ulica'] = 'Wprowadzono błędne dane!';
        header('location: Settings.php');
    }

    if($dkp == "")
    {
        $ok=false;
        $_SESSION['e_ulica'] = 'Wprowadzono błędne dane!';
        header('location: Settings.php');
    }

    if (!(is_numeric($dkp1)) || $dkp2!="-" || !(is_numeric($dkp3)))
    {
        $ok=false;
        $_SESSION['e_ulica'] = 'Wprowadzono błędne dane!';
        header('location: Settings.php');
    }

    if($dms == "")
    {
        $ok=false;
        $_SESSION['e_ulica'] = 'Wprowadzono błędne dane!';
        header('location: Settings.php');
    }

    if($dms != "")
    {
        $dmslen = strlen($dms);
        for ($i=0; $i<$dmslen;$i++)
        { 
            $a = substr($dms, $i, 1);
            if (preg_match('/[a-z|A-Z|ąĄćĆęĘłŁńŃoÓśŚźŹżŻ -]/', $a) == false)
            {
            $ok=false;
            $_SESSION['e_ulica'] = 'Wprowadzono błędne dane!';
            header('location: Settings.php');
            exit();
            }
        }   
    }


    if($dkr == "")
    {
        $ok=false;
        $_SESSION['e_ulica'] = 'Wprowadzono błędne dane!';
        header('location: Settings.php');
    }
    
   if($dkr != "")
    {
        $dkrlen = strlen($dkr);
        for ($i=0; $i<$dkrlen;$i++)
        { 
            $a = substr($dkr, $i, 1);
            if (preg_match('/[a-z|A-Z|ąĄćĆęĘłŁńŃoÓśŚźŹżŻ -]/', $a) == false)
            {
            $ok=false;
            $_SESSION['e_ulica'] = 'Wprowadzono błędne dane!';
            header('location: Settings.php');
            exit();
            }
        }   
    }

        if ($ok==true)
        {   
            if ($conn->connect_errno!=0)              
            {
                echo "Error: ".$conn->connect_errno;    
            }
            else
                {   
                if ($conn->query("UPDATE dane SET ulica='$dul', KodPocztowy='$dkp', miejscowosc='$dms', kraj='$dkr' WHERE NumerID='$log' "))
                $_SESSION['daneok'] = "Zmiany będą widoczne po ponownym zalogowaniu"; 
                header('location: settings.php');
                }
        }
    }
?>



