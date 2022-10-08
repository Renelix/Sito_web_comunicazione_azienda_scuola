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
                                <a class="nav-link active" aria-current="page" href="Tutor.php">
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
                        <h1 class="h3">Benvenuto <a href="" class="text-decoration-none" style="color: #bb2c2e ! important;"><?php print($riga['Nome'] . " " . $riga['Cognome']); ?></a>, nell'area riservata ai tutor.</h1>
                    </div>
                    <div class="alert alert-info" role="alert">
                        In questa pagina puoi visualizzare i tuoi dati anagrafici non modificabili in questo portale da te, per questo, se noti qualche incongruenza, ti preghiamo di comunicarlo all'assistenza scolastica.
                    </div>
                    <div class="container">
                        <div class="row justify-content-between">
                            <div class="col-12">
                                <h5><a href="" class="text-decoration-none" style="color: #bb2c2e ! important;">Dati personali</a></h5>
                                <div class="table-responsive">
                                    <table class="table table-striped table-sm align-start">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($riga['Nome']) {
                                                print("<tr><td>Nome</td><td>" . $riga['Nome'] . "</td></tr>");
                                            } else {
                                                print("<tr><td>Nome</td><td><div class='alert alert-warning' role'alert' id='ale'>Non inserito</div></td></tr>");
                                            }
                                            if ($riga['Cognome']) {
                                                print("<tr><td>Cognome</td><td>" . $riga['Cognome'] . "</td></tr>");
                                            } else {
                                                print("<tr><td>Cognome</td><td><div class='alert alert-warning' role='alert' id='ale'>Non inserito</div></td></tr>");
                                            }
                                            if ($riga['Data_nascita']) {
                                                print("<tr><td>Data di nascita</td><td>" . $riga['Data_nascita'] . "</td></tr>");
                                            } else {
                                                print("<tr><td>Data di nascita</td><td><div class='alert alert-warning' role='alert' id='ale'>Non inserito</div></td></tr>");
                                            }
                                            if ($riga['Sesso']) {
                                                print("<tr><td>Sesso</td><td>" . $riga['Sesso'] . "</td></tr>");
                                            } else {
                                                print("<tr><td>Sesso</td><td><div class='alert alert-warning' role='alert' id='ale'>Non inserito</div></td></tr>");
                                            }
                                            if ($riga['Email']) {
                                                print("<tr><td>E-mail</td><td>" . $riga['Email'] . "</td></tr>");
                                            } else {
                                                print("<tr><td>E-mail</td><td><div class='alert alert-warning' role='alert' id='ale'>Non inserito</div></td></tr>");
                                            }
                                            if ($riga['Telefono']) {
                                                print("<tr><td>Telefono</td><td>" . $riga['Telefono'] . "</td></tr>");
                                            } else {
                                                print("<tr><td>Telefono</td><td><div class='alert alert-warning' role='alert' id='ale'>Non inserito</div></td></tr>");
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <h5><a href="" class="text-decoration-none" style="color: #bb2c2e ! important;">Dati residenza</a></h5>
                                <div class="table-responsive">
                                    <table class="table table-striped table-sm align-middle">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($riga['Stato_residenza']) {
                                                print("<tr><td>Stato</td><td>" . $riga['Stato_residenza'] . "</td></tr>");
                                            } else {
                                                print("<tr><td>Stato</td><td><div class='alert alert-warning' role='alert' id='ale'>Non inserito</div></td></tr>");
                                            }
                                            if ($riga['Regione_residenza']) {
                                                print("<tr><td>Regione</td><td>" . $riga['Regione_residenza'] . "</td></tr>");
                                            } else {
                                                print("<tr><td>Regione</td><td><div class='alert alert-warning' role='alert' id='ale'>Non inserito</div></td></tr>");
                                            }
                                            if ($riga['Provincia_residenza']) {
                                                print("<tr><td>Provincia</td><td>" . $riga['Provincia_residenza'] . "</td></tr>");
                                            } else {
                                                print("<tr><td>Provincia</td><td><div class='alert alert-warning' role='alert' id='ale'>Non inserito</div></td></tr>");
                                            }
                                            if ($riga['Citta_residenza']) {
                                                print("<tr><td>Citta</td><td>" . $riga['Citta_residenza'] . "</td></tr>");
                                            } else {
                                                print("<tr><td>Citta</td><td><div class='alert alert-warning' role='alert' id='ale'>Non inserito</div></td></tr>");
                                            }
                                            if ($riga['Indirizzo_residenza']) {
                                                print("<tr><td>Indirizzo</td><td>" . $riga['Indirizzo_residenza'] . "</td></tr>");
                                            } else {
                                                print("<tr><td>Indirizzo</td><td><div class='alert alert-warning' role='alert' id='ale'>Non inserito</div></td></tr>");
                                            }
                                            if ($riga['N_civico_residenza']) {
                                                print("<tr><td>Civico</td><td>" . $riga['N_civico_residenza'] . "</td></tr>");
                                            } else {
                                                print("<tr><td>Civico</td><td><div class='alert alert-warning' role='alert' id='ale'>Non inserito</div></td></tr>");
                                            }
                                            mysqli_close($Connessione);
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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