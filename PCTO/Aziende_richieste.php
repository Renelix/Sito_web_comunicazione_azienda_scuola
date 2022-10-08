<!doctype html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Azienda - Area riservata PCTO</title>
  <link rel="icon" type="image/png" href="asset/img/pcto.png" />
  <link href="asset/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      var parametri = location.search;
      if (parametri == "?Studenti=Nessuno") {
        $("#studenti").removeClass("nascosto");
      } else if (parametri == "?Inserimento=Fallito") {
        $("#ifallito").removeClass("nascosto");
      } else if (parametri == "?Inserimento=Effettuato") {
        $("#ieffettuato").removeClass("nascosto");
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

    .nascosto {
      display: none;
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
            <h1 class="h3"><a href="" style="color:#198754;" class="text-decoration-none">Richieste effettuate</a></h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <a href="Aziende_richieste_nuova.php" class="btn btn-sm btn-outline-success" tabindex="-1" role="button" aria-disabled="true">
                <span data-feather="plus"></span>
                Effettua una nuova richiesta
              </a>
            </div>
          </div>
          <div class="alert alert-info" role="alert">
            In questa pagina si possono visualizzare dettagliatamente le richieste effettuate nei confronti della scuola, inoltre è possibile scaricare il contratto nel caso in cui la richiesta sia stata presa in carico da un tutor, è possibile eliminare una richiesta solamente se quest'ultima non sia stata ancora presa in carico da nessun tutor. Inoltre è possibile visualizzare dettagliatamente una richiesta comprensiva del contatto, del docente tutor e dei dati relativi agli alunni che prenderanno parte all'attività; infine, con l'apposito pulsante sarà possibile effettuare una nuova richiesta.
          </div>
          <div class="alert alert-warning nascosto" role="alert" id="studenti">
            Ci dispiace, ma alla richiesta selezionata non è stato ancora associato nessuno studente e nessun tutor.
          </div>
          <div class="alert alert-danger nascosto" role="alert" id="ifallito">
            Inoltro richiesta non riuscito, si prega di riprovare.
          </div>
          <div class="alert alert-success nascosto" role="alert" id="ieffettuato">
            Richiesta effettuata con successo.
          </div>
          <div class="table-responsive">
            <table class="table table-striped table-sm align-middle">
              <thead>
                <tr>
                  <th>Descrizione</th>
                  <th>Numero studenti</th>
                  <th>Specializzazione</th>
                  <th>Data inizio</th>
                  <th>Data fine</th>
                  <th>Contratto</th>
                  <th>Elimina</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
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
                $query = "SELECT * FROM azienda_richieste WHERE azienda_richieste.Cod_azienda=" . $_SESSION['Id_azienda'] . " ORDER BY azienda_richieste.Id_azienda_richiesta DESC";
                $risultato = mysqli_query($Connessione, $query);
                if (!$risultato) {
                  die("La tabella selezionata non esiste " . mysqli_error($Connessione));
                }
                while ($riga = mysqli_fetch_array($risultato)) {
                  print("<tr><td>" . $riga['Descrizione'] . "</td><td>" . $riga['N_studenti'] . "</td><td>" . $riga['Specializzazione_studenti'] . "</td><td>" . $riga['Data_inizio_attivita'] . "</td><td>" . $riga['Data_fine_attivita'] . "</td>");
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
                  if (!$riga['Cod_tutor']) {
                    print("<td><a href='Aziende_canc_richiesta.php?Idr=" . $riga['Id_azienda_richiesta'] . "'  class='btn btn-danger' tabindex='1' role='button' aria-disabled='true'><span data-feather='x'></span></a></td>");
                  } else {
                    print("<td><p></p><div class='alert alert-warning' role='alert'>Non possibile</div></td>");
                  }
                  print("<td><a href='Aziende_richieste_dettagli.php?id=" . $riga['Id_azienda_richiesta'] . "' class='btn btn-outline-primary' tabindex='-1' role='button' aria-disabled='true'>Dettagli</a></td></tr>");
                }
                mysqli_close($Connessione);
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