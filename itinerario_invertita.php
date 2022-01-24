<?php

require_once('config.php');

$sql = "SELECT id, nome, descrizione, immagine, info
        FROM citta
        ORDER BY id";
$result = $link->query($sql); //Contenuto del risultato dell'esecuzione query (è un vettore)

$tabella = " "; //Inizialmente la tabella che mostra le città cercate è vuota
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
<html lang="it">

<head>

    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">

    <meta name="viewport" content="with=device-width, initial=scale=1.0"><!--Adatta le dimensioni all'area di visualizzazione-->
    
    <title>Gira Puglia</title><!--Titolo della pagina mostrata-->

    <link rel="stylesheet" href="css/homepage.css"><!--Collegamento al css-->
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"><!--Directory cloud dove sono presenti i font-->

</head>

<body style="font-family: Arial, Helvetica, sans-serif; background-color: rgb(0, 0, 0); filter:invert(100%)">

    <div class="header"><!--Header della pagina-->

        <div id="myNav" class="overlay" aria-hidden="true">
            
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            
            <div class="overlay-content">

                <div>
                        <div class="field-name" style="color:white;"> Modifica dimensione caratteri</div>
                        <div class="logic-section" id="font-size">

                            <button onclick="ZoomDecrease()" style="background-color:white;color:blue" value="decrease">A -</button>
					        <button onclick="ZoomIncrease()" style="background-color:white;color:blue" value="increase">A +</button>
                        </div>
                </div>

                <div>
                        <div class="field-name" style="color:white;">Inverti colori</div>
				        <div class="logic-section" id="invert">
                            <form style="display: inline" action="itinerario_invertita.php" method="get">
                                <button style="background-color:white;color:blue" value="invert">Applica</button>
                            </form>
                            <form style="display: inline" action="itinerario.php" method="get">
                                <button style="background-color:white;color:blue">Annulla</button>
                            </form>
					        <!--<a href="gastronomia_invertita.php"> <button style="background-color:white;color:blue" value="invert">Applica</button> </a>-->
					        <!--<a href="gastronomia.php"><button style="background-color:white;color:blue">Annulla</button></a>-->
                        </div>
                </div> 


            </div>

        </div>

        <div class="header">
            <div class="trasparenza"></div>
            <div class="container">
                <div onclick="openNav()">
                    <!--<button style="background-color:white;color:blue"> <h3> IMPOSTAZIONI </h3></button>-->
                    <button style="background-color:white;color:blue; font-size: 1.17em; font-weight: bold; height: 3em;">IMPOSTAZIONI</button>
                </div>
            </div>


        <div id="outer" style="text-align: left; position: absolute; bottom:0">            
            
            <div class="inner" style="display:inline-block">
                <button style="background-color:white;color:blue; font-size: 1.17em; font-weight: bold; height: 3em;" onclick="location.href='homepage_invertita.php'"> HOME</button>
                <!--<h3> HOME </h3></button>-->
            </div>
            
            <div class="inner" style="display:inline-block">
                <button style="background-color:white;color:blue; font-size: 1.17em; font-weight: bold; height: 3em;" onclick="location.href='gastronomia_invertita.php'"> GASTRONOMIA</button>
                    <!--<h3> GASTRONOMIA </h3></button>-->

                </div>
                <button style="background-color:white;color:blue; font-size: 1.17em; font-weight: bold; height: 3em;" onclick="location.href='itinerario_invertita.php'">ITINERARIO</button>
                    <!--<h3> ITINERARIO </h3></button>-->
                </div>
            </div> 
                
            <div id="search-10" class="widget_search" ><!--Div per la barra di ricerca-->
                <form class="cercacitta" action="cercacitta.php" method="post"><!--Form per l'invio dei dati tramite POST alla pagina cercacitta.php-->
                    <div style="text-align: right;"><!--div posizionato a destra-->
                        <!--<p style="position: absolute; bottom: 0; left: 70%; width: 300 px;">--> <!--stilizzazione del tag p per posizionare in modo corretto la barra di ricerca-->
                        <p style="position: absolute; left: 70%; bottom: 0;"> <!--stilizzazione del tag p per posizionare in modo corretto la barra di ricerca-->
                            <input type="text" placeholder="Cerca una città..." name="cerca" size="40" id="cerca">  <!--Barra di ricerca con suggerimento (placeholder)-->    
                            <button type="submit" class="search" style="float:right; ">
                                <i class="fas fa-search"></i>
                            </button><!--Tasto per inviare i dati tramite form-->
                        </p>  
                    </div>
                </form>
            </div>
            
        </div>

        sei in ITINERARIO

        <div class="contenuto">
            
            <p style="text-align: center; font-size: 2.17em; font-weight: bold;"> Ti diamo il benvenuto nella sezione “ITINERARIO”. </p>
            <p style="text-align: center; font-size: 2.17em; font-weight: bold;">  Questa pagina propone delle modalità (accessibili) per visitare la Puglia.  </p>
           
            <p> Premi 0 per avviare l’itinerario. </p>

            <table>
                <tr>
                    <td><img alt="Immagine del lungomare di Bari con la ruota panoramica" src="images/itinerario_1.png"></td>
                    <td style="font-size:20px">Il nostro itinerario turistico senza barriere parte dal barese. A Bari è possibile visitare il centro città grazie ad un percorso di luce che si estende per circa 2,5 chilometri, uno dei più lunghi al mondo: si tratta di mattonelle tattili che permettono ai non vedenti e agli ipovedenti di spostarsi in città in modo sicuro. Inoltre, è possibile visitare le reliquie di San Nicola e il centro storico, accessibili ai disabili motori. Si prosegue il tour verso la costa adriatica, con le caratteristiche spiagge (Monopoli, Polignano a Mare, Mola di Bari). Invece, a Gravina ed Altamura possono essere visitate affascinanti cripte e cattedrali. Sempre in tema storico, sono di gran interesse le città vecchie di Bitonto, Giovinazzo e Molfetta, quest’ultima con un porto storico ed un’antica tradizione di cantieri navali. Nelle terre della Valle d’Itria, si fa tappa a Castellana, cui grotte sono visitabili con percorsi ad hoc e video guide Lis, così da rendere il tour accessibile a tutti; la seconda tappa è Alberobello con i suoi caratteristici trulli, seguita da Locorotondo, una città con uno dei borghi più belli di Italia; per finire, vi è Putignano, nota per il suo carnevale antico e il suo centro storico. </td>
                </tr>
                <tr>
                <td><img alt="Immagine del centro storico di Gallipoli visto dall'alto" src="images/itinerario_2.png"></td>
                    <td style="font-size:20px">Ci si sposta nel Leccese, cui chiese e monumenti sono visitabili con il supporto di audio guide; vi è poi l’area naturalistica del Parco di Rauccio e l’oasi WWF delle Cesine. Sempre in ambito naturalistico, può essere visitato ad Otranto il Parco Naturale Regionale Costa Otranto,  che offre itinerari accessibili per disabili motori, ipovedenti e non vedenti. Altre mete che offrono itinerari accessibili sono Gallipoli, Ugento, Santa Maria di Leuca, Nardò, Porto Cesareo e il “Porto Selvaggio – Palude del Capitano”. </td>
                </tr>
                <tr>
                    <td><img alt="Immagine di Torre Guaceto, un'area bagnata dal mare nella provincia di Brindisi" src="images/itinerario_3.png"></td>
                    <td style="font-size:20px">Nel Brindisino, invece, a Torre Guaceto, una riserva naturale, vi è un percorso per ipovedenti; ad Ostuni vi sono diverse mete accessibili, sia nell’area rurale che nel centro storico; anche il Parco Naturale delle Dune Costiere presenta diverse attrezzature quali passerelle e percorsi facilitati per usufruire a pieno del tour.  </td>
                </tr>
            </table>
            
            <audio src="audio/itinerario_0.mp3" id="audio0">
                <p>Your browser does not support the audio element.</p>
            </audio>


        </div>

        <div class="footer">
            <h3>CONTATTI</h3>
            <p style="color:white;"> <img alt=" " src="images/email.png"> <a href="mailto:bellifeminegaia@gmail.com" style="color: white;"> bellifeminegaia@gmail.com</a> </p>

            <h3>SONDAGGI</h3>
            <p style="color:white;"> <img alt=" " src="images/feedback.png"> <a href="https://docs.google.com/forms/d/e/1FAIpQLSdqrg8pr357q744JlWQ4x8CG8dFObXh4sdYlXo7tP8bDgNjFQ/viewform?usp=sf_link" style="color: white;"> Feedback </a> </p>

            <h3>TERMINI DI SERVIZIO & PRIVACY</h3>
            <p style="color:white;"> <img alt=" " src="images/info.png"> <a href="info.html" style="color: white;"> Termini di servizio & privacy </a> </p>
        </div>


    <script>
        
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
            var cerca=document.getElementById('cerca');
            if(cerca!=document.activeElement)
            {
            if (e.keyCode == "48") //48 corrisponde al tasto 0
            {
                document.getElementById('audio0').play()
                player = document.getElementById('audio0');
            }
            if (e.keyCode == "67") // 67 corrisponde al tasto C
            {
                window.location.href = "index.php";
            }
            if (e.keyCode == "69") // 69 corrisponde al tasto E
            {
                window.open('mailto:bellifeminegaia@gmail.com');
            }
            if (e.keyCode == "73") // 73 = I: 
            {
                document.getElementById('audioI').play()
            }
            if (e.keyCode == "70") // 70 = F: apre Moduli Google per inviare un feedback
            {
                window.location.href = "https://docs.google.com/forms/d/e/1FAIpQLSdqrg8pr357q744JlWQ4x8CG8dFObXh4sdYlXo7tP8bDgNjFQ/viewform?usp=sf_link";
            }
            if (e.keyCode == "88") // 88 = X: interrompe audio in corso
            {
                player.pause();
                player.currentTime = 0;
            }
        }}

    </script>


</body>

</html>