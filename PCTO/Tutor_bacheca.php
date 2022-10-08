<!doctype html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tutor - Area riservata PCTO</title>
    <link rel="icon" type="image/png" href="asset/img/pcto.png" />
    <link href="asset/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var parametri = location.search;
            if (parametri == "?Carico=Eseguito") {
                $("#eseguito").removeClass("nascosto");
            } else if (parametri == "?Carico=Fallito") {
                $("#fallito").removeClass("nascosto");
            }
        });
    </script>
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        #ale {
            margin-bottom: 1px;
            height: 30px;
            line-height: 30px;
            padding: 0px 15px;
        }

        .sidebar .nav-link.active {
            color: #BA702C ! important;
        }

        .sidebar .nav-link:hover {
            color: #BA702C ! important;
        }

        .head_color {
            background-color: #bb2c2e !important;
        }

        .navbar-brand {

            background-color: #BA702C !important;

        }

        .nascosto {
            display: none;
        }

        .table td,
        th {
            text-align: center;
        }
    </style>
    <link href="asset/css/progetto.css" rel="stylesheet">
</head>
<?php
session_start();
ob_start();
if (isset($_SESSION['Id_tutor_pcto'])) {
?>

    <body>
        <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow head_color">
            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="Tutor.php"><?php print($_SESSION['Nome'] . " " . $_SESSION['Cognome']); ?></a>
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </header>
        <div class="container-fluid">
            <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="Tutor.php">
                                    <span data-feather="user"></span>
                                    Dati personali
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="Tutor_bacheca.php">
                                    <span data-feather="clipboard"></span>
                                    Bacheca richieste
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="Tutor_in_carico.php">
                                    <span data-feather="server"></span>
                                    Richieste in carico
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="Tutor_studenti_storico_esperienze.php">
                                    <span data-feather="users"></span>
                                    Storico esperienze studenti
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="Privacy_policy.php">
                                    <span data-feather="file-text"></span>
                                    Privacy policy
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="cancella.php">
                                    <span data-feather="log-out"></span>
                                    Esci
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <?php
                ini_set('display_errors', 0);
                $Connessione = mysqli_connect("localhost", "root", "");
                if (!$Connessione) {
                    print("<H1>Connessione al server MySQL fallita</H1>");
                    exit;
                }
                $DB = mysqli_select_db($Connessione, "alternanza");
                if (!$DB) {
                    print("<H1>Connessione al database alternanza fallita</H1>");
                    exit;
                }
                $query = "SELECT * FROM tutor_pcto WHERE tutor_pcto.Id_tutor_pcto=" . $_SESSION['Id_tutor_pcto'];
                $risultato = mysqli_query($Connessione, $query);
                if (!$risultato) {
                    die("La tabella selezionata non esiste " . mysqli_error($Connessione));
                }
                $riga = mysqli_fetch_array($risultato);
                ?>
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h3"><a href="" class="text-decoration-none" style="color: #bb2c2e ! important;">Bacheca richieste non prese in carico da nessun tutor</a></h1>
                    </div>
                    <div class="alert alert-info" role="alert">
                        In questa pagina è possibile visualizzare tutte le richieste effettuate dalle aziende che non sono state ancora prese in carico da nessun tutor, inoltre puoi visualizzare i dettagli dell'azienda e puoi prendere in carico la relativa richiesta con gli appositi pulsanti.
                    </div>
                    <div class="alert nascosto alert-success" role="alert" id="eseguito">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        Richiesta presa in carico correttamente, se vuoi visualizzare le tue richieste in carico vai sulla voce <a href="Tutor_in_carico.php" class="alert-link">Richieste in carico</a>, nel munu a sinistra.
                    </div>
                    <div class="alert nascosto alert-danger" role="alert" id="fallito">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        La presa in carico non è andata a buon fine, se si verificano altri problemi di questo tipo notificare tutto all'assistenza.
                    </div>
                    <?php
                    $query = "SELECT * FROM aziende, azienda_richieste WHERE aziende.Id_azienda=azienda_richieste.Cod_azienda AND azienda_richieste.Cod_tutor IS NULL ORDER BY azienda_richieste.Id_azienda_richiesta DESC";
                    $risultato = mysqli_query($Connessione, $query);
                    if (!$risultato) {
                        die("La tabella selezionata non esiste " . mysqli_error($Connessione));
                    }
                    $riga = mysqli_fetch_array($risultato);
                    if ($riga['N_studenti']) {
                    ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-sm align-start">
                                <thead>
                                    <tr>
                                        <th>Azienda</th>
                                        <th>Descrizione</th>
                                        <th>Numero studenti</th>
                                        <th>Specializzazione</th>
                                        <th>Data inizio</th>
                                        <th>Data fine</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    do {
                                        print("<tr><td>" . $riga['Denominazione'] . "</td><td>" . $riga['Descrizione'] . "</td><td>" . $riga['N_studenti'] . "</td><td>" . $riga['Specializzazione_studenti'] . "</td><td>" . $riga['Data_inizio_attivita'] . "</td><td>" . $riga['Data_fine_attivita'] . "</td>");
                                        print("<td><a href='Tutor_aziende_dettagli.php?Id=" . $riga['Cod_azienda'] . "' class='btn btn-outline-primary' tabindex='-1' role='button' aria-disabled='true'>Dettaglio azienda</a></td><td><a href='Tutor_carico.php?Id=" . $riga['Id_azienda_richiesta'] . "' class='btn btn-outline-info' tabindex='-1' role='button' aria-disabled='true'>Prendi in carico</a></td></tr>");
                                    } while ($riga = mysqli_fetch_array($risultato));
                                } else {
                                    ?>
                                    <div class="alert alert-warning" role="alert">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        Nessuna richiesta pervenuta dalle aziende.
                                    </div>
                                <?php
                                }
                                mysqli_close($Connessione);
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="footer col-md-9 ms-sm-auto col-lg-10 px-md-4" role="alert">
                            Sviluppo a cura di <strong><a href="" style="color: #bb2c2e;" class="text-decoration-none">Antonio Caiafa</a></strong> V A Informatica - a.s. 2020/2021 <strong><a href="https://www.itcgtursi.edu.it/" target="_blank" style="color: #bb2c2e;" class="text-decoration-none"> ITSET "Manlio Capitolo" Tursi (MT)</a></strong>
                        </div>
                </main>
            </div>
        </div>
        <script src="asset/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
        <script src="asset/js/progetto.js"></script>
    </body>
<?php
} else {
    header("location: index.php?Sessione=Scaduta");
}
?>

</html>