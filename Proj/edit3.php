<?php

    session_start();
    require_once "connect.php";        
    $conn = @new mysqli($host, $db_user, $db_password, $db_name);  

    $log = (string)$_SESSION['lo'];



    if (isset($_POST['dtel']))
    {
        $ok = true;
        $dtel=$_POST['dtel'];
        
        if(!(is_numeric($dtel)))
        {
            $ok = false;
            $_SESSION['e_dtel'] = "Nieporawny format";
            header('location: Settings.php');
        }
        if ($ok == true)
        {
            if ($conn->connect_errno!=0)              
            {
                echo "Error: ".$conn->connect_errno;    
            }
            else
            {                    
            if ($conn->query("UPDATE dane SET Telefon='$dtel' WHERE NumerID='$log' "))
            $_SESSION['ok'] = "Zmiany będą widoczne po ponownym zalogowaniu";
            header('location: settings.php');
            }
        }
    }

        
?>
