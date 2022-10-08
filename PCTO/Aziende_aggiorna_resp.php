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
    ini_set('display_errors', 0);
    $Connessione = mysqli_connect("localhost", "root", "");
    if (!$Connessione) {
        header("location: Aziende.php?Aggiornamento=Fallito");
        exit;
    }
    $DB = mysqli_select_db($Connessione, "alternanza");
    if (!$DB) {
        header("location: Aziende.php?Aggiornamento=Fallito");
        exit;
    }

    if (isset($_GET['Referente'])) {
        $query = "SELECT Cod_referente_aziendale FROM aziende WHERE aziende.Id_azienda=" . $_SESSION['Id_azienda'];
        $risultato = mysqli_query($Connessione, $query);
        $riga = mysqli_fetch_array($risultato);
        if (isset($riga['Cod_referente_aziendale'])) {
            $Id = $riga['Cod_referente_aziendale'];
        }
    } else if (isset($_GET['Responsabile'])) {
        $query = "SELECT Cod_responsabile FROM aziende WHERE aziende.Id_azienda=" . $_SESSION['Id_azienda'];
        $risultato = mysqli_query($Connessione, $query);
        $riga = mysqli_fetch_array($risultato);
        if (isset($riga['Cod_responsabile'])) {
            $Id = $riga['Cod_responsabile'];
        }
    } else if (!isset($_GET['Responsabile']) && !isset($_GET['Referente'])) {
        header("location: Aziende.php?Aggiornamento=Fallito");
    }


    if (isset($_POST['nome'])) {
        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];
        $data = $_POST['data'];
        $sesso = $_POST['sesso'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $stato = $_POST['stato'];
        $regione = $_POST['regione'];
        $provincia = $_POST['provincia'];
        $citta = $_POST['citta'];
        $via = $_POST['via'];
        $civico = $_POST['civico'];
        if ($Id != NULL) {
            $query = "UPDATE referenti_responsabili SET referenti_responsabili.Nome = '$nome' WHERE referenti_responsabili.Id_referente_responsabile=" . $Id;
            $risultato = mysqli_query($Connessione, $query);
            $query = "UPDATE referenti_responsabili SET referenti_responsabili.Cognome = '$cognome' WHERE referenti_responsabili.Id_referente_responsabile=" . $Id;
            $risultato = mysqli_query($Connessione, $query);
            $query = "UPDATE referenti_responsabili SET referenti_responsabili.Data_nascita = '$data' WHERE referenti_responsabili.Id_referente_responsabile=" . $Id;
            $risultato = mysqli_query($Connessione, $query);
            $query = "UPDATE referenti_responsabili SET referenti_responsabili.Sesso = '$sesso' WHERE referenti_responsabili.Id_referente_responsabile=" . $Id;
            $risultato = mysqli_query($Connessione, $query);
            $query = "UPDATE referenti_responsabili SET referenti_responsabili.Email = '$email' WHERE referenti_responsabili.Id_referente_responsabile=" . $Id;
            $risultato = mysqli_query($Connessione, $query);
            $query = "UPDATE referenti_responsabili SET referenti_responsabili.Telefono = $telefono WHERE referenti_responsabili.Id_referente_responsabile=" . $Id;
            $risultato = mysqli_query($Connessione, $query);
            $query = "UPDATE referenti_responsabili SET referenti_responsabili.Stato_residenza = '$stato' WHERE referenti_responsabili.Id_referente_responsabile=" . $Id;
            $risultato = mysqli_query($Connessione, $query);
            $query = "UPDATE referenti_responsabili SET referenti_responsabili.Regione_residenza = '$regione' WHERE referenti_responsabili.Id_referente_responsabile=" . $Id;
            $risultato = mysqli_query($Connessione, $query);
            $query = "UPDATE referenti_responsabili SET referenti_responsabili.Provincia_residenza = '$provincia' WHERE referenti_responsabili.Id_referente_responsabile=" . $Id;
            $risultato = mysqli_query($Connessione, $query);
            $query = "UPDATE referenti_responsabili SET referenti_responsabili.Citta_residenza = '$citta' WHERE referenti_responsabili.Id_referente_responsabile=" . $Id;
            $risultato = mysqli_query($Connessione, $query);
            $query = "UPDATE referenti_responsabili SET referenti_responsabili.Indirizzo_residenza = '$via' WHERE referenti_responsabili.Id_referente_responsabile=" . $Id;
            $risultato = mysqli_query($Connessione, $query);
            $query = "UPDATE referenti_responsabili SET referenti_responsabili.N_civico_residenza= $civico WHERE referenti_responsabili.Id_referente_responsabile=" . $Id;
            $risultato = mysqli_query($Connessione, $query);
        } else {
            $i = 0;
            $query = "SELECT referenti_responsabili.Id_referente_responsabile FROM referenti_responsabili";
            $risultato = mysqli_query($Connessione, $query);
            $i = mysqli_num_rows($risultato);
            $i++;
            print($i);
            $query = "INSERT INTO referenti_responsabili(`Id_referente_responsabile`, `Nome`, `Cognome`, `Data_nascita`, `Sesso`, `Email`, `Telefono`, `Stato_residenza`, `Regione_residenza`, `Provincia_residenza`, `Citta_residenza`, `Indirizzo_residenza`, `N_civico_residenza`) VALUES ($i, '$nome', '$cognome', '$data', '$sesso', '$email', $telefono, '$stato', '$regione', '$provincia', '$citta', '$via', $civico)";
            $risultato = mysqli_query($Connessione, $query);
            if (isset($_GET['Referente'])) {
                $query = "UPDATE aziende SET aziende.Cod_referente_aziendale=$i WHERE aziende.Id_azienda=" . $_SESSION['Id_azienda'];
                $risultato = mysqli_query($Connessione, $query);
            } else if (isset($_GET['Responsabile'])) {
                $query = "UPDATE aziende SET aziende.Cod_responsabile=$i WHERE aziende.Id_azienda=" . $_SESSION['Id_azienda'];
                $risultato = mysqli_query($Connessione, $query);
            }
        }
        if (!$risultato) {
            header("location: Aziende.php?Aggiornamento=Fallito");
            exit;
        }
        header("location: Aziende.php?Aggiornamento=Effettuato");
    } else {
        $query = "SELECT * FROM referenti_responsabili WHERE referenti_responsabili.Id_referente_responsabile=" . $Id;
        $risultato = mysqli_query($Connessione, $query);
        if ($risultato) {
            $riga = mysqli_fetch_array($risultato);
        }
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
                                    <a class="nav-link active" aria-current="page" href="Aziende.php">
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
                            <h1 class="h3"><a href="" style="color:#198754;" class="text-decoration-none">Aggiornamento o Inserimento dati responsabili</a></h1>
                        </div>
                        <div class="alert alert-info" role="alert">
                            In questa pagina è possibile aggiornare o inserire i dati anagrafici dei responsabili aziendali che verranno mostrati nella pagina principale.
                        </div>
                        <form class="row g-3" action="#" method="POST">
                            <div class="col-md-6">
                                <label for="nom" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="nom" name="nome" value="<?php if ($risultato) {
                                                                                                        print($riga['Nome']);
                                                                                                    } ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="cogn" class="form-label">Cognome</label>
                                <input type="text" class="form-control" id="cogn" name="cognome" value="<?php if ($risultato) {
                                                                                                            print($riga['Cognome']);
                                                                                                        } ?>" required>
                            </div>
                            <div class="col-md-5">
                                <label for="dat" class="form-label">Data di nascita</label>
                                <input type="date" class="form-control" id="dat" name="data" value="<?php if ($risultato) {
                                                                                                        print($riga['Data_nascita']);
                                                                                                    } ?>" required>
                            </div>
                            <div class="col-md-2">
                                <label for="se" class="form-label">Sesso (un solo carattere maiuscolo)</label>
                                <input type="text" class="form-control" id="se" name="sesso" value="<?php if ($risultato) {
                                                                                                        print($riga['Sesso']);
                                                                                                    } ?>" required>
                            </div>
                            <div class="col-md-5">
                                <label for="tel" class="form-label">Telefono</label>
                                <input type="text" class="form-control" id="tel" name="telefono" value="<?php if ($risultato) {
                                                                                                            print($riga['Telefono']);
                                                                                                        } ?>" required>
                            </div>
                            <div class="col-12">
                                <label for="email1" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="email1" name="email" value="<?php if ($risultato) {
                                                                                                                print($riga['Email']);
                                                                                                            } ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label for="sta" class="form-label">Stato di residenza</label>
                                <input type="text" class="form-control" id="sta" name="stato" value="<?php if ($risultato) {
                                                                                                            print($riga['Stato_residenza']);
                                                                                                        } ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label for="regio" class="form-label">Regione di residenza</label>
                                <input type="text" class="form-control" id="regio" name="regione" value="<?php if ($risultato) {
                                                                                                                print($riga['Regione_residenza']);
                                                                                                            } ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label for="prov" class="form-label">Provincia di residenza</label>
                                <input type="text" class="form-control" id="prov" name="provincia" value="<?php if ($risultato) {
                                                                                                                print($riga['Provincia_residenza']);
                                                                                                            } ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label for="citt" class="form-label">Citta di residenza</label>
                                <input type="text" class="form-control" id="citt" name="citta" value="<?php if ($risultato) {
                                                                                                            print($riga['Citta_residenza']);
                                                                                                        } ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label for="via1" class="form-label">Via di residenza</label>
                                <input type="text" class="form-control" id="via1" name="via" value="<?php if ($risultato) {
                                                                                                        print($riga['Indirizzo_residenza']);
                                                                                                    } ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label for="n_civico" class="form-label">Numero civico di residenza</label>
                                <input type="text" class="form-control" id="n_civico" name="civico" value="<?php if ($risultato) {
                                                                                                                print($riga['N_civico_residenza']);
                                                                                                            } ?>" required>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-outline-primary"><span data-feather="arrow-up"></span> Aggiorna dati</button>
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
    }
    mysqli_close($Connessione);
} else {
    header("location: index.php?Sessione=Scaduta");
}
?>

</html>