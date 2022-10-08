<!doctype html>
<?php
session_start();
ob_start();
ini_set('display_errors', 0);
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Privacy policy - Area riservata PCTO</title>
    <link rel="icon" type="image/png" href="asset/img/pcto.png" />
    <link href="asset/css/bootstrap.min.css" rel="stylesheet">
    <?php
    if (isset($_SESSION['Id_tutor_pcto'])) {
    ?>
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

            a {

                color: #bb2c2e;
            }
        </style>

    <?php
    } else if (isset($_SESSION['Id_azienda'])) {
    ?>
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

            a {
                color: #198754;
            }
        </style>
    <?php
    } else if (!isset($_SESSION['Id_tutor_pcto']) && !isset($_SESSION['Id_azienda'])) {
        header("location: index.php?Sessione=Scaduta");
    }

    ?>

    <link href="asset/css/progetto.css" rel="stylesheet">
</head>

<body>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow head_color">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="Privacy_policy.php">Privacy policy</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </header>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <?php
                        if (isset($_SESSION['Id_tutor_pcto'])) {
                        ?>
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
                                <a class="nav-link" href="Tutor_studenti_storico_esperienze.php">
                                    <span data-feather="users"></span>
                                    Storico esperienze studenti
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="Privacy_policy.php">
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
                        <?php
                        } else if (isset($_SESSION['Id_azienda'])) {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="Aziende.php">
                                    <span data-feather="home"></span>
                                    Dati aziendali
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="Aziende_richieste.php">
                                    <span data-feather="users"></span>
                                    Richieste
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="Privacy_policy.php">
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
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h3"><a href="" class="text-decoration-none" <?php if (isset($_SESSION['Id_azienda'])) {
                                                                                print("style='color:#198754;'");
                                                                            } else if (isset($_SESSION['Id_tutor_pcto'])) {
                                                                                print("style='color:#bb2c2e;'");
                                                                            } ?>>Privacy policy</a></h1>
                </div>
                <h2 class="h4"><a href="" class="text-decoration-none" <?php if (isset($_SESSION['Id_azienda'])) {
                                                                            print("style='color:#198754;'");
                                                                        } else if (isset($_SESSION['Id_tutor_pcto'])) {
                                                                            print("style='color:#bb2c2e;'");
                                                                        } ?>>Chi siamo</a></h2>
                <p>Siamo un'istituzione scolastica che si occupa di istruzione superiore, abbiamo creato questo portale web per favorire l'interazione fra docenti ed aziende nel campo dei Percorsi per le Competenze Trasversali e l'Orientamento, in modo da favorire il dialogo, la comunicazione e la decisione in ambo le parti.</p>
                <br>
                <h2 class="h4"><a href="" class="text-decoration-none" <?php if (isset($_SESSION['Id_azienda'])) {
                                                                            print("style='color:#198754;'");
                                                                        } else if (isset($_SESSION['Id_tutor_pcto'])) {
                                                                            print("style='color:#bb2c2e;'");
                                                                        } ?>>Con chi condividiamo i tuoi dati</a></h2>
                <p>Tutti i dati che caratterizzano le aziende, i tutor e gli studenti non vengono ne condivisi e ne inoltrati a nessun ente esterno al di fuori dell'istituzione scolastica e del MIUR, che gestisce i Percorsi per le Competenze Trasversali e l'Orientamento o PCTO. Inoltre, all'interno del portale i dati delle aziende sono visualizzabili dai soli tutor, i dati degli studenti sono visualizzabili dai tutor e dalle aziende presso le quali gli stessi alunni svolgeranno le attività ed infine i dati dei tutor possono essere visualizzati dalle aziende solo nel caso in cui ci sia un contratto tra le parti.</p>
                <br>
                <h2 class="h4"><a href="" class="text-decoration-none" <?php if (isset($_SESSION['Id_azienda'])) {
                                                                            print("style='color:#198754;'");
                                                                        } else if (isset($_SESSION['Id_tutor_pcto'])) {
                                                                            print("style='color:#bb2c2e;'");
                                                                        } ?>>Per quanto tempo conserviamo i tuoi dati</a></h2>
                <p></p>
                <p>I tuoi dati saranno conservati nel database ufficiale, riservato ai dati delle attività PCTO ed a seconda dell'individuo riserviamo un tempo personalizzato di memorizzazione dei dati, nello specifico:</p>
                <p>- I dati delle aziende saranno conservati fino a quando l'azienda stessa non ne richiederà la cancellazione o eventuale oblio.</p>
                <p>- I dati degli studenti saranno conservati per l'intera durata del ciclo d'istruzione triennale in cui effettueranno attività PCTO.</p>
                <p>- I dati dei tutor saranno conservati fino a quando il docente, ricoprirà il ruolo di tutor PCTO all'interno dell'istituzione scolastica o fino a quando egli stesso lavorerà presso l'istituzione scolastica.</p>
                </p>
                <br>
                <h2 class="h4"><a href="" class="text-decoration-none" <?php if (isset($_SESSION['Id_azienda'])) {
                                                                            print("style='color:#198754;'");
                                                                        } else if (isset($_SESSION['Id_tutor_pcto'])) {
                                                                            print("style='color:#bb2c2e;'");
                                                                        } ?>>Quali diritti hai sui tuoi dati</a></h2>
                <p>Puoi richiedere in qualunque momento una copia di tutti i dati da te prodotti durante l'uso del portale ed hai diritto a reclamare la cancellazione di tutti i dati che ti riguardano all'interno del database ufficiale.</p>
                <br>
                <h2 class="h4"><a href="" class="text-decoration-none" <?php if (isset($_SESSION['Id_azienda'])) {
                                                                            print("style='color:#198754;'");
                                                                        } else if (isset($_SESSION['Id_tutor_pcto'])) {
                                                                            print("style='color:#bb2c2e;'");
                                                                        } ?>>Come transitano i tuoi dati</a></h2>
                <p>I dati da te comunicati o inseriti saranno trattati secondo le norme sulla sicurezza dettate dallo Stato, ovvero con una trasmissione ed un'archiviazione sicura, per questo il portale utilizza alcune tipologie di crittografie comprese nei protocolli standard di internet ed allo stesso tempo tutti i tuoi dati saranno archiviati nel database dell'istituzione scolastica favorendo la sicurezza e la cifratura.</p>
                <div class="footer col-md-9 ms-sm-auto col-lg-10 px-md-4" role="alert">
                    Sviluppo a cura di <strong><a href="" class="text-decoration-none" <?php if (isset($_SESSION['Id_azienda'])) {
                                                                                            print("style='color:#198754;'");
                                                                                        } else if (isset($_SESSION['Id_tutor_pcto'])) {
                                                                                            print("style='color:#bb2c2e;'");
                                                                                        } ?>>Antonio Caiafa</a></strong> V A Informatica - a.s. 2020/2021 <strong><a href="https://www.itcgtursi.edu.it/" target="_blank" class="text-decoration-none" <?php if (isset($_SESSION['Id_azienda'])) {
                                                                                                                                                                                                                                                            print("style='color:#198754;'");
                                                                                                                                                                                                                                                        } else if (isset($_SESSION['Id_tutor_pcto'])) {
                                                                                                                                                                                                                                                            print("style='color:#bb2c2e;'");
                                                                                                                                                                                                                                                        } ?>> ITSET "Manlio Capitolo" Tursi (MT)</a></strong>
                </div>
            </main>
        </div>
    </div>
    <script src="asset/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="asset/js/progetto.js"></script>
</body>

</html>