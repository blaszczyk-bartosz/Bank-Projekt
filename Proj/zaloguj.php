<?php

    session_start();                    //inicjalizuje tablice globalną
    require_once "connect.php";         //połączeznie z bazą
    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);  //otwarcie polaczenia z baza danych w nawiasie zmienne z pliku który łączy z bazą

    if((!isset ($_POST['user'])) || (!isset ($_POST['pass'])))      //przekierowanie na stronę startową przy bezpośredniej próbie wejścia do pliku
            {
                header('location: index.php');
                exit();
            }




    if ($polaczenie->connect_errno!=0)              //jeżeli wystąpi jakiś błąd(!=0) to
        {
            echo "Error: ".$polaczenie->connect_errno;      //informuj nas o błędzie
        }
    else
        {   
            $log = $_POST['user'];                  //w przeciwnym razie, przyjmij dane uzupełnione przez użytkownika i przypisz do zmiennych
            $pass = $_POST['pass'];   
            
            $log= htmlentities($log, ENT_QUOTES,"UTF-8");       //zencjuj znaki przypisane do (zmiennej log, uwzględniając apostrof i cudzysłów, w UTF-8)
                                                                    //zencjuj znaki przypisane do (zmiennej pass, uwzględniając apostrof i cudzysłów, w UTF-8)
            
            $_SESSION['lo'] = $log;

            if ($rezultat = $polaczenie->query(                             
                sprintf("SELECT k.NumerID, k.Haslo AS Haslo, k.Imie, k.Nazwisko, z.Saldo AS zsaldo, z.NrKonta AS znr, o.NrKonta AS onr, o.saldo AS osaldo 
                FROM klient AS k, kzero AS z, koszcz AS o
                WHERE z.NumerID = k.NumerID AND o.NumerID = k.NumerID
                AND k.NumerID='%s'",  //wykonaj zapytanie SQL dla wartości wpisanych przez użytkownika
                mysqli_real_escape_string($polaczenie,$log))))         
                {
                    $ilu = $rezultat->num_rows;                             //wynik zapytania, zmienną rezultat(cały wiersz->num_rows) przypisz do zmiennej ili
                    
                    if($ilu>0)                   //jeżeli zmienna ilu zwraca jeden wiersz(więcej nie może, bo jest tylko jeden taki użytkownik) to
                    {
                        $wiersz = $rezultat->fetch_assoc();  
                        if(password_verify($pass, $wiersz['Haslo']))
                        {
                        $_SESSION['zalogowany'] = true;                     //do zmienneh globalnej zalogowany przypisz wartość true(oznacza, że wykonują się polecenia zalogowania)
                        
                        $_SESSION['numer'] = $wiersz['NumerID'];                 //indeks(zmienną) z tablicy asocjacyjnej zapytania przypisz do zmiennej globalnej
                        $_SESSION['imie'] = $wiersz['Imie'];                //indeks(zmienną) z tablicy asocjacyjnej zapytania przypisz do zmiennej globalnej
                        $_SESSION['nazwisko'] = $wiersz['Nazwisko'];        //indeks(zmienną) z tablicy asocjacyjnej zapytania przypisz do zmiennej globalnej
                        $_SESSION['saldo1'] = round($wiersz['zsaldo'],2); 
                        $_SESSION['znrkonta'] = $wiersz['znr']; 
                        $_SESSION['onrkonta'] = $wiersz['onr'];
                        $_SESSION['saldo2'] = $wiersz['osaldo'];

                        unset($_SESSION['blad']);                   //jeżeli jesteśmy zalogowani usuń zmienną przechowującą informację o błędnych danych
                        $rezultat->close();                         //zamknij wynik zapytania
                        
                        
            if($wynik = $polaczenie->query(
                sprintf("SELECT * FROM dane AS d, klient AS k 
                WHERE k.NumerID=d.NumerID AND k.NumerID='%s'", 
                mysqli_real_escape_string($polaczenie,$log))))
                {
                    $ile = $wynik->num_rows;
                    if($ile>0)
                    $wyn = $wynik->fetch_assoc();
                    $_SESSION['dPesel'] = $wyn['PESEL'];
                    $_SESSION['dUlica'] = $wyn['Ulica'];
                    $_SESSION['dkod'] = $wyn['KodPocztowy'];
                    $_SESSION['dmiejscowosc'] = $wyn['Miejscowosc'];
                    $_SESSION['dkraj'] = $wyn['Kraj'];
                    $_SESSION['dmail'] = $wyn['Email'];
                    $_SESSION['dtel'] = $wyn['Telefon'];
                    $wynik->close();
                }
        





            if($dowod = $polaczenie->query(
                sprintf("SELECT d.DataWaznosci, d.NumerDowodu, a.Ulica, a.KodPocztowy, a.Miejscowosc, a.Kraj 
                FROM dowod AS d, klient AS k, adreskor AS a 
                WHERE k.NumerID=d.NumerID AND k.NumerID=a.NumerID AND k.NumerID='%s'", 
                mysqli_real_escape_string($polaczenie,$log))))
                {
                    $id = $dowod->num_rows;
                    if($id>0)
                    $dow = $dowod->fetch_assoc();
                    $_SESSION['dataw'] = $dow['DataWaznosci'];
                    $_SESSION['numerd'] = $dow['NumerDowodu'];
                    $_SESSION['kulica'] = $dow['Ulica'];
                    $_SESSION['kkod'] = $dow['KodPocztowy'];
                    $_SESSION['kmiejs'] = $dow['Miejscowosc'];
                    $_SESSION['kkraj'] = $dow['Kraj'];
                    $dowod->close();
                }

                    header('location: start.php');              //wszystkie zmienne przenieś i wykonaj w skrypcie następnym
                    }
                    else
                    {
                        $_SESSION['blad'] = '<span style="color:red;">Nieprawidłowy login lub hasło!</span>';  //jeżeli w bazie nie będzie danego wiersza, to 
                        header('location:index.php');    
                    }
                }
                    else
                    {
                        $_SESSION['blad'] = '<span style="color:red;">Nieprawidłowy login lub hasło!</span>';  //jeżeli w bazie nie będzie danego wiersza, to 
                        header('location:index.php');                   //wróć na stronę główną i wyświetl komunikat.
                    }
                }
            }


        
            $polaczenie->close(); //po wykonaniu wszystkiego zamknij połączenie z bazą
        
?>