<?php

//$connection = mysqli_connect('localhost', 'root', '###') // baza danych kyrego
$connection = mysqli_connect('localhost', 'root', '###') //moja baza danych sql

or die('Brak połączenia z serwerem MySQL.<br />'); 
    
//echo "Udało się połączyć z serwerem!<br />"; 
$db = mysqli_select_db($connection, 'screen') 

or die('Nie mogę połączyć się z bazą danych<br />Błąd: '.mysqli_error());  
//echo "Udało się połączyć z bazą danych!<br />"; 

?>
