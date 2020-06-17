<?php
    session_start();                    //tablica globalna, która umożliwa przepływ zmiennych globalnych między plikami php
    session_unset();                    //przerywa bieżącą sesję i wszystkie zapisane zmienne
    header('location: index.php');      //przenosi usera na stronę główną, logowania
?>