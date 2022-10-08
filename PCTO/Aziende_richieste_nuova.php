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

        .form-control:focus {
            border-color: #19826d;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(25, 130, 109, 0.6);
        }
    </style>
    <link href="asset/css/progetto.css" rel="stylesheet">
</head>
<?php
ob_start();
session_start();
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
                        <h1 class="h3"><a href="" style="color:#198754;" class="text-decoration-none">Nuova richiesta</a></h1>
                    </div>
                    <div class="alert alert-info" role="alert">
                        In questa pagina è possibile inserire i dati per effettuare una nuova richiesta.
                    </div>
                    <form class="row g-3" action="#" method="POST">
                        <div class="col-12">
                            <label for="inputdesc" class="form-label">Descrizione attività</label>
                            <input type="text" class="form-control" id="inputdesc" name="descr" required>
                        </div>
                        <div class="col-md-4">
                            <label for="inputstudenti" class="form-label">Numero studenti</label>
                            <input type="text" class="form-control" id="inputstudenti" name="nstudenti" required>
                        </div>
                        <div class="col-md-4">
                            <label for="inputdate" class="form-label">Data inizio attività</label>
                            <input type="date" class="form-control" id="inputdate" name="datai" min="<?php print(date("Y-m-d")); ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label for="inputdate1" class="form-label">Data fine attività</label>
                            <input type="date" class="form-control" id="inputdate1" name="dataf" min="<?php print(date("Y-m-d")); ?>" required>
                        </div>
                        <div class="col-12">
                            <label for="inputspecializzazione" class="form-label">Specializzazione</label>
                            <input type="text" class="form-control" id="inputspecializzazione" name="spe" required>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-success"><span data-feather="plus-circle"></span> Effettua richiesta</button>
                        </div>
                    </form>
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
    ini_set('display_errors', 0);
    if (isset($_POST['descr'])) {
        $descrizione = $_POST['descr'];
        $numero = $_POST['nstudenti'];
        $datai = $_POST['datai'];
        $dataf = $_POST['dataf'];
        $spe = $_POST['spe'];
        $Connessione = mysqli_connect("localhost", "root", "");
        if (!$Connessione) {
            header("location: Aziende_richieste.php?Inserimento=Fallito");
            exit;
        }
        $DB = mysqli_select_db($Connessione, "alternanza");
        if (!$DB) {
            header("location: Aziende_richieste.php?Inserimento=Fallito");
            exit;
        }
        $query = "INSERT INTO azienda_richieste(`Id_azienda_richiesta`, `Descrizione`, `N_studenti`, `Specializzazione_studenti`, `Data_inizio_attivita`, `Data_fine_attivita`, `Url_contratto`, `Cod_azienda`, `Cod_tutor`) VALUES (NULL, '$descrizione', $numero, '$spe', '$datai', '$dataf', NULL, " . $_SESSION['Id_azienda'] . ", NULL)";
        $risultato = mysqli_query($Connessione, $query);
        if (!$risultato) {
            header("location: Aziende_richieste.php?Inserimento=Fallito");
            exit;
        }
        header("location: Aziende_richieste.php?Inserimento=Effettuato");
        mysqli_close($Connessione);
    }
} else {
    header("location: index.php?Sessione=Scaduta");
}
?>

</html>