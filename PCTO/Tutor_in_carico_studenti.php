<!doctype html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tutor - Area riservata PCTO</title>
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

        .form-select:focus {
            border-color: #bb2c2e;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(187, 44, 46, 0.6);
        }

        .table td,
        th {
            text-align: center;
        }
    </style>
    <link href="asset/css/progetto.css" rel="stylesheet">
</head>
<?php
ob_start();
session_start();
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
                                <a class="nav-link" href="Tutor_bacheca.php">
                                    <span data-feather="clipboard"></span>
                                    Bacheca richieste
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="Tutor_in_carico.php">
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
                $Idr = $_GET['Id'];
                ini_set('display_errors', 0);
                $Connessione = mysqli_connect("localhost", "root", "");
                if (!$Connessione) {
                    print("<H1>Connessione al server MySQL fallita</H1>");
                    header("location: Tutor_in_carico.php");
                    exit;
                }
                $DB = mysqli_select_db($Connessione, "alternanza");
                if (!$DB) {
                    print("<H1>Connessione al database alternanza fallita</H1>");
                    header("location: Tutor_in_carico.php");
                    exit;
                }
                $query = "SELECT * FROM azienda_richieste, aziende WHERE aziende.Id_azienda=azienda_richieste.Cod_azienda AND azienda_richieste.Id_azienda_richiesta=$Idr AND azienda_richieste.Cod_tutor=".$_SESSION['Id_tutor_pcto'];
                $risultato = mysqli_query($Connessione, $query);
                if (!$risultato) {
                    die("La tabella selezionata non esiste " . mysqli_error($Connessione));
                    header("location: Tutor_in_carico.php");
                }
                $riga = mysqli_fetch_array($risultato);
                if(!isset($riga['Id_azienda_richiesta'])){
                    header("location: Tutor_in_carico.php");
                }
                ?>
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h4">Assegna, elimina o visualizza studenti: richiesta di <a href="" class="text-decoration-none" style="color: #bb2c2e ! important;"><?php print($riga['N_studenti'] . " studenti</a> con specializzazione <a href='' class='text-decoration-none' style='color: #bb2c2e ! important;'>" . $riga['Specializzazione_studenti'] . "</a><br>dal <a href='' class='text-decoration-none' style='color: #bb2c2e ! important;'>" . $riga['Data_inizio_attivita'] . "</a> al <a href='' class='text-decoration-none' style='color: #bb2c2e ! important;'>" . $riga['Data_fine_attivita'] . "</a> per <a href='' class='text-decoration-none' style='color: #bb2c2e ! important;'>" . $riga['Descrizione'] . "</a> dell'azienda <a href='' class='text-decoration-none' style='color: #bb2c2e ! important;'>" . $riga['Denominazione']); ?></a></h1>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <a href="#studente" class="btn btn-sm btn-outline-info" tabindex="-1" role="button" aria-disabled="true">
                                <span data-feather="plus"></span>
                                Assegna un'altro studente alla richiesta
                            </a>
                        </div>
                    </div>
                    <div class="alert alert-info" role="alert">
                        In questa pagina si possono visualizzare, eliminare ed assegnare nuovi studenti alla richiesta già presa in carico, se non si trova il menu per inserire nuovi studenti, cliccare sulla voce <a href="#studente" class="alert-link">Assegna un'altro studente alla richiesta</a> in alto a destra.
                    </div>
                    <h5><a href="" class="text-decoration-none" style="color: #bb2c2e ! important;">Studenti assegnati alla richiesta</a></h5>
                    <?php
                    $query = "SELECT * FROM azienda_richieste, richieste_studenti, anagrafica_studenti, classi_studenti, indirizzi_studenti WHERE azienda_richieste.Id_azienda_richiesta=$Idr AND azienda_richieste.Id_azienda_richiesta=richieste_studenti.Cod_richiesta AND richieste_studenti.Cod_studente=anagrafica_studenti.Id_studente AND anagrafica_studenti.Cod_classe=classi_studenti.Id_classe AND classi_studenti.Cod_indirizzo=indirizzi_studenti.Id_indirizzo ORDER BY anagrafica_studenti.Cognome ASC";
                    $risultato = mysqli_query($Connessione, $query);
                    if (!$risultato) {
                        die("La tabella selezionata non esiste " . mysqli_error($Connessione));
                    }
                    $riga = mysqli_fetch_array($risultato);
                    if (!isset($riga['Cognome'])) {
                    ?>
                        <div class="alert alert-warning" role="alert">
                            Alla richiesta non è associato nessuno studente.
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-sm align-start">
                                <thead>
                                    <tr>
                                        <th>Cognome</th>
                                        <th>Nome</th>
                                        <th>Data di nascita</th>
                                        <th>Sesso</th>
                                        <th>Classe</th>
                                        <th>Indirizzo di studi</th>
                                        <th>Valutazione aziendale</th>
                                        <th>Elimina</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    do {
                                        print("<tr><td>" . $riga['Cognome'] . "</td><td>" . $riga['Nome'] . "</td><td>" . $riga['Data_nascita'] . "</td><td>" . $riga['Sesso'] . "</td><td>" . $riga['Grado'] . $riga['Sezione'] . "</td><td>" . $riga['Denominazione'] . "</td>");
                                        if ($riga['Url_valutazione_aziendale']) {
                                            print("<td><a href='" . $riga['Url_valutazione_aziendale'] . "' target='_blank' class='btn btn-outline-primary' tabindex='-1' role='button' aria-disabled='true'>Scarica qui</a></td>");
                                        } else {
                                            print("<td><div class='alert alert-warning' role='alert' id='ale'>Non inserito</div></td>");
                                        }
                                        print("<td><a href='Tutor_canc_stud.php?Ids=" . $riga['Id_studente'] . "&Idr=" . $Idr . "'  class='btn btn-danger' tabindex='1' role='button' aria-disabled='true'><span data-feather='x'></span></a></td></tr>");
                                    } while ($riga = mysqli_fetch_array($risultato));
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <?php
                    }
                    ?>
                    <p></p>
                    <hr>
                    <p></p>
                    <h5><a href="" name="studente" class="text-decoration-none" name style="color: #bb2c2e ! important;">Assegna un'altro studente alla richiesta</a></h5>
                    <form class="row g-3" action="#" method="POST">
                        <div class="col-md-6">
                            <select class="form-select" aria-label="Default select example" name="stude">
                                <option disabled selected>Seleziona lo studente</option>
                                <?php
                                $query = "SELECT * FROM anagrafica_studenti, classi_studenti, indirizzi_studenti WHERE anagrafica_studenti.Cod_classe=classi_studenti.Id_classe AND classi_studenti.Cod_indirizzo=indirizzi_studenti.Id_indirizzo AND anagrafica_studenti.Id_studente != ALL (SELECT anagrafica_studenti.Id_studente FROM anagrafica_studenti, richieste_studenti WHERE richieste_studenti.Cod_studente=anagrafica_studenti.Id_studente AND richieste_studenti.Cod_richiesta=$Idr) ORDER BY anagrafica_studenti.Cognome ASC";
                                $risultato = mysqli_query($Connessione, $query);
                                if (!$risultato) {
                                    die("La tabella selezionata non esiste " . mysqli_error($Connessione));
                                }
                                while ($riga = mysqli_fetch_array($risultato)) {
                                    print("<option value='" . $riga['Id_studente'] . "'>" . $riga['Cognome'] . " " . $riga['Nome'] . " " . $riga['Grado'] . $riga['Sezione'] . " " . $riga['Denominazione'] . "</option>");
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-success"><span data-feather="user-plus"></span> Assegna</button>
                        </div>
                    </form>
                    <?php
                    if (isset($_POST['stude'])) {
                        $Studente = $_POST['stude'];
                        $query = "INSERT INTO richieste_studenti(`Id_richiesta_studente`, `Url_valutazione_aziendale`, `Cod_richiesta`, `Cod_studente`) VALUES (NULL, 'docs/valutazioni_aziendali/Valutazione_aziendale_standard.docx', $Idr, $Studente)";
                        $risultato = mysqli_query($Connessione, $query);
                        if (!$risultato) {
                            die("La tabella selezionata non esiste " . mysqli_error($Connessione));
                        }
                        mysqli_close($Connessione);
                        header("location: Tutor_in_carico_studenti.php?Id=$Idr");
                    }
                    mysqli_close($Connessione);
                    ?>
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