<?php

    session_start();
    require_once "connect.php";        
    $conn = @new mysqli($host, $db_user, $db_password, $db_name);  

    $log = (string)$_SESSION['lo'];


    if (isset($_POST['numerd']))
    {
        $ok = true;
        $nrd = $_POST['numerd'];
        $dw = $_POST['dataw'];

        $numer = substr($nrd,3,6);
        $seria1 = substr($nrd,0,1);
        $seria2 = substr($nrd,1,1);
        $seria3 = substr($nrd,2,1);
 

        if ($nrd == "" || $dw == "")
        {
            $ok = false;
            $_SESSION['e_dowod'] = "Wprowadzono błędne dane";
            header('location: Settings.php');
        }


        if (!(is_numeric($numer)))
        {
            $ok = false;
            $_SESSION['e_dowod'] = "Wprowadzono błędne dane";
            header('location: Settings.php');
        }

        if ((ord($seria1)<65 || ord($seria1)>90) || (ord($seria2)<65 || ord($seria2)>90) || (ord($seria3)<65 || ord($seria3)>90))
        {
            $ok = false;
            $_SESSION['e_dowod'] = "Wprowadzono błędne dane";
            header('location: Settings.php');
        }
    
        if($ok==true)
        {
            
            if ($conn->connect_errno!=0)              
            {
                echo "Error: ".$conn->connect_errno;    
            }
            else
                {   
                if ($conn->query("UPDATE dowod SET NumerDowodu='$nrd', DataWaznosci='$dw' WHERE NumerID='$log' "))
                $_SESSION['dowodok'] = "Zmiany będą widoczne po ponownym zalogowaniu"; 
                header('location: settings.php');
                }        
        }
    }
        
?>
