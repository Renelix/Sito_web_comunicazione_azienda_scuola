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
                                <a class="nav-link" href="Tutor_in_carico.php">
                                    <span data-feather="server"></span>
                                    Richieste in carico
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="Tutor_studenti_storico_esperienze.php">
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
                ?>
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h3"><a href="" class="text-decoration-none" style="color: #bb2c2e ! important;">Storico delle esperienze svolte da uno studente</a></h1>
                        <form class="row g-3" action="#" method="POST">
                            <select class="form-select" aria-label="Default select example" name="stude">
                                <option disabled selected>Seleziona lo studente</option>
                                <?php
                                $query = "SELECT * FROM anagrafica_studenti, classi_studenti, indirizzi_studenti, richieste_studenti WHERE anagrafica_studenti.Cod_classe=classi_studenti.Id_classe AND classi_studenti.Cod_indirizzo=indirizzi_studenti.Id_indirizzo AND richieste_studenti.Cod_studente=anagrafica_studenti.Id_studente GROUP BY anagrafica_studenti.Cognome ASC";
                                $risultato = mysqli_query($Connessione, $query);
                                if (!$risultato) {
                                    die("La tabella selezionata non esiste " . mysqli_error($Connessione));
                                }
                                while ($riga = mysqli_fetch_array($risultato)) {
                                    print("<option value='" . $riga['Id_studente'] . "'>" . $riga['Cognome'] . " " . $riga['Nome'] . " " . $riga['Grado'] . $riga['Sezione'] . " " . $riga['Denominazione'] . "</option>");
                                }
                                ?>
                            </select>
                            <button type="submit" class="btn btn-success"><span data-feather="search"></span> Ricerca</button>
                        </form>
                    </div>
                    <div class="alert alert-info" role="alert">
                        In questa pagina si può selezionare uno studente e visualizzarne lo storico delle esperienze, comprensive del contratto con l'azienda, del documento di valutazione aziendale e dei dettagli dell'azienda che ha proposto l'attivita PCTO.
                    </div>
                    <?php
                    if (isset($_POST['stude'])) {
                        $Studente = $_POST['stude'];
                    ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-sm align-start">
                                <thead>
                                    <tr>
                                        <th>Azienda</th>
                                        <th>Descrizione</th>
                                        <th>Data inizio</th>
                                        <th>Data fine</th>
                                        <th>Contratto</th>
                                        <th>Valutazione aziendale</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM aziende, azienda_richieste, richieste_studenti, tutor_pcto WHERE aziende.Id_azienda=azienda_richieste.Cod_azienda AND azienda_richieste.Cod_tutor=tutor_pcto.Id_tutor_pcto AND azienda_richieste.Id_azienda_richiesta=richieste_studenti.Cod_richiesta AND richieste_studenti.Cod_studente=$Studente ORDER BY azienda_richieste.Id_azienda_richiesta DESC";
                                    $risultato = mysqli_query($Connessione, $query);
                                    if (!$risultato) {
                                        die("La tabella selezionata non esiste " . mysqli_error($Connessione));
                                    }
                                    while ($riga = mysqli_fetch_array($risultato)) {
                                        print("<tr><td>" . $riga['Denominazione'] . "</td><td>" . $riga['Descrizione'] . "</td><td>" . $riga['Data_inizio_attivita'] . "</td><td>" . $riga['Data_fine_attivita'] . "</td>");
                                        if ($riga['Url_contratto']) {
                                            print("<td><a href='" . $riga['Url_contratto'] . "' target='_blank'  class='btn btn-outline-success' tabindex='1' role='button' aria-disabled='true'>Scarica qui</a></td>");
                                        } else {
                                    ?>
                                            <td>
                                                <p></p>
                                                <div class="alert alert-danger" role="alert">
                                                    Ancora non presente
                                                </div>
                                            </td>
                                        <?php
                                        }
                                        if ($riga['Url_valutazione_aziendale']) {
                                            print("<td><a href='" . $riga['Url_valutazione_aziendale'] . "' target='_blank'  class='btn btn-outline-danger' tabindex='1' role='button' aria-disabled='true'>Scarica qui</a></td>");
                                        } else {
                                        ?>
                                            <td>
                                                <p></p>
                                                <div class="alert alert-danger" role="alert">
                                                    Ancora non presente
                                                </div>
                                            </td>
                                    <?php
                                        }
                                        print("<td><a href='Tutor_aziende_dettagli.php?Id=" . $riga['Id_azienda'] . "' class='btn btn-outline-primary' tabindex='-1' role='button' aria-disabled='true'>Dettaglio azienda</a></td></tr>");
                                    }
                                    mysqli_close($Connessione);
                                    ?>
                                </tbody>
                                </tbody>
                            </table>
                        </div>
                    <?php
                    }
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