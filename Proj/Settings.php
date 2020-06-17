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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href ="style.css" type="text/css"/>
    <link rel="stylesheet" href ="set.css" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Alata|Lato&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Baloo+2|Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fontello/css/fontello.css" type="text/css"/>
    <script src="edycja.js"></script>

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
        <!--Dane podstawowe -->
        <div class="row">
            <div class="col-lg-5 offset-1 col-sm-12 mx-auto my-3" id="dane">
                <h4>Dane podstawowe</h4>
                <div class='dp1 col-6'>Numer Klienta:</div><div class='dp col-6'> <?php echo $_SESSION['numer']; ?> </div> <div class='cl'></div>
                <div class='dp1 col-6'>Imię i nazwisko:</div><div class='dp col-6'> <?php echo $_SESSION['imie']." ".$_SESSION['nazwisko']; ?> </div> <div class='cl'></div>
                <div class='dp1 col-6'>PESEL:</div><div class='dp col-6'> <?php echo $_SESSION['dPesel'];  ?> </div> <div class='cl'></div>
                <div class='dp1 col-6'>Adres Zamieszkania:</div><div class='dp col-6'> <?php echo $_SESSION['dUlica']."</br>".$_SESSION['dkod']." ".$_SESSION['dmiejscowosc']."</br>".$_SESSION['dkraj']; ?>  </div> <div class='cl'></div>
                <div class='dp3 col-6'>
                    <?php 
                    if(isset($_SESSION['e_ulica']))  echo "<span class='blad'>".($_SESSION["e_ulica"])."</span>"; unset($_SESSION['e_ulica']); 
                    if(isset($_SESSION['daneok']))  echo "<span class='ok'>".($_SESSION["daneok"])."</span>"; unset($_SESSION['daneok']); 
                    ?>
                </div>
                <div class='a col-6'><button class="b" type="button" data-toggle="modal" data-target="#exampleModal1">Zmień dane</button></div><div class='cl'></div>
            </div>
        
            <!--Numer telefonu -->
            <div class="col-lg-5 col-sm-12 mx-auto my-3" id="dane">
                <div>
                    <h4>Numery telefonów</h4>
                    <div class='dp1 col-6'>Numer telefonu: </div><div class='dp col-6'> <?php echo $_SESSION['dtel']; ?> </div><div class='cl'></div>
                    <div class='col-6 dp3'> 
                      <?php if(isset($_SESSION['e_dtel']))  echo "<span class='blad'>".($_SESSION["e_dtel"])."</span>"; unset($_SESSION['e_dtel']); 
                            if(isset($_SESSION['ok']))  echo "<span class='ok'>".($_SESSION["ok"])."</span>"; unset($_SESSION['ok']);                       
                      ?>
                    </div>                                                      
                    <div class='a col-6'><button class="b"  type="button" data-toggle="modal" data-target="#exampleModal3">Zmień numer</button></div><div class='cl'></div>
                </div>
            
              <!--Adres e-mail -->
                <div>
                    <h4>Adres e-mail</h4>
                    <div class='dp1 col-6'>Adres e-mail: </div><div class='dp col-6'> <?php echo $_SESSION['dmail']; ?> </div><div class='cl'></div>
                    <div class='col-6 dp3' > 
                      <?php if(isset($_SESSION['e_dmail']))  echo ($_SESSION['e_dmail']); unset($_SESSION['e_dmail']);
                      if(isset($_SESSION['mok']))  echo "<span class='ok'>".($_SESSION['mok'])."</span>"; unset($_SESSION['mok']); 
                      ?>
                    </div>
                    <div class='a col-6'> <button class="b" type="button" data-toggle="modal" data-target="#exampleModal4">Zmień e-mail</button></div><div class='cl'></div>
                </div>
            </div>
        </div>

        <!--Dokument tożsamości -->
        <div class="row">
            <div class="col-lg-5 offset-1 col-sm-12 mx-auto my-3" id="dane">
                <h4>Dokument tożsamości</h4>
                <div class='dp1 col-6'>Typ dokumentu:</div><div class='dp col-6'> Dowód osobisty </div>
                <div class='dp1 col-6'>Seria i numer dokumentu:</div><div class='dp col-6'> <?php echo $_SESSION['numerd']; ?> </div> <div class='cl'></div>
                <div class='dp1 col-6'>Data ważności dokumentu:</div><div class='dp col-6'> <?php echo $_SESSION['dataw']; ?> </div><div class='cl'></div>
                <div class='col-6 dp3'>
                <?php if(isset($_SESSION['e_dowod']))  echo "<span class='blad'>".($_SESSION["e_dowod"])."</span>"; unset($_SESSION['e_dowod']);
                 if(isset($_SESSION['dowodok']))  echo "<span class='ok'>".($_SESSION['dowodok'])."</span>"; unset($_SESSION['dowodok']); ?>
                </div>
                <div class='a col-6'> <button class="b" type="button" data-toggle="modal" data-target="#exampleModal2">Zmień dane</button></div><div class='cl'></div>
            </div>
        
        <!--Adres Korespondencyjny-->    
            <div class="col-lg-5 col-sm-12 mx-auto my-3" id="dane"> 
                    <h4>Adres korespondencyjny</h4>
                    <div class='dp1 col-6'>Adres korespondencyjny: </div><div class='dp col-6'> <?php echo $_SESSION['imie']." ".$_SESSION['nazwisko']."<br/>".$_SESSION['kulica']."<br/>".$_SESSION['kkod']." ".$_SESSION['kmiejs']."<br/>".$_SESSION['kkraj']; ?></div><div class='cl'></div>
                    <div class='col-6 dp3'>
                      <?php
                          if(isset($_SESSION['e_kor']))  echo "<span class='blad'>".($_SESSION["e_kor"])."</span>"; unset($_SESSION['e_kor']);
                          if(isset($_SESSION['korok']))  echo "<span class='ok'>".($_SESSION['korok'])."</span>"; unset($_SESSION['korok']);
                      ?>
                      </div>
                    <div class='a col-6'><button class="b"  type="button" data-toggle="modal" data-target="#exampleModal">Zmień dane</button></div><div class='cl'></div>
            </div>
        </div>

        <!--Informacje o RODO -->
          <div class="row">
            <div class="col-12" id="rodo">
            <h5 style="font-weight:700">RODO</h5>
            <p>Na podstawie Rozporządzenia Parlamentu Europejskiego i Rady (UE) 2016/679 z dnia 27 kwietnia 2016 r. w sprawie ochrony osób fizycznych 
            w związku z przetwarzaniem danych osobowych i w sprawie swobodnego przepływu takich danych oraz uchylenia dyrektywy 95/46/WE,
            zwanego dalej „Rozporządzeniem”, informujemy, że:</p>
            <h5 style="font-weight:700">Administrator danych:</h5>
            <p>Pani/Pana danych osobowych jest SAFE Bank z siedzibą w Poznaniu, adres: ul. Milionerów 777, 60-000 Poznań, 
            zarejestrowana w Sądzie Rejonowym dla miasta Poznań w Poznaniu, LIII Wydział Gospodarczy Krajowego Rejestru Sądowego, pod numerem KRS 01100026438, 
            NIP: 777-777-77-77, REGON: 777777777, kapitał zakładowy (kapitał wpłacony) 5 865 666 000 zł, infolinia: 450 004 009.</p>
            <div id="reg"><a class="b" href="Regulamin Rodo.pdf" download="Regulamin Rodo.pdf"> Pobierz cały regulamin</a></div>
            </div>
          </div>

    </main>

    <!--Dane korespondencyjne  -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content okno col-12">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Adres korespondencyjny</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="edit.php" method="POST">                
              <div class="dp1 col-5" id="in">Imię</div><div class="dp col-5" id="in"> <input type="text" value="<?php echo $_SESSION['imie']; ?>" disabled name="imie">  </div>    <div class="cl"></div>
              <div class="dp1 col-5" id="in">Nazwisko</div><div class="dp col-5" id="in"><input type="text" value="<?php echo $_SESSION['nazwisko']; ?>" disabled name="nazwisko"></div><div class="cl"></div>
              <div class="dp1 col-5" id="in">Ulica</div><div class="dp col-5" id="in"><input type="text" value="<?php echo $_SESSION['kulica']; ?>" name="ulica"></div><div class="cl"></div>
              <div class="dp1 col-5" id="in">Kod Pocztowy</div><div class="dp col-5" id="in"><input type="text" value="<?php echo $_SESSION['kkod']; ?>" name="kodpocztowy"></div ><div class="cl"></div> 
              <div class="dp1 col-5" id="in">Miejscowośc</div><div class="dp col-5" id="in"><input type="text" value="<?php echo $_SESSION['kmiejs']; ?>" name="miejscowosc"></div><div class="cl"></div> 
              <div class="dp1 col-5" id="in">Kraj</div><div class="dp col-5" id="in"><input type="text" value="<?php echo $_SESSION['kkraj']; ?>" name="kraj"></div><div class="cl"></div>     
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
              <button type="submit" class="btn btn-primary">Zatwierdź</button>
            </form>
            </div>
          </div>
        </div>
      </div>

      <!--Dane podstawowe -->
      <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content okno col-12">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Dane podstawowe</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="edit1.php" method="POST">                
              <div class="dp1 col-5" id="in">Imię</div><div class="dp col-5" id="in"> <input type="text" value="<?php echo $_SESSION['imie']; ?>" disabled name="imie">  </div>    <div class="cl"></div>
              <div class="dp1 col-5" id="in">Nazwisko</div><div class="dp col-5" id="in"><input type="text" value="<?php echo $_SESSION['nazwisko']; ?>" disabled name="nazwisko"></div><div class="cl"></div>
              <div class="dp1 col-5" id="in">PESEL</div><div class="dp col-5" id="in"><input type="text" value="<?php echo $_SESSION['dPesel']; ?>" disabled name="dPESEL"></div ><div class="cl"></div> 
              
              <div class="dp1 col-5" id="in">Ulica</div><div class="dp col-5" id="in"><input type="text" value="<?php echo $_SESSION['dUlica']; ?>" name="dulica"></div><div class="cl"></div>
              <div class="dp1 col-5" id="in">Kod Pocztowy</div><div class="dp col-5" id="in"><input type="text" value="<?php echo $_SESSION['dkod']; ?>" name="dkodpocztowy"></div ><div class="cl"></div> 
              <div class="dp1 col-5" id="in">Miejscowośc</div><div class="dp col-5" id="in"><input type="text" value="<?php echo $_SESSION['dmiejscowosc']; ?>" name="dmiejscowosc"></div><div class="cl"></div> 
              <div class="dp1 col-5" id="in">Kraj</div><div class="dp col-5" id="in"><input type="text" value="<?php echo $_SESSION['dkraj']; ?>" name="dkraj"></div><div class="cl"></div>     
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
              <button type="submit" class="btn btn-primary">Zatwierdź</button>
            </form>
            </div>
          </div>
        </div>
      </div>

      <!--Dokument Tożsamości -->
      <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content okno col-12">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Dokument tożsamości</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="edit2.php" method="POST">                
              <div class="dp1 col-5" id="in">Rodzaj Dokumentu</div><div class="dp col-5" id="in"> <input type="text" value="Dowód Osobisty" disabled name="imie">  </div>    <div class="cl"></div>
              <div class="dp1 col-5" id="in">Seria i numer</div><div class="dp col-5" id="in"><input type="text" value="<?php echo $_SESSION['numerd'];  ?>"  name="numerd"></div><div class="cl"></div>
              <div class="dp1 col-5" id="in">Data ważności</div><div class="dp col-5" id="in"><input class='data' type="date" value="<?php echo $_SESSION['dataw'];  ?>" name="dataw"></div ><div class="cl"></div> 
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
              <button type="submit" class="btn btn-primary">Zatwierdź</button>
            </form>
            </div>
          </div>
        </div>
      </div>


      <!--Numer telefonu -->
      <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content okno col-12">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Numer Telefonu</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="edit3.php" method="POST">                
              <div class="dp1 col-5" id="in">Numer telefonu</div><div class="dp col-5"> <input type="text" value="<?php echo $_SESSION['dtel']; ?>" name="dtel">  </div><div class="cl"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
              <button type="submit" class="btn btn-primary">Zatwierdź</button>
            </form>
            </div>
          </div>
        </div>
      </div>


      <!--Adres e-mail -->
      <div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content okno col-12">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Adres e-mail</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="edit4.php" method="POST">                
              <div class="dp1 col-5" id="in">Adres e-mail</div><div class="dp col-5" id="in"> <input type="email" value="<?php echo $_SESSION['dmail']; ?>" id="wer" name="dmail" >  </div><div class="cl"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
              <button type="submit" class="btn btn-primary">Zatwierdź</button>
              
            </form>
            
            </div>
        
          </div>
        </div>
      </div>
      



    </aside>
    <div class="row">
        <div class="footer mx-auto foot">
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