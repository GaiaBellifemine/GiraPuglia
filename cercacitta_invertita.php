<?php
include("config.php"); //Necessario per la connessione al db

$cerca = $_POST['cerca']; //Dato acquisito tramite POST da homepage.php

/* 
    Query di ricerca nel database, restituisce una vista sui dati da visualizzare nelle card dei città.
    Nella clausola where verifica che l'email sia dell'utente corretto (che ha venduto il libro) e che la parola chiave di ricerca sia quella inserita.
    Nella clausola select sono inseriti anche gli id per permettere di inviarli tramite richiesta GET ai file php email ed insert
*/

$sql = "SELECT id, nome, descrizione, immagine, info
        FROM citta
        WHERE nome='$cerca'";

$result = $link->query($sql); //Contenuto del risultato dell'esecuzione query (è una vettore)
$tabella = " "; //Inizialmente la tabella che mostra i città cercati è vuota

$i=0; //Indice che assegna un id univoco a ciascun anchor <a href> della tabella, inizialmente posto a 0

$tabella = " "; //Inizialmente la tabella che mostra i città cercati è vuota
$i=0; //Indice che assegna un id univoco a ciascun anchor <a href> della tabella, inizialmente posto a 0
while($row = $result->fetch_assoc()) //Si scorre ciascuna riga di result
{
     /*Si concatenano gli elementi in tabella da mostrare*/
    $tabella.= "
            <div class='card'>
                <div class='image'>
                    <img src='data:image/gif;base64,".base64_encode($row['immagine'])."'/>
                </div>
                <div class='title'>
                    <h1>".$row['nome']."</h1>
                </div>
                <div class='info'>
                    <h3>".$row['info']."</h3>
                </div>
                <div class='descrizione'>
                    ".$row['descrizione']."
                </div>
                
            </div>
        ";
        $i=$i+1;//Aggiorno gli id dei tag
}


$link->close(); //Chiusura della connessione al db

?>


<!DOCTYPE html><!--Informazione sul tipo di documento per il browser-->
<html>

<head>

    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">

    <meta name="viewport" content="with=device-width, initial=scale=1.0"><!--Adatta le dimensioni all'area di visualizzazione-->
    
    <title>Gira Puglia</title><!--Titolo della pagina mostrata-->

    <link rel="stylesheet" href="css/homepage_invertita.css"><!--Collegamento al css-->
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"><!--Directory cloud dove sono presenti i font-->

</head>

