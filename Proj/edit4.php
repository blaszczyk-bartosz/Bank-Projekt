<?php

    session_start();
    require_once "connect.php";        
    $conn = @new mysqli($host, $db_user, $db_password, $db_name);  

    $log = (string)$_SESSION['lo'];

    if (isset($_POST['dmail']))
    {
        $wok = true;
        $dmail = $_POST['dmail'];
        $dmails = filter_var($dmail, FILTER_SANITIZE_EMAIL);

        if((filter_var($dmails, FILTER_VALIDATE_EMAIL)==false) || ($dmails!=$dmail))
        {
            $wok=false;
            $_SESSION['e_dmail'] = "Niepoprawny adres email!";
            header('location: Settings.php');
        }

        if((strlen($dmail) < 4) || (strlen($dmail) >20 ))
        {
            $wok = false;
            $_SESSION['e_dmail'] = "Niepoprawny adres email!";
            header('location: Settings.php');
        }

        if ($wok == true)
        {
            if ($conn->connect_errno!=0)              
            {
            echo "Error: ".$conn->connect_errno;    
            }
            else        
            if ($conn->query("UPDATE dane SET Email='$dmail' WHERE NumerID='$log' ")) 
            $_SESSION['mok'] = "Zmiany będą widoczne po ponownym zalogowaniu";               
            header('location: Settings.php');
        }   
    }
?>
