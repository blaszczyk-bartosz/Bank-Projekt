<?php
session_start();                        //deklaracja tablicy globalnej przechowującej zmienne

if (!isset($_SESSION['zalogowany']))    //instrukcja utrzymania zalogowania(jeżeli nie istnieje zalogowanie)
{
    header('location: index.php');      //przenosi na stronę główną, logownia
    exit();                             //przerywa natychmiastowo działanie kodu, by dalej nie interpretowało
}

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
    <link rel="stylesheet" href ="przel.css" type="text/css"/>
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

    <div class='col-12'>
    <main>
        <div class='row justify-content-center'>
            <div class='col-lg-3 col-sm-4 wybor1'> <h2 class='srodek'><a class='link' href='kraj.php'>KRAJOWY</a></h2></div>
            <div class='col-lg-1 col-sm-1'></div>
            <div class='col-lg-3 col-sm-4 wybor2'> <h2 class='srodek'><a class='link' href='wlasny.php'>WŁASNY</a></h2></div>
        </div>

        <form action="przelk.php" method="post">
        <div class='row '>
            <div class='col-2 d1 rn'> <p class='middle'>Z Konta</p></div>
            <div class='col-lg-8 d col-sm-12'>
                <select class='col-12 ' id='konto' name='konto'>
                    <option  value="<?php echo $_SESSION['znrkonta']; ?>"><?php echo $_SESSION['znrkonta']; ?>&nbsp;&nbsp;&nbsp;&nbsp; Konto Za Zero (<?php echo $_SESSION['saldo1']; ?>)</option>
                    <option  value="<?php echo $_SESSION['onrkonta']; ?>"><?php echo $_SESSION['onrkonta']; ?>&nbsp;&nbsp;&nbsp;&nbsp; Konto Oszczędnościowe (<?php echo $_SESSION['saldo2']; ?>)</option>
                <select>
            </div>

        </div>

        
        <div class='row '>
            <div class='col-2 d1 rn'><p class='middle'>Odbiorca</p></div>
            <div class='col-lg-8 d col-sm-12'><input class='wpis col-lg-9 col-sm-12' type='text' placeholder='Odbiorca'  name='odbiorcak'></div>
        </div>

        <div class='row'>
            <div class='col-2 d1 rn'><p class='middle'>Numer Konta</p></div>
            <div class='col-lg-8 d col-sm-12'><input class='wpis col-lg-9 col-sm-12' type='text' placeholder='Numer konta odbiorcy' maxlength='26' name='numerk'></div>
        </div>

        <div class='row'>
            <div class='col-2 d1 rn'><p class='middle'>Tytuł</p></div>
            <div class='col-lg-8 d col-sm-12'><input class='wpis col-lg-9 col-sm-12' type='text' placeholder='Tytuł' name='tytulk'></div>
        </div>

        <div class='row'>
            <div class='col-2 d1 rn'><p class='middle'>Kwota</p></div>
            <div class='col-lg-8 d col-sm-12'>
                <input class='wpis col-lg-5 col-sm-5' type='text' placeholder='Kwota' name='ilek'>
            </div>
        </div>

        <div class='row'>
            <div class='col-2 d1 rn'><p class='middle'>Data Przelewu</p></div>
            <div class='col-lg-8 d col-sm-12'>
                <input class='wpis col-lg-5 col-sm-5' type='date' name='datak'>
            </div>
        </div>

        <div class='row'>
            <div class='info col-7'> 
            <?php 
            if(isset($_SESSION['k_error'])) echo "<span class='niepowodzenie'>".$_SESSION['k_error']."<span>"; unset($_SESSION['k_error']);
            if(isset($_SESSION['k_ok'])) echo "<span class='powodzenie'>".$_SESSION['k_ok']."<span>"; unset($_SESSION['k_ok']);
            ?> 
            </div><div class='sub col-5'><button type='submit' class='wyslij'>Wyślij</div><div class='cl'></div>
            </div>       
         </form>
    </main>

    </div>






















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