<body style="font-family: Arial, Helvetica, sans-serif; background-color: rgb(0,0, 0);   filter: invert(100%)">

    <section class="header"><!--Header della pagina-->

        <div id="myNav" class="overlay">
            
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            
            <div class="overlay-content">

                <p>
                        <div class="field-name" style="color:white;"> Modifica dimensione caratteri</div>
                        <div class="logic-section" id="font-size">

                            <button onclick="ZoomDecrease()" style="background-color:white;color:blue" value="decrease">A -</button>
					        <button onclick="ZoomIncrease()" style="background-color:white;color:blue" value="increase">A +</button>
                        </div>
                </p>

                <p>
                        <div class="field-name" style="color:white;">Inverti colori</div>
				        <div class="logic-section" id="invert">
					        <a href="cercacitta_invertita.php"> <button style="background-color:white;color:blue" value="invert">Applica</button> </a>
					        <a href="homepage.php"><button style="background-color:white;color:blue">Annulla</button></a>
                        </div>
                </p> 


            </div>

        </div>

        <div class="header">
            <div class="trasparenza"></div>
            <div class="container">
                <div onclick="openNav()">
                    <button style="background-color:white;color:blue"> <h3> IMPOSTAZIONI </h3></button>
                </div>
            </div>


        <div id="outer" style="text-align: 100%; position: absolute; bottom:0">            
            
            <div id="inner" style="display:inline-block">
                <button style="background-color:white;color:blue;" onclick="location.href='homepage.php'"> 
                <h3> HOME </h3></button>
            </div>
            
            <div id="inner" style="display:inline-block">
                <button style="background-color:white;color:blue;" onclick="location.href='gastronomia.php'"> 
                <h3> GASTRONOMIA </h3></button></div>
                <button style="background-color:white;color:blue;" onclick="location.href='itinerario.php'">
                <h3> ITINERARIO </h3></button></div>
            </div> 
                
            <div id="search-10" class="widget_search" ><!--Div per la barra di ricerca-->
                <form class="cercacitta" action="cercacitta_invertita.php" method="post"><!--Form per l'invio dei dati tramite POST alla pagina cercacitta_invertita.php-->
                    <div style="text-align: right;"><!--div posizionato a destra-->
                        <p style="position: absolute; bottom: 0; left: 70%; width: 300;"> <!--stilizzazione del tag p per posizionare in modo corretto la barra di ricerca-->
                            <input type="text" placeholder="Cerca una città..." name="cerca" size="40">  <!--Barra di ricerca con suggerimento (placeholder)-->    
                            <button type="submit" class="search" style="float:right; ">
                                <i class="fas fa-search"></i>
                            </button><!--Tasto per inviare i dati tramite form-->
                        </p>  
                    </div>
                </form>
            </div>
            
        </section>

        sei in HOMEPAGE

        <section class="contenuto">

             <div id="main" class="main"> 
                <?php echo $tabella; ?><!--Utilizzo il php per mostrare la tabella che possiede il contenuto html-->
            </div>

            <audio src="audio/homepage_0.mp3" id="audio0">
                <p>Your browser does not support the audio element.</p>
            </audio>
            <audio src="audio/homepage_1.mp3" id="audio1">
                <p>Your browser does not support the audio element.</p>
            </audio>
            <audio src="audio/homepage_2.mp3" id="audio2">
                <p>Your browser does not support the audio element.</p>
            </audio>
            <audio src="audio/homepage_3.mp3" id="audio3">
                <p>Your browser does not support the audio element.</p>
            </audio>
            <audio src="audio/homepage_4.mp3" id="audio4">
                <p>Your browser does not support the audio element.</p>
            </audio>
            <audio src="audio/homepage_5.mp3" id="audio5">
                <p>Your browser does not support the audio element.</p>
            </audio>
            <audio src="audio/homepage_6.mp3" id="audio6">
                <p>Your browser does not support the audio element.</p>
            </audio>
            <audio src="audio/homepage_7.mp3" id="audio7">
                <p>Your browser does not support the audio element.</p>
            </audio>
            <audio src="audio/homepage_8.mp3" id="audio8">
                <p>Your browser does not support the audio element.</p>
            </audio>
            <audio src="audio/homepage_9.mp3" id="audio9">
                <p>Your browser does not support the audio element.</p>
            </audio>
            <audio src="audio/homepage_I.mp3" id="audioI">
                <p>Your browser does not support the audio element.</p>
            </audio>


        </section>

    <div class="footer">
            <p> <h3>CONTATTI</h3></p>
            <p style="color:white;"> <img src="images/email.png"> <a href="mailto:bellifeminegaia@gmail.com" style="color: white;"> bellifeminegaia@gmail.com</a> </p>

            <p> <h3>SONDAGGI</h3></p>
            <p style="color:white;"> <img src="images/feedback.png"> <a href="https://docs.google.com/forms/d/e/1FAIpQLSdqrg8pr357q744JlWQ4x8CG8dFObXh4sdYlXo7tP8bDgNjFQ/viewform?usp=sf_link" style="color: white;"> Feedback </a> </p>

            <p> <h3>TERMINI DI SERVIZIO & PRIVACY</h3></p>
            <p style="color:white;"> <img src="images/info.png"> <a href="../info.html" style="color: white;"> Termini di servizio & privacy </a> </p>
        </div>


    <script type="text/javascript">
        
        function openNav() 
        {
            document.getElementById("myNav").style.width = "350px";
        }    

        function closeNav() 
        {
            document.getElementById("myNav").style.width = "0%";
        }

        function ZoomIncrease() // script per aumentare lo zoom nella pagina
        {
            document.body.style.zoom="200%";
        }

        function ZoomDecrease() // script per ridurre lo zoom nella pagina
        {
            document.body.style.zoom="100%";
        }

        var player = null;
        window.addEventListener("keydown", checkKeyPressed, false);
        function checkKeyPressed(e) 
        {

            if (e.keyCode == "48") // 48 = 0
            {
                document.getElementById('audio0').play()
                player = document.getElementById('audio0');
            }
            if (e.keyCode == "49") // 49 = 1
            {
                document.getElementById('audio1').play()
                player = document.getElementById('audio1');
            }
            if (e.keyCode == "50") // 50 = 2
            {
                document.getElementById('audio2').play()
                player = document.getElementById('audio2');
            }
            if (e.keyCode == "51") // 51 = 3
            {
                document.getElementById('audio3').play();
                player = document.getElementById('audio3');
            }
            if (e.keyCode == "52") // 52 = 4
            {
                document.getElementById('audio4').play();
                player = document.getElementById('audio4');
            }
            if (e.keyCode == "53") // 53 = 5
            {
                document.getElementById('audio5').play();
                player = document.getElementById('audio5');
            }
            if (e.keyCode == "54") // 54 = 6
            {
                document.getElementById('audio6').play();
                player = document.getElementById('audio6');
            }
            if (e.keyCode == "55") // 55 = 7
            {
                document.getElementById('audio7').play();
                player = document.getElementById('audio7');
            }
            if (e.keyCode == "56") // 56 = 8
            {
                document.getElementById('audio8').play();
                player = document.getElementById('audio8');
            }
            if (e.keyCode == "57") // 57 = 9
            {
                document.getElementById('audio9').play();
                player = document.getElementById('audio9');
            } 
            if (e.keyCode == "73") // 73 = I: 
            {
                document.getElementById('audioI').play()
            }
            if (e.keyCode == "67") // 67 = C: cambia pagina da Homepage a Gastronomia
            {
                window.location.href = "gastronomia.php";
            }
            if (e.keyCode == "69") // 69 = E: invia e-mail
            {
                window.open('mailto:bellifeminegaia@gmail.com');
            }
            if (e.keyCode == "70") // 70 = F: apre Moduli Google per inviare un feedback
            {
                window.location.href = "https://docs.google.com/forms/d/e/1FAIpQLSdqrg8pr357q744JlWQ4x8CG8dFObXh4sdYlXo7tP8bDgNjFQ/viewform?usp=sf_link";
            }
            if (e.keyCode == "87") // 87 = W: apre pagina Wikipedia "Isole Tremiti"
            {
                window.location.href = "https://it.wikipedia.org/wiki/Isole_Tremiti";
            }
            if (e.keyCode == "88") // 88 = X: interrompe audio in corso
            {
                player.pause();
                player.currentTime = 0;
            }
        }
    

    </script>


</body>

</html>