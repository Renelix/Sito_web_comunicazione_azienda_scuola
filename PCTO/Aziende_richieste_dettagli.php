<!doctype html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Azienda - Area riservata PCTO</title>
    <link rel="icon" type="image/png" href="asset/img/pcto.png" />
    <link href="asset/css/bootstrap.min.css" rel="stylesheet">
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
            color: #19826d ! important;
        }

        .sidebar .nav-link:hover {
            color: #19826d ! important;
        }

        .head_color {
            background-color: #198754 !important;
        }

        .navbar-brand {
            background-color: #19826d;
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
if (isset($_SESSION['Id_azienda'])) {
?>

    <body>
        <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow head_color">
            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="Aziende.php"><?php print($_SESSION['Denominazione']); ?></a>
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
                                <a class="nav-link" aria-current="page" href="Aziende.php">
                                    <span data-feather="home"></span>
                                    Dati aziendali
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="Aziende_richieste.php">
                                    <span data-feather="users"></span>
                                    Richieste
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
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h3"><a href="" style="color:#198754;" class="text-decoration-none">Dettagli richiesta selezionata</a></h1>
                    </div>
                    <div class="alert alert-info" role="alert">
                        In questa pagina vengono mostrati i dati degli alunni che prenderanno parte all'attività selezionata ed i dati di contatto del docente tutor che si occuperà del progetto.
                    </div>
                    <?php
                    $Richiesta = $_GET['id'];
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

                    $query = "SELECT * FROM azienda_richieste WHERE azienda_richieste.Id_azienda_richiesta=$Richiesta AND azienda_richieste.Cod_azienda=" . $_SESSION['Id_azienda'];
                    $risultato = mysqli_query($Connessione, $query);
                    if (!$risultato) {
                        header("location: Aziende_richieste.php");
                        exit;
                    }
                    $riga = mysqli_fetch_array($risultato);
                    if (!isset($riga['Id_azienda_richiesta'])) {
                        header("location: Aziende_richieste.php");
                        exit;
                    }

                    $query = "SELECT * FROM azienda_richieste, tutor_pcto WHERE azienda_richieste.Cod_tutor=tutor_pcto.Id_tutor_pcto AND azienda_richieste.Id_azienda_richiesta=$Richiesta";
                    $risultato = mysqli_query($Connessione, $query);
                    $Flag = 0;
                    if (!$risultato) {
                        die("La tabella selezionata non esiste " . mysqli_error($Connessione));
                    }
                    $riga = mysqli_fetch_array($risultato);
                    if ($riga['Id_tutor_pcto']) {
                    ?>
                        <h5><a href="" style="color:#198754;" class="text-decoration-none">Dati di contatto docente tutor</a></h5>
                        <div class="table-responsive">
                            <table class="table table-striped table-sm align-middle">
                                <thead>
                                    <tr>
                                        <th>Cognome</th>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Telefono</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    print("<tr><td>" . $riga['Cognome'] . "</td><td>" . $riga['Nome'] . "</td><td>" . $riga['Email'] . "</td><td>" . $riga['Telefono'] . "</td></tr>");
                                    $Flag = 1;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <?php
                    } else {
                        header("location: Aziende_richieste.php?Studenti=Nessuno");
                    }
                    $query = "SELECT * FROM azienda_richieste, richieste_studenti, anagrafica_studenti, classi_studenti, indirizzi_studenti WHERE azienda_richieste.Id_azienda_richiesta=" . $Richiesta . " AND azienda_richieste.Id_azienda_richiesta=richieste_studenti.Cod_richiesta AND richieste_studenti.Cod_studente=anagrafica_studenti.Id_studente AND anagrafica_studenti.Cod_classe=classi_studenti.Id_classe AND classi_studenti.Cod_indirizzo=indirizzi_studenti.Id_indirizzo GROUP BY anagrafica_studenti.Cognome ASC";
                    $risultato = mysqli_query($Connessione, $query);
                    if (!$risultato) {
                        die("La tabella selezionata non esiste " . mysqli_error($Connessione));
                    }
                    $riga = mysqli_fetch_array($risultato);
                    if ($riga['Id_studente']) {
                    ?>
                        <p></p>
                        <hr>
                        <p></p>
                        <h5><a href="" style="color:#198754;" class="text-decoration-none">Dati alunni associati alla richiesta</a></h5>
                        <div class="table-responsive">
                            <table class="table table-striped table-sm align-middle">
                                <thead>
                                    <tr>
                                        <th>Cognome</th>
                                        <th>Nome</th>
                                        <th>Data di nascita</th>
                                        <th>Sesso</th>
                                        <th>Classe</th>
                                        <th>Indirizzo di studi</th>
                                        <th>Valutazione aziendale</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    do {
                                        print("<tr><td>" . $riga['Cognome'] . "</td><td>" . $riga['Nome'] . "</td><td>" . $riga['Data_nascita'] . "</td><td>" . $riga['Sesso'] . "</td><td>" . $riga['Grado'] . $riga['Sezione'] . "</td><td>" . $riga['Denominazione'] . "</td>");
                                        if ($riga['Url_valutazione_aziendale']) {
                                            print("<td><a href='" . $riga['Url_valutazione_aziendale'] . "' target='_blank' class='btn btn-outline-primary' tabindex='-1' role='button' aria-disabled='true'>Scarica qui</a></td></tr>");
                                        } else {
                                            print("<td><div class='alert alert-warning' role='alert' id='ale'>Non inserito</div></td></tr>");
                                        }
                                    } while ($riga = mysqli_fetch_array($risultato));
                                    mysqli_close($Connessione);
                                    $Flag = 2;
                                } else {
                                    ?>
                                    <div class="alert alert-warning" role="alert">
                                        Alla richiesta selezionata non è stato associato ancora nessuno studente.
                                    </div>
                                <?php
                                }
                                if ($Flag == 0) {
                                    mysqli_close($Connessione);
                                    header("location: Aziende_richieste.php?Studenti=Nessuno");
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="footer col-md-9 ms-sm-auto col-lg-10 px-md-4" role="alert">
                            Sviluppo a cura di <strong><a href="" style="color:#198754;" class="text-decoration-none">Antonio Caiafa</a></strong> V A Informatica - a.s. 2020/2021 <strong><a href="https://www.itcgtursi.edu.it/" target="_blank" style="color:#198754;" class="text-decoration-none"> ITSET "Manlio Capitolo" Tursi (MT)</a></strong>
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