<?php
session_start();                        //deklaracja tablicy globalnej przechowującej zmienne

if (!isset($_SESSION['zalogowany']))    //instrukcja utrzymania zalogowania(jeżeli nie istnieje zalogowanie)
{
    header('location: index.php');      //przenosi na stronę główną, logownia
    exit();                             //przerywa natychmiastowo działanie kodu, by dalej nie interpretowało
}

require_once 'connect.php';
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name); 



?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Zalogowany Użytkownik</title>
    <meta name="description" content="Nowoczesna bankowo�� w najlepszym wydaniu. Szybko, prosto i skutecznie. Nie tra� czasu na stanie w kolejkach!">
    <meta name="keywords" content="dobry bank, szybki bank, nowoczesny bank, nowoczesna bankowo��"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href ="style.css" type="text/css"/>
    <link rel="stylesheet" href ="produkty.css" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Baloo+2|Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fontello/css/fontello.css" type="text/css"/>
</head>
<body> 



<div class="container">

    <div class="row mt-3">
        <div class="col-4 ">
            <figure>
                <a href="start.php""><img class="logo" src="safebank logo.jpg" alt="logo"/></a>
                <figcaption class="text-center">SafeBank</figcaption>
            </figure>           
        </div>

        <div class="col-4 text-center my-auto">
            <?php echo "Numer klienta: ".$_SESSION['numer']; ?><br/>
            Rodzaj Profilu: Indywidualny<br/>
            <?php echo $_SESSION['imie']." ".$_SESSION['nazwisko']; ?>
        </div>

        <div class="col-4 text-center settings ">    
            <a class="option2" href="settings.php">Ustawienia<i class="icon-cog"></i>  </a> 
            <a class="option2" href="#">Wiadomości<i class="icon-mail-alt"></i> </a>  
            <a class="option2" href="wyloguj.php">Wylogowanie<i class="icon-off"></i> </a> 
        </div>
    </div>

    <nav class="navbar navbar-light navbar-expand-md mx-0">
         
        <a href="start.php"><i class="icon-home"></i></a>          

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="przelacznik menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav mx-auto">

                <li class="nav-item active">
                    <a class="nav-link" href="start.php"> PULPIT </a>
                </li>
                                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false" id="subtransaction" aria-haspopup="true"> TRANSAKCJE </a>
                        <div class="dropdown-menu" aria-labelledby="subtransaction">
                            <a class="dropdown-item" href="kraj.php">Przelew</a>
                        </div>
                </li>

                <li class="navbar-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false" id="accounts" aria-haspopup="true"> RACHUNKI </a>
                        <div class="dropdown-menu" aria-labelledby="accounts">
                            <a class="dropdown-item" href="rzero.php" style="border-bottom: 1px solid rgba(212, 199, 199, 0.863);">Konto Za Zero</a>
                            <a class="dropdown-item" href="roszcz.php">Konto Oszczędnościowe</a>
                        </div>
                </li>
                    
                <li class="navbar-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false" id="savings" aria-haspopup="true"> OSZCZĘDNOŚCI </a>
                        <div class="dropdown-menu" aria-labelledby="savings">
                            <a class="dropdown-item" href="oszczednosci.php">Produkty</a>
                        </div>                
                </li>

                <li class="navbar-item ">
                    <a class="nav-link" href="#">KARTY</a>
                </li>

            </ul>
        </div> 
    </nav>

    <main>

    <div class='row justify-content-center'>
        <button class='dodaj' type="button" data-toggle="modal" data-target="#exampleModal"><div class='col-2 choise1'>Dodaj<br>Produkt</div></button>
        <button class='przelej' type="button" data-toggle="modal" data-target="#exampleModal1"><div class='col--2  choise1'>Przelej<br>środki</div></button>
        <button class='usun' type="button" data-toggle="modal" data-target="#exampleModal2"><div class=' col-2  choise1'>Usuń<br>produkt</div></button>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content okienko col-12">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dodaj produkt</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form action="oszcz.php" method="POST"> 
                <div class='row my-2'>
                    <div class="col-4 p1" id="in">Nazwa Produktu</div><div class="col-7" id="in"><input class='col-12 p2' type="text" name="Produkt">  </div> 
                </div>
                <div class='row my-2'>
                    <div class="col-4 p1" id="in">Kwota</div><div class="col-7" id="in"><input class='col-12  p2' type="text" name="Cel"></div>
                </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                <button type="submit" class="btn btn-primary">Zatwierdź</button>
                </form>
                </div>
            </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content okienko col-12">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Przelej</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form action="oszcz.php" method="POST"> 
                <div class='row my-2'>
                    <div class="col-3 p1" id="in">Z konta</div><div class="col-8" id="in">
                    <select class='col-12 p2'  name='ktore'>
                        <option value="<?php echo $_SESSION['znrkonta']; ?>"> <?php echo $_SESSION['saldo1']; ?> zł K. Za Zero </option>
                        <option value="<?php echo $_SESSION['onrkonta']; ?>"> <?php echo $_SESSION['saldo2']; ?> zł K. Oszczędnościowe</option>
                    </select>
                    </div> 
                </div>
                <div class='row my-2'>
                    <div class="col-3 p1" id="in">Kwota</div><div class="col-8" id="in"><input class='col-12  p2' type="text" name="ile"></div>
                </div>
                <div class='row my-2'>
                    <div class="col-3 p1" id="in">Produkt</div>
                    <div class="col-8" id="in">
                        <select class='col-12 p2' type="text" name="co">   
                                <?php   
                                    if ($polaczenie->connect_errno!=0)             
                                    {
                                        echo "Error: ".$polaczenie->connect_errno;     
                                    }
                                    else
                                    { 
                                        $log = $_SESSION['lo'];
                                        if ($oszczednosci = $polaczenie->query("SELECT * FROM oszczednosci WHERE NumerID='$log'" ))
                                        {
                                            $osz = $oszczednosci->num_rows;
                                            for($i=0; $i<$osz; $i++)
                                            {
                                                $prod = mysqli_fetch_assoc($oszczednosci);
                                                echo '<option>'.$prod['Produkt'].'</option>';
                                            }
                                        }
                                    }
                                ?>
                        </select>
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                <button type="submit" class="btn btn-primary">Zatwierdź</button>
                </form>
                </div>
            </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content okienko col-12">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Usuń produkt</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form action="oszcz.php" method="POST"> 
                <div class='row my-2'>
                    <div class="col-3 p1" id="in">Produkt</div>
                    <div class="col-8" id="in">
                        <select class='col-12 p2' type="text" name="usun">   
                                <?php   
                                    if ($polaczenie->connect_errno!=0)             
                                    {
                                        echo "Error: ".$polaczenie->connect_errno;     
                                    }
                                    else
                                    { 
                                        $log = $_SESSION['lo'];
                                        if ($oszczednosci = $polaczenie->query("SELECT * FROM oszczednosci WHERE NumerID='$log'" ))
                                        {
                                            $osz = $oszczednosci->num_rows;
                                            for($i=0; $i<$osz; $i++)
                                            {
                                                $prod = mysqli_fetch_assoc($oszczednosci);
                                                echo '<option>'.$prod['Produkt'].'</option>';
                                            }
                                        }
                                    }
                                ?>
                        </select>
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                <button type="submit" class="btn btn-primary">Zatwierdź</button>
                </form>
                </div>
            </div>
            </div>
        </div>




    <?php

        if ($polaczenie->connect_errno!=0)             
    {
        echo "Error: ".$polaczenie->connect_errno;     
    }
    else
    { 
        $log = $_SESSION['lo'];
        if($oszczednosci = $polaczenie->query("SELECT * FROM oszczednosci WHERE NumerID='$log'" ))
            {
                $osz = $oszczednosci->num_rows;
                    for($i=0; $i<$osz; $i++)
                    {
                        $prod = mysqli_fetch_assoc($oszczednosci);
                        $cel = (double) $prod['Cel'];
                        $zebrano = (double) $prod['Kwota'];
                        
                    echo '<div class="row justify-content-center my-1">';
                        echo '<div class="col-md-4 col-sm-5 prod1">'.'<div class="choise">'.$prod['Produkt'].'</div>'.'</div>';
                        echo '<div class="col-md-4 col-sm-5 prod2">'.'<div class="choise">';
                            echo '<div>'.'<span class=kasa>'.'Uzbierano: '.'</span>'.'<span class=ilosc>'.$prod['Kwota'].' zł'.'</span>'.'</div>';
                            echo '<div>'.'<span class=kasa>'.'Cel: '.'</span>'.'<span class=ilosc>'.$prod['Cel'].' zł'.'</span>'.'</div>';
                            echo '<div>'.'<span class=kasa>'.'Pozostało: '.'</span>'.'<span class=ilosc>'.($cel-$zebrano).' zł'.'</span>'.'</div>';
                        echo '</div>'.'</div>';
                    echo '</div>';

                    
                    }
                $oszczednosci->close();
                }
        }
    ?>

    <div class='row justify-content-center'>
    <div class='col-5 komunikat'><?php 
    if(isset($_SESSION['p_blad'])) echo "<span class='komunikat1'>".$_SESSION['p_blad']."<span>"; unset($_SESSION['p_blad']);
    if(isset($_SESSION['error'])) echo "<span class='komunikat2'>".$_SESSION['error']."<span>"; unset($_SESSION['error']);
    ?> </div>
    </div>


    </main>

    <aside>
    <div class="row mt-4">
        <div class="col-6" id="re">
            <figure>
                <a href="#""><img class="reklama" src="bank reklama.JPG" alt="reklama"/></a>
            </figure>           
        </div>

        <div class="col-6 doreklamy my-auto ">
            Czym się różni paczka makaronu od nowego kredytu Na Start? 
                </br>
            Kredyt Na Start można łatwo zdobyć ! 
        </div>
    </div>


    <div class="row">
        <div class="col-12 RRSO">   
            Do 30 000 zł na Twoim koncie nawet dziś. Wystarczy wypełnić wniosek i podpisać umowę - wszystko załatwisz online.
            RRSO Rzeczywista Stopa Oprocentowanie dla reprezentatywnego przykładu. Kredyt Na Start skierowany jest do osób,
            które nie zaciągnęły pożyczki gotówkowej/kredytu gotówkowego w SafeBanku. Udzielenie Kredytu Na Start dla zdecydowanych jest uzależnione
            od pozytywnej oceny zdolności kredytowej. Propozycje na podobnych warunkach mogą wystąpić w przyszłości.
        </div>
    </div>
    </aside>
    
    <div class="row">
        <div class="footer mx-auto">
            &copy; SAFE Bank &nbsp;&nbsp;&nbsp;
            <i class="icon-mail-alt"></i>dok@safebank.pl &nbsp;&nbsp;&nbsp;
            <i class="icon-mobile"></i>61 005 21 55  &nbsp;&nbsp;&nbsp;
            <i class="icon-phone"></i> 450 004 009 &nbsp;&nbsp;&nbsp;
        </div>
    </div>
</div>
    



    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" ></script>
    
</body>
</html>