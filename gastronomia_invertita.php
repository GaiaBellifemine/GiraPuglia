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
                    <img alt=' ' src='data:image/gif;base64,".base64_encode($row['immagine'])."'/>
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
                            <form style="display: inline" action="gastronomia_invertita.php" method="get">
                                <button style="background-color:white;color:blue" value="invert">Applica</button>
                            </form>
                            <form style="display: inline" action="gastronomia.php" method="get">
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

        sei in GASTRONOMIA

        <div class="contenuto">
            
            <p style="text-align: center; font-size: 2.17em; font-weight: bold;"> Ti diamo il benvenuto nella sezione “gastronomia”. </p>
            <p style="text-align: center; font-size: 2.17em; font-weight: bold;">  Questa pagina ti farà conoscere la Puglia attraverso i suoi odori e i suoi sapori.  </p>
           
            <p> Premi 0 per avviare l’itinerario gastronomico. </p>

            <table>
                <tr>
                    <td><img alt="cartina geografica della Puglia raffigurante alcuni prodotti tipici suddivisi per zona" src="images/puglia.png"></td>
                    <td style="font-size: 20px">I prodotti tipici pugliesi sono molti e la cucina si diversifica da città in città. Per l’itinerario, faremo un viaggio virtuale partendo dal nord della Puglia: il Gargano. Un prodotto tipico della zona è il caciocavallo podolico, dal gusto forte. Oltre i formaggi, un altro prodotto tipico è il limoncello. Ad Andria, invece, un formaggio tipico è la burrata. Spostandoci a sud, verso Bari, presentiamo un piatto ormai simbolo della cucina pugliese: le orecchiette con le cime di rapa. Si tratta di una ricetta dalle origini contadine ed ormai diffusa in tutta la Puglia (ma anche oltre). Altre specialità tipiche del barese sono “marine”, quali i cavatelli ai frutti di mare e le lasagne di mare. La pasta pugliese è così popolare, da essere prodotta tra le strade di Bari Vecchia ed è acquistata da tantissimi turisti, anche non italiani. Parlando di dessert, invece, dolci tipici sono gli amaretti, le castagnedde (castagnelle in italiano, a base di mandorle), le cartellate e molti altri e base di mandorle e vincotto, un prodotto che ha origine fin dai tempi degli antichi romani. Un altro dolce molto popolare è il “sospiro” (Bisceglie), conosciuto ad Altamura come “tette delle monache”, un nome che trova origine da alcune leggende. Proprio ad Altamura è prodotto un tipo di pane simbolico per la regione, spesso accostato ad un altro simbolo: l’olio di oliva. Oltre a piatti tipicamente “da tavola”, la Puglia vanta anche di un ottimo “street food”, in cui emergono sicuramente i panzerotti fritti e le frittelle, consumate soprattutto durante le festività, tra le quali quelle natalizie. Altro cibo da consumare mentre si gira tra le città, sono le pettole, sia dolci che salate, semplici da produrre (si tratta di un impasto a bare di farina, acqua lievito poi fritto in olio bollente). Più a sud, nel Salento, tra i dolci vi è sicuramente il pasticiotto, ripieno di crema e servito caldo; tra le pietanze salate, invece, figura la puccia, un pane tipico che viene condito in modi assai differenti in base al gusto o alle tradizioni locali. Tra le bevande (alcoliche) figura il Primitivo di Puglia, un vino rosso, adatto per concludere una cena in riva al mare, ascoltando il suono delle onde.</td>
                </tr>
            </table>
            
            <audio src="audio/gastronomia_0.mp3" id="audio0">
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
                window.location.href = "itinerario.php";
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