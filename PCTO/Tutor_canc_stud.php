<?php
ob_start();
session_start();
if (isset($_SESSION['Id_tutor_pcto'])) {
    if (isset($_GET['Ids']) && isset($_GET['Idr'])) {
        $ids = $_GET['Ids'];
        $idr = $_GET['Idr'];
        ini_set('display_errors', 0);
        $Connessione = mysqli_connect("localhost", "root", "");
        if (!$Connessione) {
            header("location: Tutor_in_carico_studenti.php?Id=$idr");
            exit;
        }
        $DB = mysqli_select_db($Connessione, "alternanza");
        if (!$DB) {
            header("location: Tutor_in_carico_studenti.php?Id=$idr");
            exit;
        }
        $query = "SELECT * FROM azienda_richieste, richieste_studenti WHERE azienda_richieste.Id_azienda_richiesta=$idr AND azienda_richieste.Id_azienda_richiesta=richieste_studenti.Cod_richiesta AND richieste_studenti.Cod_studente=$ids";
        $risultato = mysqli_query($Connessione, $query);
        $riga = mysqli_fetch_array($risultato);
        if (!$risultato) {
            die("La tabella selezionata non esiste " . mysqli_error($Connessione));
            header("location: Tutor_in_carico_studenti.php?Id=$idr");
            exit;
        } else if ($riga['Cod_tutor'] == $_SESSION['Id_tutor_pcto']) {
            $Richiesta = $riga['Id_richiesta_studente'];
            $query = "DELETE FROM richieste_studenti WHERE richieste_studenti.Id_richiesta_studente=$Richiesta";
            $risultato = mysqli_query($Connessione, $query);
            if (!$risultato) {
                die("La tabella selezionata non esiste " . mysqli_error($Connessione));
                mysqli_close($Connessione);
                header("location: Tutor_in_carico_studenti.php?Id=$idr");
                exit;
            } else {
                mysqli_close($Connessione);
                header("location: Tutor_in_carico_studenti.php?Id=$idr");
                exit;
            }
        }
        header("location: Tutor_in_carico_studenti.php?Id=$idr");
    } else {
        header("location: Tutor_in_carico_studenti.php?Id=$idr");
    }
} else {
    header("location: index.php?Sessione=Scaduta");
}
?>