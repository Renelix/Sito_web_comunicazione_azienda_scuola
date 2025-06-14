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
      if (parametri == "?Aggiornamento=Fallito") {
        $("#ifallito").removeClass("nascosto");
      } else if (parametri == "?Aggiornamento=Effettuato") {
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

    #ale {
      margin-bottom: 1px;
      height: 30px;
      line-height: 30px;
      padding: 0px 15px;
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
            <ul class="nav flex-column mb-auto">
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
            <h1 class="h3">Benvenuto <a href="" style="color:#198754;" class="text-decoration-none"><?php print($_SESSION['Denominazione']); ?></a>, nell'area riservata alle aziende.</h1>
          </div>
          <div class="alert alert-info" role="alert">
            In questa pagina vengono visualizzati i dati identificativi relativi all'azienda e dei suoi responsabili, con la quale viene effettuato l'accesso, se i dati non sono stati ancora inseriti invitiamo ad inserirli e se sono stati già inseriti sono modificarli in qualsiasi momento, grazie agli appositi pulsanti.
          </div>
          <div class="alert alert-danger nascosto" role="alert" id="ifallito">
            Aggiornamento o inserimento fallito, si prega di riprovare.
          </div>
          <div class="alert alert-success nascosto" role="alert" id="ieffettuato">
            Aggiornamento o inserimento effettuato con successo.
          </div>
          <div class="container">
            <div class="row justify-content-between">
              <div class="col-md-8">
                <h5><a href="" style="color:#198754;" class="text-decoration-none">Dati aziendali</a></h5>
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
                      $query = "SELECT * FROM aziende WHERE aziende.Id_azienda=" . $_SESSION['Id_azienda'];
                      $risultato = mysqli_query($Connessione, $query);
                      if (!$risultato) {
                        die("La tabella selezionata non esiste " . mysqli_error($Connessione));
                      }
                      $riga = mysqli_fetch_array($risultato);
                      if ($riga['Denominazione']) {
                        print("<tr><td>Denominazione</td><td>" . $riga['Denominazione'] . "</td></tr>");
                      } else {
                        print("<tr><td>Denominazione</td><td><div class='alert alert-warning' role'alert' id='ale'>Non inserito</div></td></tr>");
                      }
                      if ($riga['Email_certificata']) {
                        print("<tr><td>Email certificata</td><td>" . $riga['Email_certificata'] . "</td></tr>");
                      } else {
                        print("<tr><td>Email certificata</td><td><div class='alert alert-warning' role='alert' id='ale'>Non inserito</div></td></tr>");
                      }
                      if ($riga['Telefono']) {
                        print("<tr><td>Telefono</td><td>" . $riga['Telefono'] . "</td></tr>");
                      } else {
                        print("<tr><td>Telefono</td><td><div class='alert alert-warning' role='alert' id='ale'>Non inserito</div></td></tr>");
                      }
                      if ($riga['Stato_sede']) {
                        print("<tr><td>Stato</td><td>" . $riga['Stato_sede'] . "</td></tr>");
                      } else {
                        print("<tr><td>Stato</td><td><div class='alert alert-warning' role='alert' id='ale'>Non inserito</div></td></tr>");
                      }
                      if ($riga['Regione_sede']) {
                        print("<tr><td>Regione</td><td>" . $riga['Regione_sede'] . "</td></tr>");
                      } else {
                        print("<tr><td>Regione</td><td><div class='alert alert-warning' role='alert' id='ale'>Non inserito</div></td></tr>");
                      }
                      if ($riga['Provincia_sede']) {
                        print("<tr><td>Provincia</td><td>" . $riga['Provincia_sede'] . "</td></tr>");
                      } else {
                        print("<tr><td>Provincia</td><td><div class='alert alert-warning' role='alert' id='ale'>Non inserito</div></td></tr>");
                      }
                      if ($riga['Citta_sede']) {
                        print("<tr><td>Citta</td><td>" . $riga['Citta_sede'] . "</td></tr>");
                      } else {
                        print("<tr><td>Citta</td><td><div class='alert alert-warning' role='alert' id='ale'>Non inserito</div></td></tr>");
                      }
                      if ($riga['Via_sede']) {
                        print("<tr><td>Via</td><td>" . $riga['Via_sede'] . "</td></tr>");
                      } else {
                        print("<tr><td>Via</td><td><div class='alert alert-warning' role='alert' id='ale'>Non inserito</div></td></tr>");
                      }
                      if ($riga['N_civico_sede']) {
                        print("<tr><td>Numero civico</td><td>" . $riga['N_civico_sede'] . "</td></tr>");
                      } else {
                        print("<tr><td>Numero civico</td><td><div class='alert alert-warning' role='alert' id='ale'>Non inserito</div></td></tr>");
                      }
                      if ($riga['Url_convenzione']) {
                        print("<tr><td>Convenzione</td><td><a href='" . $riga['Url_convenzione'] . "' target='_blank' style='text-align:center;' class='btn btn-outline-success' tabindex='-1' role='button' aria-disabled='true'>Scarica qui</a></td></tr>");
                      } else {
                        print("<tr><td>Convenzione</td><td><div class='alert alert-warning' role='alert' id='ale'>Non inserito</div></td></tr>");
                      }
                      $Referente = $riga['Cod_referente_aziendale'];
                      $Responsabile = $riga['Cod_responsabile'];
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="col-md-4 align-self-center text-center">
                <a href="Aziende_aggiorna_dati.php" style="text-align:center;" class="btn btn-outline-primary" tabindex="-1" role="button" aria-disabled="true">Aggiorna o inserisci i dati aziendali</a>
              </div>
            </div>
          </div>
          <hr>
          <div class="container">
            <div class="row justify-content-between">
              <div class="col-md-8">
                <h5><a href="" style="color:#198754;" class="text-decoration-none">Dati referente aziendale</a></h5>
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
                      $query = "SELECT * FROM referenti_responsabili WHERE referenti_responsabili.Id_referente_responsabile=" . $Referente;
                      $risultato = mysqli_query($Connessione, $query);
                      if ($risultato) {
                        $riga = mysqli_fetch_array($risultato);
                        print("<tr><td>Nome</td><td>" . $riga['Nome'] . "</td></tr>");
                        print("<tr><td>Cognome</td><td>" . $riga['Cognome'] . "</td></tr>");
                        print("<tr><td>Data di nascita</td><td>" . $riga['Data_nascita'] . "</td></tr>");
                        print("<tr><td>Sesso</td><td>" . $riga['Sesso'] . "</td></tr>");
                        print("<tr><td>E-mail</td><td>" . $riga['Email'] . "</td></tr>");
                        print("<tr><td>Telefono</td><td>" . $riga['Telefono'] . "</td></tr>");
                        print("<tr><td>Indirizzo</td><td>" . $riga['Stato_residenza'] . ", " . $riga['Regione_residenza'] . ", " . $riga['Provincia_residenza'] . ", " . $riga['Citta_residenza'] . ", " . $riga['Indirizzo_residenza'] . " n. " . $riga['N_civico_residenza'] . "</td></tr></tbody></table></div></div>");
                      ?>
                        <div class="col-md-4 align-self-center text-center">
                          <a href="Aziende_aggiorna_resp.php?Referente=true" style="text-align:center;" class="btn btn-outline-secondary" tabindex="-1" role="button" aria-disabled="true">Aggiorna i dati del referente</a>
                        </div>
                      <?php
                      } else {
                        print("<tr><td>Referente</td><td><p><div class='alert alert-warning' role='alert'>Non inserito</div></p></td></tr></tbody></table></div></div>");
                      ?>
                        <div class="col-md-4 align-self-center text-center">
                          <a href="Aziende_aggiorna_resp.php?Referente=true" style="text-align:center;" class="btn btn-outline-secondary" tabindex="-1" role="button" aria-disabled="true">Inserisci i dati del referente</a>
                        </div>
                      <?php
                      }
                      ?>
                </div>
              </div>
              <hr>
              <div class="container">
                <div class="row justify-content-between">
                  <div class="col-md-8">
                    <h5><a href="" style="color:#198754;" class="text-decoration-none">Dati responsabile aziendale</a></h5>
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
                          $query = "SELECT * FROM referenti_responsabili WHERE referenti_responsabili.Id_referente_responsabile=" . $Responsabile;
                          $risultato = mysqli_query($Connessione, $query);
                          if ($risultato) {
                            $riga = mysqli_fetch_array($risultato);
                            print("<tr><td>Nome</td><td>" . $riga['Nome'] . "</td></tr>");
                            print("<tr><td>Cognome</td><td>" . $riga['Cognome'] . "</td></tr>");
                            print("<tr><td>Data di nascita</td><td>" . $riga['Data_nascita'] . "</td></tr>");
                            print("<tr><td>Sesso</td><td>" . $riga['Sesso'] . "</td></tr>");
                            print("<tr><td>E-mail</td><td>" . $riga['Email'] . "</td></tr>");
                            print("<tr><td>Telefono</td><td>" . $riga['Telefono'] . "</td></tr>");
                            print("<tr><td>Indirizzo</td><td>" . $riga['Stato_residenza'] . ", " . $riga['Regione_residenza'] . ", " . $riga['Provincia_residenza'] . ", " . $riga['Citta_residenza'] . ", " . $riga['Indirizzo_residenza'] . " n. " . $riga['N_civico_residenza'] . "</td></tr></tbody></table></div></div>");
                          ?>
                            <div class="col-md-4 align-self-center text-center">
                              <a href="Aziende_aggiorna_resp.php?Responsabile=true" style="text-align:center;" class="btn btn-outline-success" tabindex="-1" role="button" aria-disabled="true">Aggiorna i dati del responsabile</a>
                            </div>
                          <?php
                          } else {
                            print("<tr><td>Responsabile</td><td><p><div class='alert alert-warning' role='alert'>Non inserito</div></p></td></tr></tbody></table></div></div>");
                          ?>
                            <div class="col-md-4 align-self-center text-center">
                              <a href="Aziende_aggiorna_resp.php?Responsabile=true" style="text-align:center;" class="btn btn-outline-success" tabindex="-1" role="button" aria-disabled="true">Inserisci i dati del responsabile</a>
                            </div>
                          <?php
                          }
                          mysqli_close($Connessione);
                          ?>
                    </div>
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