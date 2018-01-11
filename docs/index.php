<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet">
    <link href="style.css">
    <title>TV PILOT</title>

</head>

<body>

    <div class="power">
        <div class="button on">
            <a href="index.php?table=tv&command=POWR1">ON</a>
        </div>
        <div class="button off">
            <a href="index.php?table=tv&command=POWR0">OFF</a>
        </div>
    </div>
    <div class="input">
        <ul>
            <li class="button">
                <a href="index.php?table=tv&command=IAVD4">HDMI1</a>
            </li>
            <li class="button">
                <a href="index.php?table=tv&command=IAVD5">HDMI2</a>
            </li>
            <li class="button">
                <a href="index.php?table=tv&command=IAVD6">HDMI3</a>
            </li>
            <li class="button">
                <a href="index.php?table=tv&command=IAVD7">HDMI4</a>
            </li>
            <li class="button">
                <a href="index.php?table=tv&command=INP12">VGA</a>
            </li>
            <li class="button">
                <a href="index.php?table=tv&command=ITVD0">TV</a>
            </li>
        </ul>
    </div>
    <!---------------------INPUT TOGGLE------------------------>
    <!-- <a href="index.php?table=tv&command=ITDG">toggle</a>-->
    <div class="volume">
        <ul>
            <li class="button volume">
                <a href="index.php?table=tv&command=VOLM">VOL <span>20</span></a>
            </li>
            <li>
                <input type="range" id="input" name="volume" min="0" max="60" value="20">
            </li>
        </ul>
    </div>
    <div class="canal">
        <ul>
            <li>
                <input class="numberCanal" type="text" placeholder="Kanał" />
            </li>
            <li>
                <ul class="plusminus">
                    <li>
                        <div class="button2">
                            <a href="index.php?table=tv&command=CHDN">DN</a>
                        </div>
                    </li>
                    <li>
                        <div class="button2">
                            <a href="index.php?table=tv&command=CHUP">UP</a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="clear"></div>
    <div class=images>
        <a href="index.php?table=tv&command=DTVD077"><img class="image1" src="images/tvp1.png" alt="tvp1"></a>
        <a href="index.php?table=tv&command=DTVD002"><img class="image1" src="images/tvpdwa.png" alt="tvp2"></a>
        <a href="index.php?table=tv&command=DTVD004"><img class="image2" src="images/polsat.png" alt="polsat"></a>
        <a href="index.php?table=tv&command=DTVD003"><img class="image4" src="images/tvp3.png" alt="tvp3"></a>
        <a href="index.php?table=tv&command=DTVD005"><img class="image3" src="images/tvn.png" alt="tvn"></a>
        <a href="index.php?table=tv&command=DTVD007"><img class="image2" src="images/tv4.png" alt="tv4"></a>
    </div>
    <!--
    <a href="index.php?table=tv&command=DTVD00">kanal 1-9</a>
    <a href="index.php?table=tv&command=DTVD0">kanal 10-99</a>
    <a href="index.php?table=tv&command=DTVD">100-999</a>-->

    <!-- <br> projektor <br>
    <a href="index.php?table=projector&command=ProjON">Power On</a>
    <a href="index.php?table=projector&command=ProjOFF">Power OFF</a>
    <a href="index.php?table=projector&command=InputVGA">Input VGA</a>-->


    <span class="log">
    <?php 

if(isset($_GET['command'])) {      
include ("connection.php");
$potwierdzenie_odbioru=1;
$command=$_GET['command']; 
$table=$_GET['table'];  
echo $table;
echo "przeslano komendę " .$command. " metodą get </br>";
} else echo "nic nie przesłano </br>";

$query = "SELECT * from `tv` WHERE `function_set` = '$command'";   
$query2 = "UPDATE `tv` SET `potwierdzenie_odbioru` = '$potwierdzenie_odbioru' WHERE tv.function_set = '$command'"; 
$query3 = "SELECT * from `screen` WHERE `id` = '1'";  
$query4 = "UPDATE `screen` SET `potwierdzenie_odbioru` = '$potwierdzenie_odbioru', `wykonaj_komende` = '$command' WHERE `screen`.`id` = 1"; 
$query5 = "SELECT * from `projektor` WHERE `function_set` = '$command'";  
$query6 = "UPDATE `projektor` SET `potwierdzenie_odbioru` = '$potwierdzenie_odbioru' WHERE projektor.function_set = '$command'"; 
 
    
    /*  WEJŚĆIE TV */
    if($table == 'tv') {     
        if ($match = mysqli_query($connection,$query)) {
            $row = mysqli_fetch_array($match);
            $stat = $row['potwierdzenie_odbioru'];
            echo "Potwierdzenie odbioru: "; 
            echo '<br>';
        }else echo ("nic nie pobrano z wiersza </br>");
        
        if($stat == 0){
            if ($match3 = mysqli_query($connection,$query2)) { 
               echo "zaktualizowano baze danych </br>";
            } else echo "nie przeslano do bazy danych </br>";
       } else echo ("nie wykonałem polecenia, ponieważ potwierdzenie odbioru = 1"); 
    }
    
    
    /* WEJŚCIE EKRAN */
    if ($table == 'ID') {
        if ($match = mysqli_query($connection, $query3)) {
            $row = mysqli_fetch_array($match); //zamien w tablice
            $stat = $row['potwierdzenie_odbioru']; //przypisz wynik do zmiennej stat;
            echo "Potwierdzenie odbioru: "; //wypluj zawartosc $row
            echo '<br>';
        } else echo ("nic nie pobrano z wiersza </br>");
        
        if($stat == 0){
            if(mysqli_query($connection, $query4)) { 
               echo "zaktualizowano baze danych </br>";
            } else echo "nie przeslano do bazy danych </br>";
       } else echo ("nie wykonałem polecenia, ponieważ potwierdzenie odbioru = 1");  
    }
    
        /* WEJŚCIE PROJEKTOR */
    if ($table == 'projector') {
        if ($match = mysqli_query($connection, $query5)) {
            $row = mysqli_fetch_array($match); 
            $stat = $row['potwierdzenie_odbioru']; 
            echo "Potwierdzenie odbioru: "; 
            echo '<br>';
        } else echo ("nic nie pobrano z wiersza </br>");
        
        if($stat == 0){
            if(mysqli_query($connection, $query6)) { 
               echo "zaktualizowano baze danych </br>";
            } else echo "nie przeslano do bazy danych </br>";
       } else echo ("nie wykonałem polecenia, ponieważ potwierdzenie odbioru = 1");  
    }
    
mysqli_close($db);	//zamykam baze danych
    
?> </span>

    <script>
        let input = document.getElementById('input');
        input.addEventListener("change", updateValue);
        input.addEventListener("mousemove", updateValue);

        function updateValue() {
            console.log(this.value);
            let percent = document.querySelector("span");
            percent.textContent = this.value;
        }

    </script>
</body>

</html>
