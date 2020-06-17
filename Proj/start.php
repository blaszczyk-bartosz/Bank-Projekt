<?php
session_start();                        //deklaracja tablicy globalnej przechowującej zmienne

if (!isset($_SESSION['zalogowany']))    //instrukcja utrzymania zalogowania(jeżeli nie istnieje zalogowanie)
{
    header('location: index.php');      //przenosi na stronę główną, logownia
    exit();                             //przerywa natychmiastowo działanie kodu, by dalej nie interpretowało
}

require_once 'connect.php';
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name); 

if ($polaczenie->connect_errno!=0)             
{
    echo "Error: ".$polaczenie->connect_errno;     
}
else
{ 
    $onr = $_SESSION['onrkonta'];
    $znr = $_SESSION['znrkonta'];
    if($story = $polaczenie->query("SELECT * FROM historia WHERE NrKonta='$znr' OR NrKonta='$onr' 
    ORDER BY 2 DESC LIMIT 7" ))
        {
            $st = $story->num_rows;
                for($i=0; $i<$st; $i++)
                {
                $historia = mysqli_fetch_assoc($story);
                $k[$i] = $historia['Kwota'];    
                $d[$i] = $historia['Data'];
                $o[$i] = $historia['Odbiorca'];
                $n[$i] = $historia['Nadawca'];
                }
            $story->close();
            }

        
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
    <div class="row mt-3 ">
        <div class="col-lg-4 offset-1 balance my-auto col-sm-12 mx-auto ">
            <h1>Safe Konto</h1>
            <h2>Konto Za Zero</h2>
            <h3><span class="count"> <?php echo $_SESSION['znrkonta']; ?> </span></h3>    
            <h4><span class="number">Dostępne środki:</span> <?php echo $_SESSION['saldo1']; ?> </h4>
            <h3><span class="count">Inne konta:</span></h3> 
            <h6>Konto Oszczędnościowe <p> <?php echo $_SESSION['onrkonta']; ?> </p></h6>
            <h4><span class="number">Dostępne środki:</span> <?php echo $_SESSION['saldo2']; ?> </h4>
        </div>

        <div class="col-lg-5 offset-1 story col-sm-12 mx-auto mt-3 story">
        <table class="table">
  <thead>
    <tr>
      <th>#</th>
      <th>Data</th>
      <th>Nazwa nadawcy/odbiorcy</th>
      <th>Kwota</th>
    </tr>
  </thead>
  <tbody>
  <tr>
      <th scope="row">1</th>
      <td><?php if(isset($d[0])) echo $d[0]; else echo ''; ?></td>
      <td><?php if(isset($o[0]) && $k[0]<0) echo 'O: '.$o[0]; if(isset($o[0]) && $k[0]>0) echo 'N: '.$n[0]; else echo '';?></td>
      <td><?php if(isset($k[0])) echo $k[0]; else echo ''; ?></td>    
    </tr>
    <tr>
      <th scope="row">2</th>
      <td><?php if(isset($d[1])) echo $d[1]; else echo ''; ?></td>
      <td><?php if(isset($o[1]) && $k[1]<0) echo 'O: '.$o[1]; if(isset($o[1]) && $k[1]>0) echo 'N: '.$n[1]; else echo '';?></td>
      <td><?php if(isset($k[1])) echo $k[1]; else echo ''; ?></td> 
    </tr>
    <tr>
      <th scope="row">3</th>
      <td><?php if(isset($d[2])) echo $d[2]; else echo ''; ?></td>
      <td><?php if(isset($o[2]) && $k[2]<0) echo 'O: '.$o[2]; if(isset($o[2]) && $k[2]>0) echo 'N: '.$n[2]; else echo '';?></td>
      <td><?php if(isset($k[2])) echo $k[2]; else echo ''; ?></td> 
    </tr>
    <tr>
      <th scope="row">4</th>
      <td><?php if(isset($d[3])) echo $d[3]; else echo '';?></td>
      <td><?php if(isset($o[3]) && $k[3]<0) echo 'O: '.$o[3]; if(isset($o[3]) && $k[3]>0) echo 'N: '.$n[3]; else echo '';?></td>
      <td><?php if(isset($k[3])) echo $k[3]; else echo '';?></td> 
    </tr>
    <tr>
      <th scope="row">5</th>
      <td><?php if(isset($d[4])) echo $d[4]; else echo ''; ?></td>
      <td><?php if(isset($o[4]) && $k[4]<0) echo 'O: '.$o[4]; if(isset($o[4]) && $k[4]>0) echo 'N: '.$n[4]; else echo '';?></td>
      <td><?php if(isset($k[4])) echo $k[4]; else echo ''; ?></td> 
    </tr>
    <tr>
      <th scope="row">6</th>
      <td><?php if(isset($d[5])) echo $d[5]; else echo ''; ?></td>
      <td><?php if(isset($o[5]) && $k[5]<0) echo 'O: '.$o[5]; if(isset($o[5]) && $k[5]>0) echo 'N: '.$n[5]; else echo '';?></td>
      <td><?php if(isset($k[5])) echo $k[5]; else echo ''; ?></td> 
    </tr>
    <tr>
      <th scope="row">7</th>
      <td><?php if(isset($d[6])) echo $d[6]; else echo ''; ?></td>
      <td><?php if(isset($o[6]) && $k[6]<0) echo 'O: '.$o[6]; if(isset($o[6]) && $k[6]>0) echo 'N: '.$n[6]; else echo '';?></td>
      <td><?php if(isset($k[6])) echo $k[6]; else echo ''; ?></td> 
    </tr>
  </tbody>
</table>
        </div>
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