<?php
    session_start();                //inicjalizacja sesji globalnej przechowującej zmienne

    if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))     //instrukcja utrzymania zalogowania, jeżeli zmienna zalogowany istnieje i jest true to
        {
            header('location: start.php');      //przenosi na stronę startową i
            exit();                             // przerywa działanie kodu, w przeciwnym razie wykonuje pozostałe linie
        }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="description" content="Nowoczesna bankowo�� w najlepszym wydaniu. Szybko, prosto i skutecznie. Nie tra� czasu na stanie w kolejkach!">
    <meta name="keywords" content="dobry bank, szybki bank, nowoczesny bank, nowoczesna bankowo��"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>SafeBank - nowoczesna bankowość</title>
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="form.css" type="text/css"/>
    <link rel="stylesheet" href="reje.css" type="text/css"/>
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <link rel="stylesheet" href="fontello/css/fontello.css" type="text/css"/>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script>
    function oszcz()
{
    var i = Math.random();
    var a = (i + 9)*10000000000000000000000000;
    var z = BigInt(a);
    document.getElementById('ko').value = z;
}


function zero()
{
    var i = Math.random();
    var a = (i + 2)*10000000000000000000000000;
    var z = BigInt(a);
    document.getElementById('zo').value = z;
}

function klient()
{
    var i = Math.random();
    var a; 
    a = Math.round((i * 100000000));
    var x = BigInt(a);
    document.getElementById('nk').value = x;
}
</script>





</head>
<body>
    <div  class='container col-lg-9 col-sm-11'>

            <div class='row'>
            <div class="col-1 znak">
            <figure>
                <a href="index.php""><img class="znak" src="safebank logo.jpg" alt="logo"/></a>
                <figcaption class="text-center tekst">SafeBank</figcaption>
            </figure>           
        </div>
                <div class='col-lg-8 col-sm-9 naglowek'>Rejestracja nowego klienta SafeBank<br><?php if(isset($_SESSION['blad'])) echo '<span class="err">'.$_SESSION['blad'].'</span>'; unset($_SESSION['blad']); ?></div>
            </div>

      

        <form action="rejestracja.php" method="POST">
            <div class='row'>
            <div class='col-lg-5 col-sm-12 rejestracja'>
                <div class='row'>
                    <div class='col-5 l'>Imię</div><div class='col-5'><input type="text" value="<?php if(isset($_SESSION['imie'])) echo $_SESSION['imie']; unset($_SESSION['imie']); ?>" placeholder="Imię" name="imie"></div>
                </div>
                <div class='row'>
                    <div class='col-5 l'>Nazwisko</div><div class='col-5'><input type="text" value="<?php if(isset($_SESSION['nazwisko'])) echo $_SESSION['nazwisko']; unset($_SESSION['nazwisko']); ?>" placeholder="Nazwisko" name="nazwisko"></div>
                </div>
                <div class='row'>
                    <div class='col-5 l'>PESEL</div><div class='col-5'><input type="text" value="<?php if(isset($_SESSION['pesel'])) echo $_SESSION['pesel']; unset($_SESSION['pesel']); ?>" placeholder="PESEL" maxlength='11' name="pesel"></div> 
                </div>
                <div class='row'>
                    <div class='col-5 l'>Seria i numer dowodu</div><div class='col-5'><input type="text" value="<?php if(isset($_SESSION['nrdowodu'])) echo $_SESSION['nrdowodu']; unset($_SESSION['nrdowodu']); ?>" placeholder="Seria i numer dowodu" name="nrdowodu"></div>
                </div>
                <div class='row'>
                    <div class='col-5 l'>Data ważności dowodu</div><div class='col-5'><input type="date" value="<?php if(isset($_SESSION['datadowodu'])) echo $_SESSION['datadowodu']; unset($_SESSION['datadowodu']); ?>" min="<?php echo date('Y-m-d'); ?>" placeholder="Data ważności dowodu" name="datadowodu"></div>  
                </div>
                <div class='row'>
                    <div class='col-5 l'>Ulica i numer zamieszkania</div><div class='col-5'><input type="text" value="<?php if(isset($_SESSION['ulica'])) echo $_SESSION['ulica']; unset($_SESSION['ulica']); ?>" placeholder="Ulica i numer zamieszkania" name="ulica"></div>  
                </div>
                <div class='row'>
                    <div class='col-5 l'>Kod pocztowy</div><div class='col-5'><input type="text" value="<?php if(isset($_SESSION['kod'])) echo $_SESSION['kod']; unset($_SESSION['kod']); ?>" placeholder="Kod pocztowy" name="kod"></div>  
                </div>
                <div class='row'>
                    <div class='col-5 l'>Miejscowość</div><div class='col-5'><input type="text" value="<?php if(isset($_SESSION['miejscowosc'])) echo $_SESSION['miejscowosc']; unset($_SESSION['miejscowosc']); ?>" placeholder="Miejscowość" name="miejscowosc"></div>  
                </div>
            </div>

            <div class='col-lg-5 col-sm-12 rejestracja'>
                <div class='row'>
                    <div class='col-5 l'>E-mail</div><div class='col-5'><input type="text" value="<?php if(isset($_SESSION['mail'])) echo $_SESSION['mail']; unset($_SESSION['mail']); ?>" placeholder="Adres e-mail" name="mail"></div>  
                </div>
                <div class='row'>
                    <div class='col-5 l'>Telefon</div><div class='col-5'><input type="text" value="<?php if(isset($_SESSION['telefon'])) echo $_SESSION['telefon']; unset($_SESSION['telefon']); ?>" placeholder="Telefon" name="telefon"></div>  
                </div>
                <div class='row'>
                    <div class='col-5 l'>Kraj pochodzenia</div><div class='col-5'><input type="text" value="<?php if(isset($_SESSION['kraj'])) echo $_SESSION['kraj']; unset($_SESSION['kraj']); ?>" placeholder="Kraj" name="kraj"></div>  
                </div>
                <div class='row'>
                    <div class='col-5 l'>Nr k. Oszczędnościowego</div><div class='col-5'><input id='ko' type="text" value="<?php if(isset($_SESSION['okonto'])) echo $_SESSION['okonto']; unset($_SESSION['okonto']); ?>" placeholder="Numer konta oszczędnościowego" name="okonto"></div>  
                </div>
                <div class='row'>
                    <div class='col-5 l'>Nr k. Za Zero</div><div class='col-5'><input id='zo' type="text" value="<?php if(isset($_SESSION['zkonto'])) echo $_SESSION['zkonto']; unset($_SESSION['zkonto']); ?>" placeholder="Numer konta za zero" name="zkonto"></div> 
                </div>
                <div class='row'>
                    <div class='col-5 l'>Numer klienta</div><div class='col-5'><input id='nk' type="text" value="<?php if(isset($_SESSION['numerid'])) echo $_SESSION['numerid']; unset($_SESSION['numerid']); ?>" placeholder="Numer Klienta" name="numerid"></div> 
                </div>
                <div class='row'>
                    <div class='col-5 l'>Podaj hasło</div><div class='col-5'><input type="password" placeholder="Wprowadź hasło" name="pass1"></div>  
                </div>
                <div class='row'>
                    <div class='col-5 l'>Powtórz hasło</div><div class='col-5'><input type="password" placeholder="Powtórz hasło" name="pass2"></div>  
                </div>
            </div>
            </div>

            <div class='row'>
                <div class='col-lg-8 col-sm-11 regulaminy'>
                    <fieldset> 
                        <div class='row'>         
                            <div class='r1 col-lg-7 col-sm-6'><label><input type='checkbox' name='regulamin'> Akceptuje regulamin SafeBank</label></div><div class='col-lg-5 col-sm-6 r1'><a href='#' onclick='oszcz()'>Generuj Numer Konta Oszczędnościowego</a></div>  
                        </div>
                        <div class='row'>  
                            <div class='r1 col-lg-7 col-sm-6'><label><input type='checkbox' name='prawda'> Oświadczam, że podane dane są prawdziwe</label></div><div class='col-lg-5 col-sm-6 r1'><a href='#' onclick='zero()'>Generuj Numer Konta Za Zero</a></div>
                        </div>
                        <div class='row'>  
                            <div class='r1 col-lg-7 col-sm-6'><label><input type='checkbox'> Wyrażam zgodę na marketing elektroniczny</label></div><div class='col-lg-5 col-sm-6 r1'><a href='#' onclick='klient()'>Generuj Numer Klienta</a></div>
                        </div>    
                    </fieldset>
                </div>
            </div>

            <div class='row justify-content-center'>
                <div class='przycisk col-2 '><input type="submit" value="Zarejestruj się"></div> 
            </div>
        </form>


    <div class="row my-3">
        <div class="footer mx-auto">
            &copy; SAFE Bank &nbsp;&nbsp;&nbsp;
            <i class="icon-mail-alt"></i>dok@safebank.pl &nbsp;&nbsp;&nbsp;
            <i class="icon-mobile"></i>61 005 21 55  &nbsp;&nbsp;&nbsp;
            <i class="icon-phone"></i> 450 004 009 &nbsp;&nbsp;&nbsp;
        </div>
    </div>
</div>
    






        
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" ></script>
</body>
</html